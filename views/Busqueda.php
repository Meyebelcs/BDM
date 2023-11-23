<?php
session_start();

if (empty($_GET['searchBar']) && empty($_GET['idCategoria'])) {
    header('Location: home.php');
    exit;
}

require_once './components/menu.php';

require_once "../models/Reportes/POV_ReportesVendedor.php";
require_once "../models/Archivo.php";
require_once "../models/Material_Inventario.php";


if (!empty($_GET['searchBar'])) {
    $busqueda = $_GET['searchBar'];
    $productosStock = POV_ReportesVendedor::getAllProductsFiltro($mysqli, 0, null, null, 0, $busqueda, 0, 'Stock');
    $productosCotizacion = POV_ReportesVendedor::getAllProductsFiltro($mysqli, 0, null, null, 0, $busqueda, 0, 'Cotizacion');
}

if (!empty($_GET['idCategoria'])) {
    $categoria = $_GET['idCategoria'];
    $productosStock = POV_ReportesVendedor::getAllProductsFiltro($mysqli, 0, null, null, $categoria, null, 0, 'Stock');
    $productosCotizacion = POV_ReportesVendedor::getAllProductsFiltro($mysqli, 0, null, null, $categoria, null, 0, 'Cotizacion');

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda</title>

    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/busqueda.css">


</head>

<body>

    <!-- navbar.php -->
    <?php include('./components/navbar.php'); ?>

    <main m-0 p-0 class="background">

        <!-- Hero -->


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
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mx-3 justify-content-center">

                    <?php
                    if ($productosStock) {
                        foreach ($productosStock as $producto) { ?>
                            <div class=" col border mx-3 mb-3 " style="width: 20rem;">
                                <div class="card" style="width: 100%;">
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($producto->getImagen()); ?>"
                                        class="card-img card-img-top" alt="Imagen actual" style="width: 300px; height: 300px;">
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
                                            <?php echo $producto->getCantidadVendida(); ?>
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

                                        <?php
                                        if ($rol != 'Vendedor') { ?>
                                            <div style="position: absolute; bottom: 10px; right: 10px;">
                                                <i class="bi bi-heart" style="margin-right: 10px; font-size: 24px;"></i>
                                                <i class="bi bi-plus-circle ml-2" style="font-size: 24px;"></i>
                                            </div>
                                        <?php } ?>



                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="col border mx-3 mb-6 mt-6 " style="width: 20rem; background:  #B7CBBF;  margin: 5rem;">
                            No hay productos con esas características
                        </div>
                    <?php } ?>



                </div>
            </div>
            <div class="productosCotizacion">
                <!-- Cards COTIZACION--------->

                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mx-3 justify-content-center">

                    <?php
                    if ($productosCotizacion) {
                        foreach ($productosCotizacion as $cotizacion) { ?>
                    <div class="card border mb-5" style="width: 50rem; ">
                        <div class="card-body">
                            <div class="d-flex justify-content-center mb-3">
                                <?php
                                $archivos = Archivo::getArchivoByProduct($mysqli, $cotizacion->getIdProducto());
                                foreach ($archivos as $imagen) { ?>

                                <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen->getArchivo()); ?>"
                                    class="card-img card-img-top mx-auto" alt="<?php echo $cotizacion->getNombre(); ?>"
                                    style="width: 20%;">

                                <?php } ?>
                            </div>
                            <h5 class="card-title mb-1">
                                <?php echo $cotizacion->getNombre(); ?>
                            </h5>
                            <small class="card-text mb-1">
                                <?php echo $cotizacion->getDescripcion(); ?>
                            </small><br>
                            <?php
                            $categoriasbyproduct = Categoria::GetCategoriasPorProducto($mysqli, $cotizacion->getIdProducto());

                            foreach ($categoriasbyproduct as $category) { ?>
                            <small class="card-text mb-1">
                                <strong> #
                                    <?php echo $category->getNombre(); ?>
                                </strong>
                            </small>
                            <?php } ?>
                            <hr class="mt-2">
                            <p class="card-text mb-1">Cantidad Vendida:
                                <?php echo $cotizacion->getCantidadVendida(); ?>
                            </p>
                            <?php
                            $calif = $cotizacion->getPromedioCalificacion();
                            for ($i = 1; $i <= 5; $i++) {
                                if ($calif >= $i) {
                                    echo '<i class="bi bi-star-fill"></i>';
                                } else {
                                    echo '<i class="bi bi-star"></i>';
                                }
                            }
                            ?>
                            <div class="card-body">
                                <table style="width:100%;">
                                    <tr>
                                        <td style="text-align: center;">
                                            <p class="card-text mb-1"><strong>Materiales</strong></p>
                                            <?php
                                            $materialesbyproduct = MaterialInventario::GetMaterialesPorProducto($mysqli, $cotizacion->getIdProducto());
                                            foreach ($materialesbyproduct as $material) { ?>
                                            <p class="card-text mb-1" style="color:  #F4BFAD;">
                                                <strong>
                                                    <?php echo $material->getNombre() ?>
                                                </strong>
                                            </p>
                                            <?php } ?>
                                        </td>
                                        <td style="text-align: center;">
                                            <p class="card-text mb-1"><strong>Cantidad</strong></p>
                                            <?php
                                            foreach ($materialesbyproduct as $material) { ?>
                                            <p class="card-text mb-1">
                                                <?php echo $material->getCantidad() ?>
                                            </p>
                                            <?php } ?>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <a href="Detalle_producto.php?idProductoIndex=<?php echo $cotizacion->getIdProducto(); ?>"
                                class="btn btn-secondary mb-1" id="">Ver Detalles</a>

                            <?php
                            if ($rol != 'Vendedor') { ?>
                            <div style="position: absolute; bottom: 10px; right: 10px;">
                                <i class="bi bi-heart" style="margin-right: 10px; font-size: 24px;"></i>
                                <i class="bi bi-plus-circle ml-2" style="font-size: 24px; padding-right:1rem;"></i>
                            </div>
                            <?php } ?>

                        </div>
                    </div>
                    <?php }
                    } else { ?>
                    <div class="col border mx-3 mb-6 mt-6 " style="width: 24rem; background:  #B7CBBF;  margin: 5rem;">
                        Aún no hay cotizaciones con estas características
                    </div>
                    <?php } ?>
                </div>

                <div aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item">
                            <a class="page-link" href="#" aria-label="Next">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>
                    </ul>
                </div>


            </div>

            <!-- Footer -->
            <?php include('./components/footer.php'); ?>

            <?php include_once "./libs/jqueryJS.php" ?>
            <?php include_once "./libs/bootstrapJS.php" ?>
            <?php include_once "./libs/sweetalertJS.php" ?>
            <script src="./js/Busqueda.js"></script>



    </main>


</body>

</html>