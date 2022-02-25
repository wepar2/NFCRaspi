<?php

class Login extends CI_Controller {

    function __construct() {
        parent::__construct();

        
        $this->load->helper('form');
        $this->load->model('login_model');
        $this->load->model('VerificaEmail');
        $this->load->model('Puedelogin');
        $this->load->model('ListarUsuarios');
        $this->load->library('form_validation');

    }

    function index() {
        $this->load->view('login_view');
    }

    function auth() {
        $email = $this->input->post('correoUserlogin', TRUE);
        $password = md5($this->input->post('passlogin', TRUE));
        $validate = $this->login_model->validate($email, $password);

        $result = $this->Puedelogin->can_login($this->input->post('correoUserlogin'), $this->input->post('passlogin'));
        if ($result == true) {
            if ($validate->num_rows() > 0) {
                $data = $validate->row_array();
                $name = $data['nombre'];
                $email = $data['email'];
                $level = $data['admin'];
                $sesdata = array(
                    'username' => $name,
                    'email' => $email,
                    'level' => $level,
                    'logged_in' => TRUE
                );
                $this->session->set_userdata($sesdata);
                // access login for admin
                if ($level === '1') {
                    
                    $data['employee_data'] = $this->ListarUsuarios->fetch_data();
                    $this->session->set_userdata($data);
                    redirect('zona-admin');

                    // access login for user
                } elseif ($level === '0') {
                    redirect('page/user');

                    // access login for author
                }
            } else {
                echo $this->session->set_flashdata('msg', 'El correo o la contraseña son incorrecto.');
                redirect('login');
            }
        } else {
            echo $this->session->set_flashdata('msg', 'Correo no Verificado. Debe verificarlo antes de continuar.');
            redirect('login');
        }
    }

    function logout() {
        $this->session->sess_destroy();
        redirect('login');
    }
    
    
}
