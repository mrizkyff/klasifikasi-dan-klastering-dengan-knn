<?php
    class Analysis extends CI_Controller
    {
        public function __construct(){
            parent::__construct();
            $this->load->model('M_debug','mdebug');
        }
        public function index(){
            $d1 = 'Implementasi Eigenface Pada Sistem Pencari Data Personal Berbasis Pengenalan Wajah';
            $d2 = 'Implementasi Algoritma Vigenere Cipher dan Playfair Cipher dalam Kriptografi Citra';
            $d3 = 'Sistem Rekomendasi Hero Dota 2 Menggunakan Klasifikasi Naive Bayes -';
            $query = 'implementasi pencarian dengan algoritma naive bayes?-,.#123^A';
            $dokumen = array(
                'd1' => $d1,
                'd2' => $d2,
                'd3' => $d3,
                'query' => $query,
            );
            print_r($dokumen);
            foreach ($dokumen as $doc) {
                print_r($this->prep($doc));
            }
            

        }
        // method preprocessing
        public function prep($teks_dokumen){
            $this->load->library('preprocessing');
            return $this->preprocessing->preprocess($teks_dokumen);
        }
        public function vsm($search_query, $dokumen){
            $this->load->library('vsm');
            return $this->vsm->get_rank($search_query, $dokumen);
        }
        // method untuk convert judul ke bentuk token
        public function generate_token(){
            $korpus = $this->mdebug->get_all_corpus();
            // $id = $korpus['id'];
            // $judul = $korpus['judul'];
            foreach ($korpus as $key => $value) {
                $data = array(
                    'token' => implode(' ',$this->prep($value['judul'])),
                );
                $this->mdebug->update_token($value['id'],$data);
            }
            echo 'sukses';
            // print_r($korpus);
        }
        public function proses_pencarian(){
            // step 1 mengumpulkan korpus dan kueri
            $kueri = 'Katalog Digital Pariwisata Semarang Berbasis Augmented Reality Untuk menjadikan Semarang Sebagai Smart City';
            // $kueri = 'Daun berwarna putih';
            $korpus = array(
                'g1' => 'Katalog Digital Pariwisata Semarang Berbasis Augmented Reality Untuk menjadikan Semarang Sebagai Smart City',
                'g2' => 'Penerapan Teknologi Augmented Reality Sebagai Media Promosi Universitas Dian Nuswantoro Berbasis Android',
                'g3' => 'RANCANG BANGUN APLIKASI KATALOG MAKANAN KOTA SEMARANG SEBAGAI SARANA REFERENSI BAGI WISATAWAN',
            );

            // step 2 preprocessing kueri 
            $kueri = $this->prep($kueri);

            // buat korpus ke dalam array
            $arrayDokumen = [];
            // var_dump($korpus);
            foreach ($korpus as $key => $value) {
                // print_r($this->prep($dokumen));
                $arrayDoc = [
                    'id_doc' => $key,
                    'dokumen' => implode(' ',$this->prep($value)),
                ];
                array_push($arrayDokumen, $arrayDoc);
            }
            print_r($arrayDokumen);

            $rank = $this->vsm($kueri, $arrayDokumen);
            print_r($rank);
        }
    }
    
?>