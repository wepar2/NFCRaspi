<?php

class PassOlvidada extends CI_Controller {

    function __construct() {
        parent::__construct();


        $this->load->helper('form');
        $this->load->model('login_model');
        $this->load->model('VerificaEmail');
        $this->load->model('Puedelogin');
        $this->load->model('ListarUsuarios');
        $this->load->model('insertarDatosRegistro');
        $this->load->model('verificaEmail');
        $this->load->model('Nickmodel');
        $this->load->library('form_validation');

    }
    
    public function index()
    {
            $this->load->view('login_view');
    }

    function nuevapass() {
        $this->form_validation->set_rules('forgotemail', 'Email', 'required|trim|valid_email|callback_email_check');
        
        
        
        if ($this->form_validation->run()) {
            
            $nick = $this->Nickmodel->nombrenick($this->input->post('forgotemail'));
            
            $email = $this->input->post('forgotemail');
            
            $this->load->helper('string');
            $rs= random_string('alnum',16);

            $this->db->set('key_verificacion_pass',$rs)
                    ->where('email', $email)
                    ->update('administradores');
           
            
            //Ahora envia el email
            $subject = "Restablece tu contraseña";
            
            
            $message = "

                        Hola, ".$nick." has solicitado que se restablezca tu contraseña. Puedes definir una contraseña nueva desde <a href='".base_url()."get_nuevopassword/index/".$rs."'>aqui</a>
                        <hr>
                        <br>
                        <a style='color: #ffff; background-color: blue; padding: 10px; border-radius: 4px; text-decoration: none;' href='".base_url()."get_nuevopassword/index/".$rs."'>Confirma su email</a>
                    ";
     
   
            $config = array(
					'protocol'  => 'smtp',
					'smtp_host' => 'smtp.hostinger.es',
					'smtp_port'  => 587,
					'smtp_user'  => 'no-reply@ilockpanel.tk', 
					'smtp_pass'  => 'Coin2019@', 
					'mailtype'   => 'html',
					'charset'    => 'utf-8',
					'wordwrap'   => TRUE
				);

            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('no-reply@ilockpanel.tk');
            $this->email->to($this->input->post('forgotemail'));
            $this->email->subject($subject);
            $this->email->message($message);
            
            if($this->email->send())
            {
                $this->load->view('confirmacionCorreo');
            }
            else{
                echo "Error correo no enviado";
            }
        }
    }

    
    
    public function email_check($str) {
        $query = $this->db->get_where('administradores', array('email' => $str), 1);

        if ($query->num_rows() == 1) {
            return true;
        } else {
            $this->form_validation->set_message('login_view', 'El correo no existe.');
            echo "<p style='font-size=100px; color=red;'>El correo no existe.</p>";
            $this->index();
            return false;
        }
    }

}
