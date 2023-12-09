<?php
session_start();

$perfil = "PerfilVendedor";

require_once './components/POV_menu.php';

require_once "../models/Reportes/POV_Reportes.php";
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
    <title>Perfil Vendedor</title>

    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/POV_Perfil.css">
    <link rel="stylesheet" href="./css/pages/unpload.css">


</head>

<body>

    <!-- navbar.php -->
    <?php include('./components/navbar.php'); ?>


    <main m-0 p-0 class="background">

        <!-- Hero -->
        <div class="Hero">
            <div class="container-fluid bg-tertiary">
                <div class="profile_Section row p-4">
                    <div class="col-xl-2 col-md-4 col-sm-5 col-xs-12">

                        <?php
                        $userImage = "../Files/" . $user->getImagen(); // Ruta de la imagen de perfil
                        $username = $user->getUsername();
                        ?>
                        <img src="<?= $userImage ?>" alt="<?= $username ?>" id="foto_perfil" class="img-hero" alt="">
                    </div>
                    <div class="col-xl-10 col-md-8 col-sm-7 col-xs-12 m-auto">
                        <div class="container text-xs-center">
                            <div class="row">
                                <div class="col-12">
                                    <h4 id="nombre_Inst">
                                        <?php echo $user->getNombres() . " " . $user->getApellidos(); ?>
                                    </h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h6>
                                        <?php echo "@" . $user->getUsername(); ?>
                                    </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <h6 id="birthday">
                                        <?php $formattedFechaNacimiento = date('d \d\e F \d\e\l Y', strtotime($user->getFechaNacimiento()));
                                        echo $formattedFechaNacimiento; ?>
                                    </h6>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-12">
                                    <a class="btn btn-secondary mb-3" data-bs-toggle="modal"
                                        data-bs-target="#changePhoto">Cambiar foto</a>
                                    <a class="btn btn-secondary mb-3" data-bs-toggle="modal"
                                        data-bs-target="#editProfile">Editar perfil</a>
                                    <a class="btn btn-secondary mb-3" href="Alta_Producto.php">Agregar Producto</a>
                                    <a class="btn btn-secondary mb-3" href="Editar_Producto.php" data-bs-toggle="modal"
                                        data-bs-target="#editproducto">Editar Producto</a>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Contenido -->


        <div class="container">
            <div class="mb-3 border-bottom d-flex align-items-center">
                <h3 class="p-2 pt-3" id="switchText">Productos</h3>
                <!-- Interruptor de bolita -->
                <label class="switch">
                    <input type="checkbox" id="switchInput">
                    <span class="slider round"></span>
                </label>
            </div>
            <div class="row mt-3 pb-3">
                <div class="pb-3 d-flex col-xs-12 col-sm-6 col-md-6 col-lg-3 select-date">
                    <label for="fechaInicial" class="form-label me-3r">Fecha:</label>
                    <input id="fechaInicial" type="date" class="form-control w-50 buscar">
                </div>
                <div class="pb-3 d-flex col-xs-12 col-sm-6 col-md-6 col-lg-3 select-date">
                    <label for="hora" class="form-label me-3r">Hora:</label>
                    <input id="hora" type="time" class="form-control w-50 buscar">
                </div>
                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 select-box">
                    <label for="categoria" class="form-label">Categoria:</label>
                </div>
                <div class="col-lg-4 col-md-10 col-sm-10 col-xs-10 select-box">
                    <select id="categoria" class="form-select buscar">
                        <option value="" selected></option>
                        <?php foreach ($categorias as $categoria) { ?>
                            <option value="<?php echo $categoria['idCategoria']; ?>">
                                <?php echo $categoria['Nombre'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>

            <div class="row mt-3 pb-3">
                <div class="pb-3 d-flex col-xs-12 col-sm-12 col-md-12 col-lg-6 ">
                    <label for="nombreProducto" class="form-label" style="white-space: nowrap;">Nombre del
                        Producto:</label>
                    <input id="nombreProducto" type="text" class="form-control buscar">
                </div>
                <div class="col-lg-1 col-md-2 col-sm-2 col-xs-2 select-box">
                    <label for="calificacion" class="form-label">Calificación:</label>
                </div>
                <div class="col-lg-4 col-md-10 col-sm-10 col-xs-10 select-box">
                    <select id="calificacion" class="form-select buscar">
                        <option value="" selected></option>
                        <option value="5">5 estrellas</option>
                        <option value="4">4 estrellas</option>
                        <option value="3">3 estrellas</option>
                        <option value="2">2 estrellas</option>
                        <option value="1">1 estrella</option>
                    </select>
                </div>
            </div>



            <!-- Contenido -->
            <div class="container">

                <div class="productosStock" id="productosStock">
                    <!-- Cards -->
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mx-3 justify-content-center"
                        id="productosStockCard">

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
                                </div>
                            <?php }
                        } else { ?>
                            <div class="col border mx-3 mb-6 mt-6 "
                                style="width: 20rem; background:  #B7CBBF;  margin: 5rem;">
                                Aún no hay productos registrados
                            </div>
                        <?php } ?>

                    </div>
                </div>
                <div class="productosCotizacion">
                    <!-- Cards COTIZACION--------->

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mx-3 justify-content-center"
                        id="productosCotizacionCard">

                        <?php
                        if ($productosCotizacion) {
                            foreach ($productosCotizacion as $cotizacion) { ?>
                        <div class="card border mb-5" style="width: 50rem; ">
                            <div class="card-body">
                                <div class="d-flex justify-content-center mb-3"
                                    style="background: #B7CBBF; padding:1rem">
                                    <?php

                                    $archivos = Archivo::getArchivoByProduct($mysqli, $cotizacion->getIdProducto());
                                    foreach ($archivos as $imagen) { ?>
                                    <img src="data:image/jpeg;base64,<?php echo base64_encode($imagen->getArchivo()); ?>"
                                        class="card-img card-img-top mx-auto"
                                        alt=" <?php echo $cotizacion->getNombre(); ?>" style="width: 20%;">

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
                                                <p class="card-text mb-1">Total de Ingresos: $
                                                    <?php echo $cotizacion->getTotalIngresos(); ?>
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
                        <div class="col border mx-3 mb-6 mt-6 "
                            style="width: 20rem; background:  #B7CBBF;  margin: 5rem;">
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

            <!-- Ingresos -->

            <div class="container mb-4">
                <div class="row pt-4 pb-3">
                    <div class="col-lg-12">
                        <h4 class="ms-5">Total de ingresos</h4>
                    </div>
                </div>
                <div class="row ms-5 pe-4">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Tipo</th>
                                <th scope="col">Total de ingresos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Productos en Stock</th>
                                <th scope="col"> $
                                    <?php echo $VentasStock; ?> mxn
                                </th>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">Cotizaciones</th>
                                <th scope="col"> $
                                    <?php echo $VentasCotizacion; ?> mxn
                                </th>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Modal editar perfil-->
        <div class="modal fade" id="editProfile" tabindex="-1" aria-labelledby="edit-profile-title" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="edit-profile-title">Editar perfil</h4>
                    </div>
                    <form action="" id="edit-profile-modal">
                        <div class="modal-body">

                            <label for="edit-username" class="form-label">Nombre de Usuario</label>
                            <input type="text" class="form-control" id="edit-username" name="username"
                                value="<?php echo $user->getUsername(); ?>">
                            <span class="text-danger" id="fusername_error_message"></span><br>

                            <label for="edit-name" class="form-label">Nombres</label>
                            <input type="text" class="form-control" id="edit-name" name="name"
                                value="<?php echo $user->getNombres(); ?>">
                            <span class="text-danger" id="fname_error_message"></span><br>
                            <label for="edit-last-name" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" id="edit-last-name" name="edit-last-name"
                                value="<?php echo $user->getApellidos(); ?>">
                            <span class="text-danger" id="sname_error_message"></span><br>
                            <label for="edit-gender" class="form-label">Género</label>
                            <select class="form-select" id="edit-gender" name="edit-gender">
                                <?php
                                if ($user->getSexo() == 'Mujer') { ?>
                                    <option>Hombre</option>
                                    <option selected>Mujer</option>
                                    <option>Otro</option>
                                <?php } else if ($user->getSexo() == 'Hombre') { ?>
                                        <option selected>Hombre</option>
                                        <option>Mujer</option>
                                        <option>Otro</option>
                                <?php } else if ($user->getSexo() == 'Otro') { ?>
                                            <option>Hombre</option>
                                            <option>Mujer</option>
                                            <option selected>Otro</option>
                                <?php }
                                ?>
                            </select>
                            <span class="text-danger" id="gender_error_message"></span><br>

                            <div style="display: none;">
                                <label for="edit-mod" class="form-label">Modalidad</label>
                                <select class="form-select" id="edit-mod" name="edit-mod">
                                    <option>Privado</option>
                                    <option selected>Público</option>
                                </select>
                                <span class="text-danger" id="mod_error_message"></span><br>
                            </div>

                            <label for="edit-birthday" class="form-label">Fecha de nacimiento</label>
                            <input type="date" class="form-control" id="edit-birthday" name="edit-birthday"
                                min="1903-01-01" value="<?php echo $user->getFechaNacimiento(); ?>">
                            <span class="text-danger" id="birthday_error_message"></span><br>
                            <label for="edit-email" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" id="edit-email" name="edit-email"
                                value="<?php echo $user->getEmail(); ?>">
                            <span class="text-danger" id="email_error_message"></span><br>
                            <label for="edit-password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="edit-password" name="edit-password"
                                value="<?php echo $user->getContrasena(); ?>">
                            <span class="text-danger" id="password_error_message"></span><br>
                            <label for="retype-password" class="form-label">Confirmar Contraseña</label>
                            <input type="password" class="form-control" id="retype-password" name="retype-password">
                            <span class="text-danger" id="confirm_password_error_message"></span><br>
                            <span class="text-danger" id="modal_error_message"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-secondary" id="save-changes" name="save-changes">Save
                                changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Cambiar photo -->
        <div class="modal fade" id="changePhoto" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4>Cambiar foto</h4>
                    </div>
                    <form action="" id="change-photo-form" method="post" enctype="multipart/form-data">
                        <div class="modal-body">
                            <div class="wrapper">
                                <div class="box">
                                    <div class="input-bx">
                                        <label for="Upload" class="uploadlabel" id="img-holder">
                                            <span class=""><i class="bi bi-cloud-arrow-up-fill"></i></span>
                                            <p>Añade una imagen</p>
                                        </label>
                                        <img src="" id="preview-img" alt="">
                                        <input type="file" name="Upload" id="Upload" class="form-control mt-3">
                                        <span class="text-danger" id="photo_error_message"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button id="close-btn" type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Close</button>
                            <button id="save-btn" type="submit" class="btn btn-secondary">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Modal editar producto-->
        <div class="modal fade" id="editproducto" tabindex="-1" aria-labelledby="edit-producto-title"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="edit-profile-title">Editar producto</h4>
                    </div>
                    <form action="" id="edit-producto-modal">
                        <div class="modal-body">

                            <label for="" class="form-label">Productos</label>
                            <div class="container mt-1">
                                <select class="form-control" id="producto-edit-name" name="nameproductoeditname">
                                    <option value="" selected disabled>Selecciona un producto</option>
                                    <?php
                                    $productosStock = POV_ReportesVendedor::getProductsbyVendedor($mysqli, $idUser, 'Stock');

                                    foreach ($productosStock as $producto) { ?>
                                        <option value="<?php echo $producto->getNombre() ?>"
                                            id="<?php echo $producto->getIdProducto() ?>">
                                            <?php echo $producto->getNombre() ?>
                                        </option>
                                    <?php } ?>
                                    <?php
                                    $productosCotizacion = POV_ReportesVendedor::getProductsbyVendedor($mysqli, $idUser, 'Cotizacion');

                                    foreach ($productosCotizacion as $productoCoti) { ?>
                                        <option value="<?php echo $productoCoti->getNombre() ?>"
                                            id="<?php echo $productoCoti->getIdProducto() ?>">
                                            <?php echo $productoCoti->getNombre() ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <a href="#" class="btn btn-secondary" id="editButton" name="save-changes">Editar</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <?php include('./components/footer.php'); ?>

        <?php include_once "./libs/sweetalertJS.php" ?>
        <?php include_once "./libs/jqueryJS.php" ?>
        <?php include_once "./libs/swiperJS.php" ?>
        <?php include_once "./libs/bootstrapJS.php" ?>
        <script src="./js/POV_Perfil_Vendedor.js"></script>
        <script src="./js/Profile_edition.js"></script>
        <script>
            document.addEventListener("DOMContentLoaded", function () {

                var editButton = document.getElementById("editButton");
                var productoSelect = document.getElementById("producto-edit-name");

                editButton.addEventListener("click", function () {
                    var selectedValue = productoSelect.options[productoSelect.selectedIndex].value;
                    var selectedId = productoSelect.options[productoSelect.selectedIndex].id;

                    var redirectUrl = "Editar_Producto.php?idProductoSelected=" + selectedId;

                    window.location.href = redirectUrl;
                });
            });
        </script>

    </main>
</body>

</html>