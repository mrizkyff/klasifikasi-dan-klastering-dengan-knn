<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_admin','admin');

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	function json() {
        header('Content-Type: application/json');
        echo $this->admin->json();
    }

	public function index(){
		$this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('admin/dashboard');
		$this->load->view('template/admin/footer');
		$this->load->view('admin/scripts/dashboard');

	}

	public function update_data(){
		$data = $this->input->post();
		$id = $data['id'];
		$data = array(
			'penulis' => $data['penulis'],
			'tahun' => $data['tahun'],
			'label' => $data['jurusan'],
			'judul' => $data['judul'],
			'abstrak' => $data['abstrak'],
		);
		$data = $this->admin->updateData($data,$id);
		echo json_encode($data);
	}

	public function hapus_data(){
		$id = $this->input->post('id_hapus');
		$data = $this->admin->hapusData($id);
		echo json_encode($data);
	}


	function do_upload(){
		$config['upload_path']          = './upload/';
		$config['allowed_types']        = 'pdf';
		$config['encrypt_name'] 		= TRUE;
		
		$this->load->library('upload',$config);
		if($this->upload->do_upload("file")){
			$data = array('upload_data' => $this->upload->data());
			$nama_file = $data['upload_data']['file_name'];

			$penulis = $this->input->post('penulis');
			$tahun = $this->input->post('tahun');
			$judul = $this->input->post('judul');
			$abstrak = $this->input->post('abstrak');
			$jurusan = $this->input->post('jurusan');

			$data = array(
				'penulis' => $penulis,
				'tahun' => $tahun,
				'judul' => $judul,
				'label' => $jurusan,
				'abstrak' => $abstrak,
				'file' => $nama_file,
			);

			$result = $this->admin->simpanData($data);
			echo json_encode($result);
		}
		
	}
	// method dumper
	public function h(){
		$this->load->view('index_dump');
		
	}
	public function i(){
		var_dump($this->input->post());
		// var_dump($this->input->file());
		echo json_encode();
	}
}
