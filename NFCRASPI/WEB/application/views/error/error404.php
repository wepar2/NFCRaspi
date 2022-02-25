<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>img/security.png">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
        <script src="<?php echo base_url(); ?>js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/script.js"></script>
        <title>404 Page Not Found</title>
    
    </head>
    <body>
        <?php if ($this->session->userdata('level') === '1'): ?>
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="<?php echo site_url('zona-admin'); ?>"><img src="<?php echo base_url(); ?>img/logo.png"></a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <!--ACCESS MENUS FOR ADMIN-->
                                <li><a href="<?php echo site_url('zona-admin'); ?>">Inicio</a></li>
                                <li class="active"><a href="<?php echo site_url('usuarios');?>">Usuarios</a></li>
                                <li><a href="<?php echo site_url('ultimo-acceso');?>">Acceso</a></li>
                                <li><a href="#">iCard</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?php echo site_url('login/logout'); ?>">Salir</a></li>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div><!--/.container-fluid -->
                </nav>
            </div>    
            <?php endif; ?>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="contenform">
                        <img class="file" src="<?php echo base_url(); ?>img/404.svg">
                        <p class="error404Text">ERROR 404</p>
                    </div>
                </div>    
            </div>
        </div>    
    </body>
</html>