<?php
session_start();

if (!isset($_SESSION["AUTH"])) {
    header("Location: landingPage.php");
    exit;
}

require_once "../models/User.php";
require_once "../db.php";
$idUser = $_SESSION["AUTH"];
$mysqli = db::connect();
$user = User::findUserById($mysqli, (int) $idUser);

/* ---------Reedireccionamiento a perfil------------ */
$rol = $user->getRol();
$urlPerfil = '';

if ($rol == 'Vendedor') {
    $urlPerfil = "POV_Perfil_Vendedor.php";
} else if ($rol == 'Comprador') {
    header("Location: home.php");
    exit;

} else if ($rol == 'Administrador') {
    header("Location: home.php");
    exit;
}

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

    <div class="container">
        <div class="d-flex align-items-center search-bar">

            <div class="btn-menu">
                <label for="btn-menu">☰</label>
            </div>

            <form action="Search.php" method="GET" class="input-group">

                <div class="navbar d-flex justify-content-between">
                    <a href="home.php" class="me-5 navbar-brand text-decoration-none">Stock & Custom</a>
                </div>

                <input class="form-control" type="search" name="searchBar" placeholder="Search" aria-label="Search">
                <button type="submit" class="btn btn-secondary">Buscar</button>
            </form>
            <!-- Fin de la barra de búsqueda -->

            <div class="custom-dropdown">
                <div class="dropdown">
                    <button class="btn text-light border-0 d-flex" type="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        Categorias <i class="ms-2 bi bi-caret-down-fill"></i>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="">Electronica</a></li>
                        <li><a class="dropdown-item" href="">Carpintería</a></li>
                        <li><a class="dropdown-item" href="">Belleza</a></li>
                    </ul>
                </div>
            </div>

            <div class="mt-2">
                <a class="btn text-light border-0 d-flex" type="button" href="chat.php">
                    <i class="bi bi-chat-dots-fill"></i>
                </a>
            </div>
            <div class="dropdown mt-2">
                <button class="btn border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php
                    $userImage = "../Files/" . $user->getImagen(); // Ruta de la imagen de perfil
                    $username = $user->getUsername();
                    ?>
                    <img src="<?= $userImage ?>" alt="<?= $username ?>" width="35" height="35" class="rounded-circle">
                    <?= $username ?>
                </button>
            </div>

        </div>


    </div>

    <div class="capa"></div>

    <input type="checkbox" id="btn-menu">
    <div class="container-menu">
        <div class="cont-menu">
            <label for="btn-menu">✖️</label>
            <nav>

                <a href=<?php echo $urlPerfil ?>>Cuenta</a>
                <a href="07_Carrito.php">Carrito</a>
                <a href="chat.php">Chat</a>
                <a href="03_Perfil_Cliente.php">Mis Compras</a>
                <a href="02_Perfil_Vendedor.php">Mis Ventas</a>
                <a href="../controllers/logout.php">Salir</a>
            </nav>

        </div>
    </div>


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
                                    <a class="btn btn-secondary mb-3" href="agregar-curso.php">Agregar Producto</a>

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
                        <option value="3">Pintura</option>
                        <option value="2">Electronica</option>
                        <option value="1">Perros</option>
                    </select>
                </div>
            </div>

            <div class="row mt-3 pb-3">
                <div class="pb-3 d-flex col-xs-12 col-sm-12 col-md-12 col-lg-6 ">
                    <label for="nombreProducto" class="form-label" style="white-space: nowrap;">Nombre del
                        Producto:</label>
                    <input id="nombreProducto" type="text" class="form-control">
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
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>



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
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>



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
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>



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
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>



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
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>



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
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>


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
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>



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
                                    <p class="card-text mb-1">Total de Ingresos: $750.00</p>
                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>



                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="productosCotizacion">
                    <!-- Cards COTIZACION--------->

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 mx-3 justify-content-center">
                        <div class="card border mb-5" style="width: 50rem; ">
                            <div class="card-body">
                                <div class="d-flex justify-content-center mb-3">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                </div>
                                <h5 class="card-title mb-1">Pintura de oleo</h5>
                                <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                <hr class="mt-2">
                                <p class="card-text mb-1">Paleta de colores: Azul y Amarillo</p>
                                <p class="card-text mb-1">Tamaños: 20x20</p>
                                <p class="card-text mb-1">Cantidad Vendida: 2</p>
                                <p class="card-text mb-1">Precio: $650</p>
                                <a href="" class="btn btn-secondary mb-1 mt-2" id="">Ver detalles</a>
                            </div>
                        </div>
                        <div class="card border mb-5" style="width: 50rem; ">
                            <div class="card-body">
                                <div class="d-flex justify-content-center mb-3">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                </div>
                                <h5 class="card-title mb-1">Pintura de oleo</h5>
                                <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                <hr class="mt-2">
                                <p class="card-text mb-1">Paleta de colores: Azul y Amarillo</p>
                                <p class="card-text mb-1">Tamaños: 20x20</p>
                                <p class="card-text mb-1">Cantidad Vendida: 2</p>
                                <p class="card-text mb-1">Precio: $650</p>
                                <a href="" class="btn btn-secondary mb-1 mt-2" id="">Ver detalles</a>
                            </div>
                        </div>
                        <div class="card border mb-5" style="width: 50rem; ">
                            <div class="card-body">
                                <div class="d-flex justify-content-center mb-3">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                    <img src="./css/assets/vangogh.png" class="card-img card-img-top mx-auto"
                                        alt="Imagen actual" style="width: 20%;">
                                </div>
                                <h5 class="card-title mb-1">Pintura de oleo</h5>
                                <small class="card-text mb-1">Pintura inspirada en el arte de Van Gogh</small>
                                <hr class="mt-2">
                                <p class="card-text mb-1">Paleta de colores: Azul y Amarillo</p>
                                <p class="card-text mb-1">Tamaños: 20x20</p>
                                <p class="card-text mb-1">Cantidad Vendida: 2</p>
                                <p class="card-text mb-1">Precio: $650</p>
                                <a href="" class="btn btn-secondary mb-1 mt-2" id="">Ver detalles</a>
                            </div>
                        </div>
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
                                <th scope="col">Método de pago</th>
                                <th scope="col">Total de ingresos</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">Tarjeta de crédito/débito</th>
                                <th scope="col" id="creditCard-ingresos"> $42,394 mxn</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th scope="row">Paypal</th>
                                <th scope="col" id="paypal-ingresos"> $20,394 mxn</th>
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
                    <form action="" id="change-photo-form"  method="post" enctype="multipart/form-data">
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

        <!-- Footer -->
        <div class="container-fluid footer bg-primary">
            <footer class="py-3 footer">
                <div class="col-md-4 d-flex align-items-center">
                    <span class="mb-3 mb-md-0">&copy; 2023 Stuck & Custom. Todos los derechos reservados.</span>
                </div>
            </footer>
        </div>

        <?php include_once "./libs/sweetalertJS.php" ?>
        <?php include_once "./libs/jqueryJS.php" ?>
        <?php include_once "./libs/swiperJS.php" ?>
        <?php include_once "./libs/bootstrapJS.php" ?>
        <script src="./js/POV_Perfil_Vendedor.js"></script>
        <script src="./js/Profile_edition.js"></script>


    </main>
</body>

</html>