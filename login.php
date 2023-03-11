<?php

session_start();

if($_POST){

    $txtCorreo=(isset($_POST['correo']))?$_POST['correo']:"";
    $txtContrasena=(isset($_POST['contrasena']))?md5($_POST['contrasena']):"";

     
    if ($txtCorreo=="" || $txtContrasena==""){   
         
        echo '<script> alert("Debe ingresar datos solicitados, intente de nuevo");window.location.href="http://localhost/PetHouse-main/PetHouse-main/index.php"</script>';                            
    }
     
    else{
  
        include("assets/config/bd.php");
        
        $sentenciaSQL=$conexion->prepare("SELECT * FROM sitio.usuario where correo=:correo and contrasena=:contrasena;");

        $sentenciaSQL->bindParam(':correo',$txtCorreo);
        $sentenciaSQL->bindParam(':contrasena',$txtContrasena);
        $sentenciaSQL->execute();
        $usuario=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        $_SESSION["id"]=$usuario['cedula'];
        
        if ($usuario==null){
            echo '<script> alert("Usuario y/o contraseña errado, intente de nuevo");window.location.href="http://localhost/PetHouse-main/PetHouse-main/index.php"</script>'; 
        }
        
        else{
            $txtCorreo=$usuario['correo'];
            $txtContrasena=$usuario['contrasena'];
            $txtRol=$usuario['rol']; 

        
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