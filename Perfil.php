<?php
session_start();

$ID=$_SESSION['id'];

include("assets/config/bd.php");

$sentenciaSQL=$conexion->prepare("SELECT * FROM usuario WHERE idUsuario=$ID");
$sentenciaSQL->execute();
$datosUsuario=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$SQL01=$conexion->prepare("SELECT * FROM mascota WHERE idUsuario=$ID");
$SQL01->execute();
$Mascota=$SQL01->fetchAll(PDO::FETCH_ASSOC);

$txtID=$datosUsuario[0]['idUsuario'];
$txtNombre=$datosUsuario[0]['nombreUsuario'];
$txtApellido=$datosUsuario[0]['apellidoUsuario'];
$txtCorreo=$datosUsuario[0]['correoUsuario'];
$txtTelefono=$datosUsuario[0]['telefonoUsuario'];
$txtCiudad=$datosUsuario[0]['ciudadUsuario'];
$txtDireccion=$datosUsuario[0]['direccionCompleta'];
$txtBarrio=$datosUsuario[0]['barrioUsuario']; 
$txtImagen=$datosUsuario[0]['fotoUsuario'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Mi perfil</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  
  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,600;1,700&family=Amatic+SC:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Inter:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
 
  <!-- =======================================================
  * Template Name: Yummy - v1.1.0
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="indexCliente.php" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo.png" alt="">
        <h1>PetHouse<span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="indexCliente.php">Inicio</a></li>
          <li><a href="mapa.php#mascotasPerdidas">Mascotas Perdidas</a></li>
          <li><a href="indexCliente.php#about">¿Quienes somos?</a></li>
          <li><a href="indexCliente.php#menu">Productos</a></li>
          <!-- <li><a href="#events">Events</a></li> -->
          <!-- <li><a href="#chefs">Chefs</a></li> -->
          <!-- <li><a href="#gallery">Gallery</a></li> -->
          <!-- <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="#">Drop Down 1</a></li>
              <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li>
            </ul>
          </li> -->
          <li><a href="index.php#contact">Contactenos</a></li>
        </ul>
      </nav><!-- .navbar -->

      <nav id="navbar" class="navbar">
        <ul>
          
          <li class="dropdown"><a><span><i style="font-size:40px;"  class="bi bi-person-fill"></i><i class="bi bi-chevron-down dropdown-indicator"></span></i></a>
            <ul>
              <li><a href="#">Historial compras</a></li>
              <li><a href="cerrar.php">Cerrar Sesión</a></li>
            </ul>
          </li>
        </ul>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->

<!-- ======= Perfil Usuario ======= -->
<section id="testimonials" class="testimonials section-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-header">
      <!-- <h2>Testimonials</h2>
      <p>What Are They <span>Saying About Us</span></p> -->
    </div>

    <div class="swiper-slide">
      <div class="testimonial-item">
        <div class="row gy-4 justify-content-center">
          
          <div class="col-lg-12">
            <!-- ======================= -->
            <div class="section profile">
              <div class="row">
                <div class="col-xl-4">
        
                  <div class="col-lg-9"> <!-- imagen de perfil -->
                    <img src="assets/img/perfiles/<?php echo $txtImagen; ?>" class="img-fluid testimonial-img" alt="">
                  </div>
        
                </div>
        
                <div class="col-xl-8">
        
                  <div class="card">
                    <div class="card-body pt-3">
                      <!-- Menu -->
                      <ul class="nav nav-tabs nav-tabs-bordered">
        
                        <li class="nav-item">
                          <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Datos Generales</button>
                        </li>
        
                        <li class="nav-item">
                          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Editar Perfil</button>
                        </li>
        
                        <!-- <li class="nav-item">
                          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Configuración</button>
                        </li> -->
        
                        <li class="nav-item">
                          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Cambiar Contraseña</button>
                        </li>

                        <li class="nav-item">
                          <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-mascotas">Registrar Mascota</button>
                        </li>
        
                      </ul>
                      <div class="tab-content pt-2">
        
                        <div class="tab-pane fade show active profile-overview" id="profile-overview">
                          
                          <!-- <h5 class="card-title">Datos Generales</h5> --><br>
        
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label ">Nombre completo:</div>
                            <div class="col-lg-9 col-md-8"><?php echo $txtNombre." ".$txtApellido; ?> </div>
                          </div>
        
                          <!-- <div class="row">
                            <div class="col-lg-3 col-md-4 label">Company</div>
                            <div class="col-lg-9 col-md-8">Lueilwitz, Wisoky and Leuschke</div>
                          </div> -->
        
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Dirección:</div>
                            <div class="col-lg-9 col-md-8"><?php echo $txtDireccion; ?></div>
                          </div>
        
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Barrio:</div>
                            <div class="col-lg-9 col-md-8"><?php echo $txtBarrio; ?></div>
                          </div>

                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Ciudad:</div>
                            <div class="col-lg-9 col-md-8"><?php echo $txtCiudad; ?></div>
                          </div>
        

        
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Teléfono:</div>
                            <div class="col-lg-9 col-md-8"><?php echo $txtTelefono; ?></div>
                          </div>
        
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Correo:</div>
                            <div class="col-lg-9 col-md-8"><?php echo $txtCorreo; ?></div>
                          </div>
        
                        </div>

                        <!-- Profile Edit code -->

                        <?php
                        
                        if(($_POST) && ($_POST['bandera'] == 1)){

                          //$txtImagenE=(isset($_FILES['archivo']['name']))?$_FILES['archivo']['name']:"";
                          $txtNombreE=(isset($_POST['nombreE']))?$_POST['nombreE']:"";
                          $txtApellidoE=(isset($_POST['apellidoE']))?$_POST['apellidoE']:"";
                          $txtTelE=(isset($_POST['telE']))?$_POST['telE']:"";   
                          $txtCiudadE=(isset($_POST['ciudadE']))?$_POST['ciudadE']:"";
                          $txtDireccionE=(isset($_POST['direccionE']))?$_POST['direccionE']:"";
                          $txtBarrioE=(isset($_POST['barrioE']))?$_POST['barrioE']:"";
                          $accion=(isset($_POST['accion']))?$_POST['accion']:"";

                          include("assets/config/bd.php");
                          
                                  $instruccionSQL= $conexion->prepare("UPDATE `pethouse`.`usuario` SET `nombreUsuario` =:nombre, `apellidoUsuario`=:apellido, `telefonoUsuario`=:tel, `ciudadUsuario`=:ciudad, `direccionCompleta`=:direccion,`barrioUsuario`=:barrio WHERE (`idUsuario` = $ID);");
                                  $instruccionSQL->bindParam(':nombre',$txtNombreE);
                                  $instruccionSQL->bindParam(':apellido',$txtApellidoE);
                                  $instruccionSQL->bindParam(':tel',$txtTelE);  
                                  $instruccionSQL->bindParam(':ciudad',$txtCiudadE);    
                                  $instruccionSQL->bindParam(':direccion',$txtDireccionE);
                                  $instruccionSQL->bindParam(':barrio',$txtBarrioE);

                                  // $fecha= new DateTime();
                                  // $nombreArchivo=($txtImagenE!=="")?$fecha->getTimestamp()."_".$_FILES["archivo"]["name"]:"imagen.jpg";

                                  // $tmpImagen=$_FILES["archivo"]["tmp_name"];

                                  // if($tmpImagen!=""){
                                  //     move_uploaded_file($tmpImagen,"assets/img/perfiles/".$nombreArchivo);
                                  // }

                                  // $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
                                  
                                  $instruccionSQL->execute();
                                                                             
                                  echo '<script> alert("Cambios registrados con exito ");window.location.href="Perfil.php"</script>';
                                // header("Location:Perfil.php");

                                if ($accion=="Eliminar"){

                                  $instrucSQL= $conexion->prepare("UPDATE `pethouse`.`usuario` SET `fotoUsuario` = 'imagen.jpg' WHERE (`idUsuario` = $ID)");
                                  $instrucSQL->execute();
                                  echo '<script> alert("Foto eliminada con exito ");window.location.href="Perfil.php"</script>';
                                }
                        }  
                        ?>

                        <!-- Editar perfil formulario-->
                        
                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                        
                          <!-- Profile Edit Form -->
                            
                          <?php  foreach($datosUsuario as $usuario){   ?>

                          <form method="POST" class="profile-form" enctype="multipart/form-data">

                            <div class="row mb-3">
                              <label for="txtImagenE" class="col-md-4 col-lg-3 col-form-label">Imagen de Perfil</label>
                              <div class="col-md-8 col-lg-9">
                                <img src="assets/img/perfiles/<?php echo $usuario['fotoUsuario'];?>" alt="Profile">
                                
                                <!-- <script>
                                  function seleccionarArchivo() {
                                      // Crear un elemento de entrada de archivo invisible
                                      var input = document.createElement('input');
                                      input.type = 'file';
                                      input.style.display = 'none';
                                      // Añadir el elemento al documento
                                      document.body.appendChild(input);
                                      // Activar el selector de archivo
                                      input.click();
                                      // Escuchar el evento de cambio del selector de archivo
                                      input.onchange = function() {
                                          // Obtener el archivo seleccionado
                                          var archivo = input.files[0];
                                          // Enviar el archivo al servidor
                                          // Aquí deberías enviar el archivo al servidor usando AJAX o un formulario
                                        };
                                  }
                                  </script> -->
                                <div class="pt-2"> 

                                <!-- <button type="file" name="accion" value="editar" title="Editar foto" class="btn btn-outline-light text-dark"><span><i class="bi bi-pencil-square"></i></span></button> 
                                <button type="submit-file" name="accion" value="eliminar" title="Eliminar foto" class="btn btn-outline-light text-dark"><span><i class="bi-trash"></i></span></button>  -->

                                  <a type="file" name="accion" value="Editar" class="btn btn-primary btn-sm" title="Subir nueva imagen de perfil" onclick="seleccionarArchivo()"><i class="bi bi-upload"></i></a>
                                  <a  name="accion" value="Eliminar" class="btn btn-danger btn-sm" title="Eliminar imagen de perfil"><i class="bi bi-trash"></i></a> 

                                </div> 
                              </div>
                            </div>   
                           
                            <div class="row mb-3">
                              <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Documento:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="idE" type="text" readonly class="form-control" id="fullName" value="<?php echo $usuario['idUsuario']; ?>">
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nombre:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="nombreE" type="text" class="form-control" id="fullName" value="<?php echo $usuario['nombreUsuario']; ?>">
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Apellidos:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="apellidoE" type="text" class="form-control" id="fullName" value="<?php echo $usuario['apellidoUsuario']; ?>">
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="Address" class="col-md-4 col-lg-3 col-form-label">Dirección:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="direccionE" type="text" class="form-control" id="Address" value="<?php echo $usuario['tipoCalle']." ".$usuario['numeroTipoCalle']." # ".$usuario['calleCruce']." - ".$usuario['distanciaNumero']; ?>">
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="Country" class="col-md-4 col-lg-3 col-form-label">Barrio:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="barrioE" type="text" class="form-control" id="Country" value="<?php echo $usuario['barrioUsuario']; ?>">
                              </div>
                            </div>
                                    
                            <div class="form-group row mb-3">						
                            <label for="input-ciudad" class="col-md-4 col-lg-3 col-form-label">Ciudad:</label>
                            <div class="col-md-8 col-lg-9">
                            <select name="ciudadE" class="form-control" required>
                                <option value="<?php echo $usuario['ciudadUsuario']; ?>"><?php echo $usuario['ciudadUsuario']; ?></option>
                                  <option value="Medellín">Medellín</option>
                                  <option value="Envigado">Envigado</option>
                                  <option value="Itaguí">Itaguí</option>
                                  <option value="Itaguí">Sabaneta</option>
                                  <option value="Bello">Bello</option>
                                  </select>
                                  </div>
							                </div>
                    
        
                            <div class="row mb-3">
                              <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Teléfono:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="telE" type="number" class="form-control" id="Phone" value="<?php  echo $usuario['telefonoUsuario']; ?>">
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="Email" class="col-md-4 col-lg-3 col-form-label">Correo:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="correoE" type="email" readonly class="form-control" id="Email" value="<?php echo $usuario['correoUsuario']; ?>">
                              </div>
                            </div>      
                            <input type="hidden" name="bandera" value="1">     
                            <div class="text-center">
                              <button type="submit" >Guardar Cambios</button>
                            </div>
                          </form><!-- End Profile Edit Form -->
                          <?php } ?>
                        </div>
        
                       <!--  Configuracion  -->
                        <div class="tab-pane fade pt-3" id="profile-settings">
        
                          <!-- Settings Form -->
                          <!-- <form class="profile-form">
        
                            <div class="row mb-3">
                              <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                              <div class="col-md-8 col-lg-9">
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="changesMade" checked>
                                  <label class="form-check-label" for="changesMade">
                                    Changes made to your account
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="newProducts" checked>
                                  <label class="form-check-label" for="newProducts">
                                    Information on new products and services
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="proOffers">
                                  <label class="form-check-label" for="proOffers">
                                    Marketing and promo offers
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                                  <label class="form-check-label" for="securityNotify">
                                    Security alerts
                                  </label>
                                </div>
                              </div>
                            </div>
        
                            <div class="text-center">
                              <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                          </form>End settings Form -->
        
                        </div>

                        <!-- Cambiar contraseña código php -->
                        <?php
 
                          if(($_POST) && ($_POST['bandera'] == 2)){

                              $txtContrasena1=(isset($_POST['claveC']))?md5($_POST['claveC']):"";
                              $txtContrasena=(isset($_POST['contrasenaC']))?md5($_POST['contrasenaC']):"";
                                
                              include("assets/config/bd.php");
                                  

                                  $consultaSQL=$conexion->prepare("SELECT * FROM pethouse.usuario where idUsuario=$ID;");
                                  $consultaSQL->execute();
                                  $usuarioC=$consultaSQL->fetch(PDO::FETCH_LAZY);
                                  $contrasenaC=$usuarioC['claveUsuario'];
                  
                                  if ($txtContrasena1==$contrasenaC)
                                  {      
                                    $consultaSQL=$conexion->prepare("UPDATE usuario SET claveUsuario=:contrasenia where idUsuario=$ID;");
                                    $consultaSQL->bindParam(':contrasenia',$txtContrasena);
                                    $consultaSQL->execute();
                                    $usuario=$consultaSQL->fetch(PDO::FETCH_LAZY);

                                      echo '<script> alert("Cambio de contraseña exitoso");window.location.href="Perfil.php"</script>';
                                  }
                                  else{
                                    echo '<script> alert("Contraseña incorrecta, intentelo de nuevo");window.location.href="Perfil.php"</script>';
                                  }
                          }
                        ?>
        
                        <!-- Cambiar contraseña -->
                        <div class="tab-pane fade pt-3" id="profile-change-password">
                          <!-- Change Password Form -->
                          <form method="post" onsubmit="return validarContrasena()" class="profile-form">
        
                            <div class="row mb-3">
                              <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Contraseña Actual</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="claveC" type="password" class="form-control" id="">
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">Nueva Contraseña</label>
                              <div class="col-md-8 col-lg-9">
                                <input type="password" class="form-control" id="contrasenaC" name="contrasenaC" minlength="8" required>                               
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Confirmar Contraseña</label>
                              <div class="col-md-8 col-lg-9">
                                <input type="password" class="form-control" id="confirmarContrasenaC" name="confirmarContrasenaC" minlength="8" required>
                              </div>
                            </div>
                            <input type="hidden" name="bandera" value="2">
                            <div class="text-center">
                              <button type="submit" class="btn btn-primary">Cambiar</button>
                            </div>
                          </form><!-- End Change Password Form -->
                          </div>
                          <script>
                          function validarContrasena() {
                            var contrasena = document.getElementById("contrasenaC").value;
                            var confirmarContrasena = document.getElementById("confirmarContrasenaC").value;
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

                            <!-- insertar mascota -->
                      <?php
                        if(($_POST) && ($_POST['bandera'] == 3)){

                        $txtFoto=(isset($_FILES['foto']['name']))?$_FILES['foto']['name']:"";
                        $txtIDM=(isset($_POST['idM']))?$_POST['idM']:"null";
                        $txtNombreM=(isset($_POST['nombreM']))?$_POST['nombreM']:"";
                        $txtRaza=(isset($_POST['raza']))?$_POST['raza']:"";
                        $txtColor=(isset($_POST['colorM']))?$_POST['colorM']:"";
                        $txtSexo=(isset($_POST['sexoM']))?$_POST['sexoM']:"";
                        $txtDescripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
                        $txtEspecie=(isset($_POST['especie']))?$_POST['especie']:"";
                
                        include("assets/config/bd.php");

                            //validación si existe en base de datos

                            $sentenciaSQL=$conexion->prepare("SELECT * FROM pethouse.mascota where idMascota='$txtIDM' and idUsuario=$ID;");
                            $sentenciaSQL->execute();
                            $mascotaR=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

                            //si ya esta registrado se ejecuta una alerta
                            if ($mascotaR!="")
                            {                
                                echo '<script> alert("Mascota ya registrada ");window.location.href="Perfil.php"</script>';
                            }

                            else{

                                $sentenciaSQL= $conexion->prepare("INSERT INTO `pethouse`.`mascota` (`nombreMascota`, `especieMascota`,`razaMascota`, `colorMascota`,`sexoMascota`,`descripcion`,`fotoMascota`, `idUsuario`) VALUES (:nombre, :especie, :raza, :color, :sexo, :descripcion, :foto, $ID);");
                                $sentenciaSQL->bindParam(':nombre',$txtNombreM);
                                $sentenciaSQL->bindParam(':raza',$txtRaza);  
                                $sentenciaSQL->bindParam(':sexo',$txtSexo);    
                                $sentenciaSQL->bindParam(':color',$txtColor);
                                $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
                                $sentenciaSQL->bindParam(':especie',$txtEspecie);
             
                                $fecha= new DateTime();
                                $nombreFoto=($txtFoto!=="")?$fecha->getTimestamp()."_".$_FILES["foto"]["name"]:"imagen.jpg";
                                $tmpImagen=$_FILES["foto"]["tmp_name"];

                                if($tmpImagen!=""){
                                    move_uploaded_file($tmpImagen,"assets/img/mascotas/".$nombreFoto);
                                }

                                $sentenciaSQL->bindParam(':foto',$nombreFoto);
                                $sentenciaSQL->execute();
                               
                                //header("Location:Perfil.php");
                                echo '<script> alert("Mascota registrada con exito ");window.location.href="Perfil.php"</script>';
                            }
                        }                    
                      ?>

                        <!-- Registro de mascotas -->
                        <div class="tab-pane fade pt-3" id="profile-mascotas">
                          
                          <form class="profile-form" method="POST" enctype="multipart/form-data">
        
                            <div class="row mb-3">
                              <label for="nombreM" class="col-md-4 col-lg-3 col-form-label">Nombre</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="nombreM" type="text" class="form-control" id="nombreM" required>
                              </div>
                            </div>

                              <div class="form-group row mb-3">              
                                <label for="" class="col-md-4 col-lg-3 col-form-label">Especie</label>
                                  <div class="col-md-8 col-lg-9">
                                  <select name="especie" class="form-control" required>
                                    <option value="" ></option>
                                    <option value="Canino">Canino</option>
                                    <option value="Felino">Felino</option>
                                    <option value="Otro">Otro</option>
                                  </select>
                                  </div>
                             </div>
        
                            <div class="row mb-3">
                              <label for="raza" class="col-md-4 col-lg-3 col-form-label">Raza</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="raza" type="text" class="form-control" id="raza" required>
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="colorM" class="col-md-4 col-lg-3 col-form-label">Color</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="colorM" type="text" class="form-control" id="colorM" required>
                              </div>
                            </div>

                            <div class="form-group row mb-3">              
                                <label for="" class="col-md-4 col-lg-3 col-form-label">Sexo</label>
                                  <div class="col-md-8 col-lg-9">
                                  <select name="sexoM" class="form-control" required> 
                                    <option value="" ></option>
                                    <option value="Hembra">Hembra</option>
                                    <option value="Macho">Macho</option>
                                  </select>
                                  </div>
                             </div>

                            <div class="row mb-3">
                              <label for="descripcion" class="col-md-4 col-lg-3 col-form-label">Descripción</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="descripcion" type="textarea" class="form-control" id="descripcion">
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="foto" class="col-md-4 col-lg-3 col-form-label">Foto</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="foto" type="file" class="form-control" id="foto">
                              </div>
                            </div>
                            
                            <div class="row mb-3">
                              <label for="idM" class="col-md-4 col-lg-3 col-form-label"></label>
                              <div class="col-md-8 col-lg-9">
                                <input name="idM" type="hidden" class="form-control" id="idM">
                              </div>
                            </div>

                            <input type="hidden" name="bandera" value="3">
                            <div class="text-center">
                              <button type="submit" class="btn btn-primary">Registrar</button>
                            </div>
                          </form><!-- End Mascotas -->
                        </div>  
                      </div><!-- End Bordered Tabs -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <!-- ======================= -->
          </div>
        </div>
      </div>
    </div><!-- End testimonial item -->
      </div>
      <div class="swiper-pagination"></div>
    </div>
  </div>
</section><!-- End Perfil Usuario -->

  <main id="main">

<!-- Codigo php para eliminar y editar mascota -->

        <?php
        if(($_POST) && ($_POST['bandera'] == 4)){

          $txtidM=(isset($_POST['idM']))?($_POST['idM']):"";
          $accion=(isset($_POST['accion']))?($_POST['accion']):"";

          switch($accion){

            case "geolocalizar":

              echo '<script> alert("se selecciono reportar como perdida, se encuentra en desarrollo coming soon!!");window.location.href="mascotasPerdidas.php"</script>';
              break;

            case "eliminar":
              
              $sentenciaSQL=$conexion->prepare("SELECT fotoMascota FROM mascota WHERE idMascota=:id");
              $sentenciaSQL->bindParam(':id',$txtidM);
              $sentenciaSQL->execute();
              $mascota=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
      
              if(isset($mascota["fotoMascota"]) && ($mascota["fotoMascota"]!="imagen.jpg" )) {
                  if(file_exists("assets/img/mascotas/".$mascota["fotoMascota"])){
                      unlink("assets/img/mascotas/".$mascota["fotoMascota"]);
      
                  }
              }
              
              $sentenciaSQL=$conexion->prepare("DELETE FROM mascota WHERE idMascota=:id");
              $sentenciaSQL->bindParam(':id',$txtidM);
              $sentenciaSQL->execute();
              //header('Location:Perfil.php');
              echo '<script> alert("Macota eliminada con exito ");window.location.href="Perfil.php"</script>';
                
            }
          
        }

        ?>
    <!-- ======= Mascotas Registradas ======= -->
    <section id="chefs" class="chefs section-bg">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Mascotas</h2>
          <p>Tus <span>Mascotas</span> Registradas</p>
        </div>
        
        <div class="row gy-4">
        <?php foreach($Mascota as $pets){?>
          <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="chef-member">
              <a href="perfilMascota.php?idMascota=<?php echo $pets['id']; ?>">
                <div class="member-img">
                  
                  <img src="assets/img/mascotas/<?php echo $pets['fotoMascota']; ?>" class="img-fluid" alt="" width="300 px" height="auto">
          
                  <div class="social btn-group-vertical"> 

                  <form method="POST">
                    <div>
                      <a href="mascotasPerdidas.php?idMascota=<?php echo $pets['idMascota']; ?>" title="Reportar como perdida" class="btn btn-outline-light text-dark"><span><i class="bi-geo-alt-fill"></i></span></a>
                      <!-- <button type="submit" name="accion" value="geolocalizar" title="Reportar como perdida" class="btn btn-outline-light text-dark"><span><i class="bi-geo-alt-fill"></i></span></button>  -->
                    </div>  
                    <div>
                      <a href="editarMascota.php?idMascota=<?php echo $pets['idMascota']; ?>" title="Editar mascota" class="btn btn-outline-light text-dark"><span><i class="bi bi-pencil-square"></i></span></a>
                    </div>
                    <div>
                      <button type="submit" name="accion" value="eliminar" title="Eliminar mascota" class="btn btn-outline-light text-dark"><span><i class="bi-trash"></i></span></button> 
                    </div>

                    <input type="hidden" name="bandera" value="4"/>
                    <input type="hidden" name="idMascota" value="<?php echo $pets['idMascota'];?>"/>
                  </form>

                    <!-- <form action="editarMascota.php" method="GET">
                    <input type="hidden" name="idMascota" value="">  
                    <button type="submit" name="" value="" title="Editar mascota" class="btn btn-outline-light text-dark"><span><i class="bi bi-pencil-square"></i></span></button>
                    </form> 

                    <button type="submit" name="accion" value="geolocalizar" title="Reportar como perdida" class="btn btn-outline-light text-dark"><span><i class="bi-geo-alt-fill"></i></span></button> 

                    <button type="submit" name="accion" value="eliminar" title="Eliminar mascota" class="btn btn-outline-light text-dark"><span><i class="bi-trash"></i></span></button> 
                    
                    <input type="hidden" name="bandera" value="4">     -->

                      <!-- <a href="#"><i class="bi bi-pencil-square"></i></a>
                      <a href="#"><i class="bi-trash-fill"></i></a> -->

                  </div>
                </div>
              </a>
              <div class="member-info">                
                <input type="hidden" name="idM" value="<?php echo $pets['idMascota'];?>">
                <h4><?php echo $pets['nombreMascota'];?></h4>
                <span><?php echo $pets['especieMascota'];?></span>
                <span>Raza: <?php echo $pets['razaMascota'];?></span>
                <span><?php echo $pets['sexoMascota'];?></span>
                <span>Color: <?php echo $pets['colorMascota'];?></span>             
                <p>Descripción:</p>
                <span> <?php echo $pets['descripcion'];?></span>
              </div>
        
            </div>            
          </div><!-- End Chefs Member -->
          <?php }  ?>
        </div>        
      </div>    
    </section><!-- End Mascotas Registradas -->

  </main><!-- End #main -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>
<?php
include("footer.php");
?>
