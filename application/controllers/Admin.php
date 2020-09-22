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
		// $data['data_skripsi'] = $this->admin->tampilData();
		$this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('admin/dashboard');
		$this->load->view('template/admin/footer');
		$this->load->view('admin/scripts/dashboard');
		// load js script

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

	// method dumper
	public function h(){
		$this->load->view('index_dump');
		
	}
}
