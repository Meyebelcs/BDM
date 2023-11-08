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
    $urlPerfil = "POV_Perfil_Cliente.php";
} else if ($rol == 'Administrador') {
    $urlPerfil = "POV_Perfil_Admin.php";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Detalle Producto</title>

    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/Detalle_producto.css">

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



        <hr class="mt-5">
        <!-- Contenido -->
        <div class="container">
            <div class="row border-3 border-bottom border-primary text-center mb-3 mt-3">
                <div class="col">
                    <h4> Detalles del Producto </h4>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8 mb-4">
                    <h1>"TITULO"</h1>
                    <a href="perfil-instructor-seen-by-others.php?idUserIndex=<?php echo $datosCurso["Resultados"][0]["idUsuario"]; ?>"
                        style="text-decoration: none; color: inherit;">
                        <h4>Vendedor: Noas House</h4>
                    </a>
                    <div class="d-flex justify-content-center mt-4">
                        <img class="img-course" src="../AVANCE 1/Styles/Assets/postman.png" alt="Imagen del curso"
                            style="max-width: 100%; height: auto;">
                    </div>
                    <div class="mt-4">
                        <h4>Descripción</h4>
                        <h5>EXelente poster del espacio, buena</h5>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="card h-200 w-200 border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex text-center align-items-center mb-3">
                                <h2 class="m-0">Precio:$</h2>
                                <h2 class="m-0">1000</h2>
                                <p class="m-0 ms-2">MXN</p>
                            </div>

                            <a href="07_Carrito.php" class="btn btn-orange w-100"><i class="bi bi-cart-fill"></i>
                                Comprar</a>

                            <?php
                            // Busca si el curso ya está comprado o no
                            $imprime = ' <a href="metodo-pago.php?idCurso=';
                            $imprime2 = '" class="btn btn-secondary w-100"><i class="bi bi-cart-fill"></i> Comprar</a>';
                            ?>

                            <hr>
                            <div class="valoracion p-2">
                                <!-- Aquí puedes mostrar la valoración del curso si es necesario -->
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row">
                <h4 class="mt-4">Deja tu reseña</h4>
                <div class="valoracion pt-0 fs-5 rating"
                    data-rating-id="<?php echo $datosCurso["Resultados"][0]["identificador"]; ?>">
                    <i class="bi bi-star" star="1"></i>
                    <i class="bi bi-star" star="2"></i>
                    <i class="bi bi-star" star="3"></i>
                    <i class="bi bi-star" star="4"></i>
                    <i class="bi bi-star" star="5"></i>
                </div>
                <form id="makeReview">
                    <input type="hidden" name="ReviewidCurso" value="<?php echo $idCursoIndex; ?>">
                    <input type="hidden" name="ReviewidUsuario" value="<?php echo $id_usuario; ?>">
                    <textarea class="form-control" id="review" rows="3"></textarea>
                    <span class="text-danger" id="error_message"></span><br>
                    <button type="submit" class="btn btn-secondary mt-3 rounded-pill mb-3" style="width: auto;">Enviar
                        reseña</button>
                </form>
            </div>
            <div class="row w-100">
                <h4 class="mt-4 mb-0">Reseñas</h4>



            </div>

            <div class="mt-2 w-200 border-top" style="margin-top: 90px;">

                <div class="profile-photo">
                    <img class="img-course" src="../AVANCE 1/Styles/Assets/postman.png" alt="Imagen del curo">
                </div>
                <div>
                    <h6 class="m-0 p-0 ms-3">Noe Boanegra</h6>
                    <div class="d-flex m-0 p-0 ms-3">


                        <small class="me-2 pt-1">09/09/2000</small>
                        <div class="valoracion p-0">
                            <?php
                            $stars = '<i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star"></i>
                        <i class="bi bi-star"></i>';

                            echo $stars;
                            ?>
                        </div>
                    </div>
                    <h6 class="m-0 p-0 ms-3"> Excelente producto 10/10 </h6>
                    <div class="mb-5"></div>
                </div>


                <div class="profile-photo">
                    <img class="img-course" src="../AVANCE 1/Styles/Assets/img/647942a5cf498.jpg" alt="Imagen del curo">
                </div>
                <div>
                    <h6 class="m-0 p-0 ms-3">Alissa </h6>
                    <div class="d-flex m-0 p-0 ms-3">


                        <small class="me-2 pt-1">09/09/2000</small>
                        <div class="valoracion p-0">
                            <?php
                            $stars = '<i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star-fill"></i>
                        <i class="bi bi-star"></i>';

                            echo $stars;
                            ?>
                        </div>
                    </div>
                    <h6 class="m-0 p-0 ms-3"> Excelente producto </h6>
                    <div class="mb-5"></div>
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


        <!-- <script src="./Scripts/03_Perfil_Cliente.js"></script> -->

    </main>

</body>

</html>