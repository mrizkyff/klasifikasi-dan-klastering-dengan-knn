<?php
    class Debug extends CI_Controller
    {
        public function __construct(){
            parent::__construct();
            $this->load->model('M_Search','search');
        }
        public function index(){
            $d1 = 'Implementasi Eigenface Pada Sistem Pencari Data Personal Berbasis Pengenalan Wajah';
            $d2 = 'Implementasi Algoritma Vigenere Cipher dan Playfair Cipher dalam Kriptografi Citra';
            $d3 = 'Sistem Rekomendasi Hero Dota 2 Menggunakan Klasifikasi Naive Bayes';
            $query = 'implementasi pencarian dengan algoritma naive bayes';
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
    }
    
?>