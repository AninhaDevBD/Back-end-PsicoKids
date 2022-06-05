<?php
include_once "model/Crianca.php"; //métodos BD

class CriancaController
{

    function Cadastrar()
    {
        $crianca = new Crianca();
        $crianca->nome          = $_POST["nome"];
        $crianca->email         = $_POST["email"];
        $crianca->senha         = password_hash($_POST["senha"], PASSWORD_DEFAULT);
        $crianca->nivelacesso   = $_POST["nivelacesso"];
        $crianca->cadastrar();

        echo "<script>
                alert('Dados gravados com sucesso!');
                window.location='".URL."novo-usuario';
              </script>";
    }

    function atualizar()
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }

        //caso não tenha privilégio
        if($_SESSION["dadosUsuario"]->nivelacesso == 2) { header("Location:".URL."adm"); return; }

        $usu = new Usuario();
        $usu->idusuario     = $_POST["idusuario"];
        $usu->nome          = $_POST["nome"];
        $usu->email         = $_POST["email"];
        $usu->senha         = password_hash($_POST["senha"], PASSWORD_DEFAULT);
        $usu->nivelacesso   = $_POST["nivelacesso"];
        $usu->atualizar();

        echo "<script>
                alert('Dados gravados com sucesso!');
                window.location='".URL."consultar-usuario';
              </script>";
    }

    function consultar()
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }
        //caso não tenha privilégio
        if($_SESSION["dadosUsuario"]->nivelacesso == 2) { header("Location:".URL."adm"); return; }

        $usu = new Usuario();
        $dadosUsuario = $usu->consultar();
        include "view/consultar_usuario.php";
    }

    function excluir($id)
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }
        //caso não tenha privilégio
        if($_SESSION["dadosUsuario"]->nivelacesso == 2) { header("Location:".URL."adm"); return; }

        $usu = new Usuario(); //usar a classe MODEL
        $usu->idusuario = $id;//enviando o id p/ MODEL
        $usu->excluir();//executar excluir (MODEL)

        //direcionar novamente para a tela de consulta
        header("Location:".URL."consultar-usuario");
    }

    function editar($id)
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }
        //caso não tenha privilégio
        if($_SESSION["dadosUsuario"]->nivelacesso == 2) { header("Location:".URL."adm"); return; }

        $usu = new Usuario(); //usar MODEL
        $usu->idusuario = $id;//enviar ID

        //retornar dados com base no ID
        $dadosUsuario = $usu->retornar();

        //abrir a tela de edição dos dados
        include "view/editar_usuario.php";
    }

    function abrirLogin()
    {
        include_once "view/login.php";
    }

    function logar()
    {
        $usu = new Usuario();
        $usu->email = $_POST["email"];
        $dadosUsuario = $usu->logar();

        if($dadosUsuario && password_verify($_POST["senha"], $dadosUsuario->senha)) //encontrou usuário com base no e-mail
        {
            $_SESSION["dadosUsuario"] = $dadosUsuario;
            header("Location:".URL."adm"); //direcionar página adm
        }
        else
        {
            echo "<script>
                alert('Usuário ou senha inválido');
                window.location='".URL."entrar';
              </script>";
        }
    }

    function sair()
    {
        session_destroy();
        header("Location:".URL);
    }
}
?>