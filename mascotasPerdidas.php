<?php

  include("assets/config/bd.php");
  

  $idMascota = $_GET['idMascota'];

  $sentenciaSQL=$conexion->prepare("SELECT * FROM mascota WHERE idMascota=$idMascota");
  $sentenciaSQL->execute();
  $datosUsuario=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


  $txtNombre=$datosUsuario[0]['nombreMascota'];
  $txtFoto=$datosUsuario[0]['fotoMascota'];


 
  
  
  if ($_POST) {
    
    $txtIDMascota=(isset($_POST['txtIDMascota']))?$_POST['txtIDMascota']:"";
    $txtDescripcionPerdida=(isset($_POST['txtDescripcionPerdida']))?$_POST['txtDescripcionPerdida']:"";

    $txtFechaHoraPerdida=(isset($_POST['fechaHoraPerdida']))?$_POST['fechaHoraPerdida']:"";
    $txtFechaHoraPerdidaMySQL = date('Y-m-d H:i:s', strtotime($txtFechaHoraPerdida));

    $txtLatitud=(isset($_POST['txtLatitud']))?$_POST['txtLatitud']:"";
    $txtLongitud=(isset($_POST['txtLongitud']))?$_POST['txtLongitud']:"";

    // Prepara la consulta
    $sentenciaSQL = mysqli_prepare($conexionn, "INSERT INTO sitio.mascotaPerdida (idMascota, descripcionPerdida, fechaHoraPerdida, latitud, longitud, estado) VALUES (?, ?, ?, ?, ?, 1);");

    // Vincula las variables a la consulta
    mysqli_stmt_bind_param($sentenciaSQL, "issdd", $txtIDMascota, $txtDescripcionPerdida, $txtFechaHoraPerdidaMySQL, $txtLatitud, $txtLongitud);

    

    // Ejecuta la consulta
    if (mysqli_stmt_execute($sentenciaSQL)) {
      // La consulta se ejecutó correctamente
      

      // Verifica si se afectó alguna fila
      if (mysqli_stmt_affected_rows($sentenciaSQL) > 0) {
          echo "La consulta se ejecutó correctamente y se afectó al menos una fila.";
          header("Location:mapa.php");
          
      } else {
          echo "La consulta se ejecutó correctamente, pero no se afectó ninguna fila.";
          
      }
    } else {
      // La consulta no se ejecutó correctamente
      
      echo "Error al ejecutar la consulta: " . mysqli_stmt_error($sentenciaSQL);
    }

    // Cierra la sentencia preparada
    mysqli_stmt_close($sentenciaSQL);
  }

  
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Crear Alerta</title>
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
  <!-- CSS Extra - Boris -->
  <link rel="stylesheet" href="assets/css/carritoCSS.css">

  <!-- MAPA -->
  <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />

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
          <li><a href="mapa.php#mascotasPerdidas">Mascotas Perdidas</a></li>
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


      <!-- =========== ICONO CARRITO =========== -->      

      <div class="car-container"> 
        <button id="carritoCompras" class="btn-carrito" data-bs-toggle="modal" data-bs-target="#staticBackdrop">                  
          <div class="container" style="padding: 0px">
            <div class="row">
              <div class="col-6">                  
                <i class="bi bi-cart2"></i>                  
              </div>
              <div class="col-3" style="padding: 0px">
                <span class="counter-products">0</span>
              </div>
            </div>
          </div> 
        </button> 
      </div>

      <!-- =========== FIN ICONO CARRITO =========== -->

      <a class="btn-book-a-table" data-bs-toggle="modal" data-bs-target="#buy-ticket-modal" 
      data-ticket-type="premium-access" href="">Iniciar Sesión</a>
      <i class="mobile-nav-toggle mobile-nav-show bi bi-list"></i>
      <i class="mobile-nav-toggle mobile-nav-hide d-none bi bi-x"></i>

    </div>
  </header><!-- End Header -->

  <main id="main">
    <!-- ======= MODAL CARRITO ======= -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tu Carrito</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div   class="modal-body">
            <!-----CART CONTENT-->
            <div class="cart-content">
              <!--CART PRODUCTS GO HERE-->
              

            </div>
            
            
            <div class="total">
              <div class="total-title">Total<span class="total-price">$0</span></div>
              
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-second" data-bs-dismiss="modal">Seguir comprando</button>
            <button type="button" class="btn btn-primary buybutton">Pagar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- ======= FIN MODAL CARRITO ======= -->

    <!-- ======= Modal login ======= -->
    <div id="buy-ticket-modal" class="modal fade">
      <div class="modal-dialog" role="document"><!--modal-lg-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          
              <section id="book-a-table" class="book-a-table">
                <div class="row g-0">
                  <div class="modal-body">
                    <div class="section-header">
                      <h2>PetHouse</h2>
                      <p>Inicio de Sesión<span>.</span></p>
                    </div>
                    
                    <!-- formulario login -->
                    <div class="row justify-content-center">        
                      <div class="col-md-8">
                        <form method="POST" action="login.php" class="">
                          <div class="form-group">
                            <input type="email" class="form-control" name="correo" placeholder="Correo">
                          </div>
                          <div class="form-group mt-3">
                            <input type="password" class="form-control" name="contrasena" placeholder="Contraseña">
                          </div>
            
                          <!-- Lista desplegable -->
                          <!-- <div class="form-group mt-3">
                            <select id="ticket-type" name="ticket-type" class="form-select">
                              <option value="">-- Select Your Ticket Type --</option>
                              <option value="standard-access">Standard Access</option>
                              <option value="pro-access">Pro Access</option>
                              <option value="premium-access">Premium Access</option>
                            </select>
                          </div> -->                        


                          <div class="text-center mt-3 col align-self-center">
                              <button id="botonL" type="submit" style="color: aliceblue;">Iniciar Sesión</button>
                          </div>
                        </form>
                      </div>
                      <div class="row"></br></div>
                        <div class="row">
                            <div class="col s4"></div>
                            <div class="col s2"><p id="enlaceregistro"><a href="registro.php">Registrarse</a></p></div>
                            <div class="col s2"><p id="enlaceolvidocontraseña"><a href="recuperar.php">¿Olvidó su contraseña?</a></p></div>
                            <div class="col s4"></div>
                             
                        </div>                 
                  </div>          
                </div>
              </section><!-- End Book A Table Section -->
            </div>
        
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    

    <!-- ----------------------------------- CONTENIDO ----------------------------------->
    <br>

    <!-------------------------------------------------------------------------------------------------->


    <!-------------------------------------- MAPA ----------------------------------->
    <!-- ======= ¿Quienes somos? ======= -->
    <section id="" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Ubicación</h2>
          <p>Selecciona el ultimo lugar <span>donde viste tu mascota</span></p>
        </div>

        <div class="row gy-4">
          <div class="col-lg-7 position-relative " data-aos="fade-up" data-aos-delay="150">
            
            <div id="map" style="width: 100%; height: 500px;"></div>

          </div>
          <div class="col-lg-5 align-items-end" data-aos="fade-up" data-aos-delay="300">
            <div class="content ps-12 ps-lg-12">
              
              <section id="book-a-table" class="book-a-table" style="padding: 20px 0px 20px 0px">
                <div class="row g-0">
                  <div class="modal-body">
                    <div class="section-header">
                      <h2>Algunos datos necesarios</h2>
                      <p><?php echo $txtNombre ?><span>.</span></p>
                    </div>
                    <!-- formulario Agregar -->
                    <div class="row justify-content-center">
                      <div class="col-md-10">
                        <!-- ==========enctype="multipart/form-data"======= -->
                        <div class="card-body">
                          
                          <form class="forms-sample" method="POST" enctype="multipart/form-data">
                          
                            <div class="form-group text-center">
                              <img src="assets/img/mascotas/<?php echo $txtFoto ?>" class="img-fluid rounded" alt="" style="width: 200px; height: 200px;">
                            </div> 
                            <div class="form-group">
                              <div class="form-group">
                                <label for="txtFechaHoraPerdida">Fecha y hora de ultimo avistamiento:</label>
                                <input type="datetime-local" class="form-control" value="" name="txtFechaHoraPerdida" id="txtFechaHoraPerdida" placeholder="$0.00">
                              </div>
                            </div>

                            

                            <div class="form-group">
                              <label for="txtDescripcionPerdida">Descripcion:</label>
                              <textarea class="form-control" value="" name="txtDescripcionPerdida" id="txtDescripcionPerdida" placeholder="Descripción" rows="4"></textarea>
                            </div>

                            <input type="text" class="form-control" required value="<?php echo $idMascota ?>" name="txtIDMascota" id="txtIDMascota" placeholder="idMascota" hidden>
                            <input type="text" class="form-control" required value="" name="txtLatitud" id="txtLatitud" placeholder="latitud" hidden>
                            <input type="text" class="form-control" required value="" name="txtLongitud" id="txtLongitud" placeholder="longitud" hidden>
                            
                            <!-- <div class="my-3">
                              <div class="loading">Cargando</div>
                              <div class="error-message"></div>
                              <div class="sent-message">Tu alerta ha sido creada. Gracias!</div>
                            </div> -->
                            <div class="text-center">
                              <button type="submit" value="Agregar" name="accion">Agregar</button>
                            </div>
                          </form>
                          
                        <!-- ================= -->
                      </div>
                  </div>
          
                </div>
              </section><!-- End Book A Table Section -->

            </div>
          </div>
        </div>

      </div>
    </section><!-- End ¿Quienes somos? -->

    <!------------------------------------------------------------------------------->

  </main><!-- End #main -->

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




  <!-- ============= MAPA ============= -->
  <script>


  
    /*=== Objeto mapa ===*/
    const map = L.map('map').
    setView([6.244338, -75.573553], /* Coordenadas iniciales */
    13);/* Zoom inicial */
    
    /*=== Dibujar mapa ===*/
    const tiles = L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
    }).addTo(map);
    
    L.control.scale().addTo(map);




  
    /*
    const circle = L.circle([6.244338, -75.573553], {
      color: 'red',
      fillColor: '#f03',
      fillOpacity: 0.5,
      radius: 500
    }).addTo(map).bindPopup('I am a circle.');
    */
    const test = L.marker([6.244338, -75.573553],/*{draggable:'true'}*/).addTo(map)
      .bindPopup('<b>Ultima ubicacion</b><br />ultimo lugar donde viste tu mascota');

    const popup = L.popup()
      .setLatLng([6.244338, -75.573553])
      .setContent('I am a standalone popup.');

    function asignar(cord) {
      cord = cord.slice(7,-1); 
      const coordenadas = cord.split(', ');
      const lat = coordenadas[0];
      const lng = coordenadas[1];
      // LatLng(6.251, -75.55409)
      //document.getElementById('txtCoordenadas').value = coordenadas;
      document.getElementById('txtLatitud').value = lat;
      document.getElementById('txtLongitud').value = lng;
    }

    function onMapClick(e) {

      asignar(e.latlng.toString());

      /*popup
        .setLatLng(e.latlng)
        .setContent(`You clicked the map at ${e.latlng.toString()}`)
        .openOn(map);*/
      
      test
        .setLatLng(e.latlng)
        .addTo(map)
        .setPopupContent(`Viste a tu mascota en ${e.latlng.toString()} ?`)
        .openPopup();
    }

    map.on('click', onMapClick);
  </script>

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



<!-- 
  Crear una tabla "mascotas perdidas" 
  Atributos:
    Coordenadas
    descripcion
    fechaHoraPerdida
    IDMascota

  crear formulario (CRUD) para la gestion de mascotas perdidas
  capturando valores del mapa (e.latlng)

  crear marcadores con informacion de la base de datos (foreach)

  Diseñar popup para las mascotas perdidas.




  CARD PARA MOSTRAR EN EL MAPA
  
  <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up" data-aos-delay="100">
            <div class="chef-member">
              <div class="member-img">
                <img src="assets/img/chefs/chefs-1.jpg" class="img-fluid" alt="">
                <div class="social">
                  <a href=""><i class="bi bi-twitter"></i></a>
                  <a href=""><i class="bi bi-facebook"></i></a>
                  <a href=""><i class="bi bi-instagram"></i></a>
                  <a href=""><i class="bi bi-linkedin"></i></a>
                </div>
              </div>
              <div class="member-info">
                <h4>Walter White</h4>
                <span>Master Chef</span>
                <p>Velit aut quia fugit et et. Dolorum ea voluptate vel tempore tenetur ipsa quae aut. Ipsum exercitationem iure minima enim corporis et voluptate.</p>
              </div>
            </div>
          </div>










-->