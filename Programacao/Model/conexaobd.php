<?php

class Conexao
{
    // Um método estático não precisa instanciar a classe
    static function Conectar()
    {
        $conn = new PDO("mysql:host=localhost;
        port=3306;dbname=psicokids", "root", "");

        // Ativando recurso de exibição de erro SQL
        $conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $conn; // Retorna a conexão para o uso

        // OBS: Não esquecer de fechar a conexão com o banco
    }
}

?>