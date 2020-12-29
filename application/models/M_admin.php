<?php 
	class M_admin extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		// untuk menampilkan data ke dtatables dengan serverside
		function json() {
			// jangan pakai bintang nanti tidak bisa search
			$this->datatables->select('tb_dokumen.id, penulis, tahun, judul, file, timestamp, nim, desc_prodi, desc_fak, lokasi');
			$this->datatables->from('tb_dokumen');
			$this->datatables->join('tb_prodi', 'tb_dokumen.kode_prodi = tb_prodi.kode_prodi');
			$this->datatables->join('tb_fakultas', 'tb_prodi.kode_fak = tb_fakultas.kode_fak');
			$this->datatables->join('tb_rak', 'tb_dokumen.kode_rak = tb_rak.id', 'left');
			$this->datatables->add_column('author','<p><b>$1</b><br>$2</p>','penulis, nim');
			$this->datatables->add_column('title','<p class="text-justify">$1</p>','judul');
			$this->datatables->add_column('aksi', '
			<a href="http://mrizkyff.com/upload/$5" target="_blank" class="badge-light"><i class="fas fa-file-pdf lead"></i></a>
			<a href="javascript:void(0);" class="edit_record badge badge-info" data-id="$1" data-penulis="$2" data-tahun="$3" data-judul="$4" data-nim="$6" data-lokasi="$7"><i class="fas fa-edit lead"></i> Edit</a>
			<a href="javascript:void(0);" class="hapus_record badge badge-danger" data-id="$1" data-judul="$4" data-lokasi="$7"><i class="fas fa-trash-alt lead"></i> Hapus</a>
			','id, penulis, tahun, judul, file, nim, lokasi');

			return $this->datatables->generate();
		}
		public function getAllData(){
			return $this->db->get('tb_dokumen')->result_array();
		}		
		public function simpanData($data){
			return $this->db->insert('tb_dokumen', $data);	
		}
		public function hapusData($id){
			$this->db->where('id',$id);
			return $this->db->delete('tb_dokumen');
		}
		public function updateData($data,$id){
			$this->db->where('id',$id);
			return $this->db->update('tb_dokumen',$data);
		}
		public function getAllRak(){
			return $this->db->query("SELECT * FROM tb_rak ORDER BY substring(id,1,1), substring(id,2)+0")->result();
		}
		public function cekLokasi($kode_lokasi){
			$this->db->select('tersedia');
			$this->db->where('id', $kode_lokasi);
			return $this->db->get('tb_rak')->result();
		}
		public function updateTersedia($kode_lokasi){
			// kurangi tersedia dengan kode lokasi yang dipilih
			$this->db->where('id',$kode_lokasi);
			$this->db->set('tersedia','tersedia-1',false);
			return $this->db->update('tb_rak');
		}
		public function updateTersediaSekarang($kode_lokasi_sekarang){
			// tambah tersedia dengan lokasi yang dipilih
			$this->db->where('id',$kode_lokasi_sekarang);
			$this->db->set('tersedia','tersedia+1', false);
			return $this->db->update('tb_rak');
		}
		public function countAllDoc(){
			return $this->db->get('tb_dokumen')->num_rows();
		}
		
		
	}
 ?>