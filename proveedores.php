<?php

include("assets/config/bd.php");

?>

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

      <a class="btn-book-a-table"  href="cerrar.php">Cerrar Sesión</a>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

      <!-- <a class="btn-book-a-table" data-bs-toggle="modal" data-bs-target="#buy-ticket-modal" 
      data-ticket-type="premium-access" href="cerrar.php">Cerrar Sesión</a>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i> -->

    </div>
  </header><!-- End Header -->

<div class="container">
<br/>
<div class="row">

<div class="col-md-5">
</br></br></br></br>
    <div class="card">
        <div class="card-header">
            Datos del Proveedor
        </div>

        <div class="card-body">

        <form method="POST" enctype="multipart/form-data">

            <div class = "form-group">
            <label for="txtID">ID:</label>
            <input type="text" required readonly class="form-control" value="<?php echo $txtID; ?>" name="txtID" id="txtID" placeholder="ID">
            </div>

            <div class = "form-group">
            <label for="txtNombre">Nombre Proveedor:</label>
            <input type="text" required class="form-control" value="<?php echo $txtNombre; ?>" name="txtNombre" id="txtNombre" placeholder="Nombre">
            </div>

            <div class = "form-group">
            <label for="txtTel">Teléfono Proveedor:</label>
            <input type="number" required class="form-control" value="<?php echo $txtTel; ?>" name="txtTel" id="txtTel" placeholder="3100000000">
            </div>

            <div class = "form-group">
            <label for="txtCorreo">Correo:</label>
            <input type="email" required class="form-control" value="<?php echo $txtCorreo; ?>" name="txtCorreo" id="txtPrecio" placeholder="@">
            </div>

            <div class = "form-group">
            <label for="txtDireccion">Dirección:</label>
            <input type="text" required class="form-control" value="<?php echo $txtDireccion; ?>" name="txtDireccion" id="txtDireccion" placeholder="Calle">
            </div>      </br>    

            <div>
                <button type="submit" name="accion" title="Agregar Proveedor" <?php echo ($accion == "Seleccionar")?"disabled":""; ?> value="Agregar" class="btn btn-success"><i class="bi bi-plus-circle"></i></button>
                <button type="submit" name="accion" title="Editar Proveedor" <?php echo ($accion != "Seleccionar")?"disabled":""; ?> value="Modificar" class="btn btn-warning"><i class="bi bi-pen-fill"></i></button>
                <button type="submit" name="accion" title="Cancelar selección" <?php echo ($accion != "Seleccionar")?"disabled":""; ?> value="Cancelar" class="btn btn-info"><i class="bi bi-x-circle"></i></button>
            </div>

        </form>
        </div>   
    </div>          
</div>

<div class="col-md-7">

<table class="table table-bordered">
    <thead>
        <tr></br></br></br></br>
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
            <td><?php echo $producto['id']; ?></td>
            <td><?php echo $producto['nombre']; ?></td>
            <td><?php echo $producto['tel']; ?></td>
            <td><?php echo $producto['correo']; ?></td>
            <td><?php echo $producto['direccion']; ?></td>  

            <td>

            <form method="post">
            <div class="btn-group" role="group" aria-label="">
            <input type="hidden" name="txtID" id="txtID" value="<?php echo $producto['id']; ?>"/>
            <button type="submit" name="accion" title="Seleccionar Proveedor" value="Seleccionar" class="btn btn-outline-success"><i class="bi bi-check2-circle"></i></button>
            <button type="submit" name="accion" title="Eliminar Proveedor" value="Borrar" class="btn btn-secondary"><i class="bi bi-trash3"></i></button>

            </form>    
                 
            </td>          

        </tr>
        <?php } ?>
    </tbody>
</table> 
        </div>   
    </div>
</div>
</br>
<?php
include("footer.php");
?>

