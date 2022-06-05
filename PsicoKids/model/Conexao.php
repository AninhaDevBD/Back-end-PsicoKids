<?php
class Conexao
{
    static function Conectar()
    {
        //informações para acessar servidor e BD
        $conexao = new PDO("mysql:host=localhost;
        port=3306;dbname=bdnoticia", "root", "");

        //ativando recurso de exibição de erro SQL
        $conexao->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
        
        return $conexao; //retorna conexão para uso
    }
}
?>