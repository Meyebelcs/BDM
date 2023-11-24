<?php
session_start();


require_once './components/menu.php';

require_once "../models/Reportes/POV_ReportesVendedor.php";
require_once "../models/Archivo.php";
require_once "../models/Material_Inventario.php";


//$productosStock = POV_ReportesVendedor::getAllSellsProductsStock($mysqli, $idUser);
$productosStock = POV_ReportesVendedor::getAllProductsFiltro($mysqli, $idUser, null, null, 0, null, 0, 'Stock');
$productosCotizacion = POV_ReportesVendedor::getAllProductsFiltro($mysqli, $idUser, null, null, 0, null, 0, 'Cotizacion');
$VentasStock = POV_ReportesVendedor::GetSellsTotalByUserStock($mysqli, $idUser);
$VentasCotizacion = POV_ReportesVendedor::GetSellsTotalByUserCotizacion($mysqli, $idUser);



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
    <link rel="stylesheet" href="./css/pages/home2.css">

</head>

<body>

    <!-- navbar.php -->
    <?php include('./components/navbar.php'); ?>

    <main m-0 p-0>

        <div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active"
                    aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item item1 active p-4">
                    <div class="container-fluid p-0 m-0 h-100">
                        <div class="d-md-flex h-100 justify-content-center">
                            <img class="d-lg-block d-none h-100" src="./css/assets/best-coursess.png"
                                alt="best-courses">
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
                            <img class="d-lg-block d-none h-100" src="./css/assets/work-with-only-the-bests.png"
                                alt="best-courses">
                        </div>
                    </div>
                </div>
                <div class="carousel-item item1">
                    <div class="container-fluid p-0 m-0 h-100">
                        <div class="d-md-flex h-100 justify-content-center">
                            <img class="d-lg-block d-none h-100" src="./css/assets/user-scenarios.png"
                                alt="best-courses">
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
        <div class="containerback">
            <div class="text-center mb-3">

                <br>
                <h3 class="border-bottom p-2 pt-3" id="switchText"> Busqueda Productos </h3>
                <br>

                <!-- Interruptor de bolita -->
                <label class="switch">
                    <input type="checkbox" id="switchInput">
                    <span class="slider round"></span>
                </label>
            </div>


            <!-- Contenido -->
            <div class="container">

                <div class="productosStock">
                    <!-- Cards -->

                    <!-- ======================= MEJOR VENDIDOS ======================== -->

                    <h3 class="border-bottom mt-4 p-2 text-center">Mejor vendidos</h3>

                    <!-- Slider main container -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php
                            if ($productosStock) {
                                foreach ($productosStock as $producto) {
                                    ?>
                                    <div class="card swiper-slide" style="width: 23rem;">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>"
                                            class="card-img-top" alt="<?php echo $producto->getNombre(); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title mb-0">
                                                <?php echo $producto->getNombre(); ?>
                                            </h4>
                                            <!-- Resto de tus datos dinámicos del producto -->
                                            <small class="card-text mb-1">
                                                <?php echo $producto->getDescripcion(); ?><br>
                                            </small>
                                            <?php
                                            $categoriasbyproduct = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());
                                            foreach ($categoriasbyproduct as $category) { ?>
                                                <small class="card-text mb-1">
                                                    <strong>#
                                                        <?php echo $category->getNombre(); ?>
                                                    </strong>
                                                </small>
                                            <?php } ?>
                                            <hr class="mt-2">
                                            <p class="card-text mb-1">Precio: $
                                                <?php echo $producto->getPrecio(); ?>
                                            </p>
                                            <p class="card-text mb-1">Cantidad Vendida:
                                                <?php echo $producto->getCantidadVendida(); ?>
                                            </p>
                                            <p class="card-text mb-1">Inventario:
                                                <?php echo $producto->getInventario(); ?>
                                            </p>
                                            <p class="card-text mb-1">Total de Ingresos: $
                                                <?php echo $producto->getTotalIngresos(); ?>
                                            </p>
                                            <p class="card-text mb-1">Fecha de publicación:
                                                <?php echo $producto->getFecha(); ?>
                                            </p>
                                            <p class="card-text mb-1">Hora de publicación:
                                                <?php echo $producto->getHora(); ?>
                                            </p>

                                            <div class="calificacion pb-2">
                                                <?php
                                                $calif = $producto->getPromedioCalificacion();
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
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="card swiper-slide" style="width: 23rem;">
                                    <div class="card-body">
                                        Aún no hay productos registrados
                                    </div>
                                </div>
                                <?php
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
                            <?php
                            if ($productosStock) {
                                foreach ($productosStock as $producto) {
                                    ?>
                                    <div class="card swiper-slide" style="width: 23rem;">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>"
                                            class="card-img-top" alt="<?php echo $producto->getNombre(); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title mb-0">
                                                <?php echo $producto->getNombre(); ?>
                                            </h4>
                                            <!-- Resto de tus datos dinámicos del producto -->
                                            <small class="card-text mb-1">
                                                <?php echo $producto->getDescripcion(); ?><br>
                                            </small>
                                            <?php
                                            $categoriasbyproduct = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());
                                            foreach ($categoriasbyproduct as $category) { ?>
                                                <small class="card-text mb-1">
                                                    <strong>#
                                                        <?php echo $category->getNombre(); ?>
                                                    </strong>
                                                </small>
                                            <?php } ?>
                                            <hr class="mt-2">
                                            <p class="card-text mb-1">Precio: $
                                                <?php echo $producto->getPrecio(); ?>
                                            </p>
                                            <p class="card-text mb-1">Cantidad Vendida:
                                                <?php echo $producto->getCantidadVendida(); ?>
                                            </p>
                                            <p class="card-text mb-1">Inventario:
                                                <?php echo $producto->getInventario(); ?>
                                            </p>
                                            <p class="card-text mb-1">Total de Ingresos: $
                                                <?php echo $producto->getTotalIngresos(); ?>
                                            </p>
                                            <p class="card-text mb-1">Fecha de publicación:
                                                <?php echo $producto->getFecha(); ?>
                                            </p>
                                            <p class="card-text mb-1">Hora de publicación:
                                                <?php echo $producto->getHora(); ?>
                                            </p>

                                            <div class="calificacion pb-2">
                                                <?php
                                                $calif = $producto->getPromedioCalificacion();
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
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="card swiper-slide" style="width: 23rem;">
                                    <div class="card-body">
                                        Aún no hay productos registrados
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>

                    <!-- ======================= MEJOR VALORADOS ======================== -->

                    <h3 class="border-bottom mt-4 p-2 text-center">Mejor vendidos</h3>

                    <!-- Slider main container -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php
                            if ($productosStock) {
                                foreach ($productosStock as $producto) {
                                    ?>
                                    <div class="card swiper-slide" style="width: 23rem;">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>"
                                            class="card-img-top" alt="<?php echo $producto->getNombre(); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title mb-0">
                                                <?php echo $producto->getNombre(); ?>
                                            </h4>
                                            <!-- Resto de tus datos dinámicos del producto -->
                                            <small class="card-text mb-1">
                                                <?php echo $producto->getDescripcion(); ?><br>
                                            </small>
                                            <?php
                                            $categoriasbyproduct = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());
                                            foreach ($categoriasbyproduct as $category) { ?>
                                                <small class="card-text mb-1">
                                                    <strong>#
                                                        <?php echo $category->getNombre(); ?>
                                                    </strong>
                                                </small>
                                            <?php } ?>
                                            <hr class="mt-2">
                                            <p class="card-text mb-1">Precio: $
                                                <?php echo $producto->getPrecio(); ?>
                                            </p>
                                            <p class="card-text mb-1">Cantidad Vendida:
                                                <?php echo $producto->getCantidadVendida(); ?>
                                            </p>
                                            <p class="card-text mb-1">Inventario:
                                                <?php echo $producto->getInventario(); ?>
                                            </p>
                                            <p class="card-text mb-1">Total de Ingresos: $
                                                <?php echo $producto->getTotalIngresos(); ?>
                                            </p>
                                            <p class="card-text mb-1">Fecha de publicación:
                                                <?php echo $producto->getFecha(); ?>
                                            </p>
                                            <p class="card-text mb-1">Hora de publicación:
                                                <?php echo $producto->getHora(); ?>
                                            </p>

                                            <div class="calificacion pb-2">
                                                <?php
                                                $calif = $producto->getPromedioCalificacion();
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
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="card swiper-slide" style="width: 23rem;">
                                    <div class="card-body">
                                        Aún no hay productos registrados
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>

                </div>







                <div class="productosCotizacion">



                    <h3 class="border-bottom mt-4 p-2 text-center">Mejor vendidos</h3>

                    <!-- Slider main container -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php
                            if ($productosCotizacion) {
                                foreach ($productosCotizacion as $Cotizacion) {
                                    ?>
                                    <div class="card swiper-slide" style="width: 23rem;">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($Cotizacion->getImagen()); ?>"
                                            class="card-img-top" alt="<?php echo $producto->getNombre(); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title mb-0">
                                                <?php echo $Cotizacion->getNombre(); ?>
                                            </h4>
                                            <!-- Resto de tus datos dinámicos del producto -->
                                            <small class="card-text mb-1">
                                                <?php echo $Cotizacion->getDescripcion(); ?><br>
                                            </small>
                                            <?php
                                            $categoriasbyproduct = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());
                                            foreach ($categoriasbyproduct as $category) { ?>
                                                <small class="card-text mb-1">
                                                    <strong>#
                                                        <?php echo $category->getNombre(); ?>
                                                    </strong>
                                                </small>
                                            <?php } ?>
                                            <hr class="mt-2">
                                            <p class="card-text mb-1">Precio: $
                                                <?php echo $producto->getPrecio(); ?>
                                            </p>
                                            <p class="card-text mb-1">Cantidad Vendida:
                                                <?php echo $producto->getCantidadVendida(); ?>
                                            </p>
                                            <p class="card-text mb-1">Inventario:
                                                <?php echo $producto->getInventario(); ?>
                                            </p>
                                            <p class="card-text mb-1">Total de Ingresos: $
                                                <?php echo $producto->getTotalIngresos(); ?>
                                            </p>
                                            <p class="card-text mb-1">Fecha de publicación:
                                                <?php echo $producto->getFecha(); ?>
                                            </p>
                                            <p class="card-text mb-1">Hora de publicación:
                                                <?php echo $producto->getHora(); ?>
                                            </p>
                                            <p class="card-text mb-1">Hora de publicación:
                                                <?php echo $producto->getHora(); ?>
                                            </p>



                                            <div class="calificacion pb-2">
                                                <?php
                                                $calif = $producto->getPromedioCalificacion();
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
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="card swiper-slide" style="width: 23rem;">
                                    <div class="card-body">
                                        Aún no hay productos registrados
                                    </div>
                                </div>
                                <?php
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
                            <?php
                            if ($productosCotizacion) {
                                foreach ($productosCotizacion as $Cotizacion) {
                                    ?>
                                    <div class="card swiper-slide" style="width: 23rem;">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($Cotizacion->getImagen()); ?>"
                                            class="card-img-top" alt="<?php echo $producto->getNombre(); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title mb-0">
                                                <?php echo $Cotizacion->getNombre(); ?>
                                            </h4>
                                            <!-- Resto de tus datos dinámicos del producto -->
                                            <small class="card-text mb-1">
                                                <?php echo $Cotizacion->getDescripcion(); ?><br>
                                            </small>
                                            <?php
                                            $categoriasbyproduct = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());
                                            foreach ($categoriasbyproduct as $category) { ?>
                                                <small class="card-text mb-1">
                                                    <strong>#
                                                        <?php echo $category->getNombre(); ?>
                                                    </strong>
                                                </small>
                                            <?php } ?>
                                            <hr class="mt-2">
                                            <p class="card-text mb-1">Precio: $
                                                <?php echo $producto->getPrecio(); ?>
                                            </p>
                                            <p class="card-text mb-1">Cantidad Vendida:
                                                <?php echo $producto->getCantidadVendida(); ?>
                                            </p>
                                            <p class="card-text mb-1">Inventario:
                                                <?php echo $producto->getInventario(); ?>
                                            </p>
                                            <p class="card-text mb-1">Total de Ingresos: $
                                                <?php echo $producto->getTotalIngresos(); ?>
                                            </p>
                                            <p class="card-text mb-1">Fecha de publicación:
                                                <?php echo $producto->getFecha(); ?>
                                            </p>
                                            <p class="card-text mb-1">Hora de publicación:
                                                <?php echo $producto->getHora(); ?>
                                            </p>

                                            <div class="calificacion pb-2">
                                                <?php
                                                $calif = $producto->getPromedioCalificacion();
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
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="card swiper-slide" style="width: 23rem;">
                                    <div class="card-body">
                                        Aún no hay productos registrados
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>

                    <!-- ======================= MEJOR VALORADOS ======================== -->

                    <h3 class="border-bottom mt-4 p-2 text-center">Mejor vendidos</h3>

                    <!-- Slider main container -->
                    <div class="swiper mySwiper">
                        <div class="swiper-wrapper">
                            <?php
                            if ($productosCotizacion) {
                                foreach ($productosCotizacion as $Cotizacion) {
                                    ?>
                                    <div class="card swiper-slide" style="width: 23rem;">
                                        <img src="data:image/jpeg;base64,<?php echo base64_encode($Cotizacion->getImagen()); ?>"
                                            class="card-img-top" alt="<?php echo $producto->getNombre(); ?>">
                                        <div class="card-body">
                                            <h4 class="card-title mb-0">
                                                <?php echo $Cotizacion->getNombre(); ?>
                                            </h4>
                                            <!-- Resto de tus datos dinámicos del producto -->
                                            <small class="card-text mb-1">
                                                <?php echo $Cotizacion->getDescripcion(); ?><br>
                                            </small>
                                            <?php
                                            $categoriasbyproduct = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());
                                            foreach ($categoriasbyproduct as $category) { ?>
                                                <small class="card-text mb-1">
                                                    <strong>#
                                                        <?php echo $category->getNombre(); ?>
                                                    </strong>
                                                </small>
                                            <?php } ?>
                                            <hr class="mt-2">
                                            <p class="card-text mb-1">Precio: $
                                                <?php echo $producto->getPrecio(); ?>
                                            </p>
                                            <p class="card-text mb-1">Cantidad Vendida:
                                                <?php echo $producto->getCantidadVendida(); ?>
                                            </p>
                                            <p class="card-text mb-1">Inventario:
                                                <?php echo $producto->getInventario(); ?>
                                            </p>
                                            <p class="card-text mb-1">Total de Ingresos: $
                                                <?php echo $producto->getTotalIngresos(); ?>
                                            </p>
                                            <p class="card-text mb-1">Fecha de publicación:
                                                <?php echo $producto->getFecha(); ?>
                                            </p>
                                            <p class="card-text mb-1">Hora de publicación:
                                                <?php echo $producto->getHora(); ?>
                                            </p>

                                            <div class="calificacion pb-2">
                                                <?php
                                                $calif = $producto->getPromedioCalificacion();
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
                                    <?php
                                }
                            } else {
                                ?>
                                <div class="card swiper-slide" style="width: 23rem;">
                                    <div class="card-body">
                                        Aún no hay productos registrados
                                    </div>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="swiper-pagination"></div>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    </div>

                </div>
            </div>







        </div>


        </div>
        <!-- Footer -->



        <!-- -----------scripts-------------->
        <?php include_once "./libs/bootstrapJS.php" ?>
        <?php include_once "./libs/swiperJS.php" ?>
        <script src="./js/Home.js"></script>



        <?php include('./components/footer.php'); ?>

        <?php include_once "./libs/jqueryJS.php" ?>

        <?php include_once "./libs/sweetalertJS.php" ?>
        <script src="./js/Busqueda.js"></script>


</body>

</html>