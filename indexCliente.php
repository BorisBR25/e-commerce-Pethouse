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

<body>
<?php
include("assets/config/bd.php");

// Collares
$sentenciaSQL=$conexion->prepare("SELECT * FROM productos WHERE categoria = 'collares' ");
$sentenciaSQL->execute();
$listaCollares=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

// Juguetes
$sentenciaSQL=$conexion->prepare("SELECT * FROM productos WHERE categoria = 'juguetes' ");
$sentenciaSQL->execute();
$listaJuguetes=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

// Comida
$sentenciaSQL=$conexion->prepare("SELECT * FROM productos WHERE categoria = 'comida' ");
$sentenciaSQL->execute();
$listaComida=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);

// Accesorios
$sentenciaSQL=$conexion->prepare("SELECT * FROM productos WHERE categoria = 'accesorios' ");
$sentenciaSQL->execute();
$listaAccesorios=$sentenciaSQL->fetchAll(PDO::FETCH_ASSOC);



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
          <li><a href="#hero">Inicio</a></li>
          <li><a href="#about">¿Quienes somos?</a></li>
          <li><a href="#menu">Productos</a></li>
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
          <li><a href="#contact">Contactenos</a></li>
        </ul>
      </nav><!-- .navbar -->
      <nav id="navbar" class="navbar">
        <ul>
          
          <li class="dropdown"><a><span>Perfil</span> <i class="bi bi-chevron-down dropdown-indicator"></i></a>
            <ul>
              <li><a href="Perfil.php">Ver Perfil</a></li>
              <li><a href="cerrar.php">Cerrar Sesión</a></li>
            </ul>
          </li>
        </ul>
      </nav>

    </div>
  </header><!-- End Header -->

  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
      <div class="row justify-content-between gy-5">
        <div class="col-lg-5 order-2 order-lg-1 d-flex flex-column justify-content-center align-items-center align-items-lg-start text-center text-lg-start">
          <h2 data-aos="fade-up">Con Nuestros Collares</h2>
          <p data-aos="fade-up" data-aos-delay="100">Tu amigo de cuatro patas estará seguro y lucirá increíble donde quiera que vaya, con nuestro collar diseñado para cualquier ocasión formal o casual.</p>
          <div class="d-flex" data-aos="fade-up" data-aos-delay="200">
            <a href="#menu" class="btn-book-a-table">Obtener ahora</a>
            <!-- <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a> -->
          </div>
        </div>
        <div class="col-lg-5 order-1 order-lg-2 text-center text-lg-start">
          <img src="assets/img/perro1.png" class="img-fluid" alt="" data-aos="zoom-out" data-aos-delay="300">
        </div>
      </div>
    </div>
  </section><!-- End Hero Section -->

  <main id="main">


    <!-- End Book A Table Section -->
            </div>
        
          </div>
        </div><!-- /.modal-content -->
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <!-- ======= ¿Por qué elegirnos? ======= -->
    <section id="why-us" class="why-us section-bg">
      <div class="container" data-aos="fade-up">

        <div class="row gy-4">

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
            <div class="why-box">
              <h3>¿Por qué elegir PetHouse?</h3>
              <p>
                Mediante nuestro aplicativo intentamos ofrecerte las herramientas necesarias para facilitar y centralizar
                la informacion sobre las mascotas perdidas, y crear un canal mediante el cual las personas puedan compartir 
                informacion que lleve al reencuentro de las mascotas con sus dueños.
                
              </p>
              <div class="text-center">
                <a href="#about" class="more-btn">Conocer más <i class="bx bx-chevron-right"></i></a>
              </div>
            </div>
          </div><!-- End Why Box -->

          <div class="col-lg-8 d-flex align-items-center">
            <div class="row gy-4">

              <div class="col-xl-4" data-aos="fade-up" data-aos-delay="200">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                  <i class="bi bi-geo-alt"></i>
                  <h4>Geoposicionamiento</h4>
                  <p>Podrás reportar en nuestro sitio web la fecha, hora y cualquier atributo extra que facilite
                    identificar a tu mascota.</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-xl-4" data-aos="fade-up" data-aos-delay="300">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                  <i class="bi bi-qr-code-scan"></i>
                  <h4>Collares QR</h4>
                  <p>Al escanear el el QR, te llevará a una pagina donde encontrarás la información de contacto del 
                    dueño de la mascota.</p>
                </div>
              </div><!-- End Icon Box -->

              <div class="col-xl-4" data-aos="fade-up" data-aos-delay="400">
                <div class="icon-box d-flex flex-column justify-content-center align-items-center">
                  <i class="bi bi-eye-slash-fill"></i>
                  <h4>Control de tus datos</h4>
                  <p>Tu tendrás el control de que datos quieres que sean visibles para 
                    que las personas con informacion de tu mascota puedan contactarse contigo.</p>
                </div>
              </div><!-- End Icon Box -->

            </div>
          </div>

        </div>

      </div>
    </section><!-- End ¿Por qué elegirnos? -->

    <!-- ======= Menu ======= -->
    <section id="menu" class="menu">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Nuestros Productos</h2>
          <p>Mira lo que tenemos disponible <span>Para Ti</span></p>
        </div>

        <ul class="nav nav-tabs d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">

          <li class="nav-item">
            <a class="nav-link active show" data-bs-toggle="tab" data-bs-target="#collares">
              <h4>Collares</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#juguetes">
              <h4>Juguetes</h4>
            </a><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#comida">
              <h4>Comida</h4>
            </a>
          </li><!-- End tab nav item -->

          <li class="nav-item">
            <a class="nav-link" data-bs-toggle="tab" data-bs-target="#accesorios">
              <h4>Accesorios</h4>
            </a>
          </li><!-- End tab nav item -->

        </ul>

        <div class="tab-content" data-aos="fade-up" data-aos-delay="300">

        
          <div class="tab-pane fade active show" id="collares">
            <?php foreach($listaCollares as $producto){  ?>
              <div class="tab-header text-center">
                <p>Productos</p>
                <h3>Collares</h3>
              </div>

              <div class="row gy-5">

                <div class="col-lg-4 menu-item">
                  <a href="assets/img/productos/<?php echo $producto['imagen'] ?>" class="glightbox"><img src="assets/img/productos/<?php echo $producto['imagen'] ?>" class="menu-img img-fluid" alt=""></a>
                  <h4><?php echo $producto['nombre'] ?></h4>
                  <p class="ingredients">
                  <?php echo $producto['descripcion'] ?>
                  </p>
                  <p class="price">
                    $ <?php echo $producto['precio'] ?>
                  </p>
                </div><!-- Menu Item -->

                

              </div>
            <?php } ?>
          </div><!-- End collares Menu Content -->
        

        
          <div class="tab-pane fade" id="juguetes">
          <?php foreach($listaJuguetes as $producto){  ?>
            <div class="tab-header text-center">
              <p>Productos</p>
              <h3>Juguetes</h3>
            </div>

            <div class="row gy-5">

              <div class="col-lg-4 menu-item">
                <a href="assets/img/productos/<?php echo $producto['imagen'] ?>" class="glightbox"><img src="assets/img/productos/<?php echo $producto['imagen'] ?>" class="menu-img img-fluid" alt=""></a>
                <h4><?php echo $producto['nombre'] ?></h4>
                <p class="ingredients">
                <?php echo $producto['descripcion'] ?>
                </p>
                <p class="price">
                  $ <?php echo $producto['precio'] ?>
                </p>
              </div><!-- Menu Item -->

              

            </div>
        <?php } ?>
          </div><!-- End Juguetes Menu Content -->

        
          <div class="tab-pane fade" id="comida">
          <?php foreach($listaComida as $producto){  ?>
            <div class="tab-header text-center">
              <p>Productos</p>
              <h3>Comida</h3>
            </div>

            <div class="row gy-5">

              <div class="col-lg-4 menu-item">
                <a href="assets/img/productos/<?php echo $producto['imagen'] ?>" class="glightbox"><img src="assets/img/productos/<?php echo $producto['imagen'] ?>" class="menu-img img-fluid" alt=""></a>
                <h4><?php echo $producto['nombre'] ?></h4>
                <p class="ingredients">
                <?php echo $producto['descripcion'] ?>
                </p>
                <p class="price">
                  $ <?php echo $producto['precio'] ?>
                </p>
              </div><!-- Menu Item -->

              

            </div>
        <?php } ?>
          </div><!-- End collares Menu Content -->

        
          <div class="tab-pane fade" id="accesorios">
          <?php foreach($listaAccesorios as $producto){  ?>
            <div class="tab-header text-center">
              <p>Productos</p>
              <h3>Accesorios</h3>
            </div>

            <div class="row gy-5">

              <div class="col-lg-4 menu-item">
                <a href="assets/img/productos/<?php echo $producto['imagen'] ?>" class="glightbox"><img src="assets/img/productos/<?php echo $producto['imagen'] ?>" class="menu-img img-fluid" alt=""></a>
                <h4><?php echo $producto['nombre'] ?></h4>
                <p class="ingredients">
                <?php echo $producto['descripcion'] ?>
                </p>
                <p class="price">
                  $ <?php echo $producto['precio'] ?>
                </p>
              </div><!-- Menu Item -->

              

            </div>
        <?php } ?>
          </div><!-- End collares Menu Content -->

        </div>

      </div>
    </section><!-- End Menu -->

    <!-- ======= Stats Counter Section ======= -->
    <section id="stats-counter" class="stats-counter">
      <div class="container" data-aos="zoom-out">

        <div class="row gy-4">

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="232" data-purecounter-duration="1" class="purecounter"></span>
              <p>Clients</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="521" data-purecounter-duration="1" class="purecounter"></span>
              <p>Projects</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="1453" data-purecounter-duration="1" class="purecounter"></span>
              <p>Hours Of Support</p>
            </div>
          </div><!-- End Stats Item -->

          <div class="col-lg-3 col-md-6">
            <div class="stats-item text-center w-100 h-100">
              <span data-purecounter-start="0" data-purecounter-end="32" data-purecounter-duration="1" class="purecounter"></span>
              <p>Workers</p>
            </div>
          </div><!-- End Stats Item -->

        </div>

      </div>
    </section><!-- End Stats Counter Section -->

    <!-- ======= ¿Quienes somos? ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>¿Quienes somos?</h2>
          <p>Conoce más <span>sobre nosotros</span></p>
        </div>

        <div class="row gy-4">
          <div class="col-lg-7 position-relative about-img" style="background-image: url(assets/img/ejemplo.jpg) ;" data-aos="fade-up" data-aos-delay="150">
            <div class="call-us position-absolute">
              <h4>Escribenos!</h4>
              <p>+1 5589 55488 55</p>
            </div>
          </div>
          <div class="col-lg-5 d-flex align-items-end" data-aos="fade-up" data-aos-delay="300">
            <div class="content ps-0 ps-lg-5">
              <p class="fst-italic">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore
                magna aliqua.
              </p>
              <ul>
                <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat.</li>
                <li><i class="bi bi-check2-all"></i> Duis aute irure dolor in reprehenderit in voluptate velit.</li>
                <li><i class="bi bi-check2-all"></i> Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</li>
              </ul>
              <p>
                Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate
                velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident
              </p>

              <div class="position-relative mt-4">
                <img src="assets/img/pet-collar-QR.jpg" class="img-fluid" alt="">
                <a href="https://www.youtube.com/watch?v=LXb3EKWsInQ" class="glightbox play-btn"></a>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section><!-- End ¿Quienes somos? -->

    <!-- ======= Contactenos ======= -->
    <section id="contact" class="contact">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Contactenos</h2>
          <p>Necesitas Ayuda? <span>Contactenos</span></p>
        </div>

        <div class="mb-3">
          <iframe style="border:0; width: 100%; height: 350px;" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15862.865980973724!2d-75.5686654!3d6.3009336!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x8e442f25d6670d4d%3A0x8043999e5e767b96!2sSENA%20-%20Centro%20de%20Tecnolog%C3%ADa%20de%20la%20Manufactura%20Avanzada!5e0!3m2!1ses-419!2sco!4v1676245186106!5m2!1ses-419!2sco" frameborder="0" allowfullscreen></iframe>
        </div><!-- End Google Maps -->

        <div class="row gy-4">

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-map flex-shrink-0"></i>
              <div>
                <h3>Dirección</h3>
                <p>Calle 104 #69-120 Medellín-Colombia</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item d-flex align-items-center">
              <i class="icon bi bi-envelope flex-shrink-0"></i>
              <div>
                <h3>Correo</h3>
                <p>contacto@pethouse.com</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-telephone flex-shrink-0"></i>
              <div>
                <h3>Telefono</h3>
                <p>+57 314 554 88 55</p>
              </div>
            </div>
          </div><!-- End Info Item -->

          <div class="col-md-6">
            <div class="info-item  d-flex align-items-center">
              <i class="icon bi bi-share flex-shrink-0"></i>
              <div>
                <h3>Horarios</h3>
                <div><strong>Lunes-Sabado:</strong> 11AM - 6PM;
                  <strong>Domingos y festivos:</strong> Cerrado
                </div>
              </div>
            </div>
          </div><!-- End Info Item -->

        </div>

        <form action="forms/contact.php" method="post" role="form" class="php-email-form p-3 p-md-4">
          <div class="row">
            <div class="col-xl-6 form-group">
              <input type="text" name="name" class="form-control" id="name" placeholder="Nombre" required>
            </div>
            <div class="col-xl-6 form-group">
              <input type="email" class="form-control" name="email" id="email" placeholder="Correo" required>
            </div>
          </div>
          <div class="form-group">
            <input type="text" class="form-control" name="subject" id="subject" placeholder="Asunto" required>
          </div>
          <div class="form-group">
            <textarea class="form-control" name="message" rows="5" placeholder="Mensaje" required></textarea>
          </div>
          <div class="my-3">
            <div class="loading">Loading</div>
            <div class="error-message"></div>
            <div class="sent-message">Your message has been sent. Thank you!</div>
          </div>
          <div class="text-center"><button type="submit">Enviar</button></div>
        </form>
        <!--End Contact Form -->

      </div>
    </section><!-- End Contact Section -->

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