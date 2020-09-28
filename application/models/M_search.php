<?php
    class M_search extends CI_Model
    {
        public function doctoArray(){
            $this->db->select('*');
            return $this->db->get('daftarta_label');
		}

		public function updateBobot($data, $id){
			$this->db->where('id',$id);
			return $this->db->update('daftarta_label',$data);
		}

		public function tampilHasil(){
            $this->db->select('*');
            $this->db->order_by("bobot","DESC");
            return $this->db->get("daftarta_label");
		}
    }
    
?>