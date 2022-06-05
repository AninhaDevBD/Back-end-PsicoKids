<?php header('Access-Control-Allow-Origin: *');

    include_once 'conexao.php';

    // Pegando valores dos campos declarados no construct
    $senhaAcesso = $_GET['senhaAcesso'];
           // Se e-mail já estiver registrado no banco, setar mensagem -> "E-mail já cadastrado"
       if($senhaAcesso = ":senhaAcesso")
       {
           echo "E-mail já cadastrado";
       }

    // Cadastrando responsável através do procedimento de cadastro feito no banco   
    $responsavel = "CALL spCadastrarSenhaAcesso (:senhaAcesso)";

    // Fecha conexão com o banco
    mysqli_close($conexao);

?>