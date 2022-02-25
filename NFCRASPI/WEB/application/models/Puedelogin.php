<?php
    class Puedelogin extends CI_Model
    {
        function can_login($email, $pass)
        {
            $this->db->where('email', $email);
            $query = $this->db->get('administradores');
            if($query->num_rows() > 0)
            {
                foreach($query->result() as $row){
                    if($row->email_validado == '1')
                    {
                        return true;
                    }
                    else
                    {
                        // return 'First verified your email address';
                        return false;
                    }
                }
            }
            else
            {
                return 'Wrong Email Address';
            }
        }
    }

?>