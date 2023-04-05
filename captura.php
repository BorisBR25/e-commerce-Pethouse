<?php
require ('C:\xampp\htdocs\PetHouseBoris\assets\php\conexion.php');

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

print_r($datos);

if(is_array($datos)){

    $id_transaccion = $datos['detalles']['id'];
    $monto = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $estado = $datos['detalles']['status'];
    $fecha = $datos['detalles']['update_time'];
    $fechaNew = date('Y-m-d H:i:s', strtotime($fecha));
    $email = $datos['detalles']['payer']['email_address'];
    $id_cliente = $datos['detalles']['payer']['payer_id'];
}


?>