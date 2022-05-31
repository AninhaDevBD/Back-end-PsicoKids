    <?php header('Access-Control-Allow-Origin: *');
    
<<<<<<< HEAD
    // Importando bibliotecas do PHPMailer
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require 'lib/autoload.php';
   

    include_once "Model/conexaobd.php";
=======
>>>>>>> bca032412f2912f573597f33f441acfce07710bd
    include_once "Model/responsavel.php";

    class ResponsavelController
    {
        function Cadastrar()
        {
            // Pegando os valores dos elementos do Construct através do $_GET
            $responsavel = new Responsavel();
<<<<<<< HEAD
            $responsavel->nome = $_GET["nomeResponsavel"];
            $responsavel->telefone = $_GET["telefone"];
            $responsavel->email = $_GET["email"];
            $responsavel->senhaEmail = $_GET["senhaEmail"];
            
            if ($responsavel->Cadastrar())
            {
                //Usuário cadastrado. Usuário poderá fazer login
                die("true");
            }

            else
            {
                //Erro ao cadastrar.
                die("false");
            }
=======
            $responsavel->nome          = $_GET["nomeResponsavel"];
            $responsavel->telefone      = $_GET["telefone"];
            $responsavel->email         = $_GET["email"];
            $responsavel->senhaEmail    = password_hash($_GET["senhaEmail"], PASSWORD_DEFAULT);
            $responsavel->Cadastrar();
>>>>>>> bca032412f2912f573597f33f441acfce07710bd
        }

        function CadastrarSenhaAcesso()
        {
            $responsavel = new Responsavel();
            $responsavel->senhaAcesso = password_hash($_GET["senhaAcesso"], PASSWORD_DEFAULT);
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
            $responsavel->idResponsavel     = $_GET["idResponsavel"];
            $responsavel->nome              = $_GET["nomeResponsavel"];
            $responsavel->telefone          = $_GET["telefone"];
            $responsavel->email             = $_GET["email"];
            $responsavel->senhaEmail        = password_hash($_GET["senhaEmail"], PASSWORD_DEFAULT);
            $responsavel->Atualizar();

            //"Dados atualizados com sucesso" -> Setar mensagem no construct
        }

        function Editar($id)
        {
            $responsavel = new Responsavel();
            $responsavel->idResponsavel = $id; // Enviar ID
            $dadosResponsavel = $responsavel->Retornar(); // Retornar dados com base no Id
        }

        function RedefineSenha()
        {
            $responsavel = new Responsavel();
            $responsavel->idResponsavel     = $_GET["idResponsavel"];
            $responsavel->senhaEmail        = password_hash($_GET["senhaEmail"], PASSWORD_DEFAULT);
            $responsavel->Atualizar();

            //"Senha redefinida com sucesso" -> Setar mensagem no construct
        }

        /*function recuperarSenha()
        {

            $conexao = Conexao::Conectar();
            if(!empty ($dados))
            {
                //Verificando se o responsavel existe no banco de dados 
                $query_Responsavel = "SELECT idResponsavel, nomeResponsavel, email 
                                        FROM responsavel
                                        WHERE nomeResponsavel = :nomeResponsavel
                                        LIMIT 1";
                $result_Responsavel = $conexao->prepare($query_Responsavel);
                $result_Responsavel->bindParam(':email', $dados['email'], PDO::PARAM_STR);
                $result_Responsavel->execute(); 


                //Se encontrou o responsavel ele acessa esse IF
                if(($result_Responsavel) AND($result_Responsavel->rowCount() != 0))
                {
                    //Lendo o valor vindo do banco
                    $row_responsavel = $result_Responsavel->fetch(PDO::FETCH_ASSOC);
                    //Gerando uma chave para o responsavel enviar para recuperar senha
                    $chave_recuperar_senha = password_hash($row_responsavel["idResponsavel"], PASSWORD_DEFAULT);
                   
                    $query_update_resposavel = "UPDATE responsavel SET recuperaSenha = :recuperaSenha 
                                                WHERE idResponsavel = :idResponsavel 
                                                LIMIT 1";
                    //Atribuindo os dados do banco a uma variavel
                    $result_update_responsavel = $conexao->prepare($query_update_resposavel);
                    //Convertendo o PASSWORD HASH em string
                    $result_update_responsavel->bindParam(':recuperaSenha', $chave_recuperar_senha, PDO::PARAM_STR);

                    $result_update_responsavel->bindParam(':idResponsavel', $row_responsavel['idResponsavel'], PDO::PARAM_INT);

                    //Se conseguir executar com sucesso acessa esse IF
                    if($result_update_responsavel->execute())
                    {
                        //Verificando se a chave é valida
                        $link = "Model/atualizaSenha.php? chave = $chave_recuperar_senha" ;
                        try
                        {
                             //Criando uma instancia para o phpMailer
                            $mail = new PHPMailer(true);
                            //Ativar somente se estiver em desenvolvimento
                            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                            
                            //fazendo ler caracter especial
                            $mail->CharSet = 'UTF-8';

                            $mail->isSMTP();                                            //Send using SMTP
                            //COLOCAR O NOSSO HOST
                            $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                            $mail->Username   = 'user@example.com';                     //SMTP username
                            $mail->Password   = 'secret';                               //SMTP password
                            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
                            $mail->Port       = 465; 

                            //Recipients
                            $mail->setFrom('from@example.com', 'Mailer');
                            $mail->addAddress($row_responsavel['email'], $row_responsavel['nomeResponsavel']);     //Add a recipient
                            $mail->addAddress('ellen@example.com');               //Name is optional
                            
                             //Content
                            $mail->isHTML(true);                                  //Set email format to HTML
                            $mail->Subject = 'Recuperar a senha';
                            $mail->Body    = 'Prezado(a)'. $row_responsavel['nomeResponsavel'] . "<br><br>Você solicitou alteração da senha.
                            <br><br>Para continuar o processo de recuperar a sua senha, clique no link abaixo ou cole
                            endereço no seu navegador: <br><br><a href ='" . $link . "'>".$link."</a><br><br>Se você não solicitou essa alteração, nenhuma ação é
                            necessária. Sua senha permanecerá a mesma até que você ative este codigo. <br><br>";

                            $mail->AltBody = 'Prezado(a)'. $row_responsavel['nomeResponsavel'] . "\n\nVocê solicitou alteração da senha.
                            <br><br>Para continuar o processo de recuperar a sua senha, clique no link abaixo ou cole
                            endereço no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é
                            necessária. Sua senha permanecerá a mesma até que você ative este codigo. \n\n";
                            
                            $mail->send();
                            $_SESSION['msg'] = "Enviado o e-mail com instruções para recuperar a senha. Acesse a sua caixa de e-mail
                            para recuperar a senha ";
                            header("Location: responsavel.php");
                            
                        }catch (Exception $e) {
                            echo "Erro: Tente novamente {$mail->ErrorInfo}";
                        }

                    }
                    else
                    {
                        echo "Erro: Tente novamente";
                    }

                }
                //Se não encontrar o responsavel no banco ele acessa esse else
                else
                {
                    echo "Erro: Usuário inválido";
                }
                
                /*if(isset($_SESSION['msg_rec']))
                {
                    echo $_SESSION['msg_rec'];
                    unset($_SESSION['msg_rec']);
                }*/

               
            }


        }*/
            
            
        function Logar()
        {
            $responsavel = new Responsavel();
            $responsavel->email = $_GET["email"];
            $dadosResponsavel = $responsavel->Logar();

            if($dadosResponsavel)
            {
                if($dadosResponsavel && password_verify($_GET["senhaEmail"], $dadosResponsavel->senhaEmail))
                {
                    //Usuário logado. Construct direcionará para a próxima tela"
                    echo "válido";
                }

                else
                {
                    //Exibir a seguinte mensagem no Construct: "Usuário ou senha inválida!"
                    echo "Não localizado";
                }
            }

            function Acessar()
            {
                $responsavel = new Responsavel();
                $dadosResponsavel = $responsavel->Acessar();

                if($dadosResponsavel)
                {
                    if($dadosResponsavel && password_verify($_GET["senhaAcesso"], $dadosResponsavel->senhaAcesso))
                    {
                        echo "válido";
                    }

                    else
                    {
<<<<<<< HEAD
                        echo "Senha de acesso inválida!";
                    }
                } 

                else
                {
                    echo "Senha de acesso inválida!";
                }   
=======
                        echo "Não localizado";
                    }
                } 
>>>>>>> bca032412f2912f573597f33f441acfce07710bd
            }

            /*function RetornarRelatorio()
            {
                $conexao = Conexao::Conectar();

                $cmd = $conexao->prepare("SELECT avaliacao FROM crianca WHERE idCrianca = :idCrianca");

                $responsavel = new Responsavel();
                $responsavel->idResposanvel = $_GET["idResponsavel"];
                $responsavel->nomeResponsavel = $_GET["nomeResponsavel"];
                $responsavel->telefone = $_GET["telefone"];
                $responsavel->email = $_GET["email"];
                $responsavel->senhaEmail = $_GET["senhaEmail"];
                $responsavel->senhaAcesso = $_GET["senhaAcesso"];
                $responsavel->RetornarRelatorio();
                $cmd->execute();
                return $cmd->fetch(PDO::FETCH_OBJ);
                // O retorno deverá ser feito através do ID da crianca
            }*/
        }
    }
?>