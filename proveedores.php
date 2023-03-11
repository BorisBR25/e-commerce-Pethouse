<?PHP
session_start();
  if(!isset($_SESSION['usuario'])){
    // header("Location:../index.php");
  }else{
    if($_SESSION['usuario']=="ok"){
      $nombreUsuario=$_SESSION["nombreUsuario"];
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Administrar Productos</title>
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
<?php  $url="http://".$_SERVER['HTTP_HOST']."/PetHouse" ?>


<?php 

$txtID=(isset($_POST['txtID']))?$_POST['txtID']:"";
$txtNombre=(isset($_POST['txtNombre']))?$_POST['txtNombre']:"";
$txtTel=(isset($_POST['txtTel']))?$_POST['txtTel']:"";
$txtCorreo=(isset($_POST['txtCorreo']))?$_POST['txtCorreo']:"";
$txtDireccion=(isset($_POST['txtDireccion']))?$_POST['txtDireccion']:"";
$accion=(isset($_POST['accion']))?$_POST['accion']:"";

include("assets/config/bd.php");

//INSERT INTO `sitio`.`proveedor` (`nombreProveedor`, `telProveedor`, `correoProveedor`, `DireccionProveedor`) VALUES ('pedigree', '312000000', 'pedigree@', 'cra 30');

switch($accion){

    case "Agregar":
        $sentenciaSQL= $conexion->prepare("INSERT INTO `sitio`.`proveedor` (`id`, `nombre`, `tel`, `correo`, `direccion`) VALUES (null,:nombre,:tel,:correo,:direccion);");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':tel',$txtTel);
        $sentenciaSQL->bindParam(':correo',$txtCorreo);   
        $sentenciaSQL->bindParam(':direccion',$txtDireccion);
        $sentenciaSQL->execute();

        header("Location:proveedor.php");
        break;

    case "Modificar":

        $sentenciaSQL=$conexion->prepare("UPDATE proveedor SET nombre=:nombre, tel=:tel, correo=:correo, direccion=:direccion WHERE id=:id");
        $sentenciaSQL->bindParam(':nombre',$txtNombre);
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->bindParam(':tel',$txtTel);
        $sentenciaSQL->bindParam(':correo',$txtCorreo);   
        $sentenciaSQL->bindParam(':direccion',$txtDireccion);  

        $sentenciaSQL->execute();
        
        //echo "presionado boton modificar";
        header("Location:proveedor.php");
        break;

    case "Cancelar":
        header("Location:proveedor.php");
       // echo "presionado bonton cancelar";
        break;

    case "Seleccionar":

        $sentenciaSQL=$conexion->prepare("SELECT * FROM proveedor WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();
        $producto=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
        
        $txtNombre=$producto['nombre'];
        $txtTel=$producto['tel'];
        $txtCorreo=$producto['correo'];
        $txtDireccion=$producto['direccion'];
        
        //echo "presionado bonton Seleccionar";
    
        break;
        
    case "Borrar":
        
        $sentenciaSQL=$conexion->prepare("DELETE FROM proveedor WHERE id=:id");
        $sentenciaSQL->bindParam(':id',$txtID);
        $sentenciaSQL->execute();

        //echo "presionado bonton Borrar";
        header("Location:proveedor.php");

        break;
    }

$sentenciaSQL=$conexion->prepare("SELECT * FROM proveedor");
$sentenciaSQL->execute();
$listaProductos=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


//print_r($_POST);
//print_r($_FILES);
//print_r($listaLibros);
?>




<!-- ================================================== MODALS ================================================== -->


  <!-- ======= Modal Agregar Proveedor ======= -->
  <div id="add-provider-modal" class="modal fade">
    <div class="modal-dialog" role="document"><!--modal-lg-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <section id="book-a-table" class="book-a-table">
          <div class="row g-0">
            <div class="modal-body">
              <div class="section-header">
                <h2>Administrador</h2>
                <p>Agregar Proveedor<span>.</span></p>
              </div>
              <!-- formulario Agregar -->
              <div class="row justify-content-center">
                <div class="col-md-10">
                  <!-- ================= -->
                  <div class="card-body">
                    
                    <form class="forms-sample"  method="POST" enctype="multipart/form-data">
                    
                      <div class="form-group" hidden>
                        <label for="txtID">ID:</label>
                        <input type="text" class="form-control" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
                      </div>  
                      <div class="form-group">
                        <label for="txtNombre">Nombre Proveedor:</label>
                        <input type="text" class="form-control" required value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
                      </div>
                      <div class="form-group">
                        <label for="txtNombre">Telefono Proveedor:</label>
                        <input type="number" class="form-control" required value="<?php echo $txtTel; ?>" name="txtTel" id="txtTel" placeholder="3120000000">
                      </div>
                      <div class="form-group">
                        <label for="txtPrecio">Correo:</label>
                        <input type="email" class="form-control" value="<?php echo $txtCorreo; ?>" name="txtCorreo" id="txtCorreo" placeholder="correo@ejemplo.com">
                      </div>
                      <div class="form-group">
                        <label for="txtPrecio">Dirección:</label>
                        <input type="text" class="form-control" value="<?php echo $txtDireccion; ?>" name="txtDireccion" id="txtDireccion" placeholder="Calle 00 #00-0">
                      </div>
                      
                      <div class="text-center mt-3 col align-self-center">
                        <button type="submit" value="Agregar" name="accion" <?php echo ($accion == "Seleccionar")?"disabled":""; ?> style="color: aliceblue;">Agregar</button>
                      </div>

                      
                    </form>
                  </div>
                  <!-- ================= -->

                </div>
              </div>
    
            </div>
          </div>
        </section><!-- End Book A Table Section -->
        
      
      
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->


  <!-- ======= Modal Editar Producto ======= -->
  <div id="edit-product-modal" class="modal fade">
    <div class="modal-dialog" role="document"><!--modal-lg-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
          <section id="book-a-table" class="book-a-table">
            <div class="row g-0">
              <div class="modal-body">
                <div class="section-header">
                  <h2>Administrador</h2>
                  <p>Editar Producto<span>.</span></p>
                </div>
                <!-- formulario Editar -->
                <div class="row justify-content-center">
                  <div class="col-md-10">
                    <!-- ================= -->
                    <div class="card-body">
                      
                      <form class="forms-sample"  method="POST" enctype="multipart/form-data">
                      
                        <div class="form-group" hidden>
                          <label for="txtID">ID:</label>
                          <input type="text" class="form-control" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
                        </div>  
                        <div class="form-group">
                          <label for="txtNombre">Nombre Producto:</label>
                          <input type="text" class="form-control" required value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Name">
                        </div>
                        <div class="form-group">
                          <label for="txtProveedor">Nombre Proveedor:</label>
                            <select class="form-control" id="txtProveedor" name="txtProveedor">
                              <option>---</option>
                              <?php
                                include("assets/config/bd.php");
                                $proveedor="SELECT * FROM proveedor";
                                $resultado= mysqli_query($conexionn,$proveedor);
                                while ($valores = mysqli_fetch_array($resultado)){
                                    echo '<option value="'.$valores['nombre'].'">'.$valores['nombre'].'</option>';
                                }                    
                              ?>
                            </select>
                          </div>
                        <div class="form-group">
                        <div class="form-group">
                          <label for="txtPrecio">Precio:</label>
                          <input type="number" class="form-control" value="<?php echo $txtPrecio; ?>" name="txtPrecio" id="txtPrecio" placeholder="$0.00">
                        </div>
                        
                          <div class = "form-group">
                            <label for="txtImagen">Imagen:</label>
                            <br/>

                            <?php
                              if($txtImagen!=""){      
                            ?>
                            <img class="img-thumbnail rounded" src="assets/img/productos/<?php echo $txtImagen; ?>" width="50" alt="" srcset="">

                            <?php 
                              } 
                            ?>

                            <input type="file" class="form-control" name="txtImagen" id="txtImagen" placeholder="Imagen">
                          </div> 
                          <!-- <label>File upload</label>
                          <input type="file" name="img[]" class="file-upload-default">
                          <div class="input-group col-xs-12">
                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                            <span class="input-group-append">
                              <button class="file-upload-browse btn btn-primary" type="button">Upload</button>
                            </span>
                          </div> -->
                        </div>
                        <div class="form-group">
                          <label for="txtDescripcion">Descripcion:</label>
                          <textarea class="form-control" value="<?php echo $txtDescripcion; ?>" name="txtDescripcion" id="txtDescripcion" placeholder="Descripción" rows="4"></textarea>
                        </div>

                        <div class="text-center mt-3 col align-self-center">
                          <button type="submit" value="modificar" name="accion" style="color: aliceblue;">Editar</button>
                        </div>

                        
                      </form>
                    </div>
                    <!-- ================= -->

                  </div>
              </div>
      
            </div>
          </section><!-- End Book A Table Section -->
        </div>
      
        </div>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

<!-- ================================================ END MODALS ================================================ -->

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo.png" alt="">
        <h1>PetHouse<span>.</span></h1>
      </a>

      <nav id="navbar" class="navbar">
        <ul>
        <li><a href="admin.php">Inicio</a></li>
          <li><a href="productos.php">Productos</a></li>
          <li><a href="proveedores.php">Proveedores</a></li>
          <!-- <li><a href="#menu">Productos</a></li> -->
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
          <!-- <li><a href="#contact">Contactenos</a></li> -->
        </ul>
      </nav><!-- .navbar -->

      <a class="btn-book-a-table" data-bs-toggle="modal" data-bs-target="#buy-ticket-modal" 
      data-ticket-type="premium-access" href="cerrar.php">Cerrar Sesión</a>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <br>
    <!-- ========== Tabla Proveedores =========== -->
    <section class="sample-page">
      <div class="container" data-aos="fade-up">
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              
              <div class="d-flex justify-content-between align-items-center">
                <h4 class="card-title">Proveedores</h4>
                <ol>
                  <a class="btn-table-product" data-bs-toggle="modal" data-bs-target="#add-provider-modal" 
                data-ticket-type="premium-access" href=""><i class="bi bi-plus-circle-dotted"></i></a>
                </ol>
              </div><br>
              

              <div class="table-responsive">
                <!-- Barra de progreso -->
                <!-- <div class="progress">
                  <div class="progress-bar bg-success" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div> -->
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nombre Proveedor</th>
                      <th>Teléfono</th>
                      <th>Correo</th>
                      <th>Dirección</th>            
                      <th>Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php  foreach($listaProductos as $producto){   ?>
                      <tr>
                        <td>
                          <?php echo $producto['id']; ?>
                        </td>
                        <td>
                          <?php echo $producto['nombre']; ?>
                        </td>
                        <td>
                          <?php echo $producto['tel']; ?>
                        </td>
                        <td>
                          <?php echo $producto['correo']; ?>
                        </td>
                        <td>
                          <?php echo $producto['direccion']; ?>
                        </td>  
                        <td class="table-icon">



                          <form method="post">
                              <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto['id']; ?>"/>
                              <input type="submit" name="accion" value="Seleccionar" class="btn btn-primary"data-bs-toggle="modal" data-bs-target="#edit-product-modal"/>
                              <a class="edit" data-bs-toggle="modal" data-bs-target="#edit-product-modal"><i class="bi bi-pen"></i></a>
                              <a class="delete"data-bs-toggle="modal" data-bs-target="#edit-product-modal"><i class="bi bi-trash"></i></a>

                          </form> 
                          
                          
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- ===================== -->

  </main><!-- End #main -->

  <!-- <a class="btn-book-a-table" data-bs-toggle="modal" data-bs-target="#edit-product-modal" 
      data-ticket-type="premium-access" href="">Cerrar Sesión</a>
      <button type="submit" value="modificar" name="accion" data-bs-toggle="modal" data-bs-target="#edit-product-modal"
      <?php echo ($accion == "Seleccionar")?"disabled":""; ?> style="color: aliceblue;">Agregar
      </button> -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="container">
      <div class="row gy-3">
        <div class="col-lg-3 col-md-6 d-flex">
          <i class="bi bi-geo-alt icon"></i>
          <div>
            <h4>Dirección</h4>
            <p>
              Calle 104 #69-120<br>
              Medellín - Colombia<br>
            </p>
          </div>

        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-telephone icon"></i>
          <div>
            <h4>Teléfono</h4>
            <p>
              <strong>Teléfono:</strong> +57 314 554 88 55<br>
              <strong>Correo:</strong> contacto@pethouse.com<br>
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links d-flex">
          <i class="bi bi-clock icon"></i>
          <div>
            <h4>Horarios de Atención</h4>
            <p>
              <strong>Lunes-Sabado: 11AM </strong> - 6PM<br>
              Domingos y festivos: Cerrado
            </p>
          </div>
        </div>

        <div class="col-lg-3 col-md-6 footer-links">
          <h4>Siguenos</h4>
          <div class="social-links d-flex">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container">
      <div class="copyright">
        &copy; Copyright <strong><span>Pethouse</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/ -->
        <!-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> -->
      </div>
    </div>

  </footer><!-- End Footer -->
  <!-- End Footer -->

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