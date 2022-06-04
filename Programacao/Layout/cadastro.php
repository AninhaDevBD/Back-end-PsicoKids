<?php header('Access-Control-Allow-Origin: *');

    include_once 'conexao.php';

    // Pegando valores dos campos declarados no construct
    $nome = $_GET['nome'];
    //$telefone = $_GET['telefone'];
    $email = $_GET['email'];
    $senhaEmail = password_hash($_GET['senhaEmail'], PASSWORD_DEFAULT);

    // Cadastrando responsável através do procedimento de cadastro feito no banco   
    $responsavel = "CALL spCadastrarResponsavel (:nomeResponsavel, :email, :senhaEmail)";

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