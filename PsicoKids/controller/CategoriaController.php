<?php
include_once "model/Categoria.php";

class CategoriaController
{
    function abrirCadastro()
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }
        include "view/categoria.php";
    }

    function cadastrar()
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }
        $cat = new Categoria();
        $cat->nomecategoria = $_POST["nomecategoria"];
        $cat->cadastrar();
        echo "<script>
                alert('Dados gravados com sucesso!');
                window.location='".URL."nova-categoria';
              </script>";
    }

    function atualizar()
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }
        $cat = new Categoria();
        $cat->idcategoria   = $_POST["idcategoria"];
        $cat->nomecategoria = $_POST["nomecategoria"];
        $cat->atualizar();

        echo "<script>
                alert('Dados gravados com sucesso!');
                window.location='".URL."consultar-categoria';
              </script>";
    }

    function consultar()
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }
        $cat = new Categoria();
        $dadosCategoria = $cat->consultar();
        include "view/consultar_categoria.php";
    }

    function excluir($id)
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }
        //caso não tenha privilégio
        if($_SESSION["dadosUsuario"]->nivelacesso == 2) { header("Location:".URL."adm"); return; }
        
        $cat = new Categoria();
        $cat->idcategoria = $id;
        $cat->excluir();
        header("Location:".URL."consultar-categoria");
    }

    function editar($id)
    {
         //caso não usuário não esteja logado
         if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }
         
        $cat = new Categoria(); //usar MODEL
        $cat->idcategoria = $id;//enviar ID

        //retornar dados com base no ID
        $dadosCategoria = $cat->retornar();

        //abrir a tela de edição dos dados
        include "view/editar_categoria.php";
    }
}

?>