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
    <title>Cambia tu contraseña</title>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                
                <a class="correo" href="<?php echo base_url(); ?>"><img class="file" src="<?php echo base_url(); ?>img/home.svg"></a>
                <br>
                <?php
                echo validation_errors();

                echo "Contraseña :" . form_password('password', '');
                echo "Password Confirmation :" . form_password('passconf', '');
                echo form_submit('submit', 'Submit');
                ?>
            </div>	
        </div>
    </div>	
</div>                    
</body>