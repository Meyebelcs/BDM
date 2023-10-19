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
    header("Location: home.php");
    exit;
} else if ($rol == 'Comprador') {
    header("Location: home.php");
    exit;
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
                    <form action="" id="change-photo-form">
                        <div class="modal-body">
                            <div class="wrapper">
                                <div class="box">
                                    <div class="input-bx">
                                        <label for="Upload" class="uploadlabel" id="img-holder">
                                            <span class=""><i class="bi bi-cloud-arrow-up-fill"></i></span>
                                            <p>Añade una imagen</p>
                                        </label>
                                        <img src="" id="preview-img" alt="">
                                        <input type="file" id="Upload" class="form-control mt-3">
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
        <script src="./js/POV_Perfil_Admin.js"></script>
        <script src="./js/Profile_edition.js"></script>

    </main>
</body>

</html>