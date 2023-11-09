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