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
    <title>Pago</title>

    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/POV_Perfil.css">

</head>

<body>

    <!-- navbar.php -->
    <?php include('./components/navbar.php'); ?>

    <main m-0 p-0 class="background">
        <!-- Contenido -->
        <div class="container mt-5">
            <div class="row d-flex">
                <form id="payment-form" class="col-xxl-6 col-lg-5 col-md-12 col-sm-12">
                    <input type="hidden" name="idNivel" value="">
                    <div class="row mt-3 mb-3 text-center">
                        <div class="col-12">
                            <h4>Método de pago</h4>
                        </div>
                    </div>

                    <div class="row mt-3 mb-3">
                        <div class="col-12">
                            <div class="form-check" data-bs-toggle="collapse" data-bs-target=".paymethod-checked"
                                aria-controls="paypal-checked" aria-expanded="false">
                                <input class="form-check-input" type="radio" name="paymethod" id="card-paymethod"
                                    checked>
                                <label class="form-check-label" for="card-paymethod">
                                    Tarjeta de crédito/debito
                                </label>
                            </div>
                            <div class="form-check" data-bs-toggle="collapse" data-bs-target=".paymethod-checked"
                                aria-controls="paypal-checked" aria-expanded="false">
                                <input class="form-check-input" type="radio" name="paymethod" id="paypal-paymethod">
                                <label class="form-check-label" for="paypal-paymethod">
                                    Paypal
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="collapse show paymethod-checked">
                        <div class="row mb-2">
                            <div class="col-6">
                                <label for="inputEmail4" class="form-label">Nombre de la tarjeta</label>
                                <input type="text" class="form-control bg-light shadow-none" id="card-name-input">
                                <span class="text-danger" id="card_name_error_message"></span><br>
                            </div>
                            <div class="col-6">
                                <label for="inputEmail4" class="form-label">CURP</label>
                                <input type="text" class="form-control bg-light shadow-none" id="curp-input">
                                <span class="text-danger" id="curp_error_message"></span><br>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col-12">
                                <label for="inputEmail4" class="form-label">Número de tarjeta</label>
                                <input type="number" class="form-control" id="card-number-input"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                    onpaste="return false;">
                                <span class="text-danger" id="card_number_error_message"></span><br>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-4">
                                <label for="inputEmail4" class="form-label">CVC/CVV</label>
                                <input type="number" class="form-control" id="card-cvv-input"
                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                    onpaste="return false;">
                                <span class="text-danger" id="card_cvv_error_message"></span><br>
                            </div>
                            <div class="col-8">
                                <label class="form-label">Fecha de vencimiento</label>
                                <div class="d-flex">
                                    <label for="" class="me-2">Mes: </label>
                                    <input id="exp-month" name="exp-month" type="text"
                                        class="bg-light form-control shadow-none" id="expiration-month-input"
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                        onpaste="return false;" minlength="2" maxlength="2" placeholder="MM">
                                    <label for="" class="me-2 ms-3">Año: </label>
                                    <input id="exp-year" name="exp-year" type="text"
                                        class="bg-light form-control shadow-none " id="expiration-year-input"
                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                        onpaste="return false;" minlength="4" maxlength="4" placeholder="YYYY">
                                </div>
                                <span class="text-danger" id="expiration_date_error_message"></span><br>
                            </div>
                        </div>
                    </div>
                    <div class="collapse paymethod-checked">

                    </div>
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h4>Detalles del pedido</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-2">
                            <img src="./css/assets/vangogh.png" alt="" height="50px">
                        </div>
                        <div class="col-8 ms-3">
                            <label for="inputEmail4" class="form-label">Pintura en oleo</label>
                        </div>
                        <div class="col-3 ms-auto">
                            <label for="inputEmail4" class="form-label">$150 MXN</label>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3 align-items-center">
                        <div class="col-12">
                            <button type="submit" id="pay-btn" idCurso="" total_pago=""
                                class="btn btn-secondary w-100">Hacer pago</button>
                        </div>
                    </div>
                </form>
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
    <script src="./js/POV_Perfil_Cliente.js"></script>

</body>

</html>