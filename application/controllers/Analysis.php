<?php
    class Analysis extends CI_Controller
    {
        public function __construct(){
            parent::__construct();
            $this->load->model('M_debug','mdebug');
            if($this->session->userdata('status') != "login"){
                redirect(base_url("login"));
            }
        }
        public function index(){
            $this->load->view('template/admin/header');
            $this->load->view('template/admin/sidebar');
            $this->load->view('admin/analytics');
            $this->load->view('template/admin/footer');
            $this->load->view('admin/scripts/analytics');
            

        }
        // method preprocessing
        public function prep($teks_dokumen){
            $this->load->library('preprocessing');
            return $this->preprocessing->preprocess($teks_dokumen);
        }
        public function vsm($search_query, $dokumen, $debug){
            $this->load->library('vsm');
            return $this->vsm->get_rank($search_query, $dokumen, $debug);
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
            // // step 1 mengumpulkan korpus dan kueri
            $data = $this->input->post();
            $korpus = [];
            $korpus_output = [];
            $kumpulan_term  = [];
            foreach ($data as $key => $value) {
                    $korpus[$key] = implode(' ',$this->prep($value));
                    $korpus_output[$key] = implode(',<br>',$this->prep($value));
                    foreach ($this->prep($value) as $indeks => $term) {
                        array_push($kumpulan_term, $term);
                    }
            }
            $kumpulan_term = array_unique($kumpulan_term);
        
            // mengurutkan index koleksi term
            $koleksi_term = [];
            foreach ($kumpulan_term as $indeks => $value) {
                array_push($koleksi_term, $value);
            }

            
            // step 2 preprocessing kueri 
            $kueri = $this->prep($this->input->post('query'));

            // step 3 buat korpus ke dalam array
            $arrayDokumen = [];
            // var_dump($korpus);
            foreach ($korpus as $key => $value) {
                // print_r($this->prep($dokumen));
                if ($key != 'query'){
                    $arrayDoc = [
                        'id_doc' => $key,
                        'dokumen' => implode(' ',$this->prep($value)),
                    ];
                    array_push($arrayDokumen, $arrayDoc);
                }
            }
            // print_r($arrayDokumen);

            // step 3 proses perhitungan
            $rank = $this->vsm($kueri, $arrayDokumen, $debug=false);
            // print_r($rank);

            // menghilangkan nested object pada dokumen term
            $dokumen_term = [];
            foreach ($rank['dokumen_term'] as $key => $value) {
                foreach ($value as $key1 => $value1) {
                    $dokumen_term[$key] = $value1;
                }
            }

            // menangkap dan proses cosine document dari proses vsm
            $cosine_document = [];
            foreach ($rank['cosine_document'] as $key => $value) {
                $cosine_document[$key] = $value;
            }

            // query term
            $query_term = [];
            foreach ($kueri as $key => $value) {
                $query_term[$value] = 1;
            }

            // gabungkan dokumen_term dengan $query_term
            array_push($dokumen_term, $query_term);


            $output = [
                'korpus' => $korpus_output,
                'koleksi_term' => $koleksi_term,
                'dokumen_term' => $dokumen_term,
                'kueri' => $query_term,
                'cosine_document' => $cosine_document,
            ];

            echo json_encode($output);

        }
        public function debug(){
            // // step 1 mengumpulkan korpus dan kueri
            // $kueri = 'Katalog Digital Pariwisata Semarang Berbasis Augmented Reality Untuk menjadikan Semarang Sebagai Smart City';
            $kueri = 'Daun kuning';
            $korpus = array(
                'g1' => 'Daun berwarna kuning',
                'g2' => 'Daun berwarna putih',
                'g3' => 'Batang berwarna kuning',
            );

            
            // step 2 preprocessing kueri 
            $kueri = $this->prep($kueri);

            // buat korpus ke dalam array
            $arrayDokumen = [];
            // var_dump($korpus);
            foreach ($korpus as $key => $value) {
                // print_r($this->prep($dokumen));
                if ($key != 'query'){
                    $arrayDoc = [
                        'id_doc' => $key,
                        'dokumen' => implode(' ',$this->prep($value)),
                    ];
                    array_push($arrayDokumen, $arrayDoc);
                }
            }
            // print_r($arrayDokumen);

            print_r($arrayDokumen);
            print_r($kueri);
            die();
            $rank = $this->vsm($kueri, $arrayDokumen, $debug=false);
            print_r($rank);

        }
    }
    
?>