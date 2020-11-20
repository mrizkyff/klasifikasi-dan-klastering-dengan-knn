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
        
        public function resetAllBobot($value = 0){
            $data = [
                'cosim' => $value,
                'jaccard' => $value,
                'dice' => $value,
            ];
            $this->db->update('ta_a11', $data);
        }
        function json() {
			// jangan pakai bintang nanti tidak bisa search
			$this->datatables->select('id, penulis, tahun, judul, file, nim, cosim');
            $this->datatables->from('ta_a11');
            $this->datatables->where('cosim != ', '0');
            $this->datatables->add_column('koleksi_ta',
            '<table border="0" width="100%" style="background-color: #fed9c9" class="mt-1">
                <tr>
                    <td rowspan="5" width="100px">
                        <div style="width: 80px; height: 120px; background-color: #ACDDDE"></div>
                    </td>
                    <td>
                        <a href="#">$1</a>
                        <p class="cosim">$6%</p>
                        <script>
                            var cosim = $(".cosim").text();
                            if(parseInt(cosim) == -1){
                                $(".cosim").hide();
                            }
                            else{
                                
                            }
                        </script>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>$2 - $3</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <h6>Teknik Informatika - S1</h6>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="row mr-0">
                            <div class="col">
                                <h6>$4</h6>
                            </div>
                            <div class="col">
                                <a href="upload/$5" target="_blank" rel="noopener noreferrer" class="float-right">Download File</a>
                                <a class="float-right">&nbsp | &nbsp</a>
                                <a href="javascript:void(0);" id="btnMeta" data-penulis="$2" data-tahun="$4" data-judul="$1" data-nim="$3" class="float-right">Meta</a>
                            </div>  
                        </div>
                    </td>
                </tr>
            </table>
            ',
            'judul, penulis, nim, tahun, file, cosim');

			return $this->datatables->generate();
		}
    }
    
?>