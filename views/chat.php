<!-- NOOO HA SIDO PROGRAMADA -->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
<!-- --------------------------------------------------->
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
    <title>Chat</title>

    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/chat.css">

</head>

<body>

    <nav class="sticky-top shadow-sm navbar-expand-lg">
        <div class="container-fluid border-0 bg-primary">

            <div class="btn-menu">
                <label for="btn-menu">☰</label>
            </div>

            <div class="capa"></div>

            <input type="checkbox" id="btn-menu">
            <div class="container-menu">
                <div class="cont-menu">
                    <label for="btn-menu">✖️</label>
                    <nav>

                        <a href=<?php echo $urlPerfil ?>>Cuenta</a>
                        <a href="Carrito.php">Carrito</a>
                        <a href="chat.php">Chat</a>
                        <a href=<?php echo $url ?>>
                            <?php echo $titulo ?>
                        </a>
                        <a href="../controllers/logout.php">Salir</a>
                    </nav>

                </div>
            </div>
            <div class="navbar d-flex justify-content-between">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <form action="Busqueda.php" method="GET" class="input-group">

                        <div class="navbar d-flex justify-content-between">
                            <a href="home.php" class="me-5 navbar-brand text-decoration-none">Stock & Custom</a>
                        </div>

                        <input class="form-control" type="search" name="searchBar" placeholder="Search"
                            aria-label="Search">
                        <button type="submit" class="btn btn-secondary">Buscar</button>
                    </form>
                    <!-- Fin de la barra de búsqueda -->

                    <div class="custom-dropdown">
                        <div class="dropdown">
                            <button class="btn text-light border-0 d-flex" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false">
                                Categorias <i class="ms-2 bi bi-caret-down-fill"></i>
                            </button>

                            <!-- -----------categorias-------- -->
                            <ul class="dropdown-menu">
                                <?php foreach ($categorias as $categoria) { ?>
                                    <li><a class="dropdown-item"
                                            href="Busqueda.php?idCategoria=<?php echo $categoria['idCategoria']; ?>">
                                            <?php echo $categoria['Nombre'] ?>
                                        </a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                    <?php
                    if ($rol !== "Administrador") {
                        echo '<div class="mt-2">
                                    <a class="btn text-light border-0 d-flex" type="button" href="chat.php">
                                        <i class="bi bi-chat-dots-fill"></i>
                                    </a>
                                    </div>';
                    } ?>

                    <div class="dropdown mt-2">
                        <button class="btn border-0" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <?php
                            $userImage = "../Files/" . $user->getImagen(); // Ruta de la imagen de perfil
                            $username = $user->getUsername();
                            ?>
                            <img src="<?= $userImage ?>" alt="<?= $username ?>" width="35" height="35"
                                class="rounded-circle">
                            <?= $username ?>
                        </button>
                    </div>
                </div>

            </div>
        </div>


    </nav>

    <!-- Contenido -->
    <div class="container-fluid m-0 p-0 mt-4 mb-4">
        <div class="row m-0 p-0">
            <div class="col-3 d-sm-none d-xs-none d-md-block" id="">
                <form class="search-form" role="search">
                    <input type="search" class="form-control " placeholder="Search..." aria-label="Search">
                    <div class="search-results" id="searchResults"></div>
                </form>
                <div id='user-chats'>

                </div>
            </div>
            <div class="col-md-4 col-sm-12">
                <div class="messages-container">
                    <div class="d-flex dropdown">
                        <h4 class="ms-2" id='chat-username'>Seleccione una conversación</h4>
                    </div>
                    <div class="overflow-auto contenedor-comentarios" id='message-container' userId='' chatId=''>
                        <div class="mt-3">
                            <!-- Contenido de la columna de comentarios existente -->
                        </div>
                    </div>
                    <div class="mt-3">
                        <form class="d-flex" id="sendMsg">
                            <input class="form-control ms-3 me-3" type="text" id="message-input" name="message-input"
                                value="" placeholder="">
                            <button type="button" name="btn-send-msg" id="btn-send-msg"
                                class="d-flex rounded-circle justify-content-center btn btn-secondary">
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-12">

                <div class="d-flex dropdown">
                    <h4 class="ms-2" id='chat-username'>COTIZACION</h4>
                </div>
                <div class="overflow-auto contenedor-comentarios" id='message-container' userId='' chatId=''>
                    <div class="mt-3">
                        <!-- Contenido de la columna de "COTIZACION" -->
                    </div>
                </div>
                <div class="mt-3">
                    <form class="d-flex" id="sendMsg">
                        <input class="form-control ms-3 me-3" type="text" id="message-input" name="message-input"
                            value="" placeholder="">
                        <button type="button" name="btn-send-msg" id="btn-send-msg"
                            class="d-flex rounded-circle justify-content-center btn btn-secondary">
                            <i class="bi bi-send-fill"></i>
                        </button>

                        <button type="button" class="button-cotizar">COTIZAR</button>

                    </form>
                </div>


            </div>
        </div>



        <!-- Footer -->
        <?php include('./components/footer.php'); ?>


        <?php include_once "./libs/jqueryJS.php" ?>
        <?php include_once "./libs/bootstrapJS.php" ?>
        <!--  <script src="./js/chat.js"></script> -->
    </div>

</body>

</html>