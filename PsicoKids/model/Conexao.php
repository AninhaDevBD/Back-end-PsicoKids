<?php
class Conexao
{
    static function conectar()
    {
        //informações para acessar servidor e BD
        $con = new PDO("mysql:host=localhost;
        port=3306;dbname=bdnoticia", "root", "");

        //ativando recurso de exibição de erro SQL
        $con->setAttribute(PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION);
        
        return $con; //retorna conexão para uso
    }
}
?>