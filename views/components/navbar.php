<div class="container">
    <div class="d-flex align-items-center search-bar">

        <div class="btn-menu">
            <label for="btn-menu">☰</label>
        </div>

        <form action="Busqueda.php" method="GET" class="input-group">

            <div class="navbar d-flex justify-content-between">
                <a href="home.php" class="me-5 navbar-brand text-decoration-none">Stock & Custom</a>
            </div>

            <input class="form-control" type="search" name="searchBar" placeholder="Buscar productos..."
                aria-label="Search">
            <button type="submit" class="btn btn-secondary" id="searchbutton">Buscar</button>
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
            <?php
            if ($rol == 'Comprador') { ?>
                 <a href="Carrito.php">Carrito</a>
            <?php }
            ?>
            <a href="chat.php">Chat</a>
            <?php
            if ($rol == 'Comprador') { ?>
                <a href="Perfil_Cliente.php">Mis Listas</a>
            <?php }
            ?>
            <a href=<?php echo $url ?>><?php echo $titulo ?></a>
            <a href="Terminos.php">Términos y Condiciones</a>
            <a href="../controllers/logout.php">Salir</a>
        </nav>

    </div>
</div>