<?php 
    class M_debug extends CI_Model
    {
        public function get_all_corpus(){
            $this->db->select('id, judul');
            return $this->db->get('ta_a11')->result_array();
        }
        public function update_token($id, $data){
            $this->db->where('id',$id);
            $this->db->update('ta_a11',$data);
        }
    }
    
?>