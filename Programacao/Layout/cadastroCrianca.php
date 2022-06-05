<?php header('Access-Control-Allow-Origin: *');

    include_once 'conexao.php';

    // Pegando valores dos campos declarados no construct
    $nome = $_GET['nomeCrianca'];
    $idade = $_GET['idade'];
    $serie = $_GET['serie'];
    $sexo = $_GET['sexo'];
    
    $consultaSelecionada = "SELECT idCrianca FROM crianca INNER JOIN responsavel ON crianca.idCrianca = responsavel.idCrianca";
    $selecionada = mysql_query($consultaSelecionada,$conexao);
    $valorRetorno = mysqli_fetch_array($selecionada);
    $valorCadastro = $valorRetorno['email'];
    
    if($nome == "" || $nome == null)
    {
        echo"Por favor, preencha todos os campos";
    }
    
    else
    {
        if($valorCadastrado == $nome)
        {
            echo"Usuário já cadastrado";
            die();
        }
        
        else
        {
            $valor = "INSERT INTO crianca (nomeCrianca, idade, serie, sexo) VALUES ('$nome','$idade', '$serie', '$sexo')";
            $insere = mysql_query($valor,$conexao);
    
            if($insere)
            {
                echo $linha['idCrianca'];
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