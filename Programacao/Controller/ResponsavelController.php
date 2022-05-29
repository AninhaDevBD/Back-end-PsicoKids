    <?php
    
    // Importando bibliotecas do PHPMailer
    // require 'path/to/PHPMailer/src/Exception.php';
    // require 'path/to/PHPMailer/src/PHPMailer.php';
    // require 'path/to/PHPMailer/src/SMTP.php';
    // require 'lib/autoload.php';
    
    include_once "Model/conexaoBD.php";
    include_once "Model/responsavel.php";
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);

    // Permissão para que ambientes externos acessem a configuração de conexão com o banco
    header('Access-Control-Allow-Origin: *');

    class ResponsavelController
    {
        function Cadastrar()
        {
            // Pegando os valores dos elementos do Construct através do $_GET
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
        }

        function RedefinirSenha()
        {
            $responsavel = new Responsavel();
            $responsavel->idResponsavel = $_GET["idResponsavel"];
            $responsavel->senhaEmail = password_hash($_GET["senhaEmail"], PASSWORD_DEFAULT);
            $responsavel->Atualizar();

            //"Senha redefinida com sucesso" -> Setar mensagem no construct
        }

        function recuperarSenha()
        {
            if(!empty ($dados))
            {
                $query_Responsavel = "SELECT idResponsavel, nomeResponsavel, 
                                        FROM responsavel
                                        WHERE nomerResponsavel = :nomeResponsavel
                                        LIMIT 1";
                $result_Responsavel = $conexao->prepare($query_Responsavel);
                $result_Responsavel->bindParam(':nomeResponsavel', $dados['nomeResponsavel'], PDO::PARAM_STR);
                $result_Responsavel->execute(); 

                if(($result_Responsavel) AND($result_Responsavel->rowCount() != 0))
                {
                    $row_responsavel = $result_Responsavel->fetch(PDO::FETCH_ASSOC);
                    $chave_recuperar_senha = password_hash($row_responsavel["idResponsavel"], PASSWORD_DEFAULT);
                   
                    $query_update_resposavel = "UPDATE responsavel SET recuperaSenha = :recuperaSenha 
                                                WHERE idResponsavel = :idResponsavel 
                                                LIMIT 1";
                    $result_update_responsavel = $conexao->prepare($query_update_resposavel);
                    $result_Responsavel->bindParam(':recuperaSenha', $chave_recuperar_senha, PDO::PARAM_STR);
                    $result_Responsavel->bindParam(':idResponsavel', $row_responsavel['idResponsavel'], PDO::PARAM_STR);

                    if($result_update_responsavel->execute())
                    {
                        
                    }
                    else
                    {
                        $_SESSION['msg'] = "Erro: Usuário inválido";
                    }

                }
                else
                {
                    $_SESSION['msg'] = "Erro: Usuário inválido";
                }

                if(isset($_SESSION['msg']))
                {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
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

                // Se não, exibir a seguinte mensagem no Construct: "Usuário ou senha inválida!"
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
                // O retorno deverá ser feito através do ID da crianca
            }
        }
    }
?>