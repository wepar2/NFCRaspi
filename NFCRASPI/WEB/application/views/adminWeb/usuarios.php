<!--inicio zona de admin-->
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
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@8.10.7/dist/sweetalert2.all.min.js"></script>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/icard.css">
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
                                <!--ACCESS MENUS FOR ADMIN-->

                                    <li><a href="<?php echo site_url('zona-admin'); ?>">Inicio</a></li>
                                    <li class="active"><a href="<?php echo site_url('usuarios');?>">Usuarios</a></li>
                                    <li><a href="<?php echo site_url('ultimo-acceso');?>">Acceso</a></li>
                                    <li><a href="#">iCard</a></li>
                                    <li><a href="#">Posts</a></li>

                            </ul>
                            <ul class="nav navbar-nav navbar-right">
                                <li><a href="<?php echo site_url('login/logout'); ?>">Salir</a></li>
                            </ul>
                        </div><!--/.nav-collapse -->
                    </div><!--/.container-fluid -->
                </nav>


                    
                <div class="row">
                    <div class="col-md-12">
                        <div class="LogoConTitulo">
                            <img class="file" src="<?php echo base_url(); ?>img/userTable.svg">
                            <h3>Usuarios iCard</h3>
                        </div>
                        <!--Modal de Subir Foto-->
                        <div class="modal modalup" id="ModalFoto" role="dialog">
                            <div class="modal-dialog">
                              <!-- Modal content-->
                              <div class="modal-content adminModal">
                                <div class="modal-header">
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                                  <h4 class="modal-title colorTextadmin">Sube una foto</h4>
                                </div>
                                <div class="modal-body">
                                  <div class="formulario">                                   
                                    <?php echo form_open_multipart('adminWeb/upFile/image_upload' , array('id' => 'img'));?>
                                        <div class="form-group uploader">
                                            <img class="file" src="<?php echo base_url();?>img/outboxTR.svg">
                                            <input type="hidden" name="id" id="idHH">
                                            <input type="file" class="upload" name="pic" tabindex="2" accept="image/png, .jpeg, .jpg, image/gif, image/PNG, .JPEG .JPG .image/GIF" required>
                                        </div> 
                                        <div class="form-group">
                                            <div class="contactoSumit">
                                                <button id="botonSumit" name="submit" type="submit" id="img-submit" data-submit="...Sending">Subir</button>
                                            </div>
                                        </div>
                                    </form>
                                  </div> 
                                </div>
                            </div>
                        </div><!--Cierre del modal-->
                    </div>
                </div> 
                    <!--iCard data-->
                <div class="container card">
                    <div class="row cardIDF">
                    </div><!-- /container -->
                </div>

            </div>
        </div>         
    </body>
</html>
<script type="text/javascript" language="javascript" >
    $(document).ready(function () {
        
        
        //Tarjeta en iCard
        
        function icard()
        {
            
            $.ajax({
            url: "<?php echo base_url(); ?>adminWeb/Usuarios/load_data",
            dataType: "JSON",
            success: function (data) {

                var html = '';    
                    for(var count=0; count < data.length; count++)
                    {   

                        //Condicional Imagen
                        if(!data[count].foto)
                        {
                            var fotoNo = '<img class="fileICA" id="nodata" src="<?php echo base_url(); ?>img/no-foto.svg">';
                        }else{
                            var fotoNo = '<div class="imgFile" id="siData" style="background: url(<?php echo base_url(); ?>'+data[count].foto+');background-position: center;background-size: cover; position: relative;"></div>';
                        }

                        //Condicional Switch
                        if(data[count].activo == 1)
                        {
                            var checkedAC = "checked='checked'";
                        }else{
                            var checkedAC = "";
                        }

                        //Condicional Null en fecha de acceso
                        if(data[count].fechaEntrada == null)
                        {
                            var fechaEnter = "no hay datos";
                        }else{
                            var fechaEnter = data[count].fechaEntrada;
                        }

                        html += '<div class="col-sm-6 col-md-4">';
                            html += '<div class="card card-price">';
                                        html += '<div class="reglon">';
                                                html += '<p class="titleCard">ICARD KIBO</p>';
                                                html += '<button type="button" name="delete_btn" id="' + data[count].id + '" class="btn_delete botonX"><img class="fileX" src="<?php echo base_url(); ?>img/x-button.svg"></button>';
                                        html += '</div>';
                                        html +='<div class="card-img">';
                                            html += '<img class="table_data img-responsive" data-row_id="' + data[count].id + '" data-column_name="foto">' + fotoNo + '';
                                                html += '<div class="card-body">';
                                                    html += '<div class="nombreCard">';
                                                            html += '<p class="table_data nombreCard" data-row_id="' + data[count].id + '" data-column_name="nombre" contenteditable>' + data[count].nombre + ' <p>';
                                                    html += '</div>';
                                                    html += '<div class="datosMas">';
                                                        html += '<div class="row">';
                                                                html += '<div class="col-xs-6 col-sm-6 col-md-6 colDER">';
                                                                    html += '<p>UID:</p>';
                                                                html += '</div>';
                                                                html += '<div class="col-xs-6 col-sm-6 col-md-6 colIZQ">';
                                                                    html += '<p class="table_data " data-row_id="' + data[count].id + '" data-column_name="uid" contenteditable>' + data[count].uid + '<p>';
                                                                html += '</div>';
                                                        html += '</div>';
                                                        html += '<div class="row">';
                                                                html += '<div class="col-xs-6 col-sm-6 col-md-6 colDER">';
                                                                    html += '<p>Fecha Registro:</p>';
                                                                html += '</div>';
                                                                html += '<div class="col-xs-6 col-sm-6 col-md-6 colIZQ">';
                                                                    html += '<p class="table_data" data-row_id="' + data[count].id + '" data-column_name="fechaRegistro" contenteditable>' + data[count].fechaRegistro + ' <p>';
                                                                html += '</div>';
                                                        html += '</div>';
                                                        html += '<div class="row">';
                                                                html += '<div class="col-xs-6 col-sm-6 col-md-6 colDER">';
                                                                    html += '<p>Ultimo Acceso:</p>';
                                                                html += '</div>';
                                                                html += '<div class="col-xs-6 col-sm-6 col-md-6 colIZQ">';
                                                                    html += '<p class="table_data" data-row_id="' + data[count].id + '" data-column_name="fechaEntrada">' + fechaEnter + '<p>';
                                                                html += '</div>';
                                                        html += '</div>';
                                                        html += '<div class="row">';
                                                            html += '<div class="col-xs-6 col-sm-6 col-md-6 colDER">';
                                                                html += '<p class="activoTE">Activo</p>';
                                                            html += '</div>';
                                                            html += '<div class="col-xs-6 col-sm-6 col-md-6 colIZQ">';
                                                                html += '<label data-row_id="' + data[count].id + '" data-column_name="activo" class="table_data centradoCO switch labelnone"><input id="inter" type="checkbox" ' + checkedAC +' name="email_validado"><span class="slider round"></span></label>';
                                                            html += '</div>';
                                                        html += '</div>';
                                                    html += '</div>';
                                                html += '</div>';
                                            html +='</div>';
                                            html += '<div class="reglonFINAL">';
                                                html += '<img class="imgReglon" src="<?php echo base_url(); ?>img/rpi.png">';
                                                html += '<img class="imgReglonN" src="<?php echo base_url(); ?>img/nfc.png">';
                                                html += '<img class="imgReglonN" src="<?php echo base_url(); ?>img/wifi.jpg">';
                                                html += '<img class="imgReglonN" src="<?php echo base_url(); ?>img/logoKI.png">';
                                        html += '</div>';
                                    html +='</div>';
                            html += '</div>';
                        html += '</div>';
                    }
                $('.cardIDF').html(html); 

                    //Captura el evento si no hay foto establecida en el perfil                    
                    $(document).on('click', '#nodata', '.table_data', function () {
                        var idPA = $(this).siblings().attr('data-row_id')

                        $("#ModalFoto").modal("show");
                        $("#idHH").val(idPA);
                    });

                    //Captura foto y si hay una existente hace una comprobacion antes de modificarla
                    $(document).on('click', '#siData', '.table_data', function () {
                        var idPA = $(this).siblings().attr('data-row_id')
                        
                        Swal.fire({
                        title: '¿Estas seguro?',
                        text: "Estas a punto de modificar una imagen ya establecida!",
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Si, borralo!'
                        }).then((result) => {
                            if (result.value) {
                                    $("#ModalFoto").modal("show");
                                    $("#idHH").val(idPA);  
                            }
                        })

                        swal({
                            title: "¿Estas Seguro?",
                            text: "Estas a punto de modificar una imagen ya establecida!",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {

                                $("#ModalFoto").modal("show");
                                $("#idHH").val(idPA);


                            } else {
                               swal("Accion cancelada!");
                            }
                        });

                    });
                }//fin del success de data ajax1
            })//Fin del ajax1
            
               
           
        }//Fin funcion de icard()
        
        icard();
        
        
        
        //Inserta en la tabla Activo
        
        $(document).on('click', '#inter', '.table_data', function () {
        
            if($('#inter').prop('checked')) {

                var value = 1;
                var table_column = $(this).parent().data('column_name');
                var idPadre = $(this).parent().attr('data-row_id');
                console.log(table_column);
                $.ajax({
                    url: "<?php echo base_url(); ?>adminWeb/Usuarios/update",
                    method: "POST",
                    data: {id: idPadre, table_column: table_column, value: value},
                    success: function (data)
                    {
                        icard();
                    }
                })

            }    

            if($('#inter').prop('checked=""')) {

                var value = 0;
                var table_column = $(this).parent().data('column_name');
                var idPadre = $(this).parent().attr('data-row_id');
                var id = $(this).data('row_id');
                $.ajax({
                    url: "<?php echo base_url(); ?>adminWeb/Usuarios/update",
                    method: "POST",
                    data: {id: idPadre, table_column: table_column, value: value},
                    success: function (data)
                    {
                        icard();
                    }
                })

            }
            if($('#inter').prop('checked')) {

                var value = 0;
                var table_column = $(this).parent().data('column_name');
                var idPadre = $(this).parent().attr('data-row_id');
                var id = $(this).data('row_id');
                $.ajax({
                    url: "<?php echo base_url(); ?>adminWeb/Usuarios/update",
                    method: "POST",
                    data: {id: idPadre, table_column: table_column, value: value},
                    success: function (data)
                    {
                        icard();
                    }
                })

            }


           
        });


        //Inserta en la Update
        $(document).on('blur', '.table_data', function () {
        /* Remueve la clase sobre la td a los 4 segundos*/
         setTimeout(remova,4000);
            var id = $(this).data('row_id');
            var table_column = $(this).data('column_name');
            var value = $(this).text();
            if(table_column != 'activo'){

                $.ajax({
                    url: "<?php echo base_url(); ?>adminWeb/Usuarios/update",
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
                text: "Estas a punto de eliminar una iCard!",
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
                            url: "<?php echo base_url(); ?>adminWeb/Usuarios/delete",
                            method: "POST",
                            data: {id: id},
                            success: function (data) {
                                icard();
                            }
                        })
                    )
                }
            })
        });
    });
</script>
<?php else: ?>
    <?php
    header('Status: 301 Moved Permanently', false, 301);
    header('Location: ../');
    ?>


<?php endif; ?>   <!--Fin zona admin-->