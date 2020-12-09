<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class Admin extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('m_admin','admin');
		$this->load->model('m_search','search');

		if($this->session->userdata('status') != "login"){
			redirect(base_url("login"));
		}
	}

	function json() {
        header('Content-Type: application/json');
        echo $this->admin->json();
	}

	public function index(){
		$data['total_doc'] = $this->admin->countAllDoc(); 
		$this->load->view('template/admin/header');
		$this->load->view('template/admin/sidebar');
		$this->load->view('admin/dashboard', $data);
		$this->load->view('template/admin/footer');
		$this->load->view('admin/scripts/dashboard');
	}	

	public function korpus(){
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

	public function getDataRak(){
		$data = $this->admin->getAllRak();
		echo json_encode($data);
	}
	public function getDataDocPerProdi(){
		$data_prodi = $this->search->getAllProdi();
		$data = [];
		foreach ($data_prodi as $key) {
			array_push($data, ['kode_prodi' => $key->kode_prodi, 'desc_prodi' => $key->desc_prodi, 'jml' => $this->search->getNumProdi($key->kode_prodi)]);
		}
		echo json_encode($data);
	}

	public function getDataDocPerTahun(){
		// get semua jumlah dokumen setiap tahun
        $data = [];
        for ($i=2015; $i <= 2020; $i++) { 
			// array_push($data, [$i => $this->search->getNumTahun($i)]);
			$data[$i] = $this->search->getNumTahun($i);
		}
		echo json_encode($data);
	}

	public function cek_lokasi(){
		$alpha = $this->input->post('alpha');
		$numeric = $this->input->post('numeric');
		$kode_lokasi = strtolower($alpha).$numeric;
		$data = $this->admin->cekLokasi($kode_lokasi);
		echo json_encode($data);
	}

	public function update_data(){
		$data = $this->input->post();
		$alpha = $data['lokasi_alpha_edit'];
		$numeric = $data['lokasi_numeric_edit'];
		$kode_lokasi = strtolower($alpha).$numeric;
		$kode_lokasi_sekarang = str_replace(".", "", strtolower($data['lokasi_sekarang']));
		$id = $data['id'];
		$data = array(
			'penulis' => $data['penulis'],
			'tahun' => $data['tahun'],
			'judul' => $data['judul'],
			'nim' => $data['nim'],
			'token' => implode(',',$this->prep($data['judul'])),
			'kode_prodi' => strtolower(substr($data['nim'],0,3)),
			'kode_rak' => $kode_lokasi,
		);
		$data = $this->admin->updateData($data,$id);

		// kurangi jumlah lokasi yang dipilih
		$data = $this->admin->updateTersedia($kode_lokasi);
		// tambah jumlah lokasi sekarang
		$data = $this->admin->updateTersediaSekarang($kode_lokasi_sekarang);
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
			$alpha = $this->input->post('lokasi_alpha');
			$numeric = $this->input->post('lokasi_numeric');
			$kode_lokasi = strtolower($alpha).$numeric;
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
				'kode_prodi' => $prodi,
				'kode_rak' => $kode_lokasi,
				'tag' => $tahun.$prodi,
			);

			// simpan ke tb_dokumen
			$result = $this->admin->simpanData($data);
			// kurangi lokasi tersedia
			$result = $this->admin->updateTersedia($kode_lokasi);
			echo json_encode($result);
		}
		
	}
	

	// method untuk preprocessing judul pada form input data
	public function prep($teks_dokumen){
		$this->load->library('preprocessing');
		return $this->preprocessing->preprocess($teks_dokumen);
	}
}
