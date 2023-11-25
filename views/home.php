<?php
session_start();

require_once './components/menu.php';

require_once "../models/Producto.php";
require_once "../models/Categoria.php";


$MasVenStock = Product::getMasVendStock($mysqli);
$MasRecStock = Product::getMasRecStock($mysqli);
$MejCalifStock = Product::getMejorCalifStock($mysqli);

$MasVenCoti = Product::getMasVendCoti($mysqli);
$MasRecCoti = Product::getMasRecCoti($mysqli);
$MejCalifCoti = Product::getMejorCalifCoti($mysqli);
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

  <!-- navbar.php -->
  <?php include('./components/navbar.php'); ?>

  <main m-0 p-0 class="background">

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

    <div class="text-center mb-3">

      <br>
      <h3 class=" p-2 pt-3" id="switchText">Productos en Stock </h3>
      <br>

      <!-- Interruptor de bolita -->
      <label class="switch">
        <input type="checkbox" id="switchInput">
        <span class="slider round"></span>
      </label>
    </div>

    <!-- Contenido -->
    <div class="container mb-5">

      <div class="productosStock" id="productosStock">
        <!-- ======================= MÁS RECIENTES ======================== -->

        <h3 class="border-bottom p-2 text-center">Más recientes</h3>

        <!-- Slider main container -->
        <div class="swiper mySwiper">
          <div class="swiper-wrapper">


            <?php if ($MasRecStock) {
              foreach ($MasRecStock as $producto) { ?>

                <div class="card swiper-slide" style="width: 20rem;">
                  <img src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>"
                    class="card-img card-img-top mx-auto d-block" alt="Imagen actual" style="width: 300px; height: 300px;">
                  <div class="card-body">
                    <h5 class="card-title mb-1">
                      <?php echo $producto->getNombre(); ?>
                    </h5>
                    <small class="card-text mb-1">
                      <?php echo $producto->getDescripcion(); ?>
                    </small><br>
                    <?php
                    $categoriasbyproduct = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());

                    foreach ($categoriasbyproduct as $category) { ?>
                      <small class="card-text mb-1">
                        <strong> #
                          <?php echo $category->getNombre(); ?>
                        </strong>
                      </small>
                    <?php } ?>
                    <hr class="mt-2">
                    <p class="card-text mb-1">Precio: $
                      <?php echo $producto->getPrecio(); ?>
                    </p>
                    <p class="card-text mb-1">Cantidad Vendida:
                      <?php echo $producto->getTotalVendido(); ?>
                    </p>
                    <p class="card-text mb-1">Fecha de publicación:
                      <?php echo $producto->getFecha(); ?>
                    </p>
                    <p class="card-text mb-1">Hora de publicación:
                      <?php echo $producto->getHora(); ?>
                    </p>
                    <div class="calificacion pb-2">
                      <?php
                      $calif = $producto->getpromedio();

                      for ($i = 1; $i <= 5; $i++) {
                        if ($calif >= $i) {
                          echo '<i class="bi bi-star-fill"></i>';
                        } else {
                          echo '<i class="bi bi-star"></i>';
                        }
                      }
                      ?>
                    </div>

                    <a href="Detalle_producto.php?idProductoIndex=<?php echo $producto->getIdProducto(); ?>"
                      class="btn btn-secondary mb-1" id="">Ver detalles</a>
                  </div>
                </div>
              <?php }
            }
            ?>



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


          <?php if ($MasVenStock) {
              foreach ($MasVenStock as $producto) { ?>

                <div class="card swiper-slide" style="width: 20rem;">
                  <img src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>"
                    class="card-img card-img-top mx-auto d-block" alt="Imagen actual" style="width: 300px; height: 300px;">
                  <div class="card-body">
                    <h5 class="card-title mb-1">
                      <?php echo $producto->getNombre(); ?>
                    </h5>
                    <small class="card-text mb-1">
                      <?php echo $producto->getDescripcion(); ?>
                    </small><br>
                    <?php
                    $categoriasbyproduct = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());

                    foreach ($categoriasbyproduct as $category) { ?>
                      <small class="card-text mb-1">
                        <strong> #
                          <?php echo $category->getNombre(); ?>
                        </strong>
                      </small>
                    <?php } ?>
                    <hr class="mt-2">
                    <p class="card-text mb-1">Precio: $
                      <?php echo $producto->getPrecio(); ?>
                    </p>
                    <p class="card-text mb-1">Cantidad Vendida:
                      <?php echo $producto->getTotalVendido(); ?>
                    </p>
                    <p class="card-text mb-1">Fecha de publicación:
                      <?php echo $producto->getFecha(); ?>
                    </p>
                    <p class="card-text mb-1">Hora de publicación:
                      <?php echo $producto->getHora(); ?>
                    </p>
                    <div class="calificacion pb-2">
                      <?php
                      $calif = $producto->getpromedio();

                      for ($i = 1; $i <= 5; $i++) {
                        if ($calif >= $i) {
                          echo '<i class="bi bi-star-fill"></i>';
                        } else {
                          echo '<i class="bi bi-star"></i>';
                        }
                      }
                      ?>
                    </div>

                    <a href="Detalle_producto.php?idProductoIndex=<?php echo $producto->getIdProducto(); ?>"
                      class="btn btn-secondary mb-1" id="">Ver detalles</a>
                  </div>
                </div>
              <?php }
            }
            ?>

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

          <?php if ($MejCalifStock) {
              foreach ($MejCalifStock as $producto) { ?>

                <div class="card swiper-slide" style="width: 20rem;">
                  <img src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>"
                    class="card-img card-img-top mx-auto d-block" alt="Imagen actual" style="width: 300px; height: 300px;">
                  <div class="card-body">
                    <h5 class="card-title mb-1">
                      <?php echo $producto->getNombre(); ?>
                    </h5>
                    <small class="card-text mb-1">
                      <?php echo $producto->getDescripcion(); ?>
                    </small><br>
                    <?php
                    $categoriasbyproduct = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());

                    foreach ($categoriasbyproduct as $category) { ?>
                      <small class="card-text mb-1">
                        <strong> #
                          <?php echo $category->getNombre(); ?>
                        </strong>
                      </small>
                    <?php } ?>
                    <hr class="mt-2">
                    <p class="card-text mb-1">Precio: $
                      <?php echo $producto->getPrecio(); ?>
                    </p>
                    <p class="card-text mb-1">Cantidad Vendida:
                      <?php echo $producto->getTotalVendido(); ?>
                    </p>
                    <p class="card-text mb-1">Fecha de publicación:
                      <?php echo $producto->getFecha(); ?>
                    </p>
                    <p class="card-text mb-1">Hora de publicación:
                      <?php echo $producto->getHora(); ?>
                    </p>
                    <div class="calificacion pb-2">
                      <?php
                      $calif = $producto->getpromedio();

                      for ($i = 1; $i <= 5; $i++) {
                        if ($calif >= $i) {
                          echo '<i class="bi bi-star-fill"></i>';
                        } else {
                          echo '<i class="bi bi-star"></i>';
                        }
                      }
                      ?>
                    </div>

                    <a href="Detalle_producto.php?idProductoIndex=<?php echo $producto->getIdProducto(); ?>"
                      class="btn btn-secondary mb-1" id="">Ver detalles</a>
                  </div>
                </div>
              <?php }
            }
            ?>

          </div>
          <div class="swiper-pagination"></div>
          <div class="swiper-button-prev"></div>
          <div class="swiper-button-next"></div>
        </div>

      </div>
      <div class="productosCotizacion" id="productosCotizacion">
        <!-- ======================= MÁS RECIENTES ======================== -->

        <h3 class="border-bottom p-2 text-center">Más recientes</h3>

        <!-- Slider main container -->
        <div class="swiper mySwiper">
          <div class="swiper-wrapper">



          <?php if ($MasRecCoti) {
              foreach ($MasRecCoti as $producto) { ?>

                <div class="card swiper-slide" style="width: 20rem;">
                  <img src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>"
                    class="card-img card-img-top mx-auto d-block" alt="Imagen actual" style="width: 300px; height: 300px;">
                  <div class="card-body">
                    <h5 class="card-title mb-1">
                      <?php echo $producto->getNombre(); ?>
                    </h5>
                    <small class="card-text mb-1">
                      <?php echo $producto->getDescripcion(); ?>
                    </small><br>
                    <?php
                    $categoriasbyproduct = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());

                    foreach ($categoriasbyproduct as $category) { ?>
                      <small class="card-text mb-1">
                        <strong> #
                          <?php echo $category->getNombre(); ?>
                        </strong>
                      </small>
                    <?php } ?>
                    <hr class="mt-2">
                    <p class="card-text mb-1">Precio: $
                      <?php echo $producto->getPrecio(); ?>
                    </p>
                    <p class="card-text mb-1">Cantidad Vendida:
                      <?php echo $producto->getTotalVendido(); ?>
                    </p>
                    <p class="card-text mb-1">Fecha de publicación:
                      <?php echo $producto->getFecha(); ?>
                    </p>
                    <p class="card-text mb-1">Hora de publicación:
                      <?php echo $producto->getHora(); ?>
                    </p>
                    <div class="calificacion pb-2">
                      <?php
                      $calif = $producto->getpromedio();

                      for ($i = 1; $i <= 5; $i++) {
                        if ($calif >= $i) {
                          echo '<i class="bi bi-star-fill"></i>';
                        } else {
                          echo '<i class="bi bi-star"></i>';
                        }
                      }
                      ?>
                    </div>

                    <a href="Detalle_producto.php?idProductoIndex=<?php echo $producto->getIdProducto(); ?>"
                      class="btn btn-secondary mb-1" id="">Ver detalles</a>
                  </div>
                </div>
              <?php }
            }
            ?>

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



          <?php if ($MasVenCoti) {
              foreach ($MasVenCoti as $producto) { ?>

                <div class="card swiper-slide" style="width: 20rem;">
                  <img src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>"
                    class="card-img card-img-top mx-auto d-block" alt="Imagen actual" style="width: 300px; height: 300px;">
                  <div class="card-body">
                    <h5 class="card-title mb-1">
                      <?php echo $producto->getNombre(); ?>
                    </h5>
                    <small class="card-text mb-1">
                      <?php echo $producto->getDescripcion(); ?>
                    </small><br>
                    <?php
                    $categoriasbyproduct = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());

                    foreach ($categoriasbyproduct as $category) { ?>
                      <small class="card-text mb-1">
                        <strong> #
                          <?php echo $category->getNombre(); ?>
                        </strong>
                      </small>
                    <?php } ?>
                    <hr class="mt-2">
                    <p class="card-text mb-1">Precio: $
                      <?php echo $producto->getPrecio(); ?>
                    </p>
                    <p class="card-text mb-1">Cantidad Vendida:
                      <?php echo $producto->getTotalVendido(); ?>
                    </p>
                    <p class="card-text mb-1">Fecha de publicación:
                      <?php echo $producto->getFecha(); ?>
                    </p>
                    <p class="card-text mb-1">Hora de publicación:
                      <?php echo $producto->getHora(); ?>
                    </p>
                    <div class="calificacion pb-2">
                      <?php
                      $calif = $producto->getpromedio();

                      for ($i = 1; $i <= 5; $i++) {
                        if ($calif >= $i) {
                          echo '<i class="bi bi-star-fill"></i>';
                        } else {
                          echo '<i class="bi bi-star"></i>';
                        }
                      }
                      ?>
                    </div>

                    <a href="Detalle_producto.php?idProductoIndex=<?php echo $producto->getIdProducto(); ?>"
                      class="btn btn-secondary mb-1" id="">Ver detalles</a>
                  </div>
                </div>
              <?php }
            }
            ?>

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

          <?php if ($MejCalifCoti) {
              foreach ($MejCalifCoti as $producto) { ?>

                <div class="card swiper-slide" style="width: 20rem;">
                  <img src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>"
                    class="card-img card-img-top mx-auto d-block" alt="Imagen actual" style="width: 300px; height: 300px;">
                  <div class="card-body">
                    <h5 class="card-title mb-1">
                      <?php echo $producto->getNombre(); ?>
                    </h5>
                    <small class="card-text mb-1">
                      <?php echo $producto->getDescripcion(); ?>
                    </small><br>
                    <?php
                    $categoriasbyproduct = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());

                    foreach ($categoriasbyproduct as $category) { ?>
                      <small class="card-text mb-1">
                        <strong> #
                          <?php echo $category->getNombre(); ?>
                        </strong>
                      </small>
                    <?php } ?>
                    <hr class="mt-2">
                    <p class="card-text mb-1">Precio: $
                      <?php echo $producto->getPrecio(); ?>
                    </p>
                    <p class="card-text mb-1">Cantidad Vendida:
                      <?php echo $producto->getTotalVendido(); ?>
                    </p>
                    <p class="card-text mb-1">Fecha de publicación:
                      <?php echo $producto->getFecha(); ?>
                    </p>
                    <p class="card-text mb-1">Hora de publicación:
                      <?php echo $producto->getHora(); ?>
                    </p>
                    <div class="calificacion pb-2">
                      <?php
                      $calif = $producto->getpromedio();

                      for ($i = 1; $i <= 5; $i++) {
                        if ($calif >= $i) {
                          echo '<i class="bi bi-star-fill"></i>';
                        } else {
                          echo '<i class="bi bi-star"></i>';
                        }
                      }
                      ?>
                    </div>

                    <a href="Detalle_producto.php?idProductoIndex=<?php echo $producto->getIdProducto(); ?>"
                      class="btn btn-secondary mb-1" id="">Ver detalles</a>
                  </div>
                </div>
              <?php }
            }
            ?>
        </div>
        <div class="swiper-pagination"></div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
      </div>

    </div>
    </div>

    <!-- Footer -->
    <?php include('./components/footer.php'); ?>



    <!-- -----------scripts-------------->
    <?php include_once "./libs/jqueryJS.php" ?>
    <?php include_once "./libs/bootstrapJS.php" ?>
    <?php include_once "./libs/swiperJS.php" ?>
    <script src="./js/Home.js"></script>
    <script>
      $(document).ready(function () {

        $('.productosCotizacion').hide();
        $('.productosStock').show();

        $('#switchInput').change(function () {
          if ($(this).is(':checked')) {
            $('#switchText').text('Cotizaciones');
            $('.productosStock').hide();
            $('.productosCotizacion').show();
          } else {
            $('#switchText').text('Productos en Stock');
            $('.productosCotizacion').hide();
            $('.productosStock').show();
          }
        });
      });
    </script>

</body>

</html>