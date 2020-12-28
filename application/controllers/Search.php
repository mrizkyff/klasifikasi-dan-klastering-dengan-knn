<?php
class Search extends CI_Controller
{
    public function __construct(){
        parent::__construct();
        $this->load->model('M_search','search');
    }
    function json() {
        header('Content-Type: application/json');
        echo $this->search->json();
    }
    public function index(){
        // panggil libarry preprocess
        $this->load->library('preprocessing');


        // get all prodi
        $data['fakultas'] = $this->search->getAllFakultas();
        $data['prodi'] = array(
            'fik' => $this->search->getProdiByKodeFak("fik"),
            'fib' => $this->search->getProdiByKodeFak("fib"),
            'feb' => $this->search->getProdiByKodeFak("feb"),
            'fkes' => $this->search->getProdiByKodeFak("fkes"),
            'ft' => $this->search->getProdiByKodeFak("ft"),
        );
        
        // get semua jumlah dokumen setiap prodi
        $allProdi = $this->search->getAllProdi();
        $data['numProdi'] = [];
        foreach ($allProdi as $prodi) {
            $data['numProdi'][$prodi->kode_prodi] = $this->search->getNumProdi($prodi->kode_prodi); 
        }

        // get semua jumlah dokumen setiap tahun
        $allTahun = [2015, 2016, 2017, 2018, 2019, 2020];
        $data['numTahun'] = [];
        for ($i=0; $i < 6; $i++) { 
            $data['numTahun'][$allTahun[$i]] = $this->search->getNumTahun($allTahun[$i]);
        }
        

        $search_query = $this->input->get('query');
        $data['waktu_pencarian'] = 0;
        // cek query kosong atau tidak, kalau tidak kosong masuk ke proses pencarian. 
        // kalau kosong masuk ke main page
        if (isset($search_query)){
            // reset semua bobot setelah semua data tampil jadi 0 
            $this->search->resetAllBobot();
            // panggil method procesSearch + waktu kalkulasi
            $tic = microtime(true);
            $this->processSearch($search_query);
            $toc = microtime(true);
            $data['waktu_pencarian'] = $toc-$tic;

            // ambil data dari db
            $data['koleksi_skripsi'] = $this->search->tampilHasil()->result();
            // kembalikan query ke form
            $data['keyword'] = $search_query;
            $data['keyword_term'] = $this->preprocessing->preprocess($search_query);
        }
        else{
            // reset semua bobot setelah semua data tampil jadi -1
            // -1 karena untuk ditampilkan semua di halaman awal
            $this->search->resetAllBobot(-1);
            $data['koleksi_skripsi'] = '';
        }
        $this->load->view('template/public/pub_header');
        $this->load->view('template/public/pub_navbar');
        $this->load->view('public/main_page', $data);
        $this->load->view('template/public/pub_footer');
        $this->load->view('public/scripts/main_page');
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
        $data_batch =[];
        for ($i=0; $i < $jumlahDokumen; $i++) { 
            $id = $allRank['cosinus_similarity'][$i]['id_doc'];
            $bobot_cosim = $allRank['cosinus_similarity'][$i]['ranking'];
            $bobot_jaccard = $allRank['jaccard_similarity'][$i]['ranking'];
            $bobot_dice = $allRank['dice_similarity'][$i]['ranking'];
            // $bobot_euclidean = $allRank['euclidean_similarity'][$i]['ranking'];

            // update bobot
            $data_batch[] = array(
                'id' => $id,
                'cosim' => round($bobot_cosim*100,4),
                // 'jaccard' => round($bobot_jaccard*100,4),
                // 'dice' => round($bobot_dice*100,4),
                // 'euclidean' => $bobot_euclidean,
            );
        }
        $this->search->updateBobot($data_batch);
    }
    
}

?>