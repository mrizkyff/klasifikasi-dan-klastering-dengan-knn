<?php
    class M_search extends CI_Model
    {
        public function doctoArray(){
            $this->db->select('*');
            return $this->db->get('tb_dokumen');
        }
        
        public function specific_search($nim, $nama){
            $this->db->select('*');
            $this->db->like('nim' , $nim, 'both');
            $this->db->like('penulis', $nama, 'both');
            return $this->db->get('tb_dokumen')->result();
        }

		public function updateBobot($data){
			// $this->db->where('id',$id);
			return $this->db->update_batch('tb_dokumen', $data, 'id');
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
            return $this->db->get("tb_dokumen");
        }
        
        public function resetAllBobot($value = 0){
            $data = [
                'cosim' => $value,
                'jaccard' => $value,
                'dice' => $value,
            ];
            $this->db->update('tb_dokumen', $data);
        }
        function json() {
			// jangan pakai bintang nanti tidak bisa search
			$this->datatables->select('tb_dokumen.id, penulis, tahun, judul, file, nim, cosim, desc_fak, desc_prodi, tb_fakultas.kode_fak, lokasi, tb_dokumen.kode_prodi, tag');
            $this->datatables->from('tb_dokumen');
            $this->datatables->join('tb_prodi', 'tb_dokumen.kode_prodi = tb_prodi.kode_prodi');
            $this->datatables->join('tb_fakultas', 'tb_prodi.kode_fak = tb_fakultas.kode_fak');
            $this->datatables->join('tb_rak', 'tb_dokumen.kode_rak = tb_rak.id', 'left');
            $this->datatables->where('cosim != ', '0');
            $this->datatables->add_column('koleksi_ta',
            '<table border="0" width="100%" style="background-color: #fed9c9" class="mt-1">
                <tr>
                    <td rowspan="5" width="100px">
                        <img src="http://localhost/ciLTE/asset/img/thumbnail_skripsi/$8.png" style="width:80px; height:120px">
                    </td>
                    <td>
                        <div class="context"><h6 style="display:inline;">$1</h6></div>
                        <script>
                            $(document).ready(function () {
                                var keyword_term = $("#keyword_term").val();
                                if(keyword_term !== undefined){
                                    $("div.context").mark(keyword_term,{
                                        "className":"highlighter"
                                    });
                                }
                            });
                        </script>
                        <p style="display:inline;" class="cosim">$6%</p>
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
                        <h6>$7</h6>
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
                                <a href="javascript:void(0);" id="btnMeta" data-penulis="$2" data-tahun="$4" data-judul="$1" data-nim="$3" data-prodi="$7" data-kdfak="$8" data-kdrak="$9" class="float-right">Meta</a>
                            </div>  
                        </div>
                    </td>
                </tr>
            </table>
            ',
            'judul, penulis, nim, tahun, file, cosim, desc_prodi, kode_fak, lokasi');
			return $this->datatables->generate();
        }

        public function getAllFakultas(){
            $this->db->select('kode_fak, desc_fak');
            return $this->db->get("tb_fakultas")->result_array();
        }
        
        public function getAllProdi(){
            $this->db->select('kode_prodi, desc_prodi');
            return $this->db->get('tb_prodi')->result();
        }

        public function getNumProdi($kode_prodi){
            $this->db->select('*');
            $this->db->where('kode_prodi',$kode_prodi);
            return $this->db->get('tb_dokumen')->num_rows();
        }
        
        public function getNumTahun($tahun){
            $this->db->select('*');
            $this->db->where('tahun',$tahun);
            return $this->db->get('tb_dokumen')->num_rows();
        }

        public function getProdiByKodeFak($kode_fak){
            $this->db->select("kode_prodi, desc_prodi");
            $this->db->where("kode_fak",$kode_fak);
            return $this->db->get("tb_prodi")->result_array();
        }
    }
?>