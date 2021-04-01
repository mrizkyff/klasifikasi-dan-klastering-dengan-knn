<?php
    class Klasifikasi extends CI_Controller
    {
        public function __construct(){
            parent::__construct();
            $this->load->library('preprocessing');
            $this->load->library('vsm');
            $this->load->model('M_search','search');
            $this->load->model('M_debug','mdebug');


        }
        public function proses_knn(){
            // tentukan query
            $query = 'besar wasit indonesia sulit percaya tanding sepakbola adil tim nasional benah total';

            // tentukan korpus
            $korpus = array(
                'g1' => 'tokoh politik partai rapat bahas koalisi beru jelang pemilu 2014 pilkada 2012 2013',
                'g2' => 'partai politik percaya besar partai utama penting partai butuh rakyat',
                'g3' => 'partai demokrat menang pemilu 2009 figur sby partai gokar usaha menang 2012 tanding partai seru',
                'g4' => 'tanding pertama persema persebaya malang untung rumah',
                'g7' => 'tanding sepakbola persebaya kampanye pilkada 2010 kota surabaya tunda',
                'g8' => 'sepakbola indonesia bangkit manajemen tim tanding tiket tingkat fokus menang tim',
            );

            // preprocessing query
            $query = $this->preprocessing->preprocess($query);


            // buat korpus ke dalam array
            $arrayDokumen = [];
            // var_dump($korpus);
            foreach ($korpus as $key => $value) {
                // print_r($this->prep($dokumen));
                if ($key != 'query'){
                    $arrayDoc = [
                        'id_doc' => $key,
                        'dokumen' => implode(' ',$this->preprocessing->preprocess($value)),
                    ];
                    array_push($arrayDokumen, $arrayDoc);
                };
            }
            $rank = $this->vsm->get_rank($query, $arrayDokumen, $debug=false);

            print_r($rank);

        }
        public function main_knn(){
            // contoh query
            $query = 'tingkat';


            // step 1 mendapatkan kata dasar dari query (preprocessing query)
            $query = $this->preprocessing->preprocess($query);

            // step 2 mendapatkan dokumen ke array
            $koleksi_dokumen = $this->search->doctoArray();
            $arrayDokumen = [];
            foreach ($koleksi_dokumen->result_array() as $row) {
                $arrayDoc = [
                    'id_doc' => $row['id'],
                    'dokumen' => $row['stem'],
                ];
                array_push($arrayDokumen, $arrayDoc);
            }

            // step 3 mendapatkan ranking dengan VSM
            $allRank = $this->vsm->get_rank($query, $arrayDokumen);

            // step 4 memasukkan cos similarity ke database
            $jumlahDokumen = count($allRank['cosinus_similarity']);
            $data_batch =[];
            $data_cosim = [];
            for ($i=0; $i < $jumlahDokumen; $i++) { 
                $id = $allRank['cosinus_similarity'][$i]['id_doc'];
                $bobot_cosim = $allRank['cosinus_similarity'][$i]['ranking'];
                $bobot_jaccard = $allRank['jaccard_similarity'][$i]['ranking'];
                $bobot_dice = $allRank['dice_similarity'][$i]['ranking'];

                // update bobot
                $data_batch[] = array(
                    'id' => $id,
                    'cosim' => round($bobot_cosim,4),
                    'jaccard' => round($bobot_jaccard,4),
                    'dice' => round($bobot_dice,4),
                );
            }

            // update bobot di database
            $this->search->updateBobot($data_batch);

            // step 5 tentukan jumlah K
            $k = 4;


            // step 6 urutkan dari yang nilai cosim tertinggi
            // ambil data dari database 
            $hasil_knn = $this->search->doctoArray()->result_array();
            $jarak = array();
            foreach ($hasil_knn as $key => $value) {
                $jarak[$key] = $value['cosim'];
            }
            // urutkan data dari yang jaraknya paling dekat (cosim paling tinggi)
            array_multisort($jarak, SORT_DESC, $hasil_knn);

            // step 7 ambil data sesuai banyaknya jumlah k
            // lalu hitung jumlah data pada masing2 class
            $x = 0;
            $olahraga = 0;
            $politik = 0;
            foreach ($hasil_knn as $key => $value) {
                if($x < $k){
                    if($value['class'] == 'politik' && $value['cosim'] != 0){
                        $politik += 1;
                    }
                    else if($value['class'] == 'olahraga' && $value['cosim'] != 0){
                        $olahraga += 1;
                    }
                    print_r([$value['id'] => $value['cosim'].' '.$value['class']]);
                }
                else{

                }
                $x += 1;
            }

            // tampilkan jumlah olahraga/politik
            print_r(['olahraga' => $olahraga, 'politik' => $politik]);
            // tentukan label dari jumlah yang terbanyak
            if ($olahraga > $politik){
                echo 'olahraga';
            }
            else if($olahraga < $politik){
                echo 'politik';
            }
            else if($olahraga == $politik){
                // tambahkan/kurangi K
                // atau jumlahkan tingkat kemiripan dari setiap dokumen untuk kelas yang sama
            }


        }
        public function generate_token(){
            $korpus = $this->mdebug->get_all_corpus();
            // $id = $korpus['id'];
            // $judul = $korpus['judul'];
            foreach ($korpus as $key => $value) {
                $data = array(
                    'stem' => implode(' ',$this->preprocessing->preprocess($value['teks'])),
                );
                $this->mdebug->update_token($value['id'],$data);
            }
            echo 'sukses';
            // print_r($korpus);
        }
    }
    
?>