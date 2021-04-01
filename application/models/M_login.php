<?php
    class M_login extends CI_Model
    {
        function cek_login($data){
            return $this->db->get_where("admin",$data);
        }
        function cek_level($data){
            $this->db->select("level");
            $this->db->where($data);
            return $this->db->get("admin")->result_array();
        }
    }
    
?>