<?php
    class Login extends CI_Controller
    {
        function __construct(){
            parent::__construct();
            $this->load->model('m_login');
        }

        function index(){
            $this->load->view('admin/login_page');
            // $this->load->view('admin/scripts/login');
        }

        function authorize(){
            $username = $this->input->post('username');
            $password = $this->input->post('password');
            $data = array(
                'username' => $username,
                'password' => $password
            );

            $cek = $this->m_login->cek_login($data)->num_rows();
            $level = $this->m_login->cek_level($data);

            $data_session = array(
                'nama' => $username,
                'status' => "login",
            );

            $this->session->set_userdata($data_session);

            echo json_encode($cek);
        }

        function logout(){
            $this->session->sess_destroy();
            redirect(base_url("login"));
        }
    }
    
?>