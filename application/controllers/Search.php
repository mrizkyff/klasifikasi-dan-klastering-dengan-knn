<?php
class Search extends CI_Controller
{
    public function index(){
        $this->load->view('template/s_header');
        $this->load->view('s_halamanPencarian');
        $this->load->view('template/s_footer');
    }
    public function prep($query){
        $this->load->library('preprocessing');
        return $this->preprocessing->preprocess($query);
    }
    public function vsm($query, $dokumen){
        $this->load->library('vsm');
        return $this->vsm->get_rank($query, $dokumen);
    }

    public function processSearch($kueri){
        // step 1 mendapatkan kata dasar dari query
        $kueri = $this->prep($kueri);

        // step 2 mendapatkan dokumen ke array
        $query = $this->m_admin->doctoArray();
        $arrayDokumen = [];
        foreach ($query->result_array() as $row) {
            $arrayDoc = [
                'id_doc' => $row['id'],
                'dokumen' => implode(" ", $this->prep($row['judul']))
            ];
            array_push($arrayDokumen, $arrayDoc);
        }

        // step 3 mendapatkan ranking dengan VSM
        $rank = $this->vsm($kueri, $arrayDokumen);

        // step 4 memasukkan cos similarity ke database
        $jumlahDokumen = count($rank);
        for ($i=0; $i < $jumlahDokumen; $i++) { 
            $id = $rank[$i]['id_doc'];
            $bobot = $rank[$i]['ranking'];
            // update
            $data = array(
                'bobot' => $bobot
            );
            $this->m_admin->updateBobot($data,$id);
        }
    }
    public function cari(){
        $kueri = $this->input->get('query');
        $this->processSearch($kueri);
        $data['skripsi'] = $this->m_admin->tampilHasil()->result();
        $data['pencarian'] = $kueri;
        $this->load->view('template/s_header');
        $this->load->view('s_hasilPencarian', $data);
        $this->load->view('template/s_footer');
    }
    
}

?>