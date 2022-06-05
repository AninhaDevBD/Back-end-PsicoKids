<?php
class Crianca
{
    //atributos
    private $idCrianca;
    private $nomeCrianca;
    private $idade;
    private $serie;
    private $sexo;
    private $avaliacao;
    private $nivel;

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
    function Cadastrar()
    {
        $conexao = Conexao::conectar();//retornando conexão
        
        //preparar comando SQL para cadastrar
        $cmd = $conexao->prepare("INSERT INTO crianca
        (nomeCrianca, idade, serie, sexo, avaliacao, nivel) VALUES 
        (:nomeCrianca, :idade, :serie, :sexo, '', '')");
        
        //parâmetros SQL
        $cmd->bindParam(":nomeCrianca",     $this->nomeCrianca);
        $cmd->bindParam(":idade",           $this->idade);
        $cmd->bindParam(":serie",           $this->serie);
        $cmd->bindParam(":sexo",            $this->sexo);
        
        $cmd->execute(); //executando o comando SQL
    }

    //método consultar
    function Consultar()
    {
        $conexao = Conexao::conectar();      
        $cmd = $conexao->prepare("SELECT  * FROM crianca");
        $cmd->execute();
        return $cmd->fetchALL(PDO::FETCH_OBJ);
    }

    //método atualizar
    function atualizar()
    {
        $conexao = Conexao::conectar();
        $cmd = $conexao->prepare("UPDATE crianca SET
                                nomeCrianca = :nome,
                                idade       = :idade,
                                serie       = :serie,
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
        $conexao = Conexao::conectar();      
        $cmd = $conexao->prepare("SELECT  * FROM usuario
        WHERE idusuario = :idusuario");

        $cmd->bindParam(":idusuario", $this->idusuario);

        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_OBJ);
    }

    function logar()
    {
        $conexao = Conexao::conectar();      
        $cmd = $conexao->prepare("SELECT  * FROM usuario
        WHERE email = :email");

        $cmd->bindParam(":email", $this->email);

        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_OBJ);
    }
}