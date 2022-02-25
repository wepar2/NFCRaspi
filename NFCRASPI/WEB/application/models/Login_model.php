<?php
class Login_model extends CI_Model{

  function validate($email,$password){
    $this->db->where('email',$email);
    $this->db->where('pass',$password);
    $result = $this->db->get('administradores',1);
    return $result;
  }

}
