<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Latest compiled and minified CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>
</br></br></br></br></br></br></br>

<script type="text/javascript">
    function confirmacion(){
        var respuesta = confirm("Seguro que desea eliminar el cliente?");
        if (respuesta == true){
            return true;
        }else{
            return false;
        }
    }
</script>

<div class="container is-fluid mb-6">
    <h1 class="title">Gestión clientes</h1>
    <h2 class="subtitle">Buscar usuario</h2>
    <br><br><br><br>
</div>

<div class="container pb-6 pt-6">

<div class="columns">
        <div class="column">
        <form action="" method="POST" autocomplete="off" >

<div class="input-group mb-3">
  <input type="number" name="txt_buscador"  class="form-control" placeholder="Ingrese doc del cliente..." pattern="{1,30}" maxlength="30">
  <button class="btn btn-success" type="submit">Buscar</button>
</div>
    </form>
  </div>
</div>
</div>
<br><br>

<?php include("assets/config/bd.php"); 
session_start();
$tabla="";


if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['accion']) && $_POST['accion'] == 'eliminar') {
  $idUsuario = $_POST['idUsuario']; // Suponiendo que el campo que contiene el ID del usuario se llame "idUsuario"

  // Realizar la consulta para eliminar el registro
  $eliminar = $conexion->prepare("DELETE FROM pethouse.usuario WHERE idUsuario = :idUsuario");
  $eliminar->bindParam(':idUsuario', $idUsuario);

  if ($eliminar->execute()) {
      // Registro eliminado exitosamente
      echo '<script> alert("El registro se eliminó correctamente..");window.location.href="busquedaCliente.php"</script>';
  } else {
      // Error al eliminar el registro
      echo '<script> alert("Ocurrió un error al eliminar el registro.");window.location.href="busquedaCliente.php"</script>';                  
               
  }
}

if(($_POST) && ($txtBusqueda=$_POST['txt_buscador'])) {

  $txtBusqueda=(isset($_POST['txt_buscador']))?$_POST['txt_buscador']:"";

  $consulta_datos=("SELECT * FROM pethouse.usuario WHERE ((idUsuario != ".$_SESSION['id'].") AND (idUsuario LIKE '%$txtBusqueda%'));");
  $consulta_total=("SELECT COUNT(idUsuario) FROM pethouse.usuario WHERE ((idUsuario != ".$_SESSION['id'].") AND (idUsuario LIKE '%$txtBusqueda%'));");

  $datos = $conexion->query($consulta_datos);
	$datos = $datos->fetchAll();

	$total = $conexion->query($consulta_total);
	$total = (int) $total->fetchColumn();

	$tabla.='
  <div class = "form-group">
	<div class="table-container">
        <table class="table table-bordered is-striped is-narrow is-hoverable is-fullwidth table-sm">
            <thead class="table-success">
                <tr class="has-text-centered">
                    <th>Documento</th>
                	  <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Usuario</th>
                    <th>Email</th>
                    <th colspan="2">Opciones</th>
                </tr>
            </thead>
          <tbody>
	';

    if($total >= 1){
      
      foreach($datos as $rows){
        $tabla.='
          <tr class="has-text-centered" >
                      <td>'.$rows['idUsuario'].'</td>
                      <td>'.$rows['nombreUsuario'].'</td>
                      <td>'.$rows['apellidoUsuario'].'</td>
                      <td>'.$rows['direccionCompleta'].'</td>
                      <td>'.$rows['correoUsuario'].'</td>
                      <td>
                      <form action="editarCliente.php" method="GET">
                      <input type="hidden" name="idUsuario" value="'.$rows['idUsuario'].'">                       
                      <button type="submit" name="accion" value="editar" title="Editar Cliente" class="btn btn-outline-light text-dark"><span><i class="bi bi-pencil-square"></i></span></button> 
                      </td>
                      </form>
                      <td>
                      <form method="POST">
                      <input type="hidden" name="idUsuario" value="'.$rows['idUsuario'].'">                        
                      <button type="submit" name="accion" value="eliminar" title="Eliminar Cliente" class="btn btn-outline-light text-dark" onclick="return confirmacion()"><span><i class="bi-trash"></i></span></button>
                      </td>
                      </form>
                  </tr>
              ';            
      }		
    }else{        
      $tabla.='
                  <tr class="has-text-centered" >
                    <td colspan="7">
                      No hay registros en el sistema
                    </td>
                  </tr>
                ';
              }
            
    $tabla.='</tbody></table></div>';

    if($total>0 ){
      $tabla.='<p class="has-text-right">Mostrando usuarios <strong>total de '.$total.'</strong></p>';
    }
    $conexion=null; 
    echo $tabla;     
  }  

?>

<?php
include("headerAdmin.php");
?>
<br><br><br><br><br><br><br>

</body>
<?php
include("footer.php");
?>

</body>
</html>