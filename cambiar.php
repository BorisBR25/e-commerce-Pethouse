<?php
include("header.php")
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambiar Contraseña<span>.</span></title>
</head>
<body>


  <div class="container">
		<div class="row justify-content-center mt-5">
			<div class="col-md-6">
			</br></br></br>
				<h3 class="text-center mb-4"><b>Cambiar Contraseña.</b></h3>
				
				<form  method="post">

					<div class="form-group row">
                <div class="col-md-6">
                  <label for="input-nombre">Código de recuperación:</label>
                  <input type="text" name="codigo" class="form-control" id="" placeholder="" required>
                </div>
                
                <div class="col-md-6">
                  <label for="input-apellido">Nueva contraseña:</label>
                  <input type="password" name="clave" class="form-control" id="" placeholder="********" minlength="8" required>
                </div>
                </div></br>
            <button type="submit" id="botonL" class="">Cambiar contraseña</button>
            </br></br></br></br></br></br></br></br></br></br></br></br></br></br>
            
            </div>
          </div>
          
          </div>

        </form>
</body>
</html>

<?php
// Conectar a la base de datos

include("assets/config/bd.php");

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Obtener la nueva contraseña y el correo electrónico del usuario
    $contrasena = mysqli_real_escape_string($conexionn, $_POST["clave"]);
    $codigo = mysqli_real_escape_string($conexionn, $_POST["codigo"]);

    // Actualizar la contraseña del usuario en la base de datos
    $consulta = "UPDATE usuario SET claveUsuario = md5('$contrasena'), codigo_recuperacion = NULL WHERE codigo_recuperacion = '$codigo'";
    mysqli_query($conexionn, $consulta);
  
    // Mostrar un mensaje de éxito al usuario
    echo '<script> alert("Su contraseña ha sido cambiada correctamente, inicie sesión.");window.location.href="index.php"</script>';
  }
  
  // Cerrar la conexión a la base de datos
  mysqli_close($conexionn);
  ?>

<?php
include("footer.php")
?>