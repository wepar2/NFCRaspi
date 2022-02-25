<?php

class Con_error404 extends CI_Controller {

    function __construct() {
        parent::__construct();

    }

    function index() {
        $this->load->view('error/error404');
    }
    
}    