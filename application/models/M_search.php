<?php
    class M_search extends CI_Model
    {
        public function doctoArray(){
            $this->db->select('*');
            return $this->db->get('ta_a11');
		}

		public function updateBobot($data, $id){
			$this->db->where('id',$id);
			return $this->db->update('ta_a11',$data);
		}

		public function tampilHasil(){
            $this->db->select('*');
            $this->db->order_by("cosim","DESC");
            return $this->db->get("ta_a11");
		}
    }
    
?>