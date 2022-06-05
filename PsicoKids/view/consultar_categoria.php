<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="<?php echo URL; ?>recursos/css/bootstrap.min.css">
    <!--CSS DataTables-->
    <link rel="stylesheet" type="text/css" href="<?php echo URL;?>recursos/css/jquery.dataTables.css">
    <!--CSS DataTables Buttons-->
    <link rel="stylesheet" type="text/css" href="<?php echo URL;?>recursos/css/buttons.dataTables.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Notícias Etec</title>
</head>
<body>
<?php include "menuadm.php"; ?>
<div class="container">
    <div class="row mt-3">
        <div class="col-sm-8 mx-auto">

            <div class="card">
                <div class="card-header bg-primary text-white">
                    Consulta de Categorias
                </div>
                <div class="card-body table-responsive">
                    <table class="table table-striped" id="tabela_dados">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Categoria</th>
                                <th>Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach($dadosCategoria as $value)
                            {   
                                if($_SESSION["dadosUsuario"]->nivelacesso == 1) 
                                {                          
                                    echo"<tr>
                                        <td>$value->idcategoria</td>
                                        <td>$value->nomecategoria</td>
                                        <td>
                                            <a href='".URL."excluir-categoria/$value->idcategoria' class='btn btn-danger btn-sm' onclick='return confirm(\"Deseja realmente excluir?\")'><i class='fa fa-trash'></i> Excluir</a>
                                            <a href='".URL."editar-categoria/$value->idcategoria' class='btn btn-warning btn-sm' onclick='excluir()'><i class='fa fa-edit'></i> Editar</a>
                                        </td>
                                    </tr>";
                                }
                                else
                                {
                                    echo"<tr>
                                    <td>$value->idcategoria</td>
                                    <td>$value->nomecategoria</td>
                                    <td>
                                        <a href='".URL."editar-categoria/$value->idcategoria' class='btn btn-warning btn-sm' onclick='excluir()'><i class='fa fa-edit'></i> Editar</a>
                                    </td>
                                </tr>";
                                }
                            }
                            ?>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</div>

<!-- JS Query--> 
<script type="text/javascript" charset="utf8" src="<?php echo URL;?>recursos/js/jquery-3.5.1.js"></script>
<!-- JS Bootstrap -->
<script src="<?php echo URL; ?>recursos/js/popper.min.js"></script>
<script src="<?php echo URL; ?>recursos/js/bootstrap.min.js"></script>
<!-- JS DataTables--> 
<script type="text/javascript" charset="utf8" src="<?php echo URL;?>recursos/js/jquery.dataTables.js"></script>
<!-- JS DataTables Buttons--> 
<script type="text/javascript" charset="utf8" src="<?php echo URL;?>recursos/js/dataTables.buttons.min.js"></script>
<!-- JS DataTables Zip--> 
<script type="text/javascript" charset="utf8" src="<?php echo URL;?>recursos/js/jszip.min.js"></script>
<!-- JS DataTables PDF MAKE--> 
<script type="text/javascript" charset="utf8" src="<?php echo URL;?>recursos/js/pdfmake.min.js"></script>
<!-- JS DataTables PDF FONT--> 
<script type="text/javascript" charset="utf8" src="<?php echo URL;?>recursos/js/vfs_fonts.js"></script>
<!-- JS DataTables PDF HTML5--> 
<script type="text/javascript" charset="utf8" src="<?php echo URL;?>recursos/js/buttons.html5.min.js"></script>
<!-- JS DataTables PDF BUTTONS PRINT--> 
<script type="text/javascript" charset="utf8" src="<?php echo URL;?>recursos/js/buttons.print.min.js"></script>

<script>
$(document).ready(function() {
    $('#tabela_dados').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]        
    }
    );
} );

</script>

</body>
</html>