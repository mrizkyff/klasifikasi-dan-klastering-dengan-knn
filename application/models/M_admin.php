<?php 
	class M_admin extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		function json() {
			// jangan pakai bintang nanti tidak bisa search
			$this->datatables->select('id, penulis, tahun, judul, abstrak');
			$this->datatables->from('daftarta');
			$this->datatables->add_column('aksi', '<a class="btn-info btn-sm" href="javascript:;">edit</a> | <a class="btn-danger btn-sm" href="world/delete/$1">delete</a>', 'ID');
			// $this->datatables->add_column('aksi','<a href="javascript:;" class="btn btn-info btn-xs item_edit">Edit</a>');
			return $this->datatables->generate();
		}		
		public function tampilData(){
			$this->db->order_by('tahun','DESC');
			return $this->db->get('daftarta')->result();
		}
		public function simpanData($data){
			return $this->db->insert('daftarta', $data);	
		}
		public function hapusData($id){
			$this->db->where('id',$id);
			return $this->db->delete('daftarta');
		}
		public function updateData($data,$id){
			$this->db->where('id',$id);
			return $this->db->update('daftarta',$data);
		}

		public function doctoArray(){
			$query = $this->db->query("SELECT * FROM daftarta");
			// $arrayDokumen = [];
			// foreach ($query->result_array() as $row) {
			// 	$arrayDoc = [
			// 		'id_doc' => $row['id'],
			// 		'dokumen' => implode(" ", $this->skripsi->prep($row['judul']))
			// 	];
			// 	array_push($arrayDokumen, $arrayDoc);
			// }
			// return $arrayDokumen;
			return $query;
		}

		public function updateBobot($data, $id){
			$this->db->where('id',$id);
			$this->db->update('daftarta',$data);
		}

		public function tampilHasil(){
			$query = $this->db->from("daftarta")->order_by("daftarta.bobot desc")->get();
			return $query;
		}
		
		public function lock($data, $id){
			$this->db->where('id',$id);
			return $this->db->update('daftarta',$data);
		}
		public function show($data, $id){
			$this->db->where('id',$id);
			return $this->db->update('daftarta',$data);
		}
	}
 ?>