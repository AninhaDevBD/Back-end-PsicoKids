<?php

    //Recendo o valor da chave
    $chave = filter_input(INPUT_GET, 'chave', FILTER_DEFAULT);

    if(!empty($chave))
    {
        $query_Responsavel = "SELECT idResponsavel 
                            FROM responsavel
                            WHERE recuperaSenha = :recuperaSenha
                            LIMIT 1";
        $result_Responsavel = $conexao->prepare($query_Responsavel);
        $result_Responsavel->bindParam(':recuperaSenha', $chave, PDO::PARAM_STR);
        $result_Responsavel->execute(); 

        //Verificando se encontrou o responsavel no banco
        if(($result_Responsavel) AND($result_Responsavel->rowCount() != 0)) 
        {
            
            $row_responsavel = $result_Responsavel->fetch(PDO::FETCH_ASSOC);
            $dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);

            if(!empty($dados))
            {
                //criptografando a nova senha
                $senha_responsavel = password_hash($dados['senhaEmail'], PASSWORD_DEFAULT);
                $recuperarSenha = "NULL";

                $query_update_resposavel = "UPDATE responsavel 
                                            SET senhaEmail = :senhaEmail, 
                                            recuperaSenha = :recuperaSenha 
                                                WHERE idResponsavel = :idResponsavel 
                                                LIMIT 1";
                 //Atribuindo os dados do banco a uma variavel
                 $result_update_responsavel = $conexao->prepare($query_update_resposavel);
                 //Convertendo o PASSWORD HASH em string
                 $result_update_responsavel->bindParam(':senhaEmail', $senha_responsavel, PDO::PARAM_STR);
                 $result_update_responsavel->bindParam(':recuperaSenha', $senha_responsavel);

                 $result_update_responsavel->bindParam(':idResponsavel', $row_responsavel['idResponsavel'], PDO::PARAM_INT);

                   //Se conseguir executar com sucesso acessa esse IF
                    if($result_update_responsavel->execute())
                    {
                        //Verificando se a chave é valida
                        echo "Senha atualizada com sucesso";
                        header("Location: responsavel.php");
                    }
                    else
                    {
                        echo "Erro: Usuário inválido";
                    }
            }
        }
        //Se não encontrou, cai nessa ELSE
        else
        {
            echo "Erro: Link inválido, solicite um novo link para atualizar a senha";
            //Enviando o responsavel para a outra pagina
            header("Location: responsavel.php");
        }
    }
    else
    {
        echo "Erro: Link inválido, solicite um novo link para atualizar a senha";
            //Enviando o responsavel para a outra pagina
            header("Location: responsavel.php");
    }

    
?>

