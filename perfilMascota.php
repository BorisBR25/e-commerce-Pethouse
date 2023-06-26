<?php
  include("assets/config/bd.php");
    

  $idMascota = $_GET['idMascota'];

  $sentenciaSQL=$conexion->prepare("SELECT * FROM mascota WHERE idMascota=$idMascota");
  $sentenciaSQL->execute();
  $datosMascota=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);


  $txtNombre=$datosMascota[0]['nombreMascota'];
  $txtFoto=$datosMascota[0]['fotoMascota'];
  $txtDescripcion=$datosMascota[0]['descripcion'];
  $txtRaza=$datosMascota[0]['razaMascota'];
  $txtSexo=$datosMascota[0]['sexoMascota'];
  $txtColor=$datosMascota[0]['colorMascota'];

  ##========================================================================================================

  $sentenciaSQL=$conexion->prepare("SELECT * FROM mascotaPerdida WHERE idMascota=$idMascota");
  $sentenciaSQL->execute();
  $datosAlerta=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

  $Estado=$datosAlerta[0]['estado'];
  $txtCreacion=$datosAlerta[0]['fechaCreacion'];

    

  if ($Estado == 1) {
    $colorEstado = "circleGreen";
    $txtEstado = "Activo";
  }
  if ($Estado == 0) {
    $colorEstado = "circleRed";
    $txtEstado = "Inactivo";
  }

  ##========================================================================================================
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Perfil Mascota</title>
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
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
  <!-- CSS Extra - Boris -->
  <link rel="stylesheet" href="assets/css/carritoCSS.css">
  <!-- CSS Extra - perfil -->
  <link rel="stylesheet" href="assets/css/perfil.css">

  <!-- MAPA -->
  <script src="https://unpkg.com/leaflet@1.0.2/dist/leaflet.js"></script>
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.0.2/dist/leaflet.css" />

  <!-- FONT-AWESOME -->
  <script src="https://kit.fontawesome.com/ea8f7f2b96.js" crossorigin="anonymous"></script>

  <!-- QRCODEJS -->
  <script src="assets/js/qrcodejs/qrcode.min.js"></script>

  <!-- =======================================================
  * Template Name: Yummy - v1.1.0
  * Template URL: https://bootstrapmade.com/yummy-bootstrap-restaurant-website-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
 
</head>

<body>

  <?php
    include("assets/config/bd.php");

    // Traer coordenadas
    $sentenciaSQL=$conexion->prepare("SELECT * FROM mascota INNER JOIN mascotaPerdida ON mascota.idMascota=mascotaPerdida.idMascota WHERE mascota.idMascota=$idMascota;");
    $sentenciaSQL->execute();
    $mascotaPerdida=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);
    
  ?>
  

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

    <!-- ======= MODAL QR ======= -->
    <div class="modal fade" id="modalQR" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="staticBackdropLabel">Tu QR</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">

            <div class="container-fluid">
              <div class="row">
                <div class="col-6 col-md-2"></div>
                <div class="col-6 col-md-8">
                  <div id="qrcode" class="text-center"></div>
                </div>
                <div class="col-6 col-md-2"></div>
              </div>
            </div>
            
            
            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-success" data-bs-dismiss="modal">Cerrar</button>
          </div>
        </div>
      </div>
    </div>
    <!-- ======= FIN MODAL QR ======= -->

    <br><br><br><br>

    <!------------------------------------------------------------------------------->
    <div class="container">
      <div class="main-body">
          <div class="row gutters-sm">
            <div class="col-md-4 mb-3">
              <!-- perfil -->
              <div class="card">
                <div class="card-body">
                  <div class="d-flex flex-column align-items-center text-center">
                    <img src="assets/img/mascotas/<?php echo $txtFoto ?>" alt="Admin" class="rounded-circle" width="150">
                    <div class="mt-3">
                      <h4><?php echo $txtNombre ?></h4>
                      <p class="text-secondary mb-1"><?php echo $txtDescripcion?></p><br>
                      <button id="QR" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modalQR">Generar QR</button>
                      <button class="btn btn-outline-success" hidden>Contactar Dueño</button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- end perfil -->

              <!-- datos -->
              <div class="card mt-3">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Raza</h6>
                    <span class="text-secondary"><?php echo $txtRaza ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Sexo</h6>
                    <span class="text-secondary"><?php echo $txtSexo ?></span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Edad</h6>
                    <span class="text-secondary">41 años</span>
                  </li>
                  <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                    <h6 class="mb-0">Color</h6>
                    <span class="text-secondary"><?php echo $txtColor ?></span>
                  </li>
                </ul>
              </div>
              <!--  end datos -->
            </div>
            <div class="col-md-8">
              <!-- alertas -->
              <div class="card mb-3">
                <div class="card-body">

                  <div class="row text-right">
                    <div class="col-sm-3" style="padding-top: 3%;">
                      <h6 class="mb-0">Estado alerta</h6>
                    </div>
                    <div class="col-sm-1 text-secondary" style="padding-top: 2.5%;">
                      <div class="<?php echo $colorEstado?>"></div>
                      <p><?php echo $txtEstado?></p>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <p style="text-align: right; padding-top: 2%;">Desde: <?php echo !empty($txtCreacion) ? $txtCreacion : '-----'; ?></p>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <p style="text-align: right; padding-top: 2%;">Hasta: <?php echo !empty($txtCreacion) ? '03/06/2023 19:29:56' : '-----'; ?></p>
                    </div>
                    <div class="col-sm-2 text-secondary" style="text-align: center; padding-top: 1%;">
                      <button class="btn btn-success" hidden>Ampliar</button>
                    </div>
                  </div>
                  
                </div>
              </div>
              <!-- end alertas -->

              <!-- mapa -->
              <div class="card mb-3">
                <div class="card-body">
                  <div id="map" style="width: 100%; height: 500px;"></div>
                </div>
              </div>
              <!-- end mapa -->

            </div>
          </div>
        </div>
    </div>

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
            <a href="https://twitter.com/" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="https://www.facebook.com/" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="https://chat.whatsapp.com/C0qN5amMTxfH2lOPtm8ivG" class="whatsapp"><i class="bi bi-whatsapp"></i></a>
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

  <!-- ============= QR ============= -->
  <script type="text/javascript">
    var qrcode = new QRCode(document.getElementById("qrcode"), {
      text: window.location.href,
      width: 290,
      height: 290,
      colorDark : "#000000",
      colorLight : "#ffffff",
      correctLevel : QRCode.CorrectLevel.H
    });
  </script>
  <!-- ============= END QR ============= -->


  <!-- ============= MAPA ============= -->
  <script>


    const marcadoresPHP = [
      <?php foreach($mascotaPerdida as $mascota){  ?>
        [ 
          '<?php echo $mascota['nombreMascota'] ?>', //--------------- 0
          <?php echo $mascota['latitud'] ?>, //---------------- 1
          <?php echo $mascota['longitud'] ?>, //--------------- 2
          '<?php echo $mascota['fotoMascota'] ?>',//------------------ 3
          '<?php echo $mascota['descripcionPerdida'] ?>',//---- 4
          '<?php echo $mascota['descripcionPerdida'] ?>',// --- 5
          <?php echo $mascota['idMascota'] ?>// --------------- 6
        ],
      <?php } ?>
    ];



    // Multiple Markers
    const coordMarcadores = [
      ['principe', 6.244338, -75.573553],
      ['luzbel', 6.25029, -75.55384]
    ];

    const infoWindowContent = [
      ['<div class="info_content">' +
      '<h3>Principe</h3>' +
      '<p>Lorem Ipsum  Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>' +'</div>'],
      ['<div class="info_content">' +
      '<h3>Luzbel</h3>' +
      '<p>Lorem Ipsum  Lorem Ipsum Lorem Ipsum Lorem Ipsum Lorem Ipsum</p>' +'</div>']
    ];

    
  
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

    let myIcon = L.icon({
      iconUrl: 'assets/img/logo.png',
      iconSize: [30, 30],
      iconAnchor: [15, 0],
      popupAnchor: [0, 0],
      //shadowUrl: 'assets\img\logo.png',
      //shadowSize: [68, 95],
      //shadowAnchor: [22, 94]
    });



    for ( let i = 0, longitudMarcadores = marcadoresPHP.length; i < longitudMarcadores; i++) {

      let latlng = L.latLng([marcadoresPHP[i][1], marcadoresPHP[i][2]]);
    
      const marker = L.marker(latlng,{icon: myIcon}/*,{draggable:'true'}*/)
        .addTo(map)
        .bindPopup(`
          <div class="card text-center" style="width: 18rem;">
            <img class="card-img-top" src="assets/img/mascotas/${marcadoresPHP[i][3]}" alt="Card image cap">
            <div class="card-body">
              <h5 class="card-title">${marcadoresPHP[i][0]}</h5>
              <p class="card-text" style="margin-bottom: 0px;">${marcadoresPHP[i][4]}</p>
              <p class="card-text" style="margin-top: 0px;">${marcadoresPHP[i][5]}</p>
              <a href="perfilMascota.php?idMascota=${marcadoresPHP[i][6]}"><button class="btn btn-success">¿Me has visto?</button></a>
              
            </div>
          </div>
        `);

    } 

  

    /*
    const circle = L.circle([6.244338, -75.573553], {
      color: 'red',
      fillColor: '#f03',
      fillOpacity: 0.5,
      radius: 500
    }).addTo(map).bindPopup('I am a circle.');
    


    function asignar(cord) {
      cord = cord.slice(7,-1); 
      const coordenadas = cord.split(', ');
      const lat = coordenadas[0];
      const lng = coordenadas[1];
      // LatLng(6.251, -75.55409)
      document.getElementById('txtCoordenadas').value = coordenadas;
    }
    */


  
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


  <!-- Scripts Carrito -->
  <script src="assets/js/productos.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>

  

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