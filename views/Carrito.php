<?php
session_start();

require_once './components/menu.php';
require_once "../models/Carrito.php";

$productosStock = Carrito::getAllProductsCarrito($mysqli, $idUser, 5);
$productosCotizacion = Carrito::getAllProductsCarrito($mysqli, $idUser, 6);

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

                    <div class="collapse paymethod-checked"></div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h4>Productos en Stock</h4>
                        </div>
                    </div>

                    <?php
                    if ($productosStock) {
                        foreach ($productosStock as $producto) {
                            ?>
                            <div class="row border-top">
                                <!-- Interruptor de bolita -->
                                <label class="switch mt-5">
                                    <input type="checkbox" id="switchInputProducto<?php echo $producto->getIdCarrito(); ?>"
                                        onchange="actualizarTotal()">
                                    <span class="slider round">
                                        <span class="bi bi-check"></span> <!-- Ícono de check de Bootstrap Icons -->
                                    </span>
                                </label>
                                <div class="col-2">
                                    <img class="pt-2"
                                        src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>" alt=""
                                        height="100px">
                                </div>
                                <div class="col-8 ms-3">
                                    <h6>
                                        <?php echo $producto->getNombre(); ?>
                                    </h6>
                                    <small style="color:#72706e;">Producto</small>
                                    <!--                + y -           -->
                                    <div class="d-flex align-items-center">
                                        <button class="cantidadCarrito btn btn-sm  me-2"
                                            onclick="restarCantidad(<?php echo $producto->getIdCarrito(); ?>)">-</button>
                                        <span>
                                            <?php echo $producto->getCantidad(); ?>
                                        </span>
                                        <button class="cantidadCarrito btn btn-sm ms-2"
                                            onclick="sumarCantidad(<?php echo $producto->getIdCarrito(); ?>)">+</button>
                                    </div>
                                </div>
                                <div class="col-3 ms-auto">
                                    <label class="form-label" id="precioProducto<?php echo $producto->getIdCarrito(); ?>">
                                        $
                                        <?php echo $producto->getPrecioUnitario(); ?> MXN
                                    </label>
                                </div>
                                <div class="col-3 ms-auto">
                                    <label class="form-label"
                                        id="SubtotalprecioProducto<?php echo $producto->getIdCarrito(); ?>">
                                        $
                                        <?php echo $producto->getSubtotal(); ?> MXN
                                    </label>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                    <!-- ------------cotizacion--------------- -->
                    <div class="row mb-3">
                        <div class="col-md-12">
                            <h4>Cotizaciones</h4>
                        </div>
                    </div>

                    <?php
                    if ($productosCotizacion) {
                        foreach ($productosCotizacion as $producto) {
                            ?>
                            <div class="row border-top">
                                <!-- Interruptor de bolita -->
                                <label class="switch mt-5">
                                    <input type="checkbox" id="switchInputCotizacion<?php echo $producto->getIdCarrito(); ?>"
                                        onchange="actualizarTotal()">
                                    <span class="slider round">
                                        <span class="bi bi-check"></span> <!-- Ícono de check de Bootstrap Icons -->
                                    </span>
                                </label>
                                <div class="col-2">
                                    <img class="pt-2"
                                        src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>" alt=""
                                        height="100px">
                                </div>
                                <div class="col-8 ms-3">
                                    <h6>
                                        <?php echo $producto->getNombre(); ?>
                                    </h6>
                                    <small style="color:#72706e;">Cotización</small>
                                    <!--                + y -           -->
                                    <div class="d-flex align-items-center">
                                        <button class="cantidadCarrito btn btn-sm  me-2"
                                            onclick="restarCantidad(<?php echo $producto->getIdCarrito(); ?>)">-</button>
                                        <span>
                                            <?php echo $producto->getCantidad(); ?>
                                        </span>
                                        <button class="cantidadCarrito btn btn-sm ms-2"
                                            onclick="sumarCantidad(<?php echo $producto->getIdCarrito(); ?>)">+</button>
                                    </div>

                                </div>
                                <div class="col-3 ms-auto">
                                    <label class="form-label" id="precioCotizacion<?php echo $producto->getIdCarrito(); ?>">
                                        $
                                        <?php echo $producto->getPrecioUnitario(); ?> MXN
                                    </label>
                                </div>
                                <div class="col-3 ms-auto">
                                    <label class="form-label"
                                        id="SubtotalprecioCotizacion<?php echo $producto->getIdCarrito(); ?>">
                                        $
                                        <?php echo $producto->getSubtotal(); ?> MXN
                                    </label>
                                </div>
                            </div>
                            <?php
                        }
                    }
                    ?>

                    <div class="row border-top">
                        <div class="col-8 ms-3 pt-1">
                            <small style="color:#72706e;">Subtotal Stock:</small>
                        </div>
                        <div class="col-3 ms-auto bt-5  pt-1">
                            <label style="color:#72706e;" class="form-label" id="totalStock">$0 MXN</label>
                        </div>
                    </div>

                    <div class="row border-top">
                        <div class="col-8 ms-3 pt-1">
                            <small style="color:#72706e;">Subtotal Cotizaciones:</small>
                        </div>
                        <div class="col-3 ms-auto bt-5  pt-1">
                            <label style="color:#72706e;" class="form-label" id="totalCotizacion">$0 MXN</label>
                        </div>
                    </div>

                    <div class="row border-top">
                        <div class="col-8 ms-3 pt-1">
                            <small style="color:#72706e;">Total:</small>
                        </div>
                        <div class="col-3 ms-auto bt-5  pt-1">
                            <label style="color:#72706e;" class="form-label" id="Total">$0 MXN</label>
                        </div>
                    </div>

                    <div class="row mt-3 mb-3 align-items-center">
                        <div class="col-12">
                            <a class="btn btn-secondary w-100" id="PagoClic">Hacer pago</a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-xxl-6 col-md-12">
                    <img style=" width:100%;" src="./css/assets/online-shopping.png" class="img-pay" alt="">
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <?php include('./components/footer.php'); ?>

    <?php include_once "./libs/jqueryJS.php" ?>
    <?php include_once "./libs/bootstrapJS.php" ?>
    <?php include_once "./libs/sweetalertJS.php" ?>

    <script>
        actualizarTotal();
        function actualizarTotal() {
            // Inicializar los totales
            let subtotalStock = 0;
            let subtotalCotizacion = 0;

            // Actualizar subtotal de productos en stock
            <?php
            if ($productosStock) {
                foreach ($productosStock as $producto) {
                    ?>
                    if (document.getElementById('switchInputProducto<?php echo $producto->getIdCarrito(); ?>').checked) {
                        subtotalStock += <?php echo $producto->getSubtotal(); ?>;
                    }
                    <?php
                }
            }
            ?>

            // Actualizar subtotal de productos en cotización
            <?php
            if ($productosCotizacion) {
                foreach ($productosCotizacion as $producto) {
                    ?>
                    if (document.getElementById('switchInputCotizacion<?php echo $producto->getIdCarrito(); ?>').checked) {
                        subtotalCotizacion += <?php echo $producto->getSubtotal(); ?>;
                    }
                    <?php
                }
            }
            ?>

            // Mostrar los subtotales actualizados en la interfaz
            document.getElementById('totalStock').innerHTML = '$' + subtotalStock.toFixed(2) + ' MXN';
            document.getElementById('totalCotizacion').innerHTML = '$' + subtotalCotizacion.toFixed(2) + ' MXN';

            // Calcular y mostrar el total general
            let total = subtotalStock + subtotalCotizacion;
            document.getElementById('Total').innerHTML = '$' + total.toFixed(2) + ' MXN';
        }


        //-----------------VALIDACION DE PAGO----------
        function validarSeleccion() {
            let productosSeleccionados = [];

            // Verificar productos en stock seleccionados
            <?php
            if ($productosStock) {
                foreach ($productosStock as $producto) {
                    ?>
                    if (document.getElementById('switchInputProducto<?php echo $producto->getIdCarrito(); ?>').checked) {
                        productosSeleccionados.push(<?php echo $producto->getIdCarrito(); ?>);
                    }
                    <?php
                }
            }
            ?>

            // Verificar productos en cotización seleccionados
            <?php
            if ($productosCotizacion) {
                foreach ($productosCotizacion as $producto) {
                    ?>
                    if (document.getElementById('switchInputCotizacion<?php echo $producto->getIdCarrito(); ?>').checked) {
                        productosSeleccionados.push(<?php echo $producto->getIdCarrito(); ?>);
                    }
                    <?php
                }
            }
            ?>

            // Redirigir a la página de pago con los ID de carritos seleccionados
            if (productosSeleccionados.length === 0) {
                Swal.fire({
                    title: 'Error',
                    text: 'Debes seleccionar al menos un producto antes de hacer el pago.',
                    icon: 'error',
                    confirmButtonText: 'Aceptar',
                    confirmButtonColor: '#F47B8F'
                });
            } else {
                // Construir la URL con los ID seleccionados
                let url = "Pago.php?idCarritos=" + productosSeleccionados.join(',');

                // Redirigir a la página de pago
                window.location.href = url;
            }
        }

        document.getElementById('PagoClic').addEventListener('click', function (event) {
            event.preventDefault();
            validarSeleccion(); // Llama a función de validación


        });
    </script>


    <script src="./js/Carrito.js"></script>

</body>

</html>