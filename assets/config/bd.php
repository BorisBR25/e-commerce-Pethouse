<?php

$host="localhost";
$bd="pethouse";
$usuario="root";
$contrasenia="admin123";

$conexionn=mysqli_connect($host,$usuario,$contrasenia,$bd);

try {
    $conexion= new PDO("mysql:host=$host;dbname=$bd",$usuario,$contrasenia);
    if($conexion){
       // echo "conectado ... al sistema ";
    }
    //unset($conexion);
    //$conexion->close();
    //die();

}catch(Exception $ex){
    echo $ex->getMessage();

}

// function conexion(){
//     $pdo = new PDO('mysql:host=localhost;dbname=pdo', 'root', 'Yubi1989*');
//     return $pdo;
// }

?>
