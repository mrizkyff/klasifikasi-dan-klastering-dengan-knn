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
		// $this->load->view('admin/scripts/dashboard');
		// load js script

	}
	public function h(){
		$this->load->view('index_dump');
		
	}
}
