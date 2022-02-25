<!DOCTYPE html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
  <script src="<?php echo base_url(); ?>js/jquery.js"></script>
  <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
  <script src="<?php echo base_url(); ?>js/script.js"></script>
  <title>Login</title>
</head>
<html>
  <body>
    <main>
      <div class="container">
        <div class="row">
          <div class="col-md-offset-3 col-md-6">
            <div class="contenform">
              <img class="file" src="<?php echo base_url(); ?>img/keyhole.svg">

              <form class="login" method="post" action="<?php echo site_url('login/auth');?>">
                <div class="form_group">
                  <?php echo $this->session->flashdata('msg');?>
                  <label for="correoUserlogin">Usuario: <span class="rojoAsterisco">*</span></label>
                    <input id="correoUserlogin" class="loginPo" type="text" name="correoUserlogin" value="" placeholder="Correo" required>
                  </div>
                  <div class="form_group">
                  <label for="passlogin">Contraseña: <span class="rojoAsterisco">*</span></label>
                    <input id="passlogin" type="password" name="passlogin" value="" placeholder="Contraseña" required>
                  </div>
                  <button id="botonEntrar" type="submit">Entrar</button>    
              </form>
            
              <button type="button" class="btn-Des olvidada" data-toggle="modal" data-target="#passModal"><span class="down">¿Has olvidado tu contraseña?</span></button>
              <div class="modal fade" id="passModal" role="dialog">
                  <div class="modal-dialog">
                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <h4 class="modal-title">Recupera tu contraseña</h4>
                      </div>
                      <div class="modal-body">
                        <div class="formulario">
                        <form id="contact" method="post" action="<?php echo base_url(); ?>PassOlvidada/nuevapass" autocomplete="nope">
                          <!-- Email -->
                          <div class="form_group">
                              <img class="imgForm" src="<?php echo base_url(); ?>img/mail.svg">
                              <input id="emailInput" type="email" name="forgotemail" value="<?php echo set_value('forgotemail'); ?>" placeholder="Correo electrónico" required>
                              <span class="text-danger"> <?php echo form_error('email') ?> </span>      
                          </div>
                          <p class="textNecesario"><span class="rojoAsterisco">*</span>Es necesario rellenar todos los campos para comenzar la descarga</p>
                          <p class="form-message"></p>
                          <div class="contactoSumit">
                            <button id="botonSumit" type="submit">Recuperar</button>
                          </div>
                        </form>
                        </div> <!--Cierre conten formulario-->
                      </div> 
                  </div>
                </div>
              </div>
            </div>  
          </div>
        </div>  
      </div>
    </main> 
  </body>
</html>