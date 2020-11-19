<?php
    class M_search extends CI_Model
    {
        public function doctoArray(){
            $this->db->select('*');
            return $this->db->get('ta_a11');
        }
        
        public function specific_search($nim, $nama){
            $this->db->select('*');
            $this->db->like('nim' , $nim, 'both');
            $this->db->like('penulis', $nama, 'both');
            return $this->db->get('ta_a11')->result();
        }

		public function updateBobot($data, $id){
			$this->db->where('id',$id);
			return $this->db->update('ta_a11',$data);
		}

		public function tampilHasil($tahun = '', $minat = ''){
            $this->db->select('*');
            if ($tahun != '' and $minat != ''){
                $this->db->where('tahun', $tahun);
                $this->db->where('minat', $minat);
            }
            else if ($tahun != ''){
                $this->db->where('tahun', $tahun);
            }
            else if ($minat != ''){
                $this->db->where('minat', $minat);
            }
            $this->db->where('cosim !=','0');
            $this->db->order_by("cosim","DESC");
            return $this->db->get("ta_a11");
        }
        
        public function resetAllBobot(){
            $data = [
                'cosim' => 0,
                'jaccard' => 0,
                'dice' => 0,
            ];
            $this->db->update('ta_a11', $data);
        }
    }
    
?>