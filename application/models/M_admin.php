<?php 
	class M_admin extends CI_Model{
		public function tampilData(){
			return $this->db->get('daftarta');
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