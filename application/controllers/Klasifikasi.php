<?php
    class Klasifikasi extends CI_Controller
    {
        public function __construct(){
            parent::__construct();
            $this->load->library('preprocessing');
            $this->load->library('vsm');
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
    }
    
?>