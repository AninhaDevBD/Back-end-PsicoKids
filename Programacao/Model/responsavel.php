<?php header('Access-Control-Allow-Origin: *');

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
            $cmd = $conexao->prepare("CALL spCadastrarResponsavel (:nomeResponsavel, :telefone, :email, :senhaEmail)");
        
            // Parâmetros SQL
            $cmd->bindParam(":nomeResponsavel", $this->nome);
            $cmd->bindParam(":telefone",        $this->telefone);
            $cmd->bindParam(":email",           $this->email);
            $cmd->bindParam(":senhaEmail",      $this->senhaEmail);
            

            $dados = "";
            $cmd1 = $this->email;
            $cmd2 = $this->senhaEmail;
            $dados = $cmd1 + $cmd2;
            

            $cmd->execute(); // Executando o comando

            $cmd->execute(); //executando o comando SQL

        }

        
        // Não esquecer de perguntar sobre
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

            $cmd = $conexao->prepare("CALL spConsultaResponsavel (:nomeResponsavel, :telefone, :email, :senhaEmail)");
            $cmd->execute();
            return $cmd->fetchAll(PDO::FETCH_OBJ);
        }

        function Atualizar()
        {
            $conexao = Conexao::Conectar();

            $cmd = $conexao->prepare("CALL spAtualizarResponsavel (:nomeResponsavel, :telefone, :email, :senhaEmail)");

            $cmd->bindParam(":nomeResponsavel", $this->nome);
            $cmd->bindParam(":telefone",        $this->telefone);
            $cmd->bindParam(":email",           $this->email);
            $cmd->bindParam(":senhaEmail",      $this->senhaEmail);
            $cmd->execute();
        }

        function RedefineSenha()
        {
            $conexao = Conexao::Conectar();

            $cmd = $conexao->prepare("UPDATE responsavel SET senhaEmail = :senhaEmail
            WHERE idResponsavel = :idResponsavel");

            $cmd->bindParam(":senhaEmail", $this->senhaEmail);
            $cmd->execute();
        }

        function Retornar()
        {
            $conexao = Conexao::Conectar();

            $cmd = $conexao->prepare("SELECT nomeResponsavel, telefone, email, senhaEmail WHERE idResponsavel = :idResponsavel");
            $cmd->bindParam(":idResponsavel", $this->idResponsavel);

            $cmd->execute();
            return $cmd->fetch(PDO::FETCH_OBJ);
        }


        function Logar()
        {
            $conexao = Conexao::Conectar();

            $cmd = $conexao->prepare("SELECT idResponsavel FROM responsavel WHERE email = :email");
            $cmd->bindParam(":email", $this->email);

            $cmd->execute();
            return $cmd->fetch(PDO::FETCH_OBJ);
        }

        // Método de acesso a tela principal
        function Acessar()
        {
            $conexao = Conexao::Conectar();

            $cmd = $conexao->prepare("SELECT * FROM responsavel WHERE senhaAcesso = :senhaAcesso");
            $cmd->bindParam(":senhaAcesso", $this->senhaAcesso);

            $cmd->execute();
            return $cmd->fetch(PDO::FETCH_OBJ);
        }

        /*function RetornarRelatorio()
        {

            //colocar os parametros
            $conexao = Conexao::Conectar();


            $cmd = $conexao->prepare("SELECT * FROM crianca WHERE avaliacao = :avaliacao");

            $cmd->bindParam(":avaliacao", $this->avaliacao);
            $cmd->execute();
            return $cmd->fetch(PDO::FETCH_OBJ);
        }*/
    }
        



?>