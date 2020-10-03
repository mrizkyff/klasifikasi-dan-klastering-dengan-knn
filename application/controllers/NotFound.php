<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NotFound extends CI_Controller
{
    public function index(){
        $this->load->view('template/public/pub_header');
        $this->load->view('notfound');
        $this->load->view('template/public/pub_footer');
    }
}


?>