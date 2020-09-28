<?php 
	class M_admin extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		// untuk menampilkan data ke dtatables dengan serverside
		function json() {
			// jangan pakai bintang nanti tidak bisa search
			$this->datatables->select('id, penulis, tahun, judul, abstrak, label, file');
			$this->datatables->from('daftarta_label');
			$this->datatables->add_column('title','<p class="text-justify">$1 <span class="badge badge-secondary lead">$2</span></p>','judul,label');
			$this->datatables->add_column('abstract','<p class="text-justify">$1</p>','abstrak');
			$this->datatables->add_column('aksi', '
			<a href="../upload/$7" target="_blank" class="badge-light"><i class="fas fa-file-pdf lead"></i></a>
			<a href="javascript:void(0);" class="edit_record badge badge-info" data-id="$1" data-penulis="$2" data-tahun="$3" data-judul="$4" data-abstrak="$5" data-label="$6"><i class="fas fa-edit lead"></i> Edit</a>
			<a href="javascript:void(0);" class="hapus_record badge badge-danger" data-id="$1" data-judul="$4"><i class="fas fa-trash-alt lead"></i> Hapus</a>
			','id, penulis, tahun, judul, abstrak, label, file');

			return $this->datatables->generate();
		}
		public function getAllData(){
			return $this->db->get('daftarta_label')->result_array();
		}		
		public function simpanData($data){
			return $this->db->insert('daftarta_label', $data);	
		}
		public function hapusData($id){
			$this->db->where('id',$id);
			return $this->db->delete('daftarta_label');
		}
		public function updateData($data,$id){
			$this->db->where('id',$id);
			return $this->db->update('daftarta_label',$data);
		}

		
		
	}
 ?>