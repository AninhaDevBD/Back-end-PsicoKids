<?php

    // Permissão para que ambientes externos acessem a configuração de conexão com o banco e as classes
    header('Access-Control-Allow-Origin: *');

    class Responsavel
    {
        // Atributos
        private $idResponsavel;
        private $nome;
        private $telefone;
        private $email;
        private $senhaEmail;
        private $senhaAcesso;
        private $idCrianca;
        private $codigoVerificacao;
        private $chave;
        
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

            // Preparar comando SQL para cadastrar
            $cmd = $conexao->prepare("INSERT INTO responsavel (nomeResponsavel, telefone, email, senhaEmail, senhaAcesso) VALUES (:nomeResponsavel,
            :telefone, :email, :senhaEmail, :senhaAcesso)");
        
            // Parâmetros SQL
            $cmd->bindParam(":nomeResponsavel", $this->nome);
            $cmd->bindParam(":telefone", $this->telefone);
            $cmd->bindParam(":email", $this->email);
            $cmd->bindParam(":senhaEmail", $this->senhaEmail);
            
            $cmd->execute(); // Executando o comando
        }

        function CadastrarSenhaAcesso()
        {
            $conexao = Conexao::Conectar(); //Retornar conexão

            // Preparar comando SQL para cadastrar
            $cmd = $conexao->prepare("INSERT INTO responsavel (senhaAcesso) VALUES (:senhaAcesso)");
        
            // Parâmetros SQL
            $cmd->bindParam(":senhaAcesso", $this->senhaAcesso);

            $cmd->execute(); // Executando o comando
        }

        function Consultar()
        {
            $conexao = Conexao::Conectar();

            $cmd = $conexao->prepare("SELECT * FROM responsavel");
            $cmd->execute();
            return $cmd->fetchAll(PDO::FETCH_OBJ);
        }

        function Retornar()
        {
            $conexao = Conexao::Conectar();

            $cmd = $conexao->prepare("SELECT nomeResponsavel, telefone, email, senhaEmail WHERE idResponsavel = :idResponsavel");
            $cmd->bindParam(":idResponsavel", $this->idResponsavel);

            $cmd->execute();
            return $cmd->fetch(PDO::FETCH_OBJ);
        }

        function Atualizar()
        {
            $conexao = Conexao::Conectar();

            $cmd = $conexao->prepare("UPDATE responsavel SET nomeResponsavel = :nomeResponsavel, telefone = :telefone, email = :email, senhaEmail = :senhaEmail
            WHERE idResponsavel = :idResponsavel");

            $cmd->bindParam(":idResponsavel", $this->idResponsavel);
            $cmd->bindParam(":nomeResponsavel", $this->nome);
            $cmd->bindParam(":telefone", $this->telefone);
            $cmd->bindParam(":email", $this->email);
            $cmd->bindParam(":senhaEmail", $this->senhaEmail);
            $cmd->execute();
        }

        function RedefinirSenha()
        {
            $conexao = Conexao::Conectar();

            $cmd = $conexao->prepare("UPDATE responsavel SET senhaEmail = :senhaEmail
            WHERE idResponsavel = :idResponsavel");

            $cmd->bindParam(":senhaEmail", $this->senhaEmail);
            $cmd->execute();
        }

        function RecuperarSenha()
        {
            $conexao = Conexao::Conectar();

            // Colocar código no banco de dados
        }

        function Logar()
        {
            $conexao = Conexao::Conectar();

            $cmd = $conexao->prepare("SELECT * FROM responsavel WHERE email = :email");
            $cmd->bindParam(":email", $this->email);

            $cmd->execute();
            return $cmd->fetch(PDO::FETCH_OBJ);
        }

        function Acessar()
        {
            $conexao = Conexao::Conectar();

            $cmd = $conexao->prepare("SELECT * FROM responsavel WHERE senhaAcesso = :senhaAcesso");
            $cmd->bindParam(":senhaAcesso", $this->senhaAcesso);

            $cmd->execute();
            return $cmd->fetch(PDO::FETCH_OBJ);
        }
}

?>