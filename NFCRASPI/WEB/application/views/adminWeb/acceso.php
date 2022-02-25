<?php if ($this->session->userdata('level') === '1'): ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>img/favicon.png">
        <title>Usuarios iCard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">

        <script src="<?php echo base_url(); ?>js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/script.js"></script>
    </head>
    <body>
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
                                <li><a href="<?php echo site_url('zona-admin'); ?>">Inicio</a></li>
                                <li><a href="<?php echo site_url('usuarios');?>">Usuarios</a></li>
                                <li class="active"><a href="<?php echo site_url('ultimo-acceso');?>">Acceso</a></li>
                                <li><a href="#">iCard</a></li>
                                <li><a href="#">Posts</a></li>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?php echo site_url('login/logout'); ?>">Salir</a></li>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div><!--/.container-fluid -->
                </nav>
                <!--inicio zona de admin-->
                <div class="row">
                    <div class="col-md-12">
                        <div class="LogoConTitulo">
                            <img class="file" src="<?php echo base_url(); ?>img/acceso.svg">
                            <h3>Acceso Recientes</h3>
                        </div>
                        <div class="container">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Nombre</th>
                                            <th>UID</th>
                                            <th>Fecha Registro</th>
                                            <th>Numero de Veces</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>                                
                            </div>
                        </div>    
                    </div>
                </div> 
            </div>
        </div>        
    </body>
</html>
<script type="text/javascript" language="javascript" >
    $(document).ready(function () {
        
        //Lee de la base datos
        function load_data()
        {
            $.ajax({
                url: "<?php echo base_url(); ?>adminWeb/Acceso/load_data",
                dataType: "JSON",
                success: function (data) {
                    //Parte editable
                var html = '<tr>';
                    
                    //Datos de la tabla
                    for (var count = 0; count < data.length; count++)
                    { 
                        html += '<tr>';
                        html += '<td class="table_data table_data_id" data-row_id="' + data[count].id + '" data-column_name="id">' + data[count].id + '</td>';
                        html += '<td class="table_data" data-row_id="' + data[count].id + '" data-column_name="nombre" >' + data[count].nombre + '</td>';
                        html += '<td class="table_data" data-row_id="' + data[count].id + '" data-column_name="uid" >' + data[count].uid + '</td>';
                        html += '<td class="table_data" data-row_id="' + data[count].id + '" data-column_name="fecha" >' + data[count].fechaEntrada + '</td>';
                        html += '<td class="table_data" data-row_id="' + data[count].id + '" data-column_name="fecha" ></td>';
                    }
                    $('tbody').html(html);
                }
            });
        }

        load_data();   
  
    });
</script>

<?php else: ?>
    <?php
    header('Status: 301 Moved Permanently', false, 301);
    header('Location: ../');
    ?>


<?php endif; ?>   <!--Fin zona admin-->