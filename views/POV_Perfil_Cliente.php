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

$rol = $user->getRol();
$urlPerfil = '';

if ($rol == 'Vendedor') {
    $urlPerfil = "POV_Perfil_Vendedor.php";
} else if ($rol == 'Comprador') {
    $urlPerfil = "POV_Perfil_Cliente.php";
}


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
    <link rel="stylesheet" href="./css/pages/POV_Perfil_Cliente.css">

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
                    <img src="./css/assets/perfil.png" alt="<?= $user->getUsername() ?>" width="35" height="35"
                        class="rounded-circle">
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
                        <img src="./css/assets/perfil.png" id="foto_perfil" class="img-hero" alt="">
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
                                        <?php echo $user->getFechaNacimiento(); ?>
                                    </h6>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-2 col-md-4 col-sm-12 col-xs-12 d-flex align-items-center justify-content-center text-center"
                                    style="background-color: #B7CBBF;  border-radius: 34px; color: white;">
                                    <h6 class="p-1 pt-2" id="profile">
                                        <?php echo $user->getModo(); ?>
                                    </h6>
                                </div>
                            </div>



                            <div class="row mt-3">
                                <div class="col-12">
                                    <a class="btn btn-secondary mb-3" data-bs-toggle="modal"
                                        data-bs-target="#changePhoto">Cambiar foto</a>
                                    <a class="btn btn-secondary mb-3" data-bs-toggle="modal"
                                        data-bs-target="#editProfile">Editar perfil</a>
                                    <a class="btn btn-secondary mb-3" href="agregar-curso.php"> Crear Lista</a>

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
                <h3 class="p-2 pt-3" id="switchText">Productos Comprados</h3>
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
                <div class="pb-3 d-flex col-xs-12 col-sm-12 col-md-12 col-lg-4 ">
                    <label for="nombreProducto" class="form-label" style="white-space: nowrap;">Nombre del
                        Producto:</label>
                    <input id="nombreProducto" type="text" class="form-control">
                </div>
                <div class="pb-3  d-flex col-xs-12 col-sm-12 col-md-12 col-lg-2 ">
                    <label for="nombreProducto" class="form-label" style="white-space: nowrap;">Precio:</label>
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
                                    <p class="card-text mb-1">Cantidad: 2</p>
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Total: $300</p>
                                    <p class="card-text mb-1"> Diste una calificación de:</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <a href="" class="btn btn-secondary mb-1" id="">Ver Ticket</a>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles del Producto</a>



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
                                    <p class="card-text mb-1">Cantidad: 2</p>
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Total: $300</p>
                                    <p class="card-text mb-1"> Diste una calificación de:</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <a href="" class="btn btn-secondary mb-1" id="">Ver Ticket</a>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles del Producto</a>



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
                                    <p class="card-text mb-1">Cantidad: 2</p>
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Total: $300</p>
                                    <p class="card-text mb-1"> Diste una calificación de:</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <a href="" class="btn btn-secondary mb-1" id="">Ver Ticket</a>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles del Producto</a>



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
                                    <p class="card-text mb-1">Cantidad: 2</p>
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Total: $300</p>
                                    <p class="card-text mb-1"> Diste una calificación de:</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <a href="" class="btn btn-secondary mb-1" id="">Ver Ticket</a>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles del Producto</a>



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
                                    <p class="card-text mb-1">Cantidad: 2</p>
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Total: $300</p>
                                    <p class="card-text mb-1"> Diste una calificación de:</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <a href="" class="btn btn-secondary mb-1" id="">Ver Ticket</a>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles del Producto</a>



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
                                    <p class="card-text mb-1">Cantidad: 2</p>
                                    <p class="card-text mb-1">Precio: $150</p>
                                    <p class="card-text mb-1">Total: $300</p>
                                    <p class="card-text mb-1"> Diste una calificación de:</p>

                                    <div class="calificacion pb-2">
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star-fill"></i>
                                        <i class="bi bi-star"></i>
                                        <i class="bi bi-star"></i>
                                    </div>
                                    <a href="" class="btn btn-secondary mb-1" id="">Ver Ticket</a>

                                    <a href="" class="btn btn-secondary mb-1" id="">Ver detalles del Producto</a>



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
                                <p class="card-text mb-1">Cantidad: 2</p>
                                <p class="card-text mb-1">Total: $650</p>
                                <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>
                                <a href="" class="btn btn-secondary mb-1" id="">Ver Ticket</a>

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
                                <p class="card-text mb-1">Cantidad: 2</p>
                                <p class="card-text mb-1">Total: $650</p>
                                <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>
                                <a href="" class="btn btn-secondary mb-1" id="">Ver Ticket</a>

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
                                <p class="card-text mb-1">Cantidad: 2</p>
                                <p class="card-text mb-1">Total: $650</p>
                                <a href="" class="btn btn-secondary mb-1" id="">Ver detalles</a>
                                <a href="" class="btn btn-secondary mb-1" id="">Ver Ticket</a>

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

        </div>

        <!-- Footer -->
        <div class="container-fluid footer mt-auto bg-primary">
            <footer class="py-3 footer">
                <div class="col-md-4 d-flex align-items-center">
                    <span class="mb-3 mb-md-0">&copy; 2023 Amethyst. Todos los derechos reservados.</span>
                </div>
            </footer>
        </div>

        <?php include_once "./libs/sweetalertJS.php" ?>
        <?php include_once "./libs/jqueryJS.php" ?>
        <?php include_once "./libs/swiperJS.php" ?>
        <?php include_once "./libs/bootstrapJS.php" ?>
        <script src="./js/POV_Perfil_Cliente.js"></script>

    </main>
</body>

</html>