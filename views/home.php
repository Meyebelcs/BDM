<?php
session_start();

if (!isset($_SESSION["AUTH"])) {
  header("Location: landingPage.php");
  exit;
}

require_once "../models/User.php";
require_once "../db.php";
$idUser = $_SESSION["AUTH"];
$mysqli = db::connect();
$user = User::findUserById($mysqli, (int) $idUser);


/* ---------Reedireccionamiento a perfil------------ */
$rol = $user->getRol();
$urlPerfil = '';

if ($rol == 'Vendedor') {
  $urlPerfil = "POV_Perfil_Vendedor.php";
} else if ($rol == 'Comprador') {
  $urlPerfil = "POV_Perfil_Cliente.php";
} else if ($rol == 'Administrador') {
  $urlPerfil = "POV_Perfil_Admin.php";
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Home</title>

  <?php include_once "./libs/fonts.php" ?>
  <?php include_once "./libs/swiper.php" ?>
  <?php include_once "./libs/bootstrap.php" ?>
  <link rel="stylesheet" href="./css/pages/home.css">

</head>

<body>

  <div class="container">
    <div class="d-flex align-items-center search-bar">

      <div class="btn-menu">
        <label for="btn-menu">☰</label>
      </div>

      <form action="Search.php" method="GET" class="input-group">

        <div class="navbar d-flex justify-content-between">
          <a href="home.php" class="me-5 navbar-brand text-decoration-none">Stock & Custom</a>
        </div>

        <input class="form-control" type="search" name="searchBar" placeholder="Search" aria-label="Search">
        <button type="submit" class="btn btn-secondary">Buscar</button>
      </form>
      <!-- Fin de la barra de búsqueda -->

      <div class="custom-dropdown">
        <div class="dropdown">
          <button class="btn text-light border-0 d-flex" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            Categorias <i class="ms-2 bi bi-caret-down-fill"></i>
          </button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="">Electronica</a></li>
            <li><a class="dropdown-item" href="">Carpintería</a></li>
            <li><a class="dropdown-item" href="">Belleza</a></li>
          </ul>
        </div>
      </div>

      <div class="mt-2">
        <a class="btn text-light border-0 d-flex" type="button" href="chat.php">
          <i class="bi bi-chat-dots-fill"></i>
        </a>
      </div>
      <div class="dropdown mt-2">
        <button class="btn border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          <?php
          $userImage = "../Files/" . $user->getImagen(); // Ruta de la imagen de perfil
          $username = $user->getUsername();
          ?>
          <img src="<?= $userImage ?>" alt="<?= $username ?>" width="35" height="35" class="rounded-circle">
          <?= $username ?>
        </button>
      </div>

    </div>


  </div>

  <div class="capa"></div>

  <input type="checkbox" id="btn-menu">
  <div class="container-menu">
    <div class="cont-menu">
      <label for="btn-menu">✖️</label>
      <nav>

        <a href=<?php echo $urlPerfil ?>>Cuenta</a>
        <a href="07_Carrito.php">Carrito</a>
        <a href="chat.php">Chat</a>
        <a href="03_Perfil_Cliente.php">Mis Compras</a>
        <a href="02_Perfil_Vendedor.php">Mis Ventas</a>
        <a href="../controllers/logout.php">Salir</a>
      </nav>

    </div>
  </div>

  <main m-0 p-0>

    <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true"
          aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
        <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item item1 active p-4">
          <div class="container-fluid p-0 m-0 h-100">
            <div class="d-md-flex h-100 justify-content-center">
              <img class="d-lg-block d-none h-100" src="./css/assets/best-coursess.png" alt="best-courses">
              <div class="carousel-caption h-100 d-flex flex-column justify-content-center">
                <h1>Registrate en los mejores cursos de Stock & Custom</h1>
                <p>El software mas usado para realizar modelos realistas</p>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item item1">
          <div class="container-fluid p-0 m-0 h-100">
            <div class="d-md-flex h-100 justify-content-center p-5">
              <div class="carousel-caption h-100 d-flex flex-column justify-content-center text-shadow">
                <h1>Contamos con los mejores instructores</h1>
                <p>El software mas usado para realizar modelos realistas</p>
              </div>
              <img class="d-lg-block d-none h-100" src="./css/assets/work-with-only-the-bests.png" alt="best-courses">
            </div>
          </div>
        </div>
        <div class="carousel-item item1">
          <div class="container-fluid p-0 m-0 h-100">
            <div class="d-md-flex h-100 justify-content-center">
              <img class="d-lg-block d-none h-100" src="./css/assets/user-scenarios.png" alt="best-courses">
              <div class="carousel-caption h-100 d-flex flex-column justify-content-center">
                <h1>Registrate en los mejores cursos de Stock & Custom</h1>
                <p>El software mas usado para realizar modelos realistas</p>
              </div>
            </div>
          </div>
        </div>

      </div>
      <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>

    <!-- Contenido -->
    <div class="container mb-5">

      <!-- ======================= MÁS RECIENTES ======================== -->

      <h3 class="border-bottom p-2 text-center">Más recientes</h3>

      <!-- Slider main container -->
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">



          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <p class="card-text me-2">
                  5
                </p>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="Detalle-producto.php" class="btn btn-secondary">Saber más</a>
            </div>
          </div>
          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <p class="card-text me-2">
                  5
                </p>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="Detalle-producto.php" class="btn btn-secondary">Saber más</a>
            </div>
          </div>
          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <p class="card-text me-2">
                  5
                </p>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="Detalle-producto.php" class="btn btn-secondary">Saber más</a>
            </div>
          </div>
          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <p class="card-text me-2">
                  5
                </p>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="" class="btn btn-secondary">Saber más</a>
            </div>
          </div>
          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="Detalle-producto.php" class="btn btn-secondary">Saber más</a>
            </div>
          </div>

        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>

      <!-- ======================= MEJOR VENDIDOS ======================== -->

      <h3 class="border-bottom mt-4 p-2 text-center">Mejor vendidos</h3>

      <!-- Slider main container -->
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">



          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="" class="btn btn-secondary">Saber más</a>
            </div>
          </div>
          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="" class="btn btn-secondary">Saber más</a>
            </div>
          </div>
          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="" class="btn btn-secondary">Saber más</a>
            </div>
          </div>
          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="" class="btn btn-secondary">Saber más</a>
            </div>
          </div>
          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="" class="btn btn-secondary">Saber más</a>
            </div>
          </div>

        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>

      <!-- ======================= MEJOR VALORADOS ======================== -->

      <h3 class="border-bottom mt-4 p-2 text-center">Mejor valorados</h3>

      <!-- Slider main container -->
      <div class="swiper mySwiper">
        <div class="swiper-wrapper">

          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="" class="btn btn-secondary">Saber más</a>
            </div>
          </div>
          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="" class="btn btn-secondary">Saber más</a>
            </div>
          </div>
          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="" class="btn btn-secondary">Saber más</a>
            </div>
          </div>
          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="" class="btn btn-secondary">Saber más</a>
            </div>
          </div>
          <div class="card swiper-slide" style="width: 23rem;">
            <img src="./css/assets/vangogh.png" class="card-img-top" alt="...">
            <div class="card-body">
              <h4 class="card-title mb-0">Pintura de oleo
              </h4>
              <small class="card-title mb-0 pb-0">
                @arleth_mel
              </small>
              <hr class="mt-2">
              <p class="card-text mb-0 pb-0">
                Pinturas inspiradas en el arte de vangogh
              </p>
              <div class="d-flex">

                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>
                <i class="bi bi-star-fill"></i>

              </div>
              <h6 class="card-text mb-3 fw-bolder">$
                34 MXN
              </h6>
              <a href="" class="btn btn-secondary">Saber más</a>
            </div>
          </div>

        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>

    </div>

    <!-- Footer -->
    <div class="container-fluid footer bg-primary">
      <footer class="py-3 footer">
        <div class="col-md-4 d-flex align-items-center">
          <span class="mb-3 mb-md-0">&copy; 2023 Stuck & Custom. Todos los derechos reservados.</span>
        </div>
      </footer>
    </div>


    <!-- -----------scripts-------------->
    <?php include_once "./libs/bootstrapJS.php" ?>
    <?php include_once "./libs/swiperJS.php" ?>
    <script src="./js/Home.js"></script>

</body>

</html>