<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InsertarDatosRegistro extends CI_Model {

	function __construct(){
		parent::__construct();
		$this->load->database();
	}
	function crearUsuario($data)
	{
		$this->db->insert('administradores', $data);
		return $this->db->insert_id();
	}
}

?>	