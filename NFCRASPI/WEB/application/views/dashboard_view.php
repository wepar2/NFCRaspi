<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>iLock Panel</title>
        <link rel="icon" type="image/png" href="<?php echo base_url(); ?>img/favicon.png">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.7/dist/sweetalert2.all.min.js"></script>
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
                            <a class="navbar-brand" href="<?php echo site_url('zona-admin'); ?>"><img src="<?php echo base_url(''); ?>img/logo.png"></a>
                        </div>
                        <div id="navbar" class="navbar-collapse collapse">
                            <ul class="nav navbar-nav">
                                <!--ACCESS MENUS FOR ADMIN-->
                                <?php if ($this->session->userdata('level') === '1'): ?>
                                    <li class="active"><a href="<?php echo site_url('zona-admin'); ?>">Inicio</a></li>
                                    <li><a href="<?php echo site_url('usuarios');?>">Usuarios</a></li>
                                    <li><a href="<?php echo site_url('ultimo-acceso');?>">Acceso</a></li>
                                    <li><a href="#">iCard</a></li>
                                    <li><a href="#">Posts</a></li>
                                    <!--ACCESS MENUS FOR User-->
                                <?php elseif ($this->session->userdata('level') === '0'): ?>
                                    <li class="active"><a href="#">Dashboard</a></li>
                                    <li><a href="#">Posts</a></li>
                                    
                                    <!--ACCESS MENUS FOR NO FUNCIOANDO-->
                                <?php else: ?>
                                    <li class="active"><a href="#">Dashboard</a></li>
                                    <li><a href="#">Posts</a></li>
                                <?php endif; ?>
                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?php echo site_url('login/logout'); ?>">Salir</a></li>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div><!--/.container-fluid -->
                </nav>

                <div class="jumbotron">
                    <h1>Welcome Back <?php echo $this->session->userdata('username'); ?></h1>
                </div>
                
                <!--inicio zona de admin-->
                <?php if ($this->session->userdata('level') === '1'): ?>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="LogoConTitulo">
                                <img class="file" src="<?php echo base_url(); ?>img/admin.svg">
                                <h3>Panel de control</h3>
                            </div>
                            
                            <!--Modal de Registro-->
                           
                                <div class="modal fade" id="myModal" role="dialog">
                                    <div class="modal-dialog">
                                      <!-- Modal content-->
                                      <div class="modal-content adminModal">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                          <h4 class="modal-title colorTextadmin">Añade un nuevo usuario</h4>
                                        </div>
                                        <div class="modal-body">
                                          <div class="formulario">
                                          <form id="contact" method="post" action="<?php echo base_url(); ?>controladorRegistroUser/registrousuariosAdmin" autocomplete="nope">
                                            <!-- Nombre -->
                                            <div class="form_group">
                                                <img class="imgForm" src="<?php echo base_url(); ?>img/user.svg">
                                                <input id="nombreInput" type="text" name="nombre" value="<?php echo set_value('nombre'); ?>" placeholder="Nombre"  required>      
                                            </div>
                                            <!-- Apellido -->
                                            <div class="form_group">
                                                <img class="imgForm" src="<?php echo base_url(); ?>img/user.svg">
                                                <input id="apellidoInput" type="text" name="apellido" value="<?php echo set_value('apellido'); ?>" placeholder="Apellido" required>

                                            </div>
                                            <!-- Email -->
                                            <div class="form_group">
                                                <img class="imgForm" src="<?php echo base_url(); ?>img/mail.svg">
                                                <input id="emailInput" type="email" name="email" value="<?php echo set_value('email'); ?>" placeholder="Correo electrónico" required>
                                                <span class="text-danger"> <?php echo form_error('email') ?> </span>      
                                            </div>
                                            <!-- Usuario -->
                                            <div class="form_group">
                                                <img class="imgForm" src="<?php echo base_url(); ?>img/user.svg">
                                                <input id="usuarioInput" type="text" name="usuario" value="<?php echo set_value('usuario'); ?>" placeholder="Usuario" autocomplete="off" required>      
                                            </div>
                                            <!--Contraseña-->
                                            <div class="form_group">
                                                <img class="imgForm" src="<?php echo base_url(); ?>img/user.svg">
                                                <input id="passInput" type="password" name="passUser" value="<?php echo set_value('passUser'); ?>" placeholder="Contraseña" autocomplete="nope" required>   
                                            </div>
                                            <!-- Telefono -->
                                            <div class="form_group telefDI">
                                              <img class="imgForm" src="<?php echo base_url(); ?>img/user.svg">
                                              <input id="telefonoInput" type="tel" name="telefono" value="<?php echo set_value('telefono'); ?>" placeholder="Teléfono" required>  
                                            </div>
                                            <!-- Direccion -->
                                            <div class="form_group telefDI">
                                              <img class="imgForm" src="<?php echo base_url(); ?>img/user.svg">
                                              <input id="direccionInput" type="text" name="direccion" value="<?php echo set_value('direccion'); ?>" placeholder="Direccion" required> 
                                            </div>
                                            <p class="textNecesario colorTextadmin"><span class="rojoAsterisco">*</span>Es necesario rellenar todos los campos para comenzar la descarga</p>
                                            <p class="form-message"></p>
 
                                            <div class="adminZI">
                                                <p style="color: #ffff;">¿Admin?</p>
                                                <label class="switch">
                                                    <input type="checkbox" name="admin">
                                                    <span class="slider round"></span>
                                                </label>
                                            </div>
                                            <div class="contactoSumit">
                                              <button id="botonSumit" type="submit">Registrar</button>
                                            </div>
                                            
                                          </form><!--Cierre conten formulario-->
                                          </div> 
                                        </div> 
                                    </div>
                                </div>
                            </div>
                            <!--Cierre del modal-->
                            <button type="button" class="masADD" data-toggle="modal" data-target="#myModal"><img src="<?php echo base_url(); ?>img/plus.svg"></button>
                            <div class="container">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>ADMIN</th>
                                                <th>Verificado Email</th>
                                                <th>Nombre</th>
                                                <th>Apellido</th>
                                                <th>Correo</th>
                                                <th>Usuario</th>
                                                <th>Telefono</th>
                                                <th>Direccion</th>
                                                <th>Accion</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                        </tbody>
                                    </table>
                                                                        
                                </div>
                            </div>    
                        </div>
                    </div> 

                    <!--Fin zona admin-->    
                <?php endif; ?>
                <div class="row">
                    <div class="col-md-12">
                        <h3>Noticia</h3>
                        <p>
                            Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h3>Noticia</h3>
                        <p>
                            Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
                        </p>
                    </div>
                    <div class="col-md-12">
                        <h3>Noticia</h3>
                        <p>
                            Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto. Lorem Ipsum ha sido el texto de relleno estándar de las industrias desde el año 1500, cuando un impresor (N. del T. persona que se dedica a la imprenta) desconocido usó una galería de textos y los mezcló de tal manera que logró hacer un libro de textos especimen. No sólo sobrevivió 500 años, sino que tambien ingresó como texto de relleno en documentos electrónicos, quedando esencialmente igual al original. Fue popularizado en los 60s con la creación de las hojas "Letraset", las cuales contenian pasajes de Lorem Ipsum, y más recientemente con software de autoedición, como por ejemplo Aldus PageMaker, el cual incluye versiones de Lorem Ipsum.
                        </p>
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
                url: "<?php echo base_url(); ?>tablaController/load_data",
                dataType: "JSON",
                success: function (data) {
                    //Parte editable
                var html = '<tr>';
                    
                    //Datos de la tabla
                    for (var count = 0; count < data.length; count++)
                    {
                        if(data[count].admin == 1)
                        {
                            var checkedAD = "checked='checked'";
                        }else{
                            var checkedAD = "";
                        }
                        
                        if(data[count].email_validado == 1)
                        {
                            var checkedEM = "checked='checked'";
                        }else{
                            var checkedEM = "";
                        }
                        
                       
                        
                        html += '<tr>';
                        html += '<td class="table_data table_data_id" data-row_id="' + data[count].id + '" data-column_name="id" contenteditable>' + data[count].id + '</td>';
                        html += '<td class="table_data centradoCO" data-row_id="' + data[count].id + '" data-column_name="admin"><label class="switch labelnone"><input id="inter" type="checkbox" ' + checkedAD +' name="admin"><span class="slider round"></span></label></td>';
                        html += '<td class="table_data centradoCO" data-row_id="' + data[count].id + '" data-column_name="email_validado"><label class="switch labelnone"><input id="emailinter" type="checkbox" ' + checkedEM +' name="email_validado"><span class="slider round"></span></label></td>';
                        html += '<td class="table_data" data-row_id="' + data[count].id + '" data-column_name="nombre" contenteditable>' + data[count].nombre + '</td>';
                        html += '<td class="table_data" data-row_id="' + data[count].id + '" data-column_name="apellido" contenteditable>' + data[count].apellido + '</td>';
                        html += '<td class="table_data" data-row_id="' + data[count].id + '" data-column_name="email" contenteditable>' + data[count].email + '</td>';
                        html += '<td class="table_data" data-row_id="' + data[count].id + '" data-column_name="usuario" contenteditable>' + data[count].usuario + '</td>';
                        html += '<td class="table_data" data-row_id="' + data[count].id + '" data-column_name="telefono" contenteditable>' + data[count].telefono + '</td>';
                        html += '<td class="table_data" data-row_id="' + data[count].id + '" data-column_name="direccion" contenteditable>' + data[count].direccion + '</td>';
                        html += '<td class="centradoCO"><button type="button" name="delete_btn" id="' + data[count].id + '" class="btn btn-xs btn-danger btn_delete "><span class="glyphicon glyphicon-remove"></span></button></td></tr>';
                    }
                    $('tbody').html(html);
                }
            });
        }

        load_data();
        
        
        //Inserta en la tabla admin
        
        $(document).on('click', '#inter', '.table_data', function () {
        
        if($('#inter').prop('checked')) {
            
            var value = 1;
            var table_column = $(this).parent().parent().data('column_name');
            var idPadre= $(this).parent().parent().attr('data-row_id');
            var id = $(this).data('row_id');
            
            $.ajax({
                url: "<?php echo base_url(); ?>tablaController/update",
                method: "POST",
                data: {id: idPadre, table_column: table_column, value: value},
                success: function (data)
                {
                    load_data();
                }
            })
        
        }    
        
        if($('#inter').prop('checked=""')) {

            var value = 0;
            var table_column = $(this).parent().parent().data('column_name');
            var idPadre= $(this).parent().parent().attr('data-row_id');
            var id = $(this).data('row_id');
            $.ajax({
                url: "<?php echo base_url(); ?>tablaController/update",
                method: "POST",
                data: {id: idPadre, table_column: table_column, value: value},
                success: function (data)
                {
                    load_data();
                }
            })
        
        }
        if($('#inter').prop('checked')) {
            
            var value = 0;
            var table_column = $(this).parent().parent().data('column_name');
            var idPadre= $(this).parent().parent().attr('data-row_id');
            var id = $(this).data('row_id');
            $.ajax({
                url: "<?php echo base_url(); ?>tablaController/update",
                method: "POST",
                data: {id: idPadre, table_column: table_column, value: value},
                success: function (data)
                {
                    load_data();
                }
            })
        
        }
        
        
           
        });
        
        
        //Inserta en la tabla email
        $(document).on('click', '#emailinter', '.table_data', function () {
        
        if($('#emailinter').prop('checked')) {
            
            var value = 1;
            var table_column = $(this).parent().parent().data('column_name');
            var idPadre= $(this).parent().parent().attr('data-row_id');
            var id = $(this).data('row_id');
            $.ajax({
                url: "<?php echo base_url(); ?>tablaController/update",
                method: "POST",
                data: {id: idPadre, table_column: table_column, value: value},
                success: function (data)
                {
                    load_data();
                }
            })
        
        }    
        
        if($('#emailinter').prop('checked=""')) {

            var value = 0;
            var table_column = $(this).parent().parent().data('column_name');
            var idPadre= $(this).parent().parent().attr('data-row_id');
            var id = $(this).data('row_id');
            $.ajax({
                url: "<?php echo base_url(); ?>tablaController/update",
                method: "POST",
                data: {id: idPadre, table_column: table_column, value: value},
                success: function (data)
                {
                    load_data();
                }
            })
        
        }
        if($('#emailinter').prop('checked')) {
            
            var value = 0;
            var table_column = $(this).parent().parent().data('column_name');
            var idPadre= $(this).parent().parent().attr('data-row_id');
            var id = $(this).data('row_id');
            $.ajax({
                url: "<?php echo base_url(); ?>tablaController/update",
                method: "POST",
                data: {id: idPadre, table_column: table_column, value: value},
                success: function (data)
                {
                    load_data();
                }
            })
        
        }
        
        
           
        });
        
  
        //Inserta en la Update
        $(document).on('blur', '.table_data', function () {
         setTimeout(remova,4000);
            var id = $(this).data('row_id');
            var table_column = $(this).data('column_name');
            var value = $(this).text();
            if(table_column != 'admin' && table_column != 'email_validado'){

                $.ajax({
                    url: "<?php echo base_url(); ?>tablaController/update",
                    method: "POST",
                    data: {id: id, table_column: table_column, value: value},
                    success: function (data)
                    {
                        $(".table_data_id").each(function(){
                            var idtable = $(this).attr("data-row_id");
                            
                            if( id == idtable){
                                $(this).parent().addClass('columnedit');
                            }
                        });
                        
                    }
                })
            }
        });
        
        
         
         function remova(){
             $('.columnedit').removeClass('columnedit');
        }
        //Inserta en la Borrar
        $(document).on('click', '.btn_delete', function () {
            var id = $(this).attr('id');
            
            Swal.fire({
                title: '¿Estas seguro?',
                text: "Estas a punto de eliminar un usuario!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borralo!'
            }).then((result) => {
                if (result.value) {
                    Swal.fire(
                        'Borrado!',
                        'El usuario a sido eliminado con exito.',
                        'success',
                        $.ajax({
                            url: "<?php echo base_url(); ?>tablaController/delete",
                            method: "POST",
                            data: {id: id},
                            success: function (data) {
                                load_data();
                            }
                        })        
                    )
                }
            })
        });
    });
</script>