<?php

include("assets/config/bd.php");

?>
<?php
// Obtener el ID del pedido enviado por la solicitud AJAX
$pedidoId = $_POST['pedidoId'];
?>

<?php 

$sentenciaSQL=$conexion->prepare("SELECT * FROM pedido");
$sentenciaSQL->execute();
$listaPedidos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


?>

<?php
    include("headerAdmin.php");
?>
<div class="container"> 


        <div class="col-md-12">
        
        <table class="table table-bordered">
            <thead>
                <tr>
                </br></br></br></br>
                    <th>ID</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>ID producto</th>
                    <th>ID usuario</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>

                <?php  foreach($listaPedidos as $pedido){   ?>
                    <tr>
                        <td><?php echo isset($pedido['idPedido']) ? $pedido['idPedido'] : ''; ?></td>
                        <td><?php echo isset($pedido['cantidadPedido']) ? $pedido['cantidadPedido'] : ''; ?></td>
                        <td><?php echo isset($pedido['subtotalPedido']) ? $pedido['subtotalPedido'] : ''; ?></td>
                        <td><?php echo isset($pedido['idProducto']) ? $pedido['idProducto'] : ''; ?></td>
                        <td><?php echo isset($pedido['idUsuario']) ? $pedido['idUsuario'] : ''; ?></td>
                        <td><button class="btn btn-danger" id="btn-despachar-<?php echo isset($pedido['idPedido']) ? $pedido['idPedido'] : ''; ?>">Por despachar</button></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        
        
        </div>
</div>
<br><br><br><br><br><br><br><br><br><br>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    $("button[id^='btn-despachar-']").each(function() {
        var button = $(this);
        var buttonId = button.attr("id");
        var pedidoId = buttonId.split("-")[2];

        // Verificar el estado almacenado en el localStorage
        var estado = localStorage.getItem("estado-" + pedidoId);
        if (estado === "despachado") {
            button.removeClass("btn-danger").addClass("btn-success").text("Despachado");
        }

        button.on("click", function() {
            // Realizar una solicitud AJAX para actualizar el estado del pedido
            $.ajax({
                url: "actualizar_estado_pedido.php",
                method: "POST",
                data: { pedidoId: pedidoId },
                success: function(response) {
                    // Cambiar el estado del botón y almacenarlo en el localStorage
                    if (button.hasClass("btn-danger")) {
                        button.removeClass("btn-danger").addClass("btn-success").text("Despachado");
                        localStorage.setItem("estado-" + pedidoId, "despachado");
                    } else {
                        button.removeClass("btn-success").addClass("btn-danger").text("Por despachar");
                        localStorage.removeItem("estado-" + pedidoId);
                    }
                },
                error: function() {
                    alert("Ocurrió un error al actualizar el estado del pedido.");
                }
            });
        });
    });
});
</script>
<?php
include("footer.php");
?>