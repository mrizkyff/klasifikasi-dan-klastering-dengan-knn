<?php 
	class M_admin extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		// untuk menampilkan data ke dtatables
		function json() {
			// jangan pakai bintang nanti tidak bisa search
			$this->datatables->select('id, penulis, tahun, judul, abstrak, label');
			$this->datatables->from('daftarta_label');
			$this->datatables->add_column('aksi', '<a href="javascript:void(0);" class="edit_record btn-info btn-sm" data-id="$1" data-penulis="$2" data-tahun="$3" data-judul="$4" data-abstrak="$5" data-label="$6">Edit</a>  <a href="javascript:void(0);" class="hapus_record btn-danger btn-sm" data-id="$1" data-judul="$4">Hapus</a>','id, penulis, tahun, judul, abstrak, label');

			return $this->datatables->generate();
		}		
		// public function tampilData(){
		// 	$this->db->order_by('tahun','DESC');
		// 	return $this->db->get('daftarta_label')->result();
		// }
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