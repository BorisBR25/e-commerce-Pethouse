<?php
session_start();
$ID=$_SESSION['id'];

include("assets/config/bd.php");

$sentenciaSQL=$conexion->prepare("SELECT * FROM usuario WHERE cedula=$ID");
$sentenciaSQL->execute();
$datosUsuario=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

$SQL01=$conexion->prepare("SELECT * FROM mascota WHERE id_usuario=$ID");
$SQL01->execute();
$Mascota=$SQL01->fetchAll(PDO::FETCH_ASSOC);
  // print_r($datosUsuario);
  // $divi=8/0;

$txtID=$datosUsuario[0]['cedula'];
$txtNombre=$datosUsuario[0]['nombre'];
$txtApellido=$datosUsuario[0]['apellido'];
$txtCorreo=$datosUsuario[0]['correo'];
$txtTelefono=$datosUsuario[0]['telefono'];
$txtCiudad=$datosUsuario[0]['ciudad'];
$txtDireccion=$datosUsuario[0]['direccion'];
$txtBarrio=$datosUsuario[0]['barrio'];
$txtImagen=$datosUsuario[0]['imagen'];

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

      <a href="index.php" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo.png" alt="">
        <h1>PetHouse<span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a href="index.php">Inicio</a></li>
          <li><a href="index.php#about">¿Quienes somos?</a></li>
          <li><a href="index.php#menu">Productos</a></li>
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
          
          <li class="dropdown"><a href="#"><span>Menú</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="#">Historial compras</a></li>
              <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li>
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
                            <div class="col-lg-3 col-md-4 label">Ciudad:</div>
                            <div class="col-lg-9 col-md-8"><?php echo $txtCiudad; ?></div>
                          </div>
        
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Barrio:</div>
                            <div class="col-lg-9 col-md-8"><?php echo $txtBarrio; ?></div>
                          </div>
        
                          <div class="row">
                            <div class="col-lg-3 col-md-4 label">Dirección:</div>
                            <div class="col-lg-9 col-md-8"><?php echo $txtDireccion; ?></div>
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

                        <!-- Editar perfil -->
                        
                        <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                        
                          <!-- Profile Edit Form -->
                          <?php  foreach($datosUsuario as $usuario){   ?>
                          <form class="profile-form" enctype="multipart/form-data">

                            <div class="row mb-3">
                              <label for="foto" class="col-md-4 col-lg-3 col-form-label">Imagen de Perfil</label>
                              <div class="col-md-8 col-lg-9">
                                <img src="assets/img/perfiles/<?php echo $usuario['imagen']; ?>" alt="Profile">
                                <div class="pt-2">
                                  <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image"><i class="bi bi-upload"></i></a>
                                  <a href="#" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                                </div>
                              </div>
                            </div>                           

                            <div class="row mb-3">
                              <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Documento:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="idE" type="text" readonly class="form-control" id="fullName" value="<?php echo $usuario['cedula']; ?>">
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Nombre:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="nombreE" type="text" class="form-control" id="fullName" value="<?php echo $usuario['nombre']; ?>">
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Apellido:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="nombreE" type="text" class="form-control" id="fullName" value="<?php echo $usuario['apellido']; ?>">
                              </div>
                            </div>
        
                            <!-- <div class="row mb-3">
                              <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                              <div class="col-md-8 col-lg-9">
                                <textarea name="about" class="form-control" id="about" style="height: 100px">Sunt est soluta temporibus accusantium neque nam maiores cumque temporibus. Tempora libero non est unde veniam est qui dolor. Ut sunt iure rerum quae quisquam autem eveniet perspiciatis odit. Fuga sequi sed ea saepe at unde.</textarea>
                              </div>
                            </div> -->
        
                            <div class="row mb-3">
                              <label for="Job" class="col-md-4 col-lg-3 col-form-label">Ciudad:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="job" type="text" class="form-control" id="Job" value="<?php echo $usuario['ciudad']; ?>">
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="Country" class="col-md-4 col-lg-3 col-form-label">Barrio:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="country" type="text" class="form-control" id="Country" value="<?php echo $usuario['barrio']; ?>">
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="Address" class="col-md-4 col-lg-3 col-form-label">Dirección:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="address" type="text" class="form-control" id="Address" value="<?php echo $usuario['direccion']; ?>">
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Teléfono:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="phone" type="text" class="form-control" id="Phone" value="<?php echo $usuario['telefono']; ?>">
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="Email" class="col-md-4 col-lg-3 col-form-label">Correo:</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="email" type="email" readonly class="form-control" id="Email" value="<?php echo $usuario['correo']; ?>">
                              </div>
                            </div>      
                                    
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
        
                        <!-- Cambiar contraseña -->
                        <div class="tab-pane fade pt-3" id="profile-change-password">
                          <!-- Change Password Form -->
                          <form class="profile-form">
        
                            <div class="row mb-3">
                              <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="password" type="password" class="form-control" id="currentPassword">
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="newpassword" type="password" class="form-control" id="newPassword">
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                              </div>
                            </div>
        
                            <div class="text-center">
                              <button type="submit" class="btn btn-primary">Change Password</button>
                            </div>
                          </form><!-- End Change Password Form -->
                          </div>

                            <!-- insert mascosta -->
                      <?php
                        if($_POST){

                        $txtFoto=(isset($_FILES['foto']['name']))?$_FILES['foto']['name']:"";
                        $txtIDM=(isset($_POST['idM']))?$_POST['idM']:"";
                        $txtNombreM=(isset($_POST['nombreM']))?$_POST['nombreM']:"";
                        $txtRaza=(isset($_POST['raza']))?$_POST['raza']:"";
                        $txtColor=(isset($_POST['colorM']))?$_POST['colorM']:"";
                        $txtSexo=(isset($_POST['sexoM']))?$_POST['sexoM']:"";
                        $txtDescripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
                                                
                        include("assets/config/bd.php");

                            //validación si existe en base de datos

                            $sentenciaSQL=$conexion->prepare("SELECT * FROM sitio.mascota where id=$txtIDM and id_usuario=$ID;");
                            $sentenciaSQL->execute();
                            $mascotaR=$sentenciaSQL->fetch(PDO::FETCH_LAZY);

                            //si ya esta registrado se ejecuta una alerta
                            if ($mascotaR!="")
                            {                
                                echo '<script> alert("Macota ya registrada ");window.location.href="http://localhost/PetHouse-main/PetHouse-main/Perfil.php#"</script>';
                            }

                            else{

                                $sentenciaSQL= $conexion->prepare("INSERT INTO `sitio`.`mascota` (`nombre`, `raza`, `sexo`, `color`, `descripcion`,`foto`, `id_usuario`) VALUES (:nombre, :raza, :sexo, :color, :descripcion, :foto, $ID);");
                                $sentenciaSQL->bindParam(':nombre',$txtNombreM);
                                $sentenciaSQL->bindParam(':raza',$txtRaza);  
                                $sentenciaSQL->bindParam(':sexo',$txtSexo);    
                                $sentenciaSQL->bindParam(':color',$txtColor);
                                $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
             
                                $fecha= new DateTime();
                                $nombreFoto=($txtFoto!=="")?$fecha->getTimestamp()."_".$_FILES["foto"]["name"]:"imagen.jpg";
                                $tmpImagen=$_FILES["foto"]["tmp_name"];

                                if($tmpImagen!=""){
                                    move_uploaded_file($tmpImagen,"assets/img/mascotas/".$nombreFoto);
                                }

                                $sentenciaSQL->bindParam(':foto',$nombreFoto);
                                $sentenciaSQL->execute();
                               
                                //header("Location:Perfil.php");
                            }
                        }

                      ?>

                        <!-- gestion mascotas -->
                        <div class="tab-pane fade pt-3" id="profile-mascotas">
                          
                          <form class="profile-form" method="POST" enctype="multipart/form-data">
        
                            <div class="row mb-3">
                              <label for="nombreM" class="col-md-4 col-lg-3 col-form-label">Nombre</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="nombreM" type="text" class="form-control" id="nombreM">
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="idM" class="col-md-4 col-lg-3 col-form-label">N° Documento</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="idM" type="text" class="form-control" id="idM">
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="raza" class="col-md-4 col-lg-3 col-form-label">Raza</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="raza" type="text" class="form-control" id="raza">
                              </div>
                            </div>
        
                            <div class="row mb-3">
                              <label for="colorM" class="col-md-4 col-lg-3 col-form-label">Color</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="colorM" type="text" class="form-control" id="colorM">
                              </div>
                            </div>

                            <div class="row mb-3">
                              <label for="sexoM" class="col-md-4 col-lg-3 col-form-label">Sexo</label>
                              <div class="col-md-8 col-lg-9">
                                <input name="sexoM" type="text" class="form-control" id="sexoM">
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
              <div class="member-img">
                <img src="assets/img/mascotas/<?php echo $pets['foto']; ?>" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi-hand-thumbs-up-fill"></i></a>
                  <a href=""><i class="bi-heart-fill"></i></a>
                  <a href=""><i class="bi-trash-fill"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4><?php echo $pets['nombre'];?></h4>
                <p>Color: <?php echo $pets['color'];?></p>
                <span><?php echo $pets['sexo'];?></span>
                <span><?php echo $pets['raza'];?></span>                
                <p><?php echo $pets['descripcion'];?></p>
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
