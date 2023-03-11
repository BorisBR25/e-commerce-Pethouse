<?php
include("header.php")
?>

<?php
session_start();

if($_POST){

    $txtImagen=(isset($_FILES['txtImagen']['name']))?$_FILES['txtImagen']['name']:"";
    $txtCorreo=(isset($_POST['correo']))?$_POST['correo']:"";
    $txtID=(isset($_POST['id']))?$_POST['id']:"";
    $txtNombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
    $txtApellido=(isset($_POST['apellido']))?$_POST['apellido']:"";
    $txtTel=(isset($_POST['tel']))?$_POST['tel']:"";   
    $txtCiudad=(isset($_POST['ciudad']))?$_POST['ciudad']:"";
    $txtDireccion=(isset($_POST['direccion']))?$_POST['direccion']:"";
    $txtBarrio=(isset($_POST['barrio']))?$_POST['barrio']:"";
    $txtContrasena=(isset($_POST['contrasena']))?md5($_POST['contrasena']):""; 

       
    include("assets/config/bd.php");

        //validación si existe en base de datos

        $sentenciaSQL=$conexion->prepare("SELECT * FROM sitio.usuario where cedula=:id;");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $usuario=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        //si ya esta registrado se ejecuta una alerta
        if ($usuario!="")
        {                
            echo '<script> alert("Usuario ya registrado, intente de nuevo ");window.location.href="http://localhost/sitioweb/administrador/index.php"</script>';
        }

        else{

            $sentenciaSQL= $conexion->prepare("INSERT INTO `sitio`.`usuario` (`cedula`, `nombre`, `apellido`, `correo`, `telefono`, `contrasena`,`ciudad`, `direccion`, `barrio`,`imagen` , `rol`) VALUES (:id, :nombre, :apellido, :correo, :tel, :contrasena, :ciudad, :direccion, :barrio, :imagen,'2');");
            $sentenciaSQL->bindParam(':correo',$txtCorreo);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':apellido',$txtApellido);
            $sentenciaSQL->bindParam(':tel',$txtTel);  
            $sentenciaSQL->bindParam(':ciudad',$txtCiudad);    
            $sentenciaSQL->bindParam(':direccion',$txtDireccion);
            $sentenciaSQL->bindParam(':barrio',$txtBarrio);
            $sentenciaSQL->bindParam(':contrasena',$txtContrasena);   

            $fecha= new DateTime();
            $nombreArchivo=($txtImagen!=="")?$fecha->getTimestamp()."_".$_FILES["txtImagen"]["name"]:"imagen.jpg";
            $tmpImagen=$_FILES["txtImagen"]["tmp_name"];

            if($tmpImagen!=""){
                move_uploaded_file($tmpImagen,"assets/img/perfiles/".$nombreArchivo);
            }

            $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
            $sentenciaSQL->execute();

            $_SESSION["id"]= $txtID;
            header("Location:Perfil.php");
        }
}

?>
    
        
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Creacion de cuenta</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

</head>
<body>

<div class="container mt-3">
</br></br></br></br>
<h3 class="text-center">Creación de cuenta</h3>
    
  <form method="POST" class="was-validated" enctype="multipart/form-data">

    <div class="mb-3 mt-3">

      <label for="uname" class="form-label">Correo:</label>
      <input type="email" class="form-control" placeholder="dominio@dominio.com" name="correo" required>
      <div class="valid-feedback">Valido.</div>
      <div class="invalid-feedback">Por favor llenar este campo.</div>
    </div>
    <div class="mb-3">

      <label for="pwd" class="form-label">Documento de identidad:</label>
      <input type="number" class="form-control" placeholder="" name="id" required>
      <div class="valid-feedback">Valido.</div>
      <div class="invalid-feedback">Por favor llenar este campo.</div>
    </div>

    <div class="mb-3 mt-3">

      <label for="uname" class="form-label">Nombre Completo:</label>
      <input type="text" class="form-control" placeholder="" name="nombre" required>
      <div class="valid-feedback">Valido.</div>
      <div class="invalid-feedback">Por favor llenar este campo.</div>
    </div>

    <div class="mb-3 mt-3">

      <label for="uname" class="form-label">Apellidos:</label>
      <input type="text" class="form-control" placeholder="" name="apellido" required>
      <div class="valid-feedback">Valido.</div>
      <div class="invalid-feedback">Por favor llenar este campo.</div>
    </div>

    <div class="mb-3 mt-3">

      <label for="uname" class="form-label">Teléfono:</label>
      <input type="number" min="1" max="9999999999" class="form-control" placeholder="" name="tel" required>
      <div class="valid-feedback">Valido.</div>
      <div class="invalid-feedback">Por favor llenar este campo.</div>
    </div>

    <div class="mb-3 mt-3">

      <label for="uname" class="form-label">Dirección:</label>
      <input type="text" class="form-control" placeholder="Cra. 30 # 30-30" name="direccion" required>
      <div class="valid-feedback">Valido.</div>
      <div class="invalid-feedback">Por favor llenar este campo.</div>
    </div>

    <div class="mb-3 mt-3">

      <label for="uname" class="form-label">Barrio:</label>
      <input type="text" class="form-control" placeholder="" name="barrio" required>
      <div class="valid-feedback">Valido.</div>
      <div class="invalid-feedback">Por favor llenar este campo.</div>
    </div>
 
    <div class="mb-3 mt-3">

      <label for="uname" class="form-label">Ciudad:</label>
      <select name="ciudad" class="form-control" required >
      <option value="">Seleccione</option>
        <option value="Medellín">Medellín</option>
        <option value="Envigado">Envigado</option>
        <option value="Itaguí">Itaguí</option>
        <option value="Bello">Bello</option>
        </select>
      <div class="valid-feedback">Valido.</div>
      <div class="invalid-feedback">Por favor llenar este campo.</div>
    </div>

    <div class="mb-3 mt-3">

    <label for="uname" class="form-label">Contraseña:</label>
    <input type="password" class="form-control" minlength="8" placeholder="*******" name="contrasena" required>
    <div class="valid-feedback">Valido.</div>
    <div class="invalid-feedback">Por favor llenar este campo.</div>
    </div>
  
    <div class = "form-group">
    <label for="txtImagen" id="icon" ><i class="icon-user "></i> Seleccione Foto de perfil:</label>
    <br/>        
    <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Foto de Perfil">
    </div>
    <br/> 
    <div class="form-check mb-3">
      <input class="form-check-input" type="checkbox" name="" required>
      <label class="form-check-label" for="myCheck">Aceptar términos y condiciones de uso.</label>
      <div class="valid-feedback">Aceptado.</div>
      <div class="invalid-feedback">Debes aceptar los términos para continuar.</div>
    </div>

    <button id="botonL" type="submit" class="">Registrarse</button>
    
  </form>
  <br/> 
</div>

</body>
</html>



<?php
include("footer.php")
?>