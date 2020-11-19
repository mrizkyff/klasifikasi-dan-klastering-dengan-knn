<?php
class Search extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_Search','search');
    }
    public function index(){
        $search_query = $this->input->get('query');
        $data['waktu_pencarian'] = 0;
        // cek query kosong atau tidak, kalau tidak kosong masuk ke proses pencarian. 
        // kalau kosong masuk ke main page
        if (isset($search_query)){
            // panggil method procesSearch + waktu kalkulasi
            $tic = microtime(true);
            $this->processSearch($search_query);
            $toc = microtime(true);
            $data['waktu_pencarian'] = $toc-$tic;

            // ambil data dari db
            $data['koleksi_skripsi'] = $this->search->tampilHasil()->result();
            $data['keyword'] = $search_query;
        }
        $this->load->view('template/public/pub_header');
        // $this->load->view('public/result_page', $data);
        $this->load->view('public/main_page', $data);
        $this->load->view('template/public/pub_footer');
        $this->load->view('public/scripts/main_page');

        // reset semua bobot setelah semua data tampil
        $this->search->resetAllBobot();
    }

    // method untuk proses pencarian
    public function processSearch($search_query){
        // panggil library preprocessing dan vsm
        $this->load->library('preprocessing');
        $this->load->library('vsm');

        // step 1 mendapatkan kata dasar dari query (preprocessing query)
        $search_query = $this->preprocessing->preprocess($search_query);

        // step 2 mendapatkan dokumen ke array
        $koleksi_dokumen = $this->search->doctoArray();
        $arrayDokumen = [];
        foreach ($koleksi_dokumen->result_array() as $row) {
            $arrayDoc = [
                'id_doc' => $row['id'],
                // 'dokumen' => implode(" ", $this->prep($row['judul']))
                // langsung ambil dari token aja, karena preprocessing korpus sudah dilakukan ketika input/create dokumen
                'dokumen' => $row['token'],
            ];
            array_push($arrayDokumen, $arrayDoc);
        }

        // step 3 mendapatkan ranking dengan VSM
        $allRank = $this->vsm->get_rank($search_query, $arrayDokumen);

        // step 4 memasukkan cos similarity ke database
        $jumlahDokumen = count($allRank['cosinus_similarity']);
        for ($i=0; $i < $jumlahDokumen; $i++) { 
            $id = $allRank['cosinus_similarity'][$i]['id_doc'];
            $bobot_cosim = $allRank['cosinus_similarity'][$i]['ranking'];
            $bobot_jaccard = $allRank['jaccard_similarity'][$i]['ranking'];
            $bobot_dice = $allRank['dice_similarity'][$i]['ranking'];
            $bobot_euclidean = $allRank['euclidean_similarity'][$i]['ranking'];

            // update bobot
            $data = array(
                'cosim' => $bobot_cosim,
                'jaccard' => $bobot_jaccard,
                'dice' => $bobot_dice,
                'euclidean' => $bobot_euclidean,
            );
            $this->search->updateBobot($data,$id);
        }
    }
}

?>