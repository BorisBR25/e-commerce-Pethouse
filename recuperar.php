<?php

// // Configuración de correo
// $correo_envio = 'tu_cuenta@outlook.com';
// $contrasena_correo = 'tu_contrasena';
// $nombre_envio = 'Nombre remitente';
// $correo_destino = 'correo_destino@dominio.com';
// $asunto = 'Recuperación de contraseña';
// $mensaje = 'Estimado usuario, haz solicitado recuperar tu contraseña. Aquí está el enlace de recuperación: https://www.ejemplo.com/recuperar.php?token=123456';

// // Configuración del servidor SMTP de Outlook
// $smtp_host = 'smtp-mail.outlook.com';
// $smtp_puerto = 587;
// $smtp_seguridad = 'tls';

// // Configuración de autenticación SMTP
// $smtp_usuario = $correo_envio;
// $smtp_contrasena = $contrasena_correo;


// // Cargar la librería PHPMailer
// require 'PHPMailer/PHPMailer.php';

// // Crear una nueva instancia de PHPMailer

// $mail = new PHPMailer();


// // Configurar el servidor SMTP
// $mail->isSMTP();
// $mail->Host = $smtp_host;
// $mail->Port = $smtp_puerto;   
// $mail->SMTPSecure = $smtp_seguridad;
// $mail->SMTPAuth = true;
// $mail->Username = $smtp_usuario;
// $mail->Password = $smtp_contrasena;

// // Configurar detalles del mensaje
// $mail->setFrom($correo_envio, $nombre_envio);
// $mail->addAddress($correo_destino);
// $mail->Subject = $asunto;
// $mail->Body = $mensaje;

// // Enviar el correo electrónico
// if ($mail->send()) {
//     echo 'El correo de recuperación ha sido enviado correctamente.';
// } else {
//     echo 'Hubo un error al enviar el correo de recuperación. Error: ' . $mail->ErrorInfo;
// }
///////////////// otra opcion /////////////////
?>

<?php
include("header.php")
?>

<?php

include("assets/config/bd.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// require 'path/to/PHPMailer/src/Exception.php';
// require 'path/to/PHPMailer/src/PHPMailer.php';
// require 'path/to/PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($conexionn, $_POST["email"]);
    $id = mysqli_real_escape_string($conexionn, $_POST["id"]);
    
    // validacion de correo en la base de datos
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

      echo '<script> alert("Se ha enviado un correo electrónico con el código de recuperación");window.location.href="cambiar.php"</script>';
    } else {

      echo '<script> alert("El correo electrónico y/o identificación ingresado no está registrado en nuestra base de datos, valide la información.");</script>';
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