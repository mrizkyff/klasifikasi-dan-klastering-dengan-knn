<?php 
    class M_debug extends CI_Model
    {
        public function get_all_corpus(){
            $this->db->select('id, judul');
            return $this->db->get('tb_dokumen')->result_array();
        }
        public function update_token($id, $data){
            $this->db->where('id',$id);
            $this->db->update('tb_dokumen',$data);
        }
    }

?>