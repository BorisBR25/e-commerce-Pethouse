<?php

$host="localhost";
$bd="sitio";
$usuario="root";
$contrasenia="admin123";

$conexionn=mysqli_connect($host,$usuario,$contrasenia,$bd);

try {
    $conexion= new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);
    if($conexion){
       // echo "conectado ... al sistema ";
    }

}catch(Exception $ex){
    echo $ex->getMessage();

}


?>
