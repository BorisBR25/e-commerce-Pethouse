<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Pethouse</title>
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
  
  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">
    <div class="container d-flex align-items-center justify-content-between">

      <a href="indexCliente.php" class="logo d-flex align-items-center me-auto me-lg-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo.png" alt="">
        <h1>PetHouse<span>.</span></h1>
      </a>

      

      <a class="btn-book-a-table" data-bs-toggle="modal" data-bs-target="#buy-ticket-modal" 
      data-ticket-type="premium-access" href="Perfil.php">Regresar</a>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

<?php
        include("assets/config/bd.php");
        session_start();

        $txtIDM=$_GET['idMascota'];
        $sentenciaSQL=$conexion->prepare("SELECT * FROM mascota WHERE idMascota=$txtIDM");
        $sentenciaSQL->execute();
        $datoMascota=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
        foreach($datoMascota as $mascota){  

       

if($_POST){
    $txtNombre=(isset($_POST['nombre']))?$_POST['nombre']:"";
    $txtEspecie=(isset($_POST['especie']))?$_POST['especie']:"";
    $txtRaza=(isset($_POST['raza']))?$_POST['raza']:"";
    $txtColor=(isset($_POST['color']))?$_POST['color']:"";
    $txtSexo=(isset($_POST['sexo']))?$_POST['sexo']:"";
    $txtDescripcion=(isset($_POST['descripcion']))?$_POST['descripcion']:"";
    $txtFoto=(isset($_FILES['foto']['name']))?$_FILES['foto']['name']:"";

    $sentenciaSQL=$conexion->prepare("UPDATE `pethouse`.`mascota` SET nombreMascota=:nombre, especieMascota=:especie, razaMascota=:raza, colorMascota=:color, sexoMascota=:sexo, descripcion=:descripcion WHERE idMascota=$txtIDM");
            $sentenciaSQL->bindParam(':nombre',$txtNombre);
            $sentenciaSQL->bindParam(':especie',$txtEspecie);
            $sentenciaSQL->bindParam(':raza',$txtRaza);
            $sentenciaSQL->bindParam(':color',$txtColor);   
            $sentenciaSQL->bindParam(':sexo',$txtSexo);  
            $sentenciaSQL->bindParam(':descripcion',$txtDescripcion);
            $sentenciaSQL->execute();
        
            if($txtFoto != ""){

                $fecha= new DateTime();
                $nombreArchivo=($txtFoto!=="")?$fecha->getTimestamp()."_".$_FILES["foto"]["name"]:"imagen.jpg";
                $tmpImagen=$_FILES["foto"]["tmp_name"];
    
                move_uploaded_file($tmpImagen,"assets/img/mascotas/".$nombreArchivo);
    
                $sentenciaSQL=$conexion->prepare("SELECT fotoMascota FROM mascota WHERE idMascota=:id");
                $sentenciaSQL->bindParam(':id',$txtIDM);
                $sentenciaSQL->execute();
                $mascota=$sentenciaSQL->fetch(PDO::FETCH_LAZY);
    
                    if(isset($mascota["fotoMascota"]) && ($mascota["fotoMascota"]!="imagen.jpg" )) {
                        if(file_exists("assets/img/mascotas/".$producto["fotoMascota"])){
                            unlink("assets/img/mascotas/".$producto["fotoMascota"]);
    
                        }
                    }
    
                $sentenciaSQL=$conexion->prepare("UPDATE mascota SET fotoMascota=:imagen WHERE idMascota=:id");
                $sentenciaSQL->bindParam(':imagen',$nombreArchivo);
                $sentenciaSQL->bindParam(':id',$txtIDM);
                $sentenciaSQL->execute();
            }
            echo '<script> alert("información actualizada con exito.");window.location.href="Perfil.php"</script>';                  
}

?>

</br></br></br></br>
<div class="container is-fluid mb-6">
    <h2 class="subtitle">Editar Mascota</h2>
</div>

<div class="container">
		<div class="row justify-content-center mt-5">
			<div class="col-md-6">
        <form class="profile-form" method="POST" enctype="multipart/form-data">

        <div class="row mb-3">
            <label for="" class="col-md-4 col-lg-3 col-form-label">Foto</label>
            <div class="col-lg-9"> <!-- imagen de perfil -->
                <img src="assets/img/mascotas/<?php echo $mascota['fotoMascota']; ?>" class="img-fluid testimonial-img" alt="">
            </div>
        </div>

        <div class="row mb-3">
            <label for="nombre" class="col-md-4 col-lg-3 col-form-label">Nombre</label>
            <div class="col-md-8 col-lg-9">
            <input name="nombre" type="text" value="<?php echo $mascota['nombreMascota'];?>" class="form-control" id="nombreM" required>
            </div>
        </div>

            <div class="form-group row mb-3">              
            <label for="" class="col-md-4 col-lg-3 col-form-label">Especie</label>
                <div class="col-md-8 col-lg-9">
                <select name="especie" class="form-control" required>
                <option value="<?php echo $mascota['especieMascota'];?>" ><?php echo $mascota['especieMascota'];?></option>
                <option value="Canino">Canino</option>
                <option value="Felino">Felino</option>
                <option value="Otro">Otro</option>
                </select>
                </div>
            </div>

        <div class="row mb-3">
            <label for="raza" class="col-md-4 col-lg-3 col-form-label">Raza</label>
            <div class="col-md-8 col-lg-9">
            <input name="raza" type="text" class="form-control" id="raza" value="<?php echo $mascota['razaMascota'];?>" required>
            </div>
        </div>

        <div class="row mb-3">
            <label for="color" class="col-md-4 col-lg-3 col-form-label">Color</label>
            <div class="col-md-8 col-lg-9">
            <input name="color" type="text" class="form-control" id="colorM" value="<?php echo $mascota['colorMascota'];?>" required>
            </div>
        </div>

        <div class="form-group row mb-3">              
            <label for="" class="col-md-4 col-lg-3 col-form-label">Sexo</label>
                <div class="col-md-8 col-lg-9">
                <select name="sexo" class="form-control" required> 
                <option value="<?php echo $mascota['sexoMascota'];?>" ><?php echo $mascota['sexoMascota'];?></option>
                <option value="Hembra">Hembra</option>
                <option value="Macho">Macho</option>
                </select>
                </div>
            </div>

        <div class="row mb-3">
            <label for="descripcion" class="col-md-4 col-lg-3 col-form-label">Descripción</label>
            <div class="col-md-8 col-lg-9">
            <input name="descripcion" type="textarea" class="form-control" id="descripcion" value="<?php echo $mascota['descripcion'];?>">
            </div>
        </div>

        <div class="row mb-3">
            <label for="foto" class="col-md-4 col-lg-3 col-form-label">Foto</label>
            <div class="col-md-8 col-lg-9">
            <input name="foto" type="file" class="form-control" id="foto">
            </div>
        </div>


        <div>
            <button type="submit" id="botonL">Guadar Cambios</button>
            <a href="Perfil.php" id="botonL">Cancelar</a>	
        </div>
        </form><!-- End Mascotas -->
        <?php  ?>
    </div> 
    <?php } ?>

    </div><!-- End Bordered Tabs -->
    
</div>
</div>           
</br>


</body>
<?php
include("footer.php");
?>

</body>
</html>