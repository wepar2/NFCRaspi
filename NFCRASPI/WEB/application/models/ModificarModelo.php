<?php 

    class ModificarModelo extends CI_Model {

        // Get all user list
        function getUsersList(){
            $this->db->select('*');
            $this->db->order_by('nombre', 'asc');
            $this->db->limit(10,0);
            $q = $this->db->get('administradores');
            $result = $q->result_array();
            return $result;
        }

        // Get user by id
        function getUserById($id){
            $this->db->select('*');
            $this->db->where('id', $id);
            $q = $this->db->get('administradores');
            $result = $q->result_array();
            return $result;
        }

        // Update record by id
        function updateUser($postData,$id){
            
            $id = trim($postData['txt_id']);
            $admin = trim($postData['txt_admin']);
            $valido = trim($postData['txt_validado']);
            $nombre = trim($postData['txt_nombre']);
            $apellido = trim($postData['txt_apellido']);
            $email = trim($postData['txt_email']);
            $usuario = trim($postData['txt_usuario']);
            $telefono = trim($postData['txt_telefono']);
            $direccion = trim($postData['txt_direccion']);
            
            if($id !='' && $admin !='' && $valido  !='' && $nombre !='' && $email !='' && $usuario  !='' && $telefono !='' &&  $direccion !=''){

                // Update
                $value=array('nombre'=>$nombre,'apellido'=>$apellido, 'email'=>$email, 'usuario'=>$usuario, 'telefono'=>$telefono, 'direccion'=>$direccion, 'admin'=>$admin, 'email_validado'=>$valido);
                $this->db->where('id',$id);
                $this->db->update('administradores',$value);
            }
        }

    }

?>