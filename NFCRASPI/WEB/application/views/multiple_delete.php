<html>
    <head>
        <meta charset="utf-8">
        <title>Welcome</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.css"/>
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/style.css">
        <link rel="stylesheet" href="<?php echo base_url(); ?>css/tabla.css">
        <script src="<?php echo base_url(); ?>js/jquery.js"></script>
        <script src="<?php echo base_url(); ?>js/bootstrap.min.js"></script>
        <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script>
        <script src="<?php echo base_url(); ?>js/script.js"></script>
    </head>
    <body>
        <div class="row">
            <div class="col-md-12">
                <div class="container">
                    <br /><br /><br />
                    <h3 align="center">Edicion</h3><br />
                    <div class="table-responsive">
                        <table class="display" id="table_id">
                            <thead>
                                <tr>
                                    <th width="5%"><button type="button" name="delete_all" id="delete_all" class="btn btn-danger btn-xs">Delete</button></th>
                                    <th width="5%">ID</th>
                                    <th width="5%">ADMIN</th>
                                    <th width="5%">Verificado</th>
                                    <th width="15%">Nombre</th>
                                    <th width="10%">Apellido</th>
                                    <th width="10%">Correo</th>
                                    <th width="15%">Usuario</th>
                                    <th width="10%">Telefono</th>
                                    <th width="38%">Direccion</th>
                                    <th width="38%"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($employee_data->result() as $row) {
                                    echo '
                                    <tr>
                                        <td><input type="checkbox" class="delete_checkbox" value="' . $row->id . '" /></td>
                                        <td>' . $row->id . ' </td>
                                        <td>' . $row->admin . '</td>
                                        <td>' . $row->email_validado . '</td>
                                        <td>' . $row->nombre . '</td>
                                        <td>' . $row->apellido . '</td>
                                        <td>' . $row->email . '</td>
                                        <td>' . $row->usuario . '</td>
                                        <td>' . $row->telefono . '</td>
                                        <td>' . $row->direccion . '</td>
                                        <td><a href="'.site_url().'modificar/index?edit='.$row->id.'">Edit</a></td>          
                                    </tr>
                                    ';
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <br>
                            <a href="<?php echo site_url('page');?>">Volver</a>
                        </div>
                    </div> 
                </div>
            </div>
        </div>    
    </body>
</html>
<style>
    .removeRow
    {
        background-color: #FF0000;
        color:#FFFFFF;
    }
</style>
<script>
    $(document).ready(function () {

        $('.delete_checkbox').click(function () {
            if ($(this).is(':checked'))
            {
                $(this).closest('tr').addClass('removeRow');
            }
            else
            {
                $(this).closest('tr').removeClass('removeRow');
            }
        });

        $('#delete_all').click(function () {
            var checkbox = $('.delete_checkbox:checked');
            if (checkbox.length > 0)
            {
                var checkbox_value = [];
                $(checkbox).each(function () {
                    checkbox_value.push($(this).val());
                });
                $.ajax({
                    url: "<?php echo base_url(); ?>multiple_delete/delete_all",
                    method: "POST",
                    data: {checkbox_value: checkbox_value},
                    success: function ()
                    {
                        $('.removeRow').fadeOut(1500);
                    }
                })
            }
            else
            {
                alert('Select atleast one records');
            }
        });

    });
</script>