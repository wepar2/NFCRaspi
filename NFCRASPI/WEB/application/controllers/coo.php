$config = array(
					'protocol'  => 'smtp',
					'smtp_host' => 'smtp.hostinger.es',
					'smtp_port'  => 587,
					'smtp_user'  => 'no-reply@ilockpanel.tk', 
					'smtp_pass'  => 'Coin2019@', 
					'mailtype'   => 'html',
					'charset'    => 'iso-8859-1',
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
					$this->load->view('dashboard_view');
				}
				else{
					echo "Error correo no enviado";
				}