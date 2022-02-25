<!doctype html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
        <script src="<?php echo base_url(); ?>js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script src="<?php echo base_url(); ?>js/script.js"></script>
        
        <title>Editar</title
    </head>
    <body>
    <?php 
        // All users list
        if(isset($view) && $view == 1)  {
            ?>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h3>ROTO</h3>
                        <div class="table-responsive">
                            <table class="display" id="table_id">
                                <thead>
                                    <tr>
                                        <th width="6%">ID</th>
                                        <th width="5%">ADMIN</th>
                                        <th width="5%">Verificado</th>
                                        <th width="15%">Nombre</th>
                                        <th width="10%">Apellido</th>
                                        <th width="10%">Correo</th>
                                        <th width="15%">Usuario</th>
                                        <th width="10%">Telefono</th>
                                        <th width="38%">Direccion</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 

                                    foreach($response as $val){  
                                        echo '<tr>
                                            <td>'.$val['id'].'</td>
                                            <td>'.$val['admin'].'</td>
                                            <td>'.$val['email_validado'].'</td>    
                                            <td>'.$val['nombre'].'</td>
                                            <td>'.$val['apellido'].'</td>
                                            <td>'.$val['email'].'</td>
                                            <td>'.$val['usuario'].'</td>
                                            <td>'.$val['telefono'].'</td>
                                            <td>'.$val['direccion'].'</td>    
                                            <td><a href="'.site_url().'modificar/index?edit='.$val['id'].'">Edit</a></td>
                                        </tr>';
                                    }
                                    ?>
                                </tbody>    
                            </table>
                        </div>    
                    </div>
                </div>    
            <?php
        } 

        // Edit user
        if(isset($view) && $view == 2)  {
        ?>
                
                
        <form method='post' action=''>
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="modal fade" id="edit" tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <div class="modal-body"
                                             
                                            <p class="espacio">ID</p> 
                                            <input id="editInput" type='text' name='txt_id' value='<?php echo $response[0]['id']; ?>'>
                                            <p class="espacio">Admin</p> 
                                            <input id="editInput" type='text' name='txt_admin'  value='<?php echo $response[0]['admin']; ?>'>
                                            <p class="espacio">Email Validado</p> 
                                            <input id="editInput" type='text' name='txt_validado' value='<?php echo $response[0]['email_validado']; ?>'>
                                            <p class="espacio">Nombre</p> 
                                            <input id="editInput" type='text' name='txt_nombre' value='<?php echo $response[0]['nombre']; ?>'>
                                            <p class="espacio">Apellido</p> 
                                            <input id="editInput" type='text' name='txt_apellido' value='<?php echo $response[0]['apellido']; ?>'>
                                            <p class="espacio">Email</p>
                                            <input id="editInput" type='text' name='txt_email' value='<?php echo $response[0]['email']; ?>'>
                                            <p class="espacio">Usuario</p> 
                                            <input id="editInput" type='text' name='txt_usuario' value='<?php echo $response[0]['usuario']; ?>'>
                                            <p class="espacio">Telefono</p> 
                                            <input id="editInput" type='text' name='txt_telefono' value='<?php echo $response[0]['telefono']; ?>'>
                                            <p class="espacio">Direccion</p> 
                                            <input id="editInput" type='text' name='txt_direccion' value='<?php echo $response[0]['direccion']; ?>'>
                                           <input type='submit' name='submit' value='Submit'></td>
                                        </div>    
                                    </div>
                                </div>
                            </div>    
                        </div>    
                    </div>
                </div>
            </div>                             
            
        </form>
    <?php
        }
    ?>
    </body>
</html>