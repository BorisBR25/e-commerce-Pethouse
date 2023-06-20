<?php
include("header.php")
?>

<?php

include("assets/config/bd.php");

// Comprobar si se ha enviado el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener el correo electrónico ingresado
    $email = mysqli_real_escape_string($conexionn, $_POST["email"]);
    $id = mysqli_real_escape_string($conexionn, $_POST["id"]);
    
    // Comprobar si el correo electrónico está registrado en la base de datos
    $consulta = "SELECT * FROM usuario WHERE correoUsuario = '$email' and idUsuario = '$id'";
    $resultado = mysqli_query($conexionn, $consulta);
  
    if (mysqli_num_rows($resultado) == 1) {
      // Generar un código de recuperación aleatorio
      $codigo = rand(100000, 999999);
  
      // Guardar el código en la base de datos junto con la dirección de correo electrónico
      $consulta = "UPDATE usuario SET codigo_recuperacion = '$codigo' WHERE correoUsuario = '$email'";
      mysqli_query($conexionn, $consulta);
  
      // Enviar el correo electrónico con el código de recuperación

      $headers = 'from: pethouseprueba@gmail.com' . "\r\n" . 
                 'MIME-Version: 1.0' . "\r\n" .
                 'Content-Type: text/html; charset=utf-8';

      $mensaje = "Su código de recuperación de contraseña es: $codigo";
      
      mail($email, "Recuperación de contraseña", $mensaje,$headers);
  
      // Mostrar un mensaje de éxito al usuario
      echo '<script> alert("Se ha enviado un correo electrónico con el código de recuperación");window.location.href="cambiar.php"</script>';
    } else {
      // Mostrar un mensaje de error al usuario
      echo '<script> alert("El correo electrónico y/o ID ingresado no está registrado en nuestra base de datos.");</script>';
    }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Contraseña</title>
</head>
<body>
    
  <div class="container">
		<div class="row justify-content-center mt-5">
			<div class="col-md-6">
			</br></br></br>
				<h3 class="text-center mb-4"><b>Recuperar contraseña<span>.</span></b></h3>
        </br></br></br></br>

  <form method="post" >

					<div class="form-group row">
						<div class="col-md-6">
							<label for="input-nombre">Correo electrónico:</label>
							<input type="text" name="email" class="form-control" id="" placeholder="Ingrese el correo electrónico" required>
						</div>
						<div class="col-md-6">
							<label for="input-apellido">Documento de identidad:</label>
							<input type="text" name="id" class="form-control" id="" placeholder="Ingrese su documento registrado">
						</div>
            </div>
          </br>
          <button type="submit" id="botonL" class="">Enviar</button>
		</form>
          </br></br></br></br></br></br></br></br></br>
        </div>
      </div>
    </div>
        
</body>
</html>


<?php
include("footer.php")
?>