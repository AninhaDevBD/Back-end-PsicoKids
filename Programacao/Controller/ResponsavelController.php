<?php

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    include_once "Model/responsavel.php";
    
    // Permissão para que ambientes externos acessem a configuração de conexão com o banco
    header('Access-Control-Allow-Origin: *');

    class ResponsavelController
    {
        function Cadastrar()
        {
            $responsavel = new Responsavel();
            $responsavel->nome = $_GET["nomeResponsavel"];
            $responsavel->telefone = $_GET["telefone"];
            $responsavel->email = $_GET["email"];
            $responsavel->senhaEmail = $_GET["senhaEmail"];
            $responsavel->Cadastrar();

            //"Dados cadastrados com sucesso" -> Setar mensagem no construct
        }

        function CadastrarSenhaAcesso()
        {
            $responsavel = new Responsavel();
            $responsavel->senhaAcesso = $_GET["senhaAcesso"];
            $responsavel->CadastrarSenhaAcesso();

            //"Senha de acesso cadastrada com sucesso" -> Setar mensagem no construct
        }

        function Consultar()
        {
            $responsavel = new Responsavel();
            $dadosresponsavel = $responsavel->Consultar();
        }

        function Atualizar()
        {
            $responsavel = new Responsavel();
            $responsavel->idResponsavel = $_GET["idResponsavel"];
            $responsavel->nome = $_GET["nomeResponsavel"];
            $responsavel->telefone = $_GET["telefone"];
            $responsavel->email = $_GET["email"];
            $responsavel->senhaEmail = password_hash($_GET["senhaEmail"], PASSWORD_DEFAULT);
            $responsavel->Atualizar();

            //"Dados atualizados com sucesso" -> Setar mensagem no construct
        }

        function Editar($id)
        {
            $responsavel = new Responsavel();
            $responsavel->idResponsavel = $id; // Enviar ID
            $dadosResponsavel = $responsavel->Retornar(); // Retornar dados com base no Id

            include "View/editarUsu.php"; // Abrir a tela de edição dos dados
        }

        function RedefinirSenha()
        {
            $responsavel = new Responsavel();
            $responsavel->idResponsavel = $_GET["idResponsavel"];
            $responsavel->senhaEmail = password_hash($_GET["senhaEmail"], PASSWORD_DEFAULT);
            $responsavel->Atualizar();

            //"Senha redefinida com sucesso" -> Setar mensagem no construct
        }

        function RecuperarSenha()
        {
            $responsavel = new Responsavel();
            $dadosResponsavel = $responsavel->RecuperarSenha();

            if ($responsavel->Cadastrar())
            {
                if ($dadosResponsavel == $responsavel->email)
                {
                    $responsavel->idResponsavel = $_GET["idResponsavel"];
                    $responsavel->email = $_GET["email"];
                    //$responsavel->email = new PHPMailer(true);

                    try
                    {
                        
                    }
                    catch (Exception $erro)
                    {
                        //throw $th;
                    }
                }

                else
                {
                    $dadosResponsavel == $responsavel->telefone;
                }
            }
        }

        function Logar()
        {
            $responsavel = new Responsavel();
            $responsavel->email = $_GET["email"];
            $dadosResponsavel = $responsavel->Logar();

            if($dadosResponsavel)
            {
                if(password_verify($_GET["senhaEmail"], $dadosResponsavel->senhaEmail))
                {
                    $_GET["dadosResponsavel"] = $dadosResponsavel;
                }

                else
                {
                    //"Usuário ou senha inválida!"
                }
            } 

            else
            {
               //"Usuário ou senha inválida!"
            }   
        }

        function Acessar()
        {
            $responsavel = new Responsavel();
            $dadosResponsavel = $responsavel->Acessar();

            if($dadosResponsavel)
            {
                if(password_verify($_GET["senhaAcesso"], $dadosResponsavel->senhaAcesso))
                {
                    $_GET["dadosResponsavel"] = $dadosResponsavel;
                }

                else
                {
                    //"Senha de acesso inválida!"
                }
            } 

            else
            {
               //"Senha de acesso inválida!"
            }   
        }

        function RetornarRelatorio()
        {
            
        }
    }

?>