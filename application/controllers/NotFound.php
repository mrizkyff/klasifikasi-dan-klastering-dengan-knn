<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotFound extends CI_Controller
{
    public function index(){
        $this->load->view('template/s_header');
        $this->load->view('notfound');
        $this->load->view('template/s_footer');
    }
}


?>