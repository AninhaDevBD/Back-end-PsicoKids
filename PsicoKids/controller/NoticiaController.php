<?php
include_once "model/Noticia.php";
include_once "model/Categoria.php";

class NoticiaController
{
    function abrirInicio()
    {
        include "view/home.php";
    }

    function abrirSobre()
    {
        include "view/sobre.php";
    }

    function abrirContato()
    {
        include "view/contato.php";
    }

    function abrirAdm()
    {
        //não existe uma sessão
        if(!isset($_SESSION["dadosUsuario"]))
        {
            //volta para o login
            header("Location:".URL."entrar");
            return;
        }

        include "view/adm.php";
    }


    function abrirCadastro()
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }

        //retornando todas as categorias cadastradas
        $cat = new Categoria();
        $dadosCategoria = $cat->consultar();
        
        include "view/noticia.php"; //abrir tela
    }

    function cadastrar()
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }

        $not = new Noticia();
        $not->data          = $_POST["data"];
        $not->titulo        = $_POST["titulo"];
        $not->idcategoria   = $_POST["idcategoria"];
        $not->conteudo      = $_POST["conteudo"];
        $not->ativo         = $_POST["ativo"];
        $not->imagem        = "";
    
        //upload de imagem
        if($_FILES["imagem"]["error"] == 0)
        {
            $nomeArquivo = $_FILES["imagem"]["name"];
            $nomeTemp    = $_FILES["imagem"]["tmp_name"];

            //pegar a extensão do arquivo
            $info       = new SplFileInfo($nomeArquivo);
            $extensao   = $info->getExtension();

            //gerar novo nome
            $novoNome   = md5(microtime()) . ".$extensao";

            $pastaDestino = "recursos/img/$novoNome";
            move_uploaded_file($nomeTemp, $pastaDestino);

            $not->imagem   = $novoNome; //nome do arquivo para BD
        }
        
        $not->cadastrar();

        echo "<script>
                alert('Dados gravados com sucesso!');
                window.location='".URL."nova-noticia';
              </script>";
    }

    function atualizar()
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }

        $not = new Noticia();
        $not->idnoticia     = $_POST["idnoticia"];
        $not->data          = $_POST["data"];
        $not->titulo        = $_POST["titulo"];
        $not->idcategoria   = $_POST["idcategoria"];
        $not->conteudo      = $_POST["conteudo"];
        $not->ativo         = $_POST["ativo"];

        $dadosNoticia = $not->retornar();
        $not->imagem = $dadosNoticia->imagem;

        //upload de imagem
        if($_FILES["imagem"]["error"] == 0 && $not->imagem != "")
        {
            $nomeTemp    = $_FILES["imagem"]["tmp_name"];
            $pastaDestino = "recursos/img/".$not->imagem;
            move_uploaded_file($nomeTemp, $pastaDestino);
        }
        else
        {
            $nomeArquivo = $_FILES["imagem"]["name"];
            $nomeTemp    = $_FILES["imagem"]["tmp_name"];

            //pegar a extensão do arquivo
            $info       = new SplFileInfo($nomeArquivo);
            $extensao   = $info->getExtension();

            //gerar novo nome
            $novoNome   = md5(microtime()) . ".$extensao";

            $pastaDestino = "recursos/img/$novoNome";
            move_uploaded_file($nomeTemp, $pastaDestino);

            $not->imagem   = $novoNome; //nome do arquivo para BD
        }
        $not->atualizar();

        echo "<script>
                alert('Dados gravados com sucesso!');
                window.location='".URL."consultar-noticia';
              </script>";
    }

    function consultar()
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }

        $not = new Noticia();
        $dadosNoticia = $not->consultar();
        include "view/consultar_noticia.php";
    }

    function excluir($id)
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }
        //caso não tenha privilégio
        if($_SESSION["dadosUsuario"]->nivelacesso == 2) { header("Location:".URL."adm"); return; }

        $not = new Noticia(); //usar a classe MODEL
        $not->idnoticia = $id;//enviando o id p/ MODEL

        //removendo imagem
        $dadosNoticia = $not->retornar();
        if(is_file("recursos/img/$dadosNoticia->imagem")) //verificar se o arquivo existe
        {
            unlink("recursos/img/$dadosNoticia->imagem"); //excluir o arquivo
        }
        $not->excluir();//executar excluir (MODEL)

        //direcionar novamente para a tela de consulta
        header("Location:".URL."consultar-noticia");
    }

    function editar($id)
    {
        //caso não usuário não esteja logado
        if(!isset($_SESSION["dadosUsuario"])) { header("Location:".URL."entrar"); return; }
        
        $not = new Noticia(); //usar MODEL
        $not->idnoticia = $id;//enviar ID

        //retornar dados com base no ID
        $dadosNoticia = $not->retornar();

        //retornando todas as categorias cadastradas
        $cat = new Categoria();
        $dadosCategoria = $cat->consultar();

        //abrir a tela de edição dos dados
        include "view/editar_noticia.php";
    }
}
?>