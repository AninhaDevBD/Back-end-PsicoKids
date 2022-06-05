<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="<?php echo URL; ?>recursos/css/bootstrap.min.css">
    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>ADM</title>
</head>
<body>
  <?php include "menuadm.php";?>
  <div class="container">
    <div class="row mt-3">
        <div class="col-sm-12">
          <div class="alert alert-success" role="alert">
            <h4 class="alert-heading">Bem-vindo(a) <?php echo $_SESSION["dadosUsuario"]->nome; ?>!</h4>
            <p>Este é um sistema desenvolvido com PHP e MySQL utilizando o padrão MVC como parte da disciplina de Programação Web III.</p>
            <hr>
            <p class="mb-0">Professor: Anderson Spera / Paulo Jacobsen</p>
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