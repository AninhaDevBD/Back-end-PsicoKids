<?php
    include_once "Layout/AtualizaSenha";
    include_once 'conexao.php';
    $Cripto = $_GET ['$cripto'];
    $email = $_GET['email'];
    $senhaEmail = $_GET['senhaEmail'];
    $responsavel_dados = $email + $senhaEmail;

    if(!empty($Cripto))
    {
        $responsavel = "SELECT idResponsavel 
                        FROM responsavel 
                        WHERE email='".$email."' AND senhaEmail='".$senhaEmail."'" ;
        $responsavel = $conexao->prepare($responsavel);
        $responsavel->bind_param(':email'== ['email'], PDO::PARAM_STR);
        $responsavel->execute();
        
        if(($responsavel) && ($responsavel-> num_rows() !=0) )
        {
            $linha_responsavel = $responsavel->fetch(PDO::FETCH_ASSOC);
            $responsavel_dados = filter_input_array(INPUT_GET, FILTER_DEFAULT);

            if(!empty($responsavel_dados))
            {
                //criptografando a nova senha
                $cripto = password_hash($responsavel_dados['senhaEmail'], PASSWORD_DEFAULT);
                $recuperarSenha = "NULL";

                $responsavel = "UPDATE responsavel 
                SET senhaEmail = :senhaEmail,
                recuperaSenha = :recuperaSenha
                WHERE idResponsavel = :idResponsavel
                LIMIT 1";

                //Atribuindo os dados do banco a uma variavel
                $result_update_responsavel = $conexao->prepare($responsavel);
                //Conevertando o password hash em string
                $result_update_responsavel->bind_Param(':recuperaSenha', $cripto, PDO::PARAM_STR);

                $result_update_responsavel->bind_Param(':idResponsavel', $linha_responsavel['idResponsavel'], PDO::PARAM_INT);

                if($result_update_responsavel->execute())
                {
                    echo "Senha Atualizada com sucesso";
                }
                else
                {
                    echo "Erro: Usúario invalido";
                }
            }
            else
            {
                echo "Tente novamente";
            }

        }
        else
        {
            echo "Erro: Coloque os dados corretamente";
        }
    }
    else
    {
        echo "erro: Usúario invalido";
    }




?>