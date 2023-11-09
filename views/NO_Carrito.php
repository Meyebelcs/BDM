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
    <title>Carrito</title>

    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/Carrito.css">

</head>

<body>

    <!-- navbar.php -->
    <?php include('./components/navbar.php'); ?>

    <main m-0 p-0 class="background">
        <!-- Contenido -->
        <div class="container mt-5">
            <div class="row d-flex">
                <div id="payment-form" class="col-xxl-6 col-lg-5 col-md-12 col-sm-12">
                    <input type="hidden" name="idNivel" value="">
                    <div class="row mt-3 mb-3 text-center">
                        <div class="col-12">
                            <h4>Carrito</h4>
                        </div>
                    </div>


                    <div class="collapse paymethod-checked">

                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h4>Detalles del producto</h4>
                        </div>
                    </div>
                    <div class="row border-top">
                        <!-- Interruptor de bolita -->
                        <label class="switch mt-5">
                            <input type="checkbox" id="switchInput">
                            <span class="slider round">
                                <span class="bi bi-check"></span> <!-- Ícono de check de Bootstrap Icons -->
                            </span>
                        </label>
                        <div class="col-2">
                            <img class="pt-2" src="./css/assets/vangogh.png" alt="" height="100px">
                        </div>
                        <div class="col-8 ms-3">
                            <h6>Pintura en oleo</h6>
                            <samll style="color:#72706e;">Producto</samll>
                            <div class="d-flex align-items-center">
                                <button class="cantidadCarrito btn btn-sm  me-2">-</button>
                                <span>2</span>
                                <button class="cantidadCarrito btn btn-sm ms-2">+</button>
                            </div>
                        </div>
                        <div class="col-3 ms-auto">
                            <label class="form-label">$150 MXN</label>
                        </div>
                    </div>
                    <div class="row border-top">
                        <!-- Interruptor de bolita -->
                        <label class="switch mt-5">
                            <input type="checkbox" id="switchInput">
                            <span class="slider round">
                                <span class="bi bi-check"></span> <!-- Ícono de check de Bootstrap Icons -->
                            </span>
                        </label>
                        <div class="col-2">
                            <img class="pt-2" src="./css/assets/vangogh.png" alt="" height="100px">
                        </div>
                        <div class="col-8 ms-3">
                            <h6>Pintura en oleo</h6>
                            <samll style="color:#72706e;">Cotización</samll>
                            <div class="d-flex align-items-center">
                                <button class="cantidadCarrito btn btn-sm  me-2">-</button>
                                <span>2</span>
                                <button class="cantidadCarrito btn btn-sm ms-2">+</button>
                            </div>
                        </div>
                        <div class="col-3 ms-auto">
                            <label class="form-label">$150 MXN</label>
                        </div>
                    </div>
                    <div class="row border-top">
                        <!-- Interruptor de bolita -->
                        <label class="switch mt-5">
                            <input type="checkbox" id="switchInput">
                            <span class="slider round">
                                <span class="bi bi-check"></span> <!-- Ícono de check de Bootstrap Icons -->
                            </span>
                        </label>
                        <div class="col-2">
                            <img class="pt-2" src="./css/assets/vangogh.png" alt="" height="100px">
                        </div>
                        <div class="col-8 ms-3">
                            <h6>Pintura en oleo</h6>
                            <samll style="color:#72706e;">Producto</samll>
                            <div class="d-flex align-items-center">
                                <button class="cantidadCarrito btn btn-sm  me-2">-</button>
                                <span>2</span>
                                <button class="cantidadCarrito btn btn-sm ms-2">+</button>
                            </div>
                        </div>
                        <div class="col-3 ms-auto">
                            <label class="form-label">$150 MXN</label>
                        </div>
                    </div>
                    <div class="row border-top">
                        <!-- Interruptor de bolita -->
                        <label class="switch mt-5">
                            <input type="checkbox" id="switchInput">
                            <span class="slider round">
                                <span class="bi bi-check"></span> <!-- Ícono de check de Bootstrap Icons -->
                            </span>
                        </label>

                        <div class="col-2">
                            <img class="pt-2" src="./css/assets/vangogh.png" alt="" height="100px">
                        </div>
                        <div class="col-8 ms-3">
                            <h6>Pintura en oleo</h6>
                            <samll style="color:#72706e;">Cotización</samll>
                            <div class="d-flex align-items-center">
                                <button class="cantidadCarrito btn btn-sm  me-2">-</button>
                                <span>2</span>
                                <button class="cantidadCarrito btn btn-sm ms-2">+</button>
                            </div>
                        </div>
                        <div class="col-3 ms-auto">
                            <label class="form-label">$150 MXN</label>
                        </div>
                    </div>
                    <div class="row border-top">
                        <div class="col-8 ms-3 pt-1">
                            <samll style="color:#72706e;">Suma Total:</samll>
                        </div>
                        <div class="col-3 ms-auto bt-5  pt-1">
                            <label style="color:#72706e;" class="form-label">$150 MXN</label>
                        </div>
                    </div>

                    <div class="row mt-3 mb-3 align-items-center">
                        <div class="col-12">
                            <a href="06_Pago.php" class="btn btn-secondary w-100">Hacer pago</a>

                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-xxl-6 col-md-12">
                    <img style=" width:100%;" src="./css/assets/online-shopping.png" class="img-pay"
                        alt="">
                </div>
            </div>
        </div>
    </main>


    <!-- Footer -->
    <?php include('./components/footer.php'); ?>

    <?php include_once "./libs/jqueryJS.php" ?>
    <?php include_once "./libs/bootstrapJS.php" ?>
    <?php include_once "./libs/sweetalertJS.php" ?>
    <script src="./js/Carrito.js"></script>

</body>

</html>