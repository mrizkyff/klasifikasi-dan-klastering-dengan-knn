<?php

	defined('BASEPATH') OR exit('No direct script access allowed');
	/**
	 * 
	 */
	class Skripsi extends CI_Controller
	{
		function __construct(){
			parent::__construct();
	
			if($this->session->userdata('status') != "login"){
				redirect(base_url("index.php/login"));
			}
		}

		public function index(){
			$data['skripsi'] = $this->m_skripsi->tampilData()->result();
			$this->load->view('template/header');
			$this->load->view('template/sidebar');
			$this->load->view('skripsi', $data);
			$this->load->view('template/footer');
		}

		public function tambahAksi($filepdf){
			$penulis = $this->input->post('penulis');
			$tahun = $this->input->post('tahun');
			$judul = $this->input->post('judul');
			$abstrak = $this->input->post('abstrak');
			$bobot = 0;
			$download = 1;
			$show = 1;

			$data = array(
				'penulis' => $penulis,
				'tahun' => $tahun,
				'judul' => $judul,
				'abstrak' => $abstrak,
				'file' => $filepdf,
				'bobot' => $bobot,
				'download' => $download,
				'show' => $show
			);

			// $this->m_skripsi->simpanData($data);
			if($this->m_skripsi->simpanData($data)){
				$this->session->set_flashdata('sukses_tambah','Dokumen Berhasil Disimpan');
			}
			else{
				$this->session->set_flashdata('gagal_tambah','Dokumen Gagal Disimpan');
			}
			redirect('skripsi/index');
		}

		public function do_upload()
        {
                $config['upload_path']          = './upload/';
                $config['allowed_types']        = 'pdf';
                $config['max_size']             = 1024;
                // $config['max_width']            = 1024;
                // $config['max_height']           = 768;

                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('fileupload'))
                {
                        $error = array('error' => $this->upload->display_errors());

                        // $this->load->view('upload_form', $error);
						// var_dump($error);
						$this->session->set_flashdata('gagal_tambah','Dokumen Gagal Disimpan, File Error!');
						redirect('skripsi/index');
                }
                else
                {
                        // $upload_data = array('upload_data' => $this->upload->data());
                        // $this->load->view('upload_success', $data);
                        // var_dump($upload_data);
                		$upload_data = $this->upload->data();
                        // $data = array(
                        // 	'file' => $upload_data['file_name']
                        // );

                        $this->tambahAksi($upload_data['file_name']);
                        // var_dump($data);

                }
        }
        public function hapusAksi(){
        	$id = $this->input->get('id');
			// $this->m_skripsi->hapusData($id);
			if(!$this->m_skripsi->hapusData($id)){
				$this->session->set_flashdata('gagal_hapus','Dokumen Gagal dihapus!');
			}
			else{
				$this->session->set_flashdata('sukses_hapus','Dokumen Berhasil dihapus!');
			}
        	redirect('skripsi/index');
        }
        public function updateAksi(){
        	$id = $this->input->post('id');
        	$penulis = $this->input->post('penulis');
			$tahun = $this->input->post('tahun');
			$judul = $this->input->post('judul');
			$abstrak = $this->input->post('abstrak');

			$data = array(
				'penulis' => $penulis,
				'tahun' => $tahun,
				'judul' => $judul,
				'abstrak' => $abstrak,
			);
			// $this->m_skripsi->updateData($data,$id);
			if(!$this->m_skripsi->updateData($data,$id)){
				$this->session->set_flashdata('gagal_edit','Dokumen Gagal di Update!');
			}
			else{
				$this->session->set_flashdata('sukses_edit','Dokumen Berhasil di Update!');
			}
        	redirect('skripsi/index');
        }

        public function prep($query){
        	// $query = $this->input->post('query');
        	$this->load->library('preprocessing');
        	return $this->preprocessing->preprocess($query);
        	// echo implode( ", ", $data);
        	// echo $this->preprocessing->case_folding($query);
        	// echo $data;
        }
        public function vsm($query, $dokumen){
        	$this->load->library('vsm');
        	return $this->vsm->get_rank($query, $dokumen);
        }

        public function processSearch($kueri){
        	// step 1 mendapatkan kata dasar dari query
        	$kueri = $this->prep($kueri);

        	// step 2 mendapatkan dokumen ke array
        	$query = $this->m_skripsi->doctoArray();
        	$arrayDokumen = [];
        	foreach ($query->result_array() as $row) {
				$arrayDoc = [
					'id_doc' => $row['id'],
					'dokumen' => implode(" ", $this->prep($row['judul']))
				];
				array_push($arrayDokumen, $arrayDoc);
			}
			// var_dump($kueri);
			// var_dump($arrayDokumen);

			// step 3 mendapatkan ranking dengan VSM
			$rank = $this->vsm($kueri, $arrayDokumen);
			// var_dump($rank);

			// step 4 memasukkan cos similarity ke database
			$jumlahDokumen = count($rank);
			for ($i=0; $i < $jumlahDokumen; $i++) { 
				$id = $rank[$i]['id_doc'];
				$bobot = $rank[$i]['ranking'];
				// update
				$data = array(
					'bobot' => $bobot
				);
				$this->m_skripsi->updateBobot($data,$id);
			}
        }
        public function search(){
			$kueri = $this->input->post('query');
			$this->processSearch($kueri);
			$data['skripsi'] = $this->m_skripsi->tampilHasil()->result();
			$data['pencarian'] = $kueri;
			$this->load->view('template/header',$data);
			$this->load->view('template/sidebar');
			// $this->load->view('hasilPencarian', $data);
			$this->load->view('template/tableContent',$data);
			$this->load->view('template/footer');
		}

		public function lock(){
			$id = $this->input->get('id');
			$status = $this->input->get('status');
			$edit = 0;
			if ($status == 0){
				$edit = 1;
			}
			else if($status == 1){
				$edit = 0;
			}
			else{
				$edit = 0;
			}
			$data = array(
				'download' => $edit
			);
			// $this->m_skripsi->lock($data, $id);
			if($this->m_skripsi->lock($data, $id)){
				$this->session->set_flashdata('sukses_lock','Dokumen berhasil di Lock/Unlock!');
			}else{
				$this->session->set_flashdata('gagal_lock','Dokumen Gagal di Lock/Unlock!');
			}
			$this->index();
		}
		
		public function show(){
			$id = $this->input->get('id');
			$status = $this->input->get('status');
			$edit = 0;
			if ($status == 0){
				$edit = 1;
			}
			else if($status == 1){
				$edit = 0;
			}
			else{
				$edit = 0;
			}
			$data = array(
				'show' => $edit
			);
			// $this->m_skripsi->show($data, $id);
			if($this->m_skripsi->show($data, $id)){
				$this->session->set_flashdata('sukses_show','Dokumen berhasil di Seen/Unseen!');
			}else{
				$this->session->set_flashdata('gagal_show','Dokumen gagal di Seen/Unseen!');
			}
			$this->index();
		}
		
	}
?>