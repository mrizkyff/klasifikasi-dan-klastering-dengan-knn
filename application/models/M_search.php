<?php
    class M_search extends CI_Model
    {
        public function doctoArray(){
            $this->db->select('*');
            return $this->db->get('tb_dataset');
        }
        

		public function updateBobot($data){
			// $this->db->where('id',$id);
			return $this->db->update_batch('tb_dataset', $data, 'id');
		}

        
        public function resetAllBobot($value = 0){
            $data = [
                'cosim' => $value,
                'jaccard' => $value,
                'dice' => $value,
            ];
            $this->db->update('tb_dokumen', $data);
        }

        

    }
?>