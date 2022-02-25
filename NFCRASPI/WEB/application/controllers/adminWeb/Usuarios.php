<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Livetable_Usuario_model');
    }

    function index() {
        $this->load->view('adminWeb/usuarios');
    }

    function load_data() {
        $data = $this->Livetable_Usuario_model->load_data();
        echo json_encode($data);
    }

    function update() {
        $data = array(
            $this->input->post('table_column') => $this->input->post('value')
        );

        $res = $this->Livetable_Usuario_model->update($data, $this->input->post('id'));
        echo json_encode(array('status' => 'OK', 'data pruebas ' => $data, 'ss' => $this->input->post('id')));
    }

    function delete() {
        $this->Livetable_Usuario_model->delete($this->input->post('id'));
    }

}
