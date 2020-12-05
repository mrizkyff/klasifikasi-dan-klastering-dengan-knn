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
		$this->load->view('admin/korpus');
		$this->load->view('template/admin/footer');
		$this->load->view('admin/scripts/korpus');

	}

	public function rak(){
		// ambil data rak
		$data['rak'] = $this->admin->getAllRak();
		$this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('admin/rak',$data);
		$this->load->view('template/admin/footer');
		$this->load->view('admin/scripts/rak');
	}

	public function update_data(){
		$data = $this->input->post();
		$id = $data['id'];
		$data = array(
			'penulis' => $data['penulis'],
			'tahun' => $data['tahun'],
			'judul' => $data['judul'],
			'nim' => $data['nim'],
			'token' => implode(',',$this->prep($data['judul'])),
			'kode_prodi' => strtolower(substr($data['nim'],0,3)),
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
		$tanggal = date("Y-m-d H:i:s");
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
			$minat = $this->input->post('minat');
			$nim = $this->input->post('nim');
			// token adalah bentuk baku dari judul karena sudah dilakukan preprocessing
			$token = implode(',',$this->prep($judul));

			// parsing prodi
			$prodi = strtolower(substr($nim,0,3));

			$data = array(
				'penulis' => $penulis,
				'tahun' => $tahun,
				'judul' => $judul,
				'nim' => $nim,
				'token' => $token,
				'file' => $nama_file,
				'timestamp' => $tanggal,
				'kode_prodi' => $prodi
			);

			$result = $this->admin->simpanData($data);
			echo json_encode($result);
		}
		
	}
	

	// method untuk preprocessing judul pada form input data
	public function prep($teks_dokumen){
		$this->load->library('preprocessing');
		return $this->preprocessing->preprocess($teks_dokumen);
	}
}
