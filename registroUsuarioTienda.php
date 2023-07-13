<?php
session_start();

if($_POST){

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
	$direccionCompleta=$direccion1." ".$direccion2." "."#"." ".$direccion3." ".$direccion4;
    $txtBarrio=(isset($_POST['barrio']))?$_POST['barrio']:"";
    $rol = 3;


    include("assets/config/bd.php");

        //validación si existe en base de datos

        $sentenciaSQL=$conexion->prepare("SELECT * FROM pethouse.usuario where idUsuario=:id;");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $usuario=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

        //si ya esta registrado se ejecuta una alerta
        if ($usuario!="")
        {                
            echo '<script> alert("Usuario ya registrado, intente de nuevo ");window.location.href="pasarela.php"</script>';
        }

        else{

            $sentenciaSQL= $conexion->prepare("INSERT INTO usuario (`idUsuario`, `nombreUsuario`, `apellidoUsuario`, `correoUsuario`,`tipoCalle`,`numeroTipoCalle`, `calleCruce`, `distanciaNumero`,`direccionCompleta`,`barrioUsuario`,`ciudadUsuario`,`rolUsuario` , `telefonoUsuario`) VALUES (:id, :nombre, :apellido, :correo, :direccion1, :direccion2, :direccion3, :direccion4,:direccionCompleta, :barrio, :ciudad, :rol, :tel);");
            $sentenciaSQL->bindParam(':correo',$txtCorreo);
            $sentenciaSQL->bindParam(':id',$txtID);
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':apellido',$txtApellido);
            $sentenciaSQL->bindParam(':tel',$txtTel);  
            $sentenciaSQL->bindParam(':ciudad',$txtCiudad);    
            $sentenciaSQL->bindParam(':direccion1',$direccion1);
			$sentenciaSQL->bindParam(':direccion2',$direccion2);
			$sentenciaSQL->bindParam(':direccion3',$direccion3);
			$sentenciaSQL->bindParam(':direccion4',$direccion4);
			$sentenciaSQL->bindParam(':direccionCompleta',$direccionCompleta);
            $sentenciaSQL->bindParam(':rol',$rol);
            $sentenciaSQL->bindParam(':barrio',$txtBarrio);
            $sentenciaSQL->execute();
             // Verificar los mensajes de error
            var_dump($sentenciaSQL->errorInfo());

        }
    }
?>