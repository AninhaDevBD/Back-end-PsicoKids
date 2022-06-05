<?php header('Access-Control-Allow-Origin: *');

    include_once 'conexao.php';

    // Pegando valores dos campos declarados no construct
    $senhaAcesso = $_GET['senhaAcesso'];

    /* Verificando se a senha de acesso digitada pelo usuário existe no banco.
    Enquanto a senha digitada for existente em algum registro do banco, o usuário é autenticado*/
    
    $responsavel = "SELECT idResponsavel FROM responsavel WHERE senhaAcesso='".$senhaAcesso."'";
    
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