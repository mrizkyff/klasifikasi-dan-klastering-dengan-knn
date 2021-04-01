<?php
    class M_VSM extends CI_Model
    {
        public function get_kata_dasar($kata){
            $this->db->select('*');
            $this->db->where('katadasar',$kata);
            return $this->db->get('tb_katadasar')->result_array();
        }
    }
    
?>