<?php header('Access-Control-Allow-Origin: *');

    include_once 'conexao.php';

    // Pegando valores dos campos declarados no construct
    $email = $_GET['email'];
    $senhaEmail = $_GET['senhaEmail'];

    /* Verificando se o e-mail e senha digitados pelo usuário existem no banco.
    Enquanto o email e senha digitados forem igual aos existentes em registro no banco, o usuário é autenticado*/
    
    $responsavel = "SELECT idResponsavel FROM responsavel WHERE email='".$email."' AND senhaEmail='".$senhaEmail."'" ;
    
    $responsavel = str_replace("\'","",$responsavel);
    $resultado = mysqli_query($conexao,$responsavel);

    // Enquanto o banco retornar linha afetada da busca do e-mail e senha digitados, o id é retornado e o usuário permanece logado
    while($linha = mysqli_fetch_array($resultado))
    {
        echo $linha['idResponsavel'];
    }

    // Fecha conexão com o banco
    mysqli_close($conexao);
?>