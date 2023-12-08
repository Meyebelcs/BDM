<?php
session_start();

require_once './components/menu.php';

require_once "../models/Chat.php";
require_once "../models/Mensaje.php";
require_once "../models/Producto.php";
require_once "../models/Material_Inventario.php";
require_once "../models/Carrito.php";


$idChatSearch = 'firsttime';
$idProductoSelected = 'firsttime';
$Messages = 'firsttime';
$idStatusCotizacion = ' ';
$idCarrito = 'firsttime';
$Chats = Chat::getChatsByUser($mysqli, $idUser);



if (!empty($_GET['idChatSelected'])) {
    $idChatSearch = $_GET['idChatSelected'];
    $idProductoSelected = $_GET['idProductoSelected'];
    $Messages = Mensaje::getMessagesByUser($mysqli, $idChatSearch);

}


//verificar status del chat , desactivarlo si ya se realizó el carrito

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
    <link rel="stylesheet" href="./css/pages/chat2.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


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
                    </form>

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
    <div id="container">
        <aside>


            <ul>
                <?php
                if ($Chats) {
                    foreach ($Chats as $Chat) {
                        $userImage;
                        $username;

                        //asigna el chat seleccionado a la variable y el producto seleccionado tmn
                        if ($idChatSearch == $Chat->getIdChat()) {
                            $idProductoSelected = $Chat->getIdProducto();
                            $idStatusCotizacion = Chat::obtenerIdStatusCotizacionTemporal($mysqli, $idChatSearch, $idProductoSelected);
                            $idCarrito = Carrito::getidCarritoByProductChat($mysqli, $idProductoSelected, $idChatSearch);

                        }
                        //imprime la foto del cliente o vendedor segun quien está en sesion
                
                        if ($idUser == $Chat->getIdUsuarioCliente()) {
                            $userImage = "../Files/" . $Chat->getImagenVendedor();
                            $username = $Chat->getNombreVendedor();
                        } else {
                            $userImage = "../Files/" . $Chat->getImagenCliente();
                            $username = $Chat->getNombreCliente();
                        }

                        // Agrega un enlace que redirige a chat.php con el parámetro idChat
                        ?>
                        <li>
                            <a
                                href="chat.php?idChatSelected=<?php echo $Chat->getIdChat(); ?>&idProductoSelected=<?php echo $idProductoSelected; ?>">
                                <img class="round-image" src="<?php echo $userImage; ?>" alt="">
                                <div>
                                    <h2>
                                        <?php echo $username; ?>
                                    </h2>
                                </div>
                            </a>
                        </li>

                        <?php
                    }
                } else {
                    ?>
                    <div class="col border mx-3 mb-6 mt-6 " style="width: 20rem; background:  #B7CBBF;  margin: 5rem;">
                        No hay chats
                    </div>
                    <?php
                }
                ?>
            </ul>
        </aside>
        <main>

            </header>
            <ul id="chat">

                <!--  ====================boton para el carrito================ -->
                <!-- Verificar q el boton esté en espera -->
                <?php if ($idStatusCotizacion == 8) { ?>

                    <button type="submit" class="btn btn-secondary" id="btnAgregarCarritoBoton">Agregar a Carrito</button>

                <?php } ?>

                <!-- Verificar q el boton esté en espera -->
                <?php if ($idStatusCotizacion == 6) { ?>
                    La cotizacion ya fue agregada al carrito
                <?php } ?>
                <!--  =============================================================== -->


                <?php
                if ($rol == 'Vendedor') {
                    if ($Messages != 'firsttime') {

                        if ($Messages) {
                            foreach ($Messages as $mensaje) {

                                $UsuarioMensaje = User::findUserById($mysqli, $mensaje->getIdUsuarioCreador());
                                $rol = $UsuarioMensaje->getRol();

                                if ($UsuarioMensaje->getRol() == 'Comprador') { ?>
                                    <li class="you">
                                        <div class="entete">

                                            <h2>
                                                <?php echo $UsuarioMensaje->getUsername() ?>
                                            </h2>
                                            <h3>
                                                <?php echo $mensaje->getFechaCreacion() ?>
                                            </h3>
                                        </div>

                                        <div class="message">
                                            <?php echo $mensaje->getMensaje() ?>
                                        </div>
                                    </li>
                                <?php } else { ?>
                                    <li class="me">
                                        <div class="entete">
                                            <h3>
                                                <?php echo $mensaje->getFechaCreacion() ?>
                                            </h3>
                                            <h2>
                                                <?php echo $UsuarioMensaje->getUsername() ?>
                                            </h2>

                                        </div>

                                        <div class="message">
                                            <?php echo $mensaje->getMensaje() ?>
                                        </div>
                                    </li>
                                <?php }
                                ?>
                            <?php }
                        } else { ?>
                            <div class="col border mx-3 mb-6 mt-6 " style="width: 20rem; background:  #B7CBBF;  margin: 5rem;">
                                No hay mensajes
                            </div>
                        <?php } ?>
                        <footer>
                            <textarea placeholder="Type your message"></textarea>

                            <a href="#">Send</a>
                        </footer>
                    <?php }
                } else {
                    //si el que inicia sesion es el comprador
                    if ($Messages != 'firsttime') {


                        if ($Messages) {
                            foreach ($Messages as $mensaje) {

                                $UsuarioMensaje = User::findUserById($mysqli, $mensaje->getIdUsuarioCreador());
                                $rol = $UsuarioMensaje->getRol();

                                if ($UsuarioMensaje->getRol() == 'Comprador') { ?>
                                    <li class="me">
                                        <div class="entete">
                                            <h3>
                                                <?php echo $mensaje->getFechaCreacion() ?>
                                            </h3>
                                            <h2>
                                                <?php echo $UsuarioMensaje->getUsername() ?>
                                            </h2>

                                        </div>

                                        <div class="message">
                                            <?php echo $mensaje->getMensaje() ?>
                                        </div>
                                    </li>

                                <?php } else { ?>
                                    <li class="you">
                                        <div class="entete">

                                            <h2>
                                                <?php echo $UsuarioMensaje->getUsername() ?>
                                            </h2>
                                            <h3>
                                                <?php echo $mensaje->getFechaCreacion() ?>
                                            </h3>
                                        </div>

                                        <div class="message">
                                            <?php echo $mensaje->getMensaje() ?>
                                        </div>
                                    </li>
                                <?php }
                                ?>
                            <?php }
                        } else { ?>
                            <div class="col border mx-3 mb-6 mt-6 " style="width: 20rem; background:  #B7CBBF;  margin: 5rem;">
                                No hay mensajes
                            </div>
                        <?php } ?>
                        <footer>
                            <textarea placeholder="Type your message"></textarea>

                            <a href="#">Send</a>
                        </footer>
                        <?php
                    }

                }
                ?>
            </ul>
        </main>

        <!-- Otros elementos que desees agregar -->
    </div>
    </div>




    <div class="cotizacion" <?php echo ($rol === 'Comprador') ? 'style="display:none;"' : ''; ?>>
        <?php
        $Cotizacion = Product::getInfoProductCoti($mysqli, $idProductoSelected, $idChatSearch);
        if ($Cotizacion) {
            foreach ($Cotizacion as $producto) { ?>
                <div class="cotizacion-titulo">

                    <h1>Producto:</h1>
                    <h2>
                        <?php echo $producto->getNombre() ?>
                    </h2>
                    <input type="hidden" id="idCarritoHidden" name=" <?php echo $idCarrito; ?>"
                        value=" <?php echo $idCarrito; ?>" />
                    <input type="hidden" id="idProductoHidden" name=" <?php echo $producto->getIdProducto() ?>"
                        value=" <?php echo $producto->getIdProducto() ?>" />
                    <input type="hidden" id="idChatHidden" name=" <?php echo $idChatSearch ?>"
                        value=" <?php echo $idChatSearch ?>" />
                    <br><label for="cantidad">Cantidad:</label>
                    <input type="number" id="cantidadCoti" name="cantidadCoti" min="1" value="1" />

                    <h2>Descripción:</h2>
                    <textarea id="miTextarea" rows="4" cols="30"
                        placeholder="<?php echo $producto->getDescripcion() ?>..."></textarea>

                </div>
                <div class="row mt-4">
                    <div class="col-lg-12 p-2 d-flex">
                        <h4 class="pe-4">Materiales</h4>
                        <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
                            data-bs-target="#addmaterial">Añadir Material</button>
                    </div>
                </div>

                <div class="row">
                    <div class="accordion levels" id="levels">

                    </div>
                    <span class="text-danger" id="material_error_messageCotizacion"></span><br>

                    <button type="submit" class="btn btn-secondary m-2 mb-3" id="btnCrearCotizacion">Crear Cotización</button>

                    </form>
                </div>
            <?php }
        } ?>


    </div>



    <!-- Modal Añadir material-->
    <div class="modal fade" id="addmaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-material" class="modal-content">
                <input type="hidden" name="formulario" value="addmaterial-form">
                <div class="modal-header">
                    <h4>Añadir material</h4>
                </div>
                <div class="modal-body">
                    <label for="" class="form-label">Nombre</label>
                    <div class="container mt-1">
                        <select class="form-control" id="MaterialList" name="MaterialList">
                            <option value="" selected disabled>Selecciona un material</option>
                            <?php
                            $materialesbyproduct = MaterialInventario::GetMaterialesPorProducto($mysqli, $idProductoSelected);
                            foreach ($materialesbyproduct as $material) { ?>
                                <option value="<?php echo $material->getNombre() ?>"
                                    id="<?php echo $material->getIdMaterial() ?>">
                                    <?php echo $material->getNombre() ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <span class="text-danger" id="material_name_error_message"></span><br>

                    <label class="form-label pt-2 me-3" for="">Cantidad:</label>
                    <input class="form-control" type="text" id="material-cantidad" name="costo-add-material">
                    <span class="text-danger" id="material_cantidad_error_message"></span><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close">Cerrar</button>
                    <button type="button" id="add-material-btn" class="btn btn-secondary">Añadir material</button>
                    <span class="text-danger" id="material_error_message"></span><br>
                </div>
            </form>
        </div>
    </div>


    </select>
    <!-- Modal editar material-->
    <div class="modal fade" id="editmaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="edit-material" class="modal-content">
                <div class="modal-header">
                    <h4>Editar material</h4>
                </div>
                <div class="modal-body">
                    <label for="" class="form-label">Nombre</label>
                    <div class="container mt-1">
                        <select class="form-control" id="material-edit-name" name="namematerialeditname">
                            <option value="" selected disabled>Selecciona un material</option>
                            <?php
                            $materialesbyproduct = MaterialInventario::GetMaterialesPorProducto($mysqli, $idProductoSelected);
                            foreach ($materialesbyproduct as $material) { ?>
                                <option value="<?php echo $material->getNombre() ?>"
                                    id="<?php echo $material->getIdMaterial() ?>">
                                    <?php echo $material->getNombre() ?>
                                </option>
                            <?php } ?>
                        </select>
                    </div>
                    <span class="text-danger" id="material_edit_name_error_message"></span><br>
                    <label class="form-label pt-2 me-3" for="">Cantidad:</label>
                    <input class="form-control" type="text" id="material-edit-price" name="namematerialeditcosto">
                    <span class="text-danger" id="material_edit_price_error_message"></span><br>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        id="close-edit-material">Cerrar</button>
                    <button type="button" id="edit-material-btn" class="btn btn-secondary">Guardar cambios</button>
                    <span class="text-danger" id="material_edit_error_message"></span><br>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal delete material-->
    <div class="modal fade" id="deletematerial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form id="add-material" class="modal-content">
                <input type="hidden" name="formulario" value="addmaterial-form">
                <div class="modal-header">
                    <h4>Eliminar material</h4>
                </div>
                <div class="modal-body">
                    <h6>¿Estás seguro de que deseas eliminar este material?</h6>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close">Cerrar</button>
                    <button type="button" id="delete-material-btn" class="btn btn-secondary">Eliminar</button>
                    <span class="text-danger" id="material_error_message"></span><br>
                </div>
            </form>
        </div>
    </div>

    </div>

</body>


<?php include_once "./libs/jqueryJS.php" ?>
<?php include_once "./libs/bootstrapJS.php" ?>
<?php include_once "./libs/sweetalertJS.php" ?>

<script type="module" src="./js/chat.js"></script>


</html>