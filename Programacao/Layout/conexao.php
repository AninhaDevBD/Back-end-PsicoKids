<?php header('Access-Control-Allow-Origin: *');

// Executando conexão com o banco
$conexao = mysqli_connect("localhost","root","","bdpsicokids");
    
// Checando conexão com o banco
if (mysqli_connect_error())
{
    echo "Falha ao conectar com o banco: " . mysqli_connect_error();
}

?>