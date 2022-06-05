<?php
class Noticia
{
    //atributos
    private $idnoticia;
    private $data;
    private $titulo;
    private $idcategoria;
    private $conteudo;
    private $imagem;
    private $ativo;

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
        $cmd = $con->prepare("INSERT INTO noticia
        (data, titulo, idcategoria,conteudo,imagem,ativo) VALUES
        (:data, :titulo, :idcategoria,:conteudo,:imagem,:ativo)");
        //enviar valores para os parâmetros SQL
        $cmd->bindParam(":data", $this->data);
        $cmd->bindParam(":titulo", $this->titulo);
        $cmd->bindParam(":idcategoria", $this->idcategoria);
        $cmd->bindParam(":conteudo", $this->conteudo);
        $cmd->bindParam(":imagem", $this->imagem);
        $cmd->bindParam(":ativo", $this->ativo);
        $cmd->execute();//executa o comando SQL
    }
    //método consultar
    function consultar()
    {
        $con = Conexao::conectar();
        $cmd = $con->prepare("SELECT * FROM noticia 
        JOIN categoria ON categoria.idcategoria = noticia.idcategoria");
        $cmd->execute();
        return $cmd->fetchALL(PDO::FETCH_OBJ);
    }

    //método excluir
    function excluir()
    {
        $con = Conexao::conectar();
        $cmd = $con->prepare("DELETE FROM noticia
        WHERE idnoticia = :idnoticia");
        //enviar valores para os parâmetros SQL
        $cmd->bindParam(":idnoticia", $this->idnoticia);
        $cmd->execute();//executa o comando SQL
    }

    //métodos alterar /atualizar (UPDATE)
    function atualizar()
    {
        $con = Conexao::conectar();
        $cmd = $con->prepare("UPDATE noticia SET
                                     data = :data,
                                     titulo         = :titulo,
                                     idcategoria    = :idcategoria,
                                     conteudo       = :conteudo,
                                     imagem         = :imagem,
                                     ativo          = :ativo
                             WHERE idnoticia = :idnoticia");

        //enviar valores para os parâmetros SQL
        $cmd->bindParam(":idnoticia",   $this->idnoticia);
        $cmd->bindParam(":data",        $this->data);
        $cmd->bindParam(":titulo",      $this->titulo);
        $cmd->bindParam(":idcategoria", $this->idcategoria);
        $cmd->bindParam(":conteudo",    $this->conteudo);
        $cmd->bindParam(":imagem",      $this->imagem);
        $cmd->bindParam(":ativo",       $this->ativo);

        $cmd->execute();//executa o comando SQL
    }

    //retornar
    function retornar()
    {
        $con = Conexao::conectar();
        $cmd = $con->prepare("SELECT * FROM noticia WHERE idnoticia = :idnoticia");
        $cmd->bindParam(":idnoticia", $this->idnoticia);
        $cmd->execute();
        return $cmd->fetch(PDO::FETCH_OBJ);
    }
}
?>