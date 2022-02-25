<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class UpFile extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->model('UploadFile_model');
    }

    function do_upload()
    {
        $url = "../upload";
        $image=basename($_FILES['pic']['name']);
        $image=str_replace(' ','|',$image);
        $type = explode(".",$image);
        $type = $type[count($type)-1];
        if (in_array($type,array('jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF')))
        {
            $tmppath="upload/".uniqid(rand()).".".$type;
            if(is_uploaded_file($_FILES["pic"]["tmp_name"]))
            {
                move_uploaded_file($_FILES['pic']['tmp_name'],$tmppath);
                return $tmppath;
            }
        }
        else
        {
           echo "<p style='color:red;'>Error en la formato de la foto o subida dañada</p>";
           

           //redirect(base_url() . 'adminWeb/usuarios', 'refresh');
           // redirect(base_url());
        }
    }
    
    function cargaView()
    {
        
    }
    
    function image_upload()
    {
            $data ['foto']= $this->do_upload();

            $res = $this->UploadFile_model->update($data, $this->input->post('id'));
            
            $this->load->view('adminWeb/usuarios');
//            redirect(base_url() . 'adminWeb/usuarios', 'refresh');
    }

}
