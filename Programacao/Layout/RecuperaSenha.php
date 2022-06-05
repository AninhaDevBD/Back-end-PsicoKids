<?php header('Access-Control-Allow-Origin: *');

     // Importando bibliotecas do PHPMailer
     use PHPMailer\PHPMailer\PHPMailer;
     use PHPMailer\PHPMailer\SMTP;
     use PHPMailer\PHPMailer\Exception;
     require 'lib/autoload.php';
    include_once 'conexao.php';

    // Pegando valores dos campos declarados no construct
    $email = $_GET['email'];
    $senhaEmail = $_GET['senhaEmail'];

    /* Verificando se o e-mail e senha digitados pelo usuário existem no banco.
    Enquanto o email e senha digitados forem igual aos existentes em registro no banco, o usuário é autenticado*/
    if(!empty($email && $senhaEmail))
    {
        $responsavel = "SELECT idResponsavel FROM responsavel WHERE email='".$email."' AND senhaEmail='".$senhaEmail."'" ;
        $responsavel = $conexao->prepare($responsavel);
        $responsavel->bind_param(':email'== ['email'], PDO::PARAM_STR);
        $responsavel->execute(); 

        if($responsavel != 0)
        {
            //Lendo o que vir do banco
            $linha_responsavel = $responsavel ->fetch(PDO::FETCH_ASSOC);
            //Gerando uma criptografia para o responsavel enviar para recuperar senha
            $cripto = password_hash($linha_responsavel["idResponsavel"], PASSWORD_DEFAULT);

            $responsavel = "UPDATE responsavel 
                            SET recuperaSenha = :recuperaSenha
                            WHERE idResponsavel = :idResponsavel
                            LIMIT 1";
            
            //Atribuindo os dados do banco a uma variavel
            $result_update_responsavel = $conexao->prepare($responsavel);
            //Conevertando o password hash em string
            $result_update_responsavel->bind_Param(':recuperaSenha', $cripto, PDO::PARAM_STR);

            $result_update_responsavel->bind_Param(':idResponsavel', $linha_responsavel['idResponsavel'], PDO::PARAM_INT);

            //Se conseguir executar com sucesso 
            if($result_update_responsavel->execute())
            {
                
                 //Verificando se a chave é valida
                 $link = "Layout/RecuperaSenha.php? chave = $cripto" ;
                   try
                   {
                       //Server settings
                        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                        $mail->isSMTP();                                            //Send using SMTP
                        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                        $mail->Username   = 'user@example.com';                     //SMTP username
                        $mail->Password   = 'secret';                               //SMTP password
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                        //Recipients
                        $mail->setFrom('from@example.com', 'Mailer');
                        $mail->addAddress('joe@example.net', 'Joe User');     //Add a recipient
                        $mail->addAddress('ellen@example.com');               //Name is optional
                        $mail->addReplyTo('info@example.com', 'Information');
                        $mail->addCC('cc@example.com');
                        $mail->addBCC('bcc@example.com');

                        //Content
                        $mail->isHTML(true);                                  //Set email format to HTML
                        $mail->Subject = 'Recuperar Senha';
                        $mail->Body    = 'Prezado(a)'. $linha_responsavel['nomeResponsavel'] . "<br><br>Você solicitou alteração da senha.
                        <br><br>Para continuar o processo de recuperar a sua senha, clique no link abaixo ou cole
                        endereço no seu navegador: <br><br><a href ='" . $link . "'>".$link."</a><br><br>Se você não solicitou essa alteração, nenhuma ação é
                        necessária. Sua senha permanecerá a mesma até que você ative este codigo. <br><br>";
                        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
                    
                   }catch (Exception $e){

                   }
                
            }
            else
            {
                echo "Erro: Tente novamente";
            }


        }
    
    
    
    }
    else
    {
        echo "Coloque seus dados";

    }
   
    
    $responsavel = str_replace("\'","",$responsavel);
    $resultado = mysqli_query($conexao,$responsavel);

    // Enquanto o banco retornar linha afetada da busca do e-mail e senha digitados, o id é retornado e o usuário permanece logado
    while($linha = mysqli_fetch_array($resultado))
    {
        echo $linha['idResponsavel'];
    }

    // Fecha conexão com o banco
    mysqli_close($conexao);
?>