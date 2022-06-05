<?php

if(isset($_GET["classe"]) && isset($_GET["metodo"]))
{
    $classe = $_GET["classe"];
    $metodo = $_GET["metodo"];
    include_once "Controller/$classe.php";
    $obj = new $classe();
    $obj->$metodo();
}
else
{
    echo "Página não encontrada";
}
?>