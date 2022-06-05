<?php
session_start();
include_once "controller/NoticiaController.php";
include_once "controller/UsuarioController.php";
include_once "controller/CategoriaController.php";

define("URL", "http://localhost/noticia/"); //url principal

if($_GET)
{
    $url = $_GET["url"];
    $url = explode("/",$url);
    
    switch($url[0])
    {
        case "inicio":
            $noticia = new NoticiaController();
            $noticia->abrirInicio();
        break;

        case "sobre":
            $noticia = new NoticiaController();
            $noticia->abrirSobre();
        break;

        case "contato":
            $noticia = new NoticiaController();
            $noticia->abrirContato();
        break;

        case "adm":
            $noticia = new NoticiaController();
            $noticia->abrirAdm();
        break;

        //rotas usuário
        case "novo-usuario":
            $usu = new UsuarioController();
            $usu->abrirCadastro();
        break;

        case "cadastrar-usuario":
            $usu = new UsuarioController();
            $usu->cadastrar();
        break;

        case "consultar-usuario":
            $usu = new UsuarioController();
            $usu->consultar();
        break;

        case "excluir-usuario":
            $usu = new UsuarioController();
            $usu->excluir($url[1]);
        break;

        case "editar-usuario":
            $usu = new UsuarioController();
            $usu->editar($url[1]);
        break;

        case "atualizar-usuario":
            $usu = new UsuarioController();
            $usu->atualizar();
        break;

        case "entrar":
            $usu = new UsuarioController();
            $usu->abrirLogin();
        break;

        case "logar":
            $usu = new UsuarioController();
            $usu->logar();
        break;

        case "sair":
            $usu = new UsuarioController();
            $usu->sair();
        break;


        //rotas categoria
        case "nova-categoria":
            $cat = new CategoriaController();
            $cat->abrirCadastro();
        break;

        case "cadastrar-categoria":
            $cat = new CategoriaController();
            $cat->cadastrar();
        break;

        case "consultar-categoria":
            $cat = new CategoriaController();
            $cat->consultar();
        break;

        case "excluir-categoria":
            $cat = new CategoriaController();
            $cat->excluir($url[1]);
        break;

        case "editar-categoria":
            $cat = new CategoriaController();
            $cat->editar($url[1]);
        break;

        case "atualizar-categoria":
            $cat = new CategoriaController();
            $cat->atualizar();
        break;



        //rotas notícia
        case "nova-noticia":
            $not = new NoticiaController();
            $not->abrirCadastro();
        break;

        case "cadastrar-noticia":
            $not = new NoticiaController();
            $not->cadastrar();
        break;

        case "consultar-noticia":
            $not = new NoticiaController();
            $not->consultar();
        break;

        case "excluir-noticia":
            $not = new NoticiaController();
            $not->excluir($url[1]);
        break;

        case "editar-noticia":
            $not = new NoticiaController();
            $not->editar($url[1]);
        break;

        case "atualizar-noticia":
            $not = new NoticiaController();
            $not->atualizar();
        break;

        

        default:
            echo "Página não localizada!";
        break;
    }
}
else
{
    $noticia = new NoticiaController();
    $noticia->abrirInicio();
}
?>