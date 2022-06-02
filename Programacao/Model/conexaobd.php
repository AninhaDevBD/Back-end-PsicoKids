<?php

class Conexao
{
    // Um método estático não precisa instanciar a classe
    static function Conectar()
    {
        $conexao = new PDO("mysql:host=localhost;
        port=3306;dbname=bdpsicokids", "root", "");

        // Ativando recurso de exibição de erro SQL
        $conexao->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

        return $conexao; // Retorna a conexão para o uso

        // OBS: Não esquecer de fechar a conexão com o banco
    }
}

?>