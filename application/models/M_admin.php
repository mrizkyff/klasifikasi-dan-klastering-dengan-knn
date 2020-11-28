<?php 
	class M_admin extends CI_Model{

		public function __construct(){
			parent::__construct();
		}

		// untuk menampilkan data ke dtatables dengan serverside
		function json() {
			// jangan pakai bintang nanti tidak bisa search
			$this->datatables->select('id, penulis, tahun, judul, file, timestamp, nim, desc_prodi, desc_fak');
			$this->datatables->from('tb_dokumen');
			$this->datatables->join('tb_prodi', 'tb_dokumen.kode_prodi = tb_prodi.kode_prodi');
            $this->datatables->join('tb_fakultas', 'tb_prodi.kode_fak = tb_fakultas.kode_fak');
			$this->datatables->add_column('author','<p><b>$1</b><br>$2</p>','penulis, nim');
			$this->datatables->add_column('title','<p class="text-justify">$1</p>','judul');
			$this->datatables->add_column('aksi', '
			<a href="upload/$5" target="_blank" class="badge-light"><i class="fas fa-file-pdf lead"></i></a>
			<a href="javascript:void(0);" class="edit_record badge badge-info" data-id="$1" data-penulis="$2" data-tahun="$3" data-judul="$4" data-nim="$6"><i class="fas fa-edit lead"></i> Edit</a>
			<a href="javascript:void(0);" class="hapus_record badge badge-danger" data-id="$1" data-judul="$4"><i class="fas fa-trash-alt lead"></i> Hapus</a>
			','id, penulis, tahun, judul, file, nim');

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

		
		
	}
 ?>