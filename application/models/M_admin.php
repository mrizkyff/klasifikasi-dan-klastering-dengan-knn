<?php 
	class M_admin extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		// untuk menampilkan data ke dtatables dengan serverside
		function json() {
			// jangan pakai bintang nanti tidak bisa search
			$this->datatables->select('id, penulis, tahun, judul, minat, file');
			$this->datatables->from('ta_a11');
			$this->datatables->add_column('title','<p class="text-justify">$1 <span class="badge badge-secondary lead">$2</span></p>','judul,minat');
			$this->datatables->add_column('aksi', '
			<a href="upload/$6" target="_blank" class="badge-light"><i class="fas fa-file-pdf lead"></i></a>
			<a href="javascript:void(0);" class="edit_record badge badge-info" data-id="$1" data-penulis="$2" data-tahun="$3" data-judul="$4" data-minat="$5"><i class="fas fa-edit lead"></i> Edit</a>
			<a href="javascript:void(0);" class="hapus_record badge badge-danger" data-id="$1" data-judul="$4"><i class="fas fa-trash-alt lead"></i> Hapus</a>
			','id, penulis, tahun, judul, minat, file');

			return $this->datatables->generate();
		}
		public function getAllData(){
			return $this->db->get('ta_a11')->result_array();
		}		
		public function simpanData($data){
			return $this->db->insert('ta_a11', $data);	
		}
		public function hapusData($id){
			$this->db->where('id',$id);
			return $this->db->delete('ta_a11');
		}
		public function updateData($data,$id){
			$this->db->where('id',$id);
			return $this->db->update('ta_a11',$data);
		}

		
		
	}
 ?>