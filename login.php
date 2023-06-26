<?php

session_start();

if($_POST){

    $txtCorreo=(isset($_POST['correo']))?$_POST['correo']:"";
    $txtContrasena=(isset($_POST['contrasena']))?md5($_POST['contrasena']):"";

     
    if ($txtCorreo=="" || $txtContrasena==""){   
         
        echo '<script> alert("Debe ingresar datos solicitados, intente de nuevo");window.location.href="index.php"</script>';                            
    }
     
    else{
  
        include("assets/config/bd.php");
        
        $sentenciaSQL=$conexion->prepare("SELECT * FROM pethouse.usuario where correoUsuario=:correo and claveUsuario=:contrasena;");

        $sentenciaSQL->bindParam(':correo',$txtCorreo);
        $sentenciaSQL->bindParam(':contrasena',$txtContrasena);
        $sentenciaSQL->execute();
        $usuario=$sentenciaSQL->fetch(PDO::FETCH_LAZY);        
        
        if ($usuario==null){
            
            echo '<script> alert("Usuario y/o contraseña errado, intente de nuevo");window.location.href="index.php"</script>'; 
        }
        
        else{
            $txtCorreo=$usuario['correoUsuario'];
            $txtContrasena=$usuario['claveUsuario'];
            $txtRol=$usuario['rolUsuario']; 
            $_SESSION["id"]=$usuario['idUsuario'];
            $_SESSION["rol"]=$usuario['rolUsuario'];
            $_SESSION["nombre"]=$usuario['nombreUsuario'];
        
                if($txtRol == 1){           
                    header("location:admin.php");                    
                }
                    elseif($txtRol != 1){                        
                        header("location:Perfil.php");
                    }
        }
    }
}

?>