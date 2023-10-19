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
    <title>Perfil Administrador</title>


    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/POV_Perfil.css">


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

        <div class="col py-3">
            <div class="content">
                <div class="container mt-3">
                    <div class="row">
                        <h2>Información general</h2>
                    </div>

                    <div class="row d-flex flex-lg-row flex-sm-column flex-xs-column mt-3">
                        <div class="card d-flex w-100 me-3 col mt-3">
                            <div class="card-body col-12">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="bi bi-collection-play-fill"></i>
                                    </div>
                                    <div class="col-7 mt-2 ms-3">
                                        <h5 class="card-title">Productos</h5>
                                        <h5 class="card-text">
                                            20,900
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card d-flex w-100 me-3 col mt-sm-3 mt-xs-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="bi bi-mortarboard-fill"></i>
                                    </div>
                                    <div class="col-7 mt-2 ms-3">
                                        <h5 class="card-title">Cotizaciones</h5>
                                        <h5 class="card-text">
                                            10,000
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card d-flex w-100 me-3 col mt-sm-3 mt-xs-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4 text-center">
                                        <i class="bi bi-mortarboard-fill"></i>
                                    </div>
                                    <div class="col-7 mt-2 ms-3">
                                        <h5 class="card-title">Vendedores</h5>
                                        <h5 class="card-text">
                                            10,000
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card d-flex w-100 me-3 col mt-sm-3 mt-xs-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4  text-center">
                                        <i class="bi bi-person-workspace"></i>
                                    </div>
                                    <div class="col-7 mt-2 ms-3">
                                        <h5 class="card-title">Clientes</h5>
                                        <h5 class="card-text">
                                            3,000
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <h3>Perfil</h3>
                    </div>
                </div>
            </div>
        </div>

        <!-- Hero -->
        <div class="Hero">
            <div class="container-fluid bg-tertiary">
                <div class="profile_Section row p-4">
                    <div class="col-12 text-center mb-3">
                        <img src="./css/assets/perfil.png" id="foto_perfil" class="img-hero" alt="">
                    </div>
                    <div class="col-12 text-center">
                        <h4 id="nombre_Inst">
                            <?php echo $user->getUsername() ?>
                        </h4>
                        <h6>
                            <?php echo $user->getNombres() . " " . $user->getApellidos(); ?>
                        </h6>
                        <h6>
                            <?= $user->getEmail() ?>
                        </h6>
                        <h6>
                            <?php $formattedFechaNacimiento = date('d \d\e F \d\e\l Y', strtotime($user->getFechaNacimiento()));
                            echo $formattedFechaNacimiento; ?>
                        </h6>
                    </div>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-secondary m-2" data-bs-toggle="modal" data-bs-target="#editProfile">Editar
                            perfil</a>
                        <a class="btn btn-secondary m-2" data-bs-toggle="modal" data-bs-target="#changePhoto">Cambiar
                            foto</a>
                    </div>
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
        <script src="./js/POV_Perfil_Admin.js"></script>

    </main>
</body>

</html>