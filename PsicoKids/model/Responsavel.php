<?php
class Usuario
{
    //atributos
    private $idusuario;
    private $nome;
    private $email;
    private $senha;
    private $nivelacesso;

    //método get
    function __get($atributo)
    {
        return $this->$atributo;
    }

    //método set
    function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    //método construtor (inicia automaticamente ao instanciar)
    function __construct()
    {
        include_once "Conexao.php";//incluir arquivo de conexão
    }

    //métodos cadastrar
    function cadastrar()
    {
        $con = Conexao::conectar();//retornando conexão
        
        //preparar comando SQL para cadastrar
        $cmd = $con->prepare("INSERT INTO usuario
        (nome, email, senha, nivelacesso) VALUES 
        (:nome, :email, :senha, :nivelacesso)");
        
        //parâmetros SQL
        $cmd->bindParam(":nome",        $this->nome);
        $cmd->bindParam(":email",       $this->email);
        $cmd->bindParam(":senha",       $this->senha);
        $cmd->bindParam(":nivelacesso", $this->nivelacesso);
        
        $cmd->execute(); //executando o comando SQL
    }

    //método consultar
    function consultar()
    {
        $con = Conexao::conectar();      
        $cmd = $con->prepare("SELECT  * FROM usuario");
        $cmd->execute();
        return $cmd->fetchALL(PDO::FETCH_OBJ);
    }

    //método excluir
    function excluir()
    {
        $con = Conexao::conectar();
        $cmd = $con->prepare("DELETE FROM usuario
        WHERE idusuario = :idusuario");
        $cmd->bindParam(":idusuario", $this->idusuario);
        $cmd->execute();
    }

    //método atualizar
    function atualizar()
    {
        $con = Conexao::conectar();
        $cmd = $con->prepare("UPDATE usuario SET
                                nome        = :nome,
                                email       = :email,
                                senha       = :senha,
                                nivelacesso = :nivelacesso
                            WHERE idusuario = :idusuario");
        
        $cmd->bindParam(":nome",        $this->nome);
        $cmd->bindParam(":email",       $this->email);
        $cmd->bindParam(":senha",       $this->senha);
        $cmd->bindParam(":nivelacesso", $this->nivelacesso);
        $cmd->bindParam(":idusuario",   $this->idusuario);

        $cmd->execute();
    }

    //método retornar
    function retornar()
    {
        $con = Conexao::conectar();      
        $cmd = $con->prepare("SELECT  * FROM usuario
        WHERE idusuario = :idusuario");

        $cmd->bindParam(":idusuario", $this->idusuario);

        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_OBJ);
    }

    function logar()
    {
        $con = Conexao::conectar();      
        $cmd = $con->prepare("SELECT  * FROM usuario
        WHERE email = :email");

        $cmd->bindParam(":email", $this->email);

        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_OBJ);
    }
}