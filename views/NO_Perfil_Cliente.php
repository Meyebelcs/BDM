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
    <title>Perfil Cliente</title>

    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/Perfil_Cliente.css">

</head>

<body>

    <!-- navbar.php -->
    <?php include('./components/navbar.php'); ?>


    <main m-0 p-0 class="background">

        <!-- Hero -->
        <div class="Hero">
            <div class="container-fluid bg-tertiary">
                <div class="profile_Section row p-4">
                    <div class="col-12 text-center mb-3">
                        <img src="./css/assets/perfil.png" id="foto_perfil" class="img-hero" alt="">
                    </div>
                    <div class="col-12 text-center">
                        <h4 id="nombre_Inst">Melany Arleth Jiménez Gómez</h4>
                        <h6>@arleth_mel</h6>

                        <div class="text-center col-12 mb-3 ">
                            <h6 class="p-1 pt-3" id="switchText">Perfil Privado</h6>
                            <!-- Interruptor de bolita -->
                            <label class="switch">
                                <input type="checkbox" id="switchInput">
                                <span class="slider round"></span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
        </div>




        <!-- Contenido -->
        <div class="container">

            <div class="PerfilPublico mb-5">

                <div class="text-center mb-3">
                    <h3 class="p-2 pt-3" id="switchText">Listas</h3>
                </div>
                <!-- Cards -->

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mx-3 justify-content-center">
                    <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                        <div class="card" style="width: 100%;">
                            <img src="./css/assets/vangogh.png" class="card-img card-img-top" alt="Imagen actual">
                            <div class="card-body">
                                <h5 class="card-title mb-1">Favoritos</h5>
                                <small class="card-text mb-1">Productos deseados</small>
                                <hr class="mt-2">
                                <p class="card-text mb-2">15 elementos</p>


                                <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                    <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                        <div class="card" style="width: 100%;">
                            <img src="./css/assets/vangogh.png" class="card-img card-img-top" alt="Imagen actual">
                            <div class="card-body">
                                <h5 class="card-title mb-1">Regalos Amigos</h5>
                                <small class="card-text mb-1">Regalos bonitos para los que quiero</small>
                                <hr class="mt-2">
                                <p class="card-text mb-2">42 elementos</p>


                                <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>
                            </div>
                        </div>
                    </div>
                    <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                        <div class="card" style="width: 100%;">
                            <img src="./css/assets/vangogh.png" class="card-img card-img-top" alt="Imagen actual">
                            <div class="card-body">
                                <h5 class="card-title mb-1">Para Papá</h5>
                                <small class="card-text mb-1">Cosas para decorar el carro</small>
                                <hr class="mt-2">
                                <p class="card-text mb-2">26 elementos</p>


                                <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>
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
        <script src="./js/Perfil_Cliente.js"></script>
    </main>

</body>

</html>