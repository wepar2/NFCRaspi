<?php
	defined('BASEPATH') OR exit('No direct script access allowed');

	class VerificaEmail extends CI_Model {

		function verifica_email($key)
		{
			$this->db->where('key_verificacion', $key);
			$this->db->where('email_validado', '0');
			$query = $this->db->get('administradores');
			if($query->num_rows() > 0){
				$data = array(
					'email_validado'  => '1'
				);
				$this->db->where('key_verificacion', $key);
				$this->db->update('administradores', $data);
				return true;
			}else{
				return false;
			}
		}
	}
?>