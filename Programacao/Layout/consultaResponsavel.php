<?php header('Access-Control-Allow-Origin: *');

    include_once 'conexao.php';

    // Pegando valores dos campos declarados no construct
    $nome = $_GET['nome'];
    $email = $_GET['email'];
    $senhaEmail = password_hash($_GET['senhaEmail'], PASSWORD_DEFAULT);

        // Cadastrando responsável através do procedimento de cadastro feito no banco   
    $responsavel = "CALL spConsultaResponsavel (:nomeResponsavel, :email, :senhaEmail)";

    // Fecha conexão com o banco
    mysqli_close($conexao);

?>