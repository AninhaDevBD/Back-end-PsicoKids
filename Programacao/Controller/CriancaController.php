<?php

    include_once "Model/crianca.php";

    // Permissão para que ambientes externos acessem a configuração de conexão com o banco
    header('Access-Control-Allow-Origin: *');

    class CriancaController
    {
        function Cadastrar()
        {
            $crianca = new Crianca();
            $crianca->nome = $_GET["nomeCrianca"];
            $crianca->idade = $_GET["idade"];
            $crianca->serie = $_GET["serie"];
            $crianca->sexo = $_GET["sexo"];
            $crianca->avaliacao = $_GET["avaliacao"];
            $crianca->nivel = $_GET["nivel"];
            $crianca->imagem = $_GET["imagem"];
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