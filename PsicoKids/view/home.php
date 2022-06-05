<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=h1, initial-scale=1.0">
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="<?php echo URL; ?>recursos/css/bootstrap.min.css">
    <title>Etec News</title>
</head>
<body>

<?php include "menu.php"; ?>

<div class="container-fluid">
    <div class="row mt-2">
        <div class="col-sm-4">
            
            <div class="card">
                <div class="card-header">
                    Categorias
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Tecnologia</li>
                    <li class="list-group-item">Esportes</li>
                    <li class="list-group-item">Natureza</li>
                </ul>
            </div>

        </div>

        <div class="col-sm-8">
            
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Pesquisar..." aria-label="Pesquisar..." aria-describedby="button-addon2">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" id="button-addon2">OK</button>
                </div>
            </div>

            <div class="card mb-3">
                <img class="card-img-top" src="recursos/img/combustivel.jpg" alt="Imagem de capa do card">
                <div class="card-body">
                    <h5 class="card-title">Título do card</h5>
                    <p class="card-text">Este é um card maior com suporte a texto embaixo, que funciona como uma introdução a um conteúdo adicional. Este conteúdo é um pouco maior, para demonstração.</p>
                    <p class="card-text"><small class="text-muted">Atualizados 3 minutos atrás</small></p>
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
</body>
</html>