<?php
session_start();

require_once './components/menu.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Listas</title>

    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/Perfil_Listas.css">


</head>

<body>

    <!-- navbar.php -->
    <?php include('./components/navbar.php'); ?>

    <main m-0 p-0 class="background">

        <div class="Hero">
            <div class="container-fluid bg-tertiary">
                <div class="profile_Section row p-4">
                    <div class="col-12 text-center mb-3">
                        <img src="./css/assets/vangogh.png" id="foto_perfil" class="img-hero square-image" alt="">
                    </div>
                    <div class="col-12 text-center">
                        <h4>FAVORITOS</h4>
                        <h6>@arleth_mel</h6>

                        <div class="text-center col-12 mb-3 ">

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="mt-5">
        <!-- Contenido -->
        <div class="productosStock">
            <!-- Cards -->
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mx-3 justify-content-center">
                <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                    <div class="card" style="width: 100%;">
                        <img src="./css/assets/vangogh.png" class="card-img card-img-top" alt="Imagen actual">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Pintura de oleo</h5>
                            <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                            <hr class="mt-2">
                            <p class="card-text mb-1">Precio: $150</p>
                            <p class="card-text mb-1">Cantidad Vendida: 15</p>
                            <div class="calificacion pb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </div>

                            <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                            <div style="position: absolute; bottom: 10px; right: 10px;">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-plus-circle ml-2"></i>
                            </div>

                        </div>
                    </div>
                </div>
                <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                    <div class="card" style="width: 100%;">
                        <img src="./css/assets/vangogh.png" class="card-img card-img-top" alt="Imagen actual">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Pintura de oleo</h5>
                            <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                            <hr class="mt-2">
                            <p class="card-text mb-1">Precio: $150</p>
                            <p class="card-text mb-1">Cantidad Vendida: 15</p>
                            <div class="calificacion pb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </div>

                            <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                            <div style="position: absolute; bottom: 10px; right: 10px;">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-plus-circle ml-2"></i>
                            </div>

                        </div>
                    </div>
                </div>
                <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                    <div class="card" style="width: 100%;">
                        <img src="./css/assets/vangogh.png" class="card-img card-img-top" alt="Imagen actual">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Pintura de oleo</h5>
                            <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                            <hr class="mt-2">
                            <p class="card-text mb-1">Precio: $150</p>
                            <p class="card-text mb-1">Cantidad Vendida: 15</p>
                            <div class="calificacion pb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </div>

                            <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                            <div style="position: absolute; bottom: 10px; right: 10px;">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-plus-circle ml-2"></i>
                            </div>

                        </div>
                    </div>
                </div>
                <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                    <div class="card" style="width: 100%;">
                        <img src="./css/assets/vangogh.png" class="card-img card-img-top" alt="Imagen actual">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Pintura de oleo</h5>
                            <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                            <hr class="mt-2">
                            <p class="card-text mb-1">Precio: $150</p>
                            <p class="card-text mb-1">Cantidad Vendida: 15</p>
                            <div class="calificacion pb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </div>

                            <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                            <div style="position: absolute; bottom: 10px; right: 10px;">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-plus-circle ml-2"></i>
                            </div>

                        </div>
                    </div>
                </div>
                <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                    <div class="card" style="width: 100%;">
                        <img src="./css/assets/vangogh.png" class="card-img card-img-top" alt="Imagen actual">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Pintura de oleo</h5>
                            <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                            <hr class="mt-2">
                            <p class="card-text mb-1">Precio: $150</p>
                            <p class="card-text mb-1">Cantidad Vendida: 15</p>
                            <div class="calificacion pb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </div>

                            <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                            <div style="position: absolute; bottom: 10px; right: 10px;">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-plus-circle ml-2"></i>
                            </div>

                        </div>
                    </div>
                </div>
                <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                    <div class="card" style="width: 100%;">
                        <img src="./css/assets/vangogh.png" class="card-img card-img-top" alt="Imagen actual">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Pintura de oleo</h5>
                            <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                            <hr class="mt-2">
                            <p class="card-text mb-1">Precio: $150</p>
                            <p class="card-text mb-1">Cantidad Vendida: 15</p>
                            <div class="calificacion pb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </div>

                            <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                            <div style="position: absolute; bottom: 10px; right: 10px;">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-plus-circle ml-2"></i>
                            </div>

                        </div>
                    </div>
                </div>
                <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                    <div class="card" style="width: 100%;">
                        <img src="./css/assets/vangogh.png" class="card-img card-img-top" alt="Imagen actual">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Pintura de oleo</h5>
                            <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                            <hr class="mt-2">
                            <p class="card-text mb-1">Precio: $150</p>
                            <p class="card-text mb-1">Cantidad Vendida: 15</p>
                            <div class="calificacion pb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </div>

                            <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                            <div style="position: absolute; bottom: 10px; right: 10px;">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-plus-circle ml-2"></i>
                            </div>

                        </div>
                    </div>
                </div>
                <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                    <div class="card" style="width: 100%;">
                        <img src="./css/assets/vangogh.png" class="card-img card-img-top" alt="Imagen actual">
                        <div class="card-body">
                            <h5 class="card-title mb-1">Pintura de oleo</h5>
                            <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                            <hr class="mt-2">
                            <p class="card-text mb-1">Precio: $150</p>
                            <p class="card-text mb-1">Cantidad Vendida: 15</p>
                            <div class="calificacion pb-2">
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star-fill"></i>
                                <i class="bi bi-star"></i>
                                <i class="bi bi-star"></i>
                            </div>

                            <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>

                            <div style="position: absolute; bottom: 10px; right: 10px;">
                                <i class="bi bi-heart"></i>
                                <i class="bi bi-plus-circle ml-2"></i>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
        <div class="PerfilPrivado">
            <!-- Cards COTIZACION--------->

            <div class="row pt-5 row-cols-1 row-cols-md-2 row-cols-lg-4 mx-3 justify-content-center">
                <div class="card border mb-5" style="width: 50rem; ">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-1">Este Perfil es Privado</h5>
                    </div>
                </div>
            </div>

        </div>
        </div>

        <!-- Footer -->
        <?php include('./components/footer.php'); ?>

        <?php include_once "./libs/jqueryJS.php" ?>
        <?php include_once "./libs/bootstrapJS.php" ?>
        <?php include_once "./libs/sweetalertJS.php" ?>
        <script src="./js/Perfil_Listas.js"></script>
    </main>

</body>

</html>