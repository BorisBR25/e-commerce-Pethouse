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
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
</br></br></br></br>
<?php
include("headerAdmin.php");
include("assets/config/bd.php"); 

$idUsuario = $_GET['idUsuario'];
	
$sentenciaSQL=$conexion->prepare("SELECT * FROM pethouse.usuario WHERE idUsuario = $idUsuario");
$sentenciaSQL->execute();
$datos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

/*Código para guardar en usuario el update*/

if($_POST){
    $txtNombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
    $txtApellido=(isset($_POST['apellido']))?$_POST['apellido']:"";
    $txtTel=(isset($_POST['tel']))?$_POST['tel']:"";
    $txtCorreo=(isset($_POST['correo']))?$_POST['correo']:"";
    $txtDireccion=(isset($_POST['direccion']))?$_POST['direccion']:"";
    $txtRol=(isset($_POST['nombreRol']))?$_POST['nombreRol']:"";

    $sentenciaSQL=$conexion->prepare("UPDATE `pethouse`.`usuario` SET nombreusuario=:nombre, apellidoUsuario=:apellido, correoUsuario=:correo, direccionCompleta=:direccion, telefonoUsuario=:tel, rolUsuario=:rol WHERE idUsuario=$idUsuario");
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':apellido',$txtApellido);
            $sentenciaSQL->bindParam(':tel',$txtTel);
            $sentenciaSQL->bindParam(':correo',$txtCorreo);   
            $sentenciaSQL->bindParam(':direccion',$txtDireccion);  
            $sentenciaSQL->bindParam(':rol',$txtRol);
            $sentenciaSQL->execute();
        
            //header("Location:editarCliente.php");
            echo '<script> alert("información actualizada con exito.");window.location.href="busquedaCliente.php"</script>';                  
}

?>
<div class="container is-fluid mb-6">
    <h1>Editar datos de usuario<span>.</span></h1>   
</div>

<div class="container">
		<div class="row justify-content-center mt-5">
			<div class="col-md-6">
			
            <form method="POST"  autocomplete="off">
					<div class="form-group row">
						<div class="col-md-6">
							<label for="input-nombre">Nombre:</label>
							<input type="text" name="nombre" class="form-control" id="" value="<?php echo $datos[0]['nombreUsuario']; ?>">
						</div>
						<div class="col-md-6">
							<label for="input-apellido">Apellidos:</label>
							<input type="text" name="apellido" class="form-control" id="" value="<?php echo $datos[0]['apellidoUsuario']; ?>" >
						</div>
					</div>

                    <div class="form-group row">
						<div class="col-md-6">
							<label for="input-nombre">Documento Identidad:</label>
							<input type="number" readonly name="id" class="form-control" id="" value="<?php echo $datos[0]['idUsuario']; ?>">
						</div>
						<div class="col-md-6">
							<label for="input-apellido">Correo Electrónico:</label>
							<input type="email" name="correo" class="form-control" id="" value="<?php echo $datos[0]['correoUsuario']; ?>" >
						</div>
					</div>

                    <div class="form-group">
						<label for="input-codigo-postal">Dirección:</label>
						<input type="text" name="direccion" class="form-control" id="input-codigo-postal" value="<?php echo $datos[0]['direccionCompleta']; ?>">
					</div>

				    <div class="form-group">
						<label for="input-codigo-postal">Teléfono de contacto:</label>
						<input type="number" name="tel" class="form-control" id="input-codigo-postal" value="<?php echo $datos[0]['telefonoUsuario']; ?>">
					</div>


                    <div class="form-group row">
						<div class="col-md-6">
							<label for="input-rol">Rol actual:</label>
							<input type="number" readonly name="rol" class="form-control" id="" value="<?php echo $datos[0]['rolUsuario']; ?>">
						</div>
						<div class="col-md-6">
							<label for="input-apellido">Cambiar rol a:</label>
							<select name="nombreRol" class="form-control">
                                <option></option>
                                  <option value="2">2-Usuario</option>
                                  <option value="1">1-Administrador</option>
                                  </select>
						</div>
					</div>                    
                    
					<button type="submit" id="botonL" >Guardar</button>		
					<a href="busquedaCliente.php" id="botonL">Cancelar</a>		
				</form>
				
        </div>
		
    </div>
</div> 

</br> 
</body>
<?php
include("footer.php");
?>

</body>
</html>