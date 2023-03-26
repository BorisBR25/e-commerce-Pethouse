<?php
include("header.php");
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
    $direccion1=(isset($_POST['direccion1']))?$_POST['direccion1']:"";
	$direccion2=(isset($_POST['direccion2']))?$_POST['direccion2']:"";
	$direccion3=(isset($_POST['direccion3']))?$_POST['direccion3']:"";
	$direccion4=(isset($_POST['direccion4']))?$_POST['direccion4']:"";
	$txtDireccion=$direccion1." ".$direccion2." "."#"." ".$direccion3." ".$direccion4;
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
            echo '<script> alert("Usuario ya registrado, intente de nuevo ");window.location.href="http://localhost/PetHouse-main/PetHouse-main/index.php"</script>';
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
           // echo '<script> alert("Usuario ya registrado, intente de nuevo ");window.location.href="http://localhost/PetHouse-main/PetHouse-main/Perfil.php"</script>';
            header("Location:Perfil.php");
        }
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Creación de Cuenta</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container">
		<div class="row justify-content-center mt-5">
			<div class="col-md-6">
			</br></br></br>
				<h3 class="text-center mb-4"><b>Creación de Cuenta.</b></h3>
				
				<form onsubmit="return validarContrasena()" method="post" enctype="multipart/form-data" >

					<div class="form-group row">
						<div class="col-md-6">
							<label for="input-nombre">Nombre:</label>
							<input type="text" name="nombre" class="form-control" id="" placeholder="Ingrese su nombre" required>
						</div>
						<div class="col-md-6">
							<label for="input-apellido">Apellido:</label>
							<input type="text" name="apellido" class="form-control" id="" placeholder="Ingrese su apellido">
						</div>
					</div>

                    <div class="form-group row">
						<div class="col-md-6">
							<label for="input-nombre">Documento Identidad:</label>
							<input type="number" name="id" class="form-control" id="" placeholder="Ingrese su documento" required>
						</div>
						<div class="col-md-6">
							<label for="input-apellido">Correo Electrónico:</label>
							<input type="email" name="correo" class="form-control" id="" placeholder="email@dominio.com" required>
						</div>
					</div>

					<div class="form-group row">
						<div class="col-md-3">
							<label for="">Tipo de Calle:</label>
                            <select name="direccion1" class="form-control" required>
                                <option value="" ></option>
                                  <option value="Calle">Calle</option>
                                  <option value="Carrera">Carrera</option>
                                  <option value="Avenida">Avenida</option>
                                  <option value="Circular">Circular</option>
                                  <option value="Diagonal">Diagonal</option>
                                  <option value="Tranversal">Tranversal</option>
                                  </select>
							</div>
						<div class="col-md-3">
							<label>Número:</label>
							<input type="text" name="direccion2" class="form-control" id="" placeholder="Ingrese el número"   >
						</div>
						<div class="col-md-3">
							<label>#</label>
							<input type="text" name="direccion3" class="form-control" id="" placeholder="Ingrese número de cruce" required>
						</div>
						<div class="col-md-3">
							<label>Número:</label>
							<input type="text" name="direccion4" class="form-control" id="" placeholder="Distancia">
						</div>
					</div>

                    <div class="form-group row">
						<div class="col-md-6">
							<label for="input-ciudad">Ciudad:</label>
                            <select name="ciudad" class="form-control" required>
                                <option value=""></option>
                                  <option value="Medellín">Medellín</option>
                                  <option value="Envigado">Envigado</option>
                                  <option value="Itaguí">Itaguí</option>
                                  <option value="Itaguí">Sabaneta</option>
                                  <option value="Bello">Bello</option>
                                  </select>
							</div>
						<div class="col-md-6">
							<label for="input-provincia">Barrio:</label>
							<input type="text" name="barrio" class="form-control" id="" placeholder="Ingrese nombre barrio">
						</div>
					</div>

					<div class="form-group">
						<label for="input-codigo-postal">Teléfono de contacto:</label>
						<input type="number" name="tel" class="form-control" id="input-codigo-postal" placeholder="Ingrese número de contacto">
					</div>

                    <div class="form-group">
						<label for="txtImagen">Seleccione Foto de perfil:</label>
						<input type="file" name="txtImagen" id="txtImagen" class="form-control" placeholder="">
					</div>

                    <div class="form-group row">
                        <div class="col-md-6">
                            <label>Contraseña:</label>
                            <input type="password" class="form-control" id="contrasena" name="contrasena" minlength="8" required>                            
                        </div>
                        <div class="col-md-6">
                            <label for="confirmarContraseña">Confirmar contraseña:</label>
                            <input type="password" class="form-control" id="confirmarContrasena" name="confirmarContrasena" minlength="8" required>                                        
                        </div>
                    </div>     

                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="" required>
                        <label class="form-check-label" for="myCheck">Aceptar términos y condiciones de uso.</label>
                        <div class="valid-feedback">Aceptado.</div>
                        <div class="invalid-feedback">Debes aceptar los términos para continuar.</div>
                    </div>
                    
					<button type="submit" id="botonL" class="">Crear Cuenta</button>
				</form>


	<script>
	function validarContrasena() {
		var contrasena = document.getElementById("contrasena").value;
		var confirmarContrasena = document.getElementById("confirmarContrasena").value;
		if (contrasena != confirmarContrasena) {
			alert("Las contraseñas no coinciden.");
			return false;
		}
		if (contrasena.length < 8) {
			alert("La contraseña debe tener al menos 8 caracteres.");
			return false;
		}
		return true;
	}
	</script>

			</div>
		</div>
	</div>
</body>
</html>


<?php
include("footer.php")
?>