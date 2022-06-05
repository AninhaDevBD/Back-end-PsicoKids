<?php
class Categoria
{
    //atributos
    private $idcategoria;
    private $nomecategoria;

    //get / set
    function __get($atributo)
    {
        return $this->$atributo;
    }
    function __set($atributo, $valor)
    {
        $this->$atributo = $valor;
    }

    function __construct() //executa automaticamente
    {
        include_once "Conexao.php";//incluir a classe de conexão
    }

    //método cadastrar
    function cadastrar()
    {
        $con = Conexao::conectar();
        $cmd = $con->prepare("INSERT INTO categoria
        (nomecategoria) VALUES
        (:nomecategoria)");
        //enviar valores para os parâmetros SQL
        $cmd->bindParam(":nomecategoria", $this->nomecategoria);

        $cmd->execute();//executa o comando SQL
    }
    //método consultar
    function consultar()
    {
        $con = Conexao::conectar();
        $cmd = $con->prepare("SELECT * FROM categoria");
        $cmd->execute();
        return $cmd->fetchALL(PDO::FETCH_OBJ);
    }

    //método excluir
    function excluir()
    {
        $con = Conexao::conectar();
        $cmd = $con->prepare("DELETE FROM categoria
        WHERE idcategoria = :idcategoria");
        //enviar valores para os parâmetros SQL
        $cmd->bindParam(":idcategoria", $this->idcategoria);
        $cmd->execute();//executa o comando SQL
    }

    //métodos alterar /atualizar (UPDATE)
    function atualizar()
    {
        $con = Conexao::conectar();
        $cmd = $con->prepare("UPDATE categoria SET
                                     nomecategoria = :nomecategoria
                             WHERE idcategoria = :idcategoria");

        //enviar valores para os parâmetros SQL
        $cmd->bindParam(":idcategoria",   $this->idcategoria);
        $cmd->bindParam(":nomecategoria",        $this->nomecategoria);

        $cmd->execute();//executa o comando SQL
    }

    //retornar
    function retornar()
    {
        $con = Conexao::conectar();
        $cmd = $con->prepare("SELECT * FROM categoria WHERE idcategoria = :idcategoria");
        $cmd->bindParam(":idcategoria", $this->idcategoria);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_OBJ);
    }
}
?>