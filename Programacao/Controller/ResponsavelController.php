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
            
            if ($responsavel->Cadastrar())
            {
                //Usuário cadastrado. Usuário poderá fazer login
                die("true")
            }

            else
            {
                //Erro ao cadastrar.
                die("false");
            }
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

        /*function RecuperarSenha()
        {
            $responsavel = new Responsavel();
            $dadosResponsavel = $responsavel->RecuperarSenha();

            //Se o usuário já possuir cadastro no banco de dados, a recuperação de senha pode ser feita
            if ($responsavel->Cadastrar())
            {
                // Se o usuário optar por receber o código de recuperação de senha via e-mail...
                if ($responsavel->email)
                {
                    $responsavel->idResponsavel = $_GET["idResponsavel"];
                    $responsavel->email = $_GET["email"];

                    // Gerando código aleatório criptografado de verificação contendo 4 dígitos
                    $responsavel->codigoVerificacao = random_bytes(1000, 9999);

                    // Colocando em execução a função necessária para o envio de email
                    $responsavel->email = new PHPMailer(true);

                    try
                    {
                        // Configurações com o servidor SMTP
                        $responsavel->email->isSMTP();                                   //Protocolo SMTP para envio de e-mail
                        $responsavel->email->Servidor       = '';                        
                        $responsavel->email->SMTPAuth   = true;                          //Autenticação do protocolo
                        $responsavel->email->Username   = '';                            
                        $responsavel->email->Password   = '';                            //SMTP password
                        $responsavel->email->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;   //Enable implicit TLS encryption
                        $responsavel->email->Porta       = 587;                          //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
                        
                        // Definindo autor do e-mail e pegando destinatário digitado pelo usuário
                        $responsavel->email->setFrom('PsicoKids@gmail.com', 'Equipe PsicoKids');
                        $responsavel->email->addAddress($responsavel->email["email"]); 

                        // Definindo dados do e-mail                             
                        $responsavel->email->Assunto = 'Recuperação de senha';
                        $responsavel->email->Subtitulo = "Olá" . $responsavel->email["email"];
                        $responsavel->email->Descricao = "Para redefinir sua senha de login em sua conta PsicoKids, copie e cole este código de confirmação: <br>" .$responsavel->codigoVerificacao;
                        // Chave para verificar se o usuário verificou o email

                        // Executa a ação de enviar o e-mail
                        $responsavel->email->send();
                    }

                    catch (Exception $erro)
                    {
                        $erro = ['erro' => true];
                    }

                if ($responsavel->telefone)
                {
                    
                }
                    
                }    
            }
        }*/

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
                    //Usuário logado. Construct direcionará para a próxima tela"
                    die("true");
                }

                else
                {
                    //Exibir a seguinte mensagem no Construct: "Usuário ou senha inválida!"
                    die("false");
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
                $responsavel = new Responsavel();
                $dadosResponsavel = $responsavel->RetornarRelatorio();
                // O retorno deverá ser feito através do ID da crianca
            }
        }
    }
?>