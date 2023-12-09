<!-- NOOO HA SIDO PROGRAMADA -->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<?php
session_start();

require_once './components/menu.php';

require_once "../models/Reportes/POV_Reportes.php";
require_once "../models/Lista.php";
require_once "../models/Archivo.php";
require_once "../models/Material_Inventario.php";

if (empty($_GET['idUsuarioSelected'])) {
    header("Location: home.php");
    exit;
}
$idUsuarioSelected = $_GET['idUsuarioSelected'];
$UserInfo = User::findUserById($mysqli, (int) $idUsuarioSelected);
$productosStock = POV_ReportesVendedor::getProductsbyVendedor($mysqli, $idUser, 'Stock');
$productosCotizacion = POV_ReportesVendedor::getProductsbyVendedor($mysqli, $idUser, 'Cotizacion');


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil Vendedor</title>

    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/Perfil_Vendedor.css">


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
                        <?php
                        $userImage = "../Files/" . $user->getImagen(); // Ruta de la imagen de perfil
                        $username = $user->getUsername();
                        ?>
                        <img src="<?= $userImage ?>" alt="<?= $username ?>" id="foto_perfil" class="img-hero" alt="">
                    </div>
                    <div class="col-12 text-center">
                        <h4 id="nombre_Inst">
                            <?php echo $UserInfo->getNombres() . " " . $UserInfo->getApellidos(); ?>
                        </h4>
                        <h6>
                            <?php echo "@" . $user->getUsername(); ?>
                        </h6>
                    </div>

                </div>
            </div>
        </div>

        <div class="text-center mb-3">
            <h3 class="border-bottom p-2 pt-3" id="switchText">Productos en Stock</h3>
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
                                        class="card-img card-img-top" alt="  <?php echo $producto->getNombre(); ?>"
                                        style="width: 300px; height: 300px;">
                                    <div class="card-body">
                                        <h5 class="card-title mb-1">
                                            <?php echo $producto->getNombre(); ?>
                                        </h5>
                                        <small class="card-text mb-1">
                                            <?php echo $producto->getDescripcion(); ?><br>
                                        </small>
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
                                        <p class="card-text mb-1">Inventario:
                                            <?php echo $producto->getInventario(); ?>
                                        </p>
                                        <p class="card-text mb-1">Fecha de publicación:
                                            <?php echo $producto->getFecha(); ?>
                                        </p>

                                        <a href="Detalle_producto.php?idProductoIndex=<?php echo $producto->getIdProducto(); ?>"
                                            class="btn btn-secondary mb-1" id="">Ver detalles</a>

                                        <?php
                                        if ($rol != 'Vendedor') { ?>

                                            <div style="position: absolute; bottom: 10px; right: 10px;">

                                                <i class="bi bi-plus-circle ml-2" id="addListPlus"
                                                    style="font-size: 24px; padding-right:1rem;"
                                                    data-producto-id="<?php echo $producto->getIdProducto(); ?>"
                                                    data-bs-toggle="modal" data-bs-target="#addList"></i>

                                            </div>
                                        <?php } ?>


                                    </div>
                                </div>
                            </div>
                        <?php }
                    } else { ?>
                        <div class="col border mx-3 mb-6 mt-6 " style="width: 20rem; background:  #B7CBBF;  margin: 5rem;">
                            Aún no hay productos registrados
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
                            <div class="d-flex justify-content-center mb-3" style="background: #B7CBBF; padding:1rem">
                                <?php

                                $archivos = Archivo::getArchivoByProduct($mysqli, $cotizacion->getIdProducto());
                                foreach ($archivos as $imagen) { ?>
                                <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen->getArchivo()); ?>"
                                    class="card-img card-img-top mx-auto" alt=" <?php echo $cotizacion->getNombre(); ?>"
                                    style="width: 20%;">

                                <?php } ?>

                            </div>
                            <h5 class="card-title mb-1">
                                <?php echo $cotizacion->getNombre(); ?>
                            </h5>
                            <small class="card-text mb-1">
                                <?php echo $cotizacion->getDescripcion(); ?> <br>
                            </small>

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
                            <div class="card-body">
                                <table style="width:100%;">
                                    <tr>
                                        <td style="text-align: left;">
                                            <p class="card-text mb-1">Cantidad Vendida:
                                                <?php echo $cotizacion->getCantidadVendida(); ?>
                                            </p>
                                           
                                            <p class="card-text mb-1">Fecha de publicación:
                                                <?php echo $cotizacion->getFecha(); ?>
                                            </p>
                                            <p class="card-text mb-1">Hora de publicación:
                                                <?php echo $cotizacion->getHora(); ?>
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
                                        </td>
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



                            <hr class="mt-2">
                            <a href="Detalle_producto.php?idProductoIndex=<?php echo $cotizacion->getIdProducto(); ?>"
                                class="btn btn-secondary mb-1 mt-2" id="">Ver
                                detalles</a>
                        </div>
                    </div>
                    <?php }
                    } else { ?>
                    <div class="col border mx-3 mb-6 mt-6 " style="width: 20rem; background:  #B7CBBF;  margin: 5rem;">
                        Aún no hay cotizaciones registradas
                    </div>
                    <?php } ?>


                </div>

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

        <!-- Modal Añadir lista-->
        <div class="modal fade" id="addList" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form id="add-material" class="modal-content">
                    <input type="hidden" name="formulario" value="addList-form">
                    <div class="modal-header">
                        <h4>Agregar a una Lista</h4>
                    </div>
                    <div class="modal-body">

                        <div class="container mt-1">
                            <select class="form-control" id="nombreList" name="nombreList">
                                <option value="" selected disabled>Selecciona una Lista</option>
                                <?php
                                $listasbyuser = Lista::getlistasbyUser($mysqli, $idUser);
                                foreach ($listasbyuser as $lista) { ?>
                                    <option value="<?php echo $lista->getNombre() ?>"
                                        id="<?php echo $lista->getIdLista() ?>">
                                        <?php echo $lista->getNombre() ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <span class="text-danger" id="lista_name_error_message"></span><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                            id="close">Cerrar</button>
                        <button type="button" id="add-lista-btn" class="btn btn-secondary">Agregar
                            Producto</button>
                        <span class="text-danger" id="lista_error_message"></span><br>
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <?php include('./components/footer.php'); ?>

        <?php include_once "./libs/jqueryJS.php" ?>
        <?php include_once "./libs/bootstrapJS.php" ?>
        <?php include_once "./libs/sweetalertJS.php" ?>
        <script src="./js/Perfil_Vendedor.js"></script>
        <script src="./js/Agregar_ProductoEnLista.js"></script>


    </main>


</body>

</html>