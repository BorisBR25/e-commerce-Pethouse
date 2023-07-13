<?php
require ('../PetHouse/assets/config/bd.php');

$json = file_get_contents('php://input');
$datos = json_decode($json, true);



//print_r($datos);
if(is_array($datos)){
    $paypal = 'Paypal';
    $id_transaccion = $datos['detalles']['id'];
    $monto = $datos['detalles']['purchase_units'][0]['amount']['value'];
    $estado = $datos['detalles']['status'];
    $fecha = $datos['detalles']['update_time'];
    $fechaNew = date('Y-m-d H:i:s', strtotime($fecha));
    $email = $datos['detalles']['payer']['email_address'];
    $id_cliente = $datos['detalles']['payer']['payer_id'];
    

    $sentenciaSQL= $conexion->prepare("INSERT INTO `pethouse`.`datoPago` (`nombrePago`,`correoCliente`,`respuestaPago` ) VALUES (:nombrePago, :correocliente, :respuestaPago);");
        $sentenciaSQL->bindParam(':nombrePago',$paypal);
        $sentenciaSQL->bindParam(':correocliente',$email);
        $sentenciaSQL->bindParam(':respuestaPago',$estado);
        $sentenciaSQL->execute();

     
}

//////sentencia factura////////////

?>
