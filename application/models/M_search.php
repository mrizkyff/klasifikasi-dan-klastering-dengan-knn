<?php
    class M_search extends CI_Model
    {
        public function doctoArray(){
            $this->db->select('*');
            return $this->db->get('daftarta_label');
		}

		public function updateBobot($data, $id){
			$this->db->where('id',$id);
			$this->db->update('daftarta_label',$data);
		}

		public function tampilHasil(){
			$query = $this->db->from("daftarta_label")->order_by("daftarta_label.bobot desc")->get();
			return $query;
		}
    }
    
?>