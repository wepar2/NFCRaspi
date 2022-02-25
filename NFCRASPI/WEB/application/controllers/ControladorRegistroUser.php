<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class ControladorRegistroUser extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('form');
		$this->load->model('insertarDatosRegistro');
		$this->load->model('verificaEmail');
		$this->load->library('form_validation');

	}

	public function index()
	{
		$this->load->view('login_view');
	}

	function registrousuarios(){
		$now = date("Y-m-d H:i:s");

		$user_agent = $_SERVER['HTTP_USER_AGENT'];


		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');
		$this->form_validation->set_rules('apellido', 'Apellido', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[administradores.email]');
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|trim');
		$this->form_validation->set_rules('passUser', 'Pass', 'required|trim');
		$this->form_validation->set_rules('telefono', 'Telefono', 'required|trim|numeric|exact_length[9]');
		$this->form_validation->set_rules('direccion', 'direccion', 'required|trim');
                
                
		if ($this->form_validation->run()){
                        
			$key_verificacion = md5(rand());
			$encrypted_password = md5($this->input->post('passUser'));
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'apellido' => $this->input->post('apellido'),
				'email' => $this->input->post('email'),
				'usuario' => $this->input->post('usuario'),
				'pass' => $encrypted_password,
				'telefono' => $this->input->post('telefono'),
				'direccion' => $this->input->post('direccion'),
				'ip' => $this->input->ip_address(),
				'fechaRegistro'=> $now,
				'navegador' => $this->getBrowser(),
				'os' => $this-> getPlatform(),
				'version' => $user_agent,
				'key_verificacion' => $key_verificacion
			);
						
			$id = $this->insertarDatosRegistro->crearUsuario($data);

			if($id > 0)
			{
                            $this->$enviarCorrreo();
			}
		}else{
			echo "Error en el formulario de registro";
			$this->index();
		}
		
	}/*CIERRE CLASE registrousuarios*/
        
        
        function registrousuariosAdmin(){
		$now = date("Y-m-d H:i:s");

		$user_agent = $_SERVER['HTTP_USER_AGENT'];


		$this->form_validation->set_rules('nombre', 'Nombre', 'required|trim');
		$this->form_validation->set_rules('apellido', 'Apellido', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[administradores.email]');
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|trim');
		$this->form_validation->set_rules('passUser', 'Pass', 'required|trim');
		$this->form_validation->set_rules('telefono', 'Telefono', 'required|trim|numeric|exact_length[9]');
		$this->form_validation->set_rules('direccion', 'direccion', 'required|trim');

		if ($this->form_validation->run()){
                        
                        if($this->input->post('admin'))
                        {
                            $admin = 1;
                        }
                        else{
                            $admin = 0;
                        }
                    
			$key_verificacion = md5(rand());
			$encrypted_password = md5($this->input->post('passUser'));
			$data = array(
				'nombre' => $this->input->post('nombre'),
				'apellido' => $this->input->post('apellido'),
				'email' => $this->input->post('email'),
				'usuario' => $this->input->post('usuario'),
				'pass' => $encrypted_password,
				'telefono' => $this->input->post('telefono'),
				'direccion' => $this->input->post('direccion'),
                                'admin' => $admin,
				'ip' => $this->input->ip_address(),
				'fechaRegistro'=> $now,
				'navegador' => $this->getBrowser(),
				'os' => $this-> getPlatform(),
				'version' => $user_agent,
				'key_verificacion' => $key_verificacion,
                                
			);
						
			$id = $this->insertarDatosRegistro->crearUsuario($data);

			if($id > 0)
			{
                            $this->enviarCorreo($key_verificacion);
                            redirect('zona-admin');
			}
                    }else{
                            echo "Error en el formulario de registro";
                            $this->load->view('dashboard_view');
                    }
		
	}/*CIERRE CLASE registrousuariosADMIN*/

        function enviarCorreo($key_verificacion)
        {
            $subject = "Por favor verifica el email para logearse";
            $message = "
                    <p style='background-color: #e2e2e2; font-size: 33px; color: #6761d8; padding-top: 20px; padding-bottom: 20px; text-align: center;'><a href='www.ilockpanel.tk'>iLockPanel</a></p>
                    <p>Hola ".$this->input->post('nombre')." ".$this->input->post('apellido')." </p>
                    <p>Para completar su registro o reactivar su cuenta en login.com, debe confirmar su direccion de correo electronico haciendo clic en el boton de abajo</p>
                    <br>
                    <br>
                    <a style='color: #ffff; background-color: blue; padding: 10px; border-radius: 4px; text-decoration: none;' href='".base_url()."verifica-tu-email/".$key_verificacion."'>Confirma su email</a>
            ";


            $config = array(
                    'protocol'  => 'smtp',
                    'smtp_host' => 'smtp.hostinger.com',
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
            $this->email->to($this->input->post('email'));
            $this->email->subject($subject);
            $this->email->message($message);
            if($this->email->send())
            {
                redirect('zona-admin');

            }
            else{
                echo "Error correo no enviado";
            }
        }
        
        
	// Verifica el mail
	function verifica_email()
 	{
 		
		if($this->uri->segment(3)){
		    $key_verificacion = $this->uri->segment(3);
		    if($this->verificaEmail->verifica_email($key_verificacion))
		    {
		    	$data['message'] = '<h1 align="center">Tu email a sido verificado, ahora puedes loguearte </h1>
		    		<br>
		    		<a class="enlaceLogin" href="'.base_url().'">aqui</a>';
		    }
		    else{
		    	$data['message'] = '<h1 align="center">Link caducado o no valido.</h1>
		    	<p>Pongase en contacto con el administrador para resolver el problema. </p>
				
		    	<p>Correo: info@ilockpanel.tk</p>
		    	<br>
				<br>
				<a class="btn-Des" href="'.base_url().'">Volver</a>
		    	';
		    }
		    $this->load->view('email_verification', $data);
		}
 	}

	/*FUNCION VER BROWSER*/

	function getBrowser(){
		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		if(strpos($user_agent, 'Maxthon') !== FALSE)
			return "Maxthon";
		elseif(strpos($user_agent, 'SeaMonkey') !== FALSE)
			return "SeaMonkey";
		elseif(strpos($user_agent, 'Vivaldi') !== FALSE)
			return "Vivaldi";
		elseif(strpos($user_agent, 'Arora') !== FALSE)
			return "Arora";
		elseif(strpos($user_agent, 'Avant Browser') !== FALSE)
			return "Avant Browser";
		elseif(strpos($user_agent, 'Beamrise') !== FALSE)
			return "Beamrise";
		elseif(strpos($user_agent, 'Epiphany') !== FALSE)
			return 'Epiphany';
		elseif(strpos($user_agent, 'Chromium') !== FALSE)
			return 'Chromium';
		elseif(strpos($user_agent, 'Iceweasel') !== FALSE)
			return 'Iceweasel';
		elseif(strpos($user_agent, 'Galeon') !== FALSE)
			return 'Galeon';
		elseif(strpos($user_agent, 'Edge') !== FALSE)
			return 'Microsoft Edge';
		elseif(strpos($user_agent, 'Trident') !== FALSE) //IE 11
			return 'Internet Explorer';
		elseif(strpos($user_agent, 'MSIE') !== FALSE)
			return 'Internet Explorer';
		elseif(strpos($user_agent, 'Opera Mini') !== FALSE)
			return "Opera Mini";
		elseif(strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
			return "Opera";
		elseif(strpos($user_agent, 'Firefox') !== FALSE)
			return 'Mozilla Firefox';
		elseif(strpos($user_agent, 'Chrome') !== FALSE)
			return 'Google Chrome';
		elseif(strpos($user_agent, 'Safari') !== FALSE)
			return "Safari";
		elseif(strpos($user_agent, 'iTunes') !== FALSE)
			return 'iTunes';
		elseif(strpos($user_agent, 'Konqueror') !== FALSE)
			return 'Konqueror';
		elseif(strpos($user_agent, 'Dillo') !== FALSE)
			return 'Dillo';
		elseif(strpos($user_agent, 'Netscape') !== FALSE)
			return 'Netscape';
		elseif(strpos($user_agent, 'Midori') !== FALSE)
			return 'Midori';
		elseif(strpos($user_agent, 'ELinks') !== FALSE)
			return 'ELinks';
		elseif(strpos($user_agent, 'Links') !== FALSE)
			return 'Links';
		elseif(strpos($user_agent, 'Lynx') !== FALSE)
			return 'Lynx';
		elseif(strpos($user_agent, 'w3m') !== FALSE)
			return 'w3m';
		else
			return 'No hemos podido detectar su navegador';
	}

	function getPlatform(){
		$user_agent = $_SERVER['HTTP_USER_AGENT'];

		if(strpos($user_agent, 'Windows NT 10.0') !== FALSE)
			return "Windows 10";
		elseif(strpos($user_agent, 'Windows NT 6.3') !== FALSE)
			return "Windows 8.1";
		elseif(strpos($user_agent, 'Windows NT 6.2') !== FALSE)
			return "Windows 8";
		elseif(strpos($user_agent, 'Windows NT 6.1') !== FALSE)
			return "Windows 7";
		elseif(strpos($user_agent, 'Windows NT 6.0') !== FALSE)
			return "Windows Vista";
		elseif(strpos($user_agent, 'Windows NT 5.1') !== FALSE)
			return "Windows XP";
		elseif(strpos($user_agent, 'Windows NT 5.2') !== FALSE)
			return 'Windows 2003';
		elseif(strpos($user_agent, 'Windows NT 5.0') !== FALSE)
			return 'Windows 2000';
		elseif(strpos($user_agent, 'Windows ME') !== FALSE)
			return 'Windows ME';
		elseif(strpos($user_agent, 'Win98') !== FALSE)
			return 'Windows 98';
		elseif(strpos($user_agent, 'Win95') !== FALSE)
			return 'Windows 95';
		elseif(strpos($user_agent, 'WinNT4.0') !== FALSE)
			return 'Windows NT 4.0';
		elseif(strpos($user_agent, 'Windows Phone') !== FALSE)
			return 'Windows Phone';
		elseif(strpos($user_agent, 'Windows') !== FALSE)
			return 'Windows';
		elseif(strpos($user_agent, 'iPhone') !== FALSE)
			return 'iPhone';
		elseif(strpos($user_agent, 'iPad') !== FALSE)
			return 'iPad';
		elseif(strpos($user_agent, 'Debian') !== FALSE)
			return 'Debian';
		elseif(strpos($user_agent, 'Ubuntu') !== FALSE)
			return 'Ubuntu';
		elseif(strpos($user_agent, 'Slackware') !== FALSE)
			return 'Slackware';
		elseif(strpos($user_agent, 'Linux Mint') !== FALSE)
			return 'Linux Mint';
		elseif(strpos($user_agent, 'Gentoo') !== FALSE)
			return 'Gentoo';
		elseif(strpos($user_agent, 'Elementary OS') !== FALSE)
			return 'ELementary OS';
		elseif(strpos($user_agent, 'Fedora') !== FALSE)
			return 'Fedora';
		elseif(strpos($user_agent, 'Kubuntu') !== FALSE)
			return 'Kubuntu';
		elseif(strpos($user_agent, 'Linux') !== FALSE)
			return 'Linux';
		elseif(strpos($user_agent, 'FreeBSD') !== FALSE)
			return 'FreeBSD';
		elseif(strpos($user_agent, 'OpenBSD') !== FALSE)
			return 'OpenBSD';
		elseif(strpos($user_agent, 'NetBSD') !== FALSE)
			return 'NetBSD';
		elseif(strpos($user_agent, 'SunOS') !== FALSE)
			return 'Solaris';
		elseif(strpos($user_agent, 'BlackBerry') !== FALSE)
			return 'BlackBerry';
		elseif(strpos($user_agent, 'Android') !== FALSE)
			return 'Android';
		elseif(strpos($user_agent, 'Mobile') !== FALSE)
			return 'Firefox OS';
		elseif(strpos($user_agent, 'Mac OS X+') || strpos($user_agent, 'CFNetwork+') !== FALSE)
			return 'Mac OS X';
		elseif(strpos($user_agent, 'Macintosh') !== FALSE)
			return 'Mac OS Classic';
		elseif(strpos($user_agent, 'OS/2') !== FALSE)
			return 'OS/2';
		elseif(strpos($user_agent, 'BeOS') !== FALSE)
			return 'BeOS';
		elseif(strpos($user_agent, 'Nintendo') !== FALSE)
			return 'Nintendo';
		else
			return 'Unknown Platform';
	}

}/*CIERRE PHP*/
?>