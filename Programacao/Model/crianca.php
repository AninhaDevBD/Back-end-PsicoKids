<?php

// Permissão para que ambientes externos ax=cessem a configuração de conexão com o banco
header('Access-Control-Allow-Origin: *');

    class Crianca
    {
        // Atributos
        private $idCrianca;
        private $nome;
        private $idade;
        private $serie;
        private $sexo;
        private $avaliacao;
        private $nivel;
        private $imagem;
        
        // Métodos mágicos
        function __get($atributo)
        {
            return $this->$atributo;
        }

        function __set($atributo, $valor)
        {
            $this->$atributo = $valor;
        }

        // Método construtor (inicia automaticamente ao instanciar)
        function __construct()
        {
            include_once "conexaobd.php"; // incluir arquivo de conexão
        }


        function Cadastrar()
        {
            $conexao = Conexao::Conectar(); //Retornar conexão

            // Preparando comando SQL para cadastrar
            $cmd = $conexao->prepare("CALL spCadastrarCriança (:nomeCrianca, :idade, :serie, :sexo, :avaliacao, :nivel, :imagemPerfil)");
        
            // Parâmetros SQL
            $cmd->bindParam(":nomeCrianca", $this->nome);
            $cmd->bindParam(":idade", $this->idade);
            $cmd->bindParam(":serie", $this->serie);
            $cmd->bindParam(":sexo", $this->sexo);
            $cmd->bindParam(":avaliacao", $this->avaliacao);
            $cmd->bindParam(":nivel", $this->nivel);
            $cmd->bindParam(":imagemPerfil", $this->imagem);

            $cmd->execute(); // Executando o comando
        }

        function Consultar()
        {
            $conexao = Conexao::Conectar();

            $cmd = $conexao->prepare("CALL spConsultaCrianca (:nomeCrianca, :idade, :serie, :sexo, :imagemPerfil)");

            $cmd->bindParam(":nomeCrianca", $this->nome);
            $cmd->bindParam(":idade", $this->idade);
            $cmd->bindParam(":serie", $this->serie);
            $cmd->bindParam(":sexo", $this->sexo);
            $cmd->bindParam(":spimagemPerfil", $this->imagem);


            $cmd->execute();
            return $cmd->fetchAll(PDO::FETCH_OBJ);
        }
        
        function Retornar()
        {
            $conexao = Conexao::Conectar();

            $cmd = $conexao->prepare("SELECT nomeCrianca, idade, serie, sexo, imagemPerfil WHERE idCrianca = :idCrianca");
            $cmd->bindParam(":idCrianca", $this->idCrianca);

            $cmd->execute();
            return $cmd->fetch(PDO::FETCH_OBJ);
        }

        function Atualizar()
        {
            $con = Conexao::Conectar();

            $cmd = $con->prepare("CALL spAtualizaCrianca (:nomeCrianca, :idade, :serie, :sexo, :imagemPerfil)");

            $cmd->bindParam(":nomeCrianca", $this->nome);
            $cmd->bindParam(":idade", $this->idade);
            $cmd->bindParam(":serie", $this->serie);
            $cmd->bindParam(":sexo", $this->sexo);
            $cmd->bindParam(":imagemPerfil", $this->imagemPerfil);
            $cmd->execute();
        }

        function RetornarRelatorio()
        {

            
            $conexao = Conexao::Conectar();


            $cmd = $conexao->prepare("SELECT * FROM crianca WHERE avaliacao = :avaliacao");

            $cmd->bindParam(":avaliacao", $this->avaliacao);
            $cmd->execute();
            return $cmd->fetch(PDO::FETCH_OBJ);
        }
    }