<?php header('Access-Control-Allow-Origin: *');

    $email = $_GET['email'];
    $senhaEmail = $_GET['senhaEmail'];

    $conexao = mysqli_connect("localhost","root","usbw","bdpsicokids");
    
    // Checando conexão com o banco
    if (mysqli_connect_error())
    {
        echo "Falha ao conectar com o banco: " . mysqli_connect_error();
    }

    // Login
    $responsavel = "SELECT idResponsavel FROM responsavel WHERE email='".$email."' AND senhaEmail='".$senhaEmail."'" ;
    $responsavel = str_replace("\'","",$responsavel);
    $resultado = mysqli_query($conexao,$responsavel);

    while($row = mysqli_fetch_array($resultado))
    {
        echo $row['idResponsavel'];
    }

    // Fecha conexão com o banco
    mysqli_close($conexao);
    ?>
