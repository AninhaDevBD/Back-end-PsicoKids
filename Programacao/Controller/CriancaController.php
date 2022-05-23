<?php

    include_once "Model/crianca.php";

    // Permissão para que ambientes externos acessem a configuração de conexão com o banco
    header('Access-Control-Allow-Origin: *');

    class CriancaController
    {
        function Cadastrar()
        {
            // Pegando os valores dos elementos do Construct através do $_GET
            $crianca = new Crianca();
            $crianca->nome = $_GET["nomeCrianca"];
            $crianca->idade = $_GET["idade"];
            $crianca->serie = $_GET["serie"];
            $crianca->sexo = $_GET["sexo"];
            $crianca->avaliacao = $_GET["avaliacao"];
            $crianca->nivel = $_GET["nivel"];

            // Upload de imagem de perfil
            $nomeImagem = $_FILES ["imagemPerfil"]["name"];
            $nomeTemporario = $_FILES ["imagem"]["tmp_name"];

            // Pegar a extensão do arquivo
            $informacoes = new SplFileInfo($nomeImagem);
            $extensao = $informacoes->getExtension();

            // Gerar novo nome
            $novoNome = md5(microtime()) . ".$extensao";

            $pastaDestino = "Recursos/Img/$novoNome";
            move_uploaded_file($nomeTemporario, $pastaDestino);

            $crianca->imagem = $novoNome; //Nome do arquivo para o banco

            $crianca->Cadastrar();

            //"Dados cadastrados com sucesso" Setar mensagem no construct
        }

        function Atualizar()
        {
            $crianca = new Crianca();
            $crianca->idCrianca = $_GET["idCrianca"];
            $crianca->nome = $_GET["nomeCrianca"];
            $crianca->idade = $_GET["idade"];
            $crianca->serie = $_GET["serie"];
            $crianca->sexo = $_GET["sexo"];
            $crianca->avaliacao = $_GET["avaliacao"];
            $crianca->nivel = $_GET["nivel"];
            $crianca->imagem = $_GET["imagem"];
            $crianca->Atualizar();

            //"Dados atualizados com sucesso" Setar mensagem no construct
        }
    }

?>