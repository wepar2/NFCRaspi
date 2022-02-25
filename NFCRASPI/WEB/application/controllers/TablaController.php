<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class TablaController extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('livetable_model');
    }

    function index() {
        $this->load->view('dashboard_view');
    }

    function load_data() {
        $data = $this->livetable_model->load_data();
        echo json_encode($data);
    }

    function insert() {
        $data = array(
            'id' => $this->input->post('id'),
            'nombre' => $this->input->post('nombre'),
            'apellido' => $this->input->post('apellido'),
            'email' => $this->input->post('email'),
            'usuario' => $this->input->post('usuario'),
            'telefono' => $this->input->post('telefono'),
            'direccion' => $this->input->post('direccion'),
            'admin' => $this->input->post('admin'),
            'email_validado' => $this->input->post('verificado')
        );

        $this->livetable_model->insert($data);
    }

    function update() {
        $data = array(
            $this->input->post('table_column') => $this->input->post('value')
        );

        $res = $this->livetable_model->update($data, $this->input->post('id'));
        echo json_encode(array('status' => 'OK', 'data pruebas ' => $data, 'ss' => $this->input->post('id')));
    }

    function delete() {
        $this->livetable_model->delete($this->input->post('id'));
    }

}
