<?php
require('../PetHouse/assets/config/bd.php');

$json = file_get_contents('php://input');
$datos = json_decode($json, true);

if (is_array($datos) && isset($datos['datos']) && isset($datos['id'])) {
    $idValue = $datos['id']; // Obtén el valor del 'id' desde la petición

    $productos = json_decode($datos['datos'], true);

    $sentenciaSQL = $conexion->prepare("INSERT INTO `pethouse`.`pedido` (`cantidadPedido`, `subtotalPedido`, `subtotalIva`, `idProducto`, `idUsuario`) VALUES (:cantidad, :subtotal, :subtotaliva, :idproducto, :idusuario);");

    foreach ($productos as $producto) {
        $id_producto = $producto['id'];
        $total = $producto['price'];
        $cantidad = $producto['quantity'];

        // Eliminar caracteres no numéricos del valor de 'subtotalPedido'
        $subtotal_pedido = preg_replace('/[^0-9]/', '', $total);
        $subtotal_iva = $subtotal_pedido * 1.19; // Calcula el subtotal con IVA (asumiendo un 19% de IVA)

        $sentenciaSQL->bindParam(':cantidad', $cantidad);
        $sentenciaSQL->bindParam(':subtotal', $subtotal_pedido);
        $sentenciaSQL->bindParam(':subtotaliva', $subtotal_iva);
        $sentenciaSQL->bindParam(':idproducto', $id_producto);
        $sentenciaSQL->bindParam(':idusuario', $idValue);
        $sentenciaSQL->execute();

        include ('enviar_mail.php');  
    }
} else {
    // Maneja la situación cuando el valor del input 'id' está vacío
    echo "El valor del input 'id' está vacío";
}
?>


