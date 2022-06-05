<?php header('Access-Control-Allow-Origin: *');

    include_once 'conexao.php';

    // Pegando valores dos campos declarados no construct
    $nome = $_GET['nome'];
    $email = $_GET['email'];
    $senhaEmail = md5($_GET['senhaEmail']);
    $senhaAcesso = md5($_GET['senhaAcesso']);

    $consultaSelecionada = "SELECT email FROM responsavel WHERE email = '$email'";
    $seleciona = mysqli_query($conexao, $consultaSelecionada);
    $retornoConsulta = $seleciona;
    $valorCadastro = $retornoConsulta['email'];

    if($email == "" || $email == null)
    {
        echo"Por favor, preencha todos os campos";
    }
    
    else
    {
        if($valorCadastro == $email)
        {
            echo"Usuário já cadastrado";
            
            die();
        }

        else
        {
            $cadastro = "INSERT INTO responsavel (idResponsavel, nome, email, senhaEmail, senhaAcesso, idCrianca) VALUES (NULL, '$nome','$email', '$senhaEmail', '', '')";
            $insere = mysqli_query($conexao, $cadastro);
    
            if($insere)
            {
                echo $linha['idResponsavel'];
            }
            
            else
            {
                echo"Não foi possível cadastrar esse usuário";
            }
        }
    }
      
    //$responsavel = "CALL spCadastrarResponsavel (:nomeResponsavel, :email, :senhaEmail)"
    // Fecha conexão com o banco
    mysqli_close($conexao);

?>