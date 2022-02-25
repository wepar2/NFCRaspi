<?php
class Nickmodel extends CI_Model{

  function nombrenick($email){
      
    $this->db->select('usuario');
    $this->db->from('administradores');
    $this->db->where('email', $email);
    
    $query = $this->db->get();
    
    if ($query->num_rows() > 0) {
        $row = $query->row_array(); 
        return $row['usuario'];
    }
    
    return false;
    
  }

}
