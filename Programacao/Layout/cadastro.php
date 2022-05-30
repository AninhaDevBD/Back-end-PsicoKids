<?php header('Access-Control-Allow-Origin: *');

    include_once 'conexao.php';

    // Pegando valores dos campos declarados no construct
    $nome = $_GET['nome'];
    $telefone = $_GET['telefone'];
    $email = $_GET['email'];
    $senhaEmail = $_GET['senhaEmail'];

       // Se e-mail já estiver registrado no banco, setar mensagem -> "E-mail já cadastrado"
       if($email = ":email")
       {
           echo "E-mail já cadastrado";
       }

    // Cadastrando responsável através do procedimento de cadastro feito no banco   
    $responsavel = "CALL spCadastrarResponsavel (:nomeResponsavel, :telefone, :email, :senhaEmail)";

    // Fecha conexão com o banco
    mysqli_close($conexao);

?>