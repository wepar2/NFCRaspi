<?php

class Get_nuevopassword extends CI_Controller {

    public function index($rs = FALSE) {
        $this->load->database();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[2]|matches[passconf]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'trim|required');

        if ($this->form_validation->run() == FALSE) {
            echo form_open();
            $this->load->view('nuevapass_view');
        } else {
            
            $qq = $query = $this->db->get_where('administradores', array('key_verificacion_pass' => $rs), 0);   
            
            $query = $this->db->get_where('administradores', array('key_verificacion_pass' => $rs), 1);
            
            
            
            if ($rs =='' || $query->num_rows() == 0) {
                show_error('Lo siento, la solicitud a caducado');
            } else {
                $data = array(
                    'pass' => md5($this->input->post('password')),
                    'key_verificacion_pass' => ''
                );

                $where = $this->db->where('key_verificacion_pass', $rs);

                $where->update('administradores', $data);

                echo "Contraseña cambiada!";
                $this->load->view('login_view');
            }
        }
    }

}
