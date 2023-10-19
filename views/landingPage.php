<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stock & Custom</title>

  <?php include_once "./libs/bootstrap.php" ?>
  <?php include_once "./libs/fonts.php" ?>
  <?php include_once "./libs/swiper.php" ?>
  <link rel="stylesheet" href="./css/pages/landingPage.css">

</head>

<body>

  <div class="container">
    <div class="btn-menu">
      <label for="btn-menu">☰</label>
    </div>
    <div class="logo"></div>

    <div class="d-flex align-items-center search-bar">
      <form action="Search.php" method="GET" class="input-group">

        <div class="navbar d-flex justify-content-between">
          <p class="LOGOF1">Stock & Custom</p>
        </div>
    </div>
  </div>
  </div>



  </header>
  <div class="capa"></div>

  <input type="checkbox" id="btn-menu">
  <div class="container-menu">
    <div class="cont-menu">
      <label for="btn-menu">✖️</label>
      <nav>

        <a href="login.php">Inicio de sesión</a>
        <a href="register.php">Registrarse</a>

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
                <h1>Registrate y encuentra los mejores precios en </h1>
                <h3>Stock & Custom</h3>
                <p>Ofertas</p>
              </div>
            </div>
          </div>
        </div>
        <div class="carousel-item item1">
          <div class="container-fluid p-0 m-0 h-100">
            <div class="d-md-flex h-100 justify-content-center p-5">
              <div class="carousel-caption h-100 d-flex flex-column justify-content-center text-shadow">
                <h1>Ofetas todos los dias</h1>
                <p>Unete hoy</p>
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
                <h1>Registrate en Stock & Custom</h1>
                <p>Empieza a ahorra ya</p>
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


    <!-- -----------scripts-------------->

    <?php include_once "./libs/bootstrapJS.php" ?>
    <?php include_once "./libs/swiperJS.php" ?>
    <script src="./js/landingPage.js"></script>

  </main>

</body>

</html>