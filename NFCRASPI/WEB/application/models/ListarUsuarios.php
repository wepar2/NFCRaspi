<?php

class ListarUsuarios extends CI_Model {

    function fetch_data() {
       $query= $this->db->select()
       ->from("administradores")
        ->order_by('id', 'asc')
        ->get();
       $result=$query->result_array();
       if(!empty($result)){
           return $result;
       }else{
           return false;
       }
        
    }

}

?>