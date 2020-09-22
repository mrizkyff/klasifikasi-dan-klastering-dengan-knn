<?php 
	class M_admin extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		// untuk menampilkan data ke dtatables
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

		public function doctoArray(){
			$query = $this->db->query("SELECT * FROM daftarta_label");
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
			$this->db->update('daftarta_label',$data);
		}

		public function tampilHasil(){
			$query = $this->db->from("daftarta_label")->order_by("daftarta_label.bobot desc")->get();
			return $query;
		}
		
		public function lock($data, $id){
			$this->db->where('id',$id);
			return $this->db->update('daftarta_label',$data);
		}
		public function show($data, $id){
			$this->db->where('id',$id);
			return $this->db->update('daftarta_label',$data);
		}
	}
 ?>