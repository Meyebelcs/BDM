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
$idUsersesion = $_SESSION["AUTH"];
$mysqli = db::connect();
$usersesion = User::findUserById($mysqli, (int) $idUsersesion);
$rolsesion = $usersesion->getRol();

if (!empty($_GET['idChatSelected'])) {
  $idChatSearch = $_GET['idChatSelected'];
  $idProductoSelected = $_GET['idProductoSelected'];
  $Messages = Mensaje::getMessagesByUser($mysqli, $idChatSearch);

}


//verificar status del chat , desactivarlo si ya se realizó el carrito
?>



<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat</title>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <?php include_once "./libs/fonts.php" ?>
  <?php include_once "./libs/bootstrap.php" ?>
  <link rel="stylesheet" href="./css/pages/chat3.css">
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>


<body>

  <?php include('./components/navbar.php'); ?>

  <div class="container2">
    <!-- Columna de contactos -->
    <div class="column" style="overflow-y: auto; max-height: 900px;">
      <h2>Contactos</h2>


      <?php
      if ($Chats) {
        foreach ($Chats as $Chat) {
          $userImage;
          $username;

          //asigna el chat seleccionado a la variable y el producto seleccionado tmn
          if ($idChatSearch == $Chat->getIdChat()) {
            $idProductoSelected = $Chat->getIdProducto();
            $idStatusCotizacion = Chat::obtenerIdStatusCotizacionTemporal($mysqli, $idChatSearch, $idProductoSelected);
            $mysqli = db::connect();
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

          ?>

          <a
            href="Chat.php?idChatSelected=<?php echo $Chat->getIdChat(); ?>&idProductoSelected=<?php echo $idProductoSelected; ?>">
            <div class="contact">
              <img src="<?php echo $userImage; ?>" alt="Foto de perfil">
              <div>
                <p class="contact-name">
                  <?php echo $username; ?> -
                  <?php
                  $mysqli = db::connect();
                  $producto = Product::findProductoById($mysqli, $Chat->getIdProducto());


                  echo $producto->getNombre(); ?>
                </p>
              </div>
            </div>
          </a>

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
    </div>



    <div class="column">
      <h2>Chat</h2>
      <div class="chat-area" id="chatArea">
        <!-- Área para mostrar los mensajes -->
        <?php
        if ($rol == 'Vendedor') {
          if ($Messages != 'firsttime') {

            if ($Messages) {
              foreach ($Messages as $mensaje) {
                $mysqli = db::connect();
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

          <?php }
        } else {
          //si el que inicia sesion es el comprador
          if ($Messages != 'firsttime') {


            if ($Messages) {
              foreach ($Messages as $mensajeComprador) {
                $mysqli = db::connect();
                $UsuarioMensaje = User::findUserById($mysqli, $mensajeComprador->getIdUsuarioCreador());
                $rol = $UsuarioMensaje->getRol();

                if ($UsuarioMensaje->getRol() == 'Comprador') { ?>
                  <li class="me">
                    <div class="entete">
                      <h3>
                        <?php echo $mensajeComprador->getFechaCreacion() ?>
                      </h3>
                      <h2>
                        <?php echo $UsuarioMensaje->getUsername() ?>
                      </h2>

                    </div>

                    <div class="message">
                      <?php echo $mensajeComprador->getMensaje() ?>
                    </div>
                  </li>

                <?php } else { ?>
                  <li class="you">
                    <div class="entete">

                      <h2>
                        <?php echo $UsuarioMensaje->getUsername() ?>
                      </h2>
                      <h3>
                        <?php echo $mensajeComprador->getFechaCreacion() ?>
                      </h3>
                    </div>

                    <div class="message">
                      <?php echo $mensajeComprador->getMensaje() ?>
                    </div>
                  </li>
                <?php }
                ?>
              <?php }
            } else { ?>
              <div class="col border mx-3 mb-6 mt-6 " style="width: 20rem; background:  #B7CBBF;  margin: 5rem;">
                No hay mensajes
              </div>
            <?php }
          }

        } ?>

        <!---------- ocultos ----------->
        <input type="hidden" id="idCarritoHidden2" name=" <?php echo $idCarrito; ?>"
          value=" <?php echo $idCarrito; ?>" />
        <input type="hidden" id="idProductoHidden2" name=" <?php echo $idProductoSelected ?>"
          value=" <?php echo $idProductoSelected ?>" />

        <input type="hidden" id="idChatHidden2" name=" <?php echo $idChatSearch ?>"
          value=" <?php echo $idChatSearch ?>" />

          
        <?php if ($rolsesion === 'Vendedor') { ?>
        <input type="hidden" id="idUsuariorolHidden" name="Vendedor" value="Vendedor" />
        <?php } else { ?>
        <input type="hidden" id="idUsuariorolHidden" name="Comprador" value="Comprador" />
        <?php } ?>

      </div>

      <!-- boton de enviar mensaje -->
      <?php if (!empty($_GET['idChatSelected'])) { ?>
        <div class="message-input">
          <input type="text" id="messageInput" placeholder="Escribe tu mensaje...">
          <button type="button" id="message-btn" class="btn btn-secondary">Enviar</button>
        </div>
        <span class="text-danger" id="error_message"></span><br>
      <?php } ?>


    </div>

    <!-- Tercera columna con "Hola" -->
    <div class="column" style="overflow-y: auto; max-height: 900px;">

      <?php if ($idStatusCotizacion == 8) { ?>
        <button type="button" id="add-carrito-btn" class="btn btn-secondary">Añadir a
          carrito</button>

      <?php } ?>


      <!-- Verificar q el boton esté en espera -->
      <?php if ($idStatusCotizacion == 6) { ?>
        <div class="alert alert-info" role="alert">
          ¡La cotización ya fue agregada al carrito!
        </div>
      <?php } ?>

      <?php
      $mysqli = db::connect();
      $Cotizacion = Product::getInfoProductCoti($mysqli, $idProductoSelected, $idChatSearch);
      if ($Cotizacion) {
        foreach ($Cotizacion as $producto) {


          if ($rolsesion === 'Comprador') { ?>
            <div class="cotizacion">
              <div class="cotizacion-titulo">
                <br></br>
                <h4><strong>Producto:</strong></h4>
                <h5>
                  <?php echo $producto->getNombre() ?>
                </h5>
              </div>
            </div>
          </div>
        <?php } else { ?>
          <?php if ($idStatusCotizacion != 6 && $idStatusCotizacion != 8) { ?>

            <div class="cotizacion">
              <div class="cotizacion-titulo">
                <br></br>
                <h4><strong>Producto:</strong></h4>
                <h5>
                  <?php echo $producto->getNombre() ?>
                </h5>
                <h4><strong>Descripción:</strong></h4>
                <textarea id="miTextarea" rows="4" cols="30"
                  placeholder="<?php echo $producto->getDescripcion() ?>..."></textarea>
              </div>
              <!---------- ocultos ----------->
      <input type="hidden" id="idCarritoHidden" name=" <?php echo $idCarrito; ?>" value=" <?php echo $idCarrito; ?>" />
      <input type="hidden" id="idProductoHidden" name=" <?php echo $producto->getIdProducto() ?>"
        value=" <?php echo $producto->getIdProducto() ?>" />
      <input type="hidden" id="idChatHidden" name=" <?php echo $idChatSearch ?>" value=" <?php echo $idChatSearch ?>" />

      <br><label for="cantidad"><strong>Cantidad: </strong></label>
      <input type="number" id="cantidadCoti" name="cantidadCoti" min="1" value="1" />

      <br><br><label for="precio"><strong>Precio:</strong></label>
      <input type="number" id="precioproductCoti" name="precioCoti" min="1" value="1" />

      <div class="row mt-4">
        <div class="col-lg-12 p-2 d-flex">
          <h4 class="pe-4"><strong>Materiales</strong></h4>
          <button type="button" class="btn btn-secondary btn-sm" data-bs-toggle="modal"
            data-bs-target="#addmaterial">Añadir Material</button>
        </div>
      </div>

      <div class="row">
        <div class="accordion levels" id="levels">

        </div>
        <span class="text-danger" id="material_error_messageCotizacion"></span><br>
        <button type="submit" class="btn btn-secondary m-4 mb-9" id="btnCrearCotizacion">Crear Cotización</button>

      </div>
    </div>
    <?php }
          }
        }
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
          <label class="form-label" style="color: black;">Nombre</label>
          <div class="container mt-1">
            <select class="form-control" id="MaterialList" name="MaterialList">
              <option value="" selected disabled>Selecciona un material</option>
              <?php
              $materialesbyproduct = MaterialInventario::GetMaterialesPorProducto($mysqli, $idProductoSelected);
              foreach ($materialesbyproduct as $material) { ?>
                <option value="<?php echo $material->getNombre() ?>" id="<?php echo $material->getIdMaterial() ?>">
                  <?php echo $material->getNombre() ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <span class="text-danger" id="material_name_error_message"></span><br>

          <label class="form-label pt-2 me-3" style="color: black;">Cantidad:</label>
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


  <!-- Modal editar material-->
  <div class="modal fade" id="editmaterial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form id="edit-material" class="modal-content">
        <div class="modal-header">
          <h4>Editar material</h4>
        </div>
        <div class="modal-body">
          <label for="" class="form-label" style="color: black;">Nombre</label>
          <div class="container mt-1">
            <select class="form-control" id="material-edit-name" name="namematerialeditname">
              <option value="" selected disabled>Selecciona un material</option>
              <?php
              $materialesbyproduct = MaterialInventario::GetMaterialesPorProducto($mysqli, $idProductoSelected);
              foreach ($materialesbyproduct as $material) { ?>
                <option value="<?php echo $material->getNombre() ?>" id="<?php echo $material->getIdMaterial() ?>">
                  <?php echo $material->getNombre() ?>
                </option>
              <?php } ?>
            </select>
          </div>
          <span class="text-danger" id="material_edit_name_error_message"></span><br>
          <label class="form-label pt-2 me-3" for="" style="color: black;">Cantidad:</label>
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
          <h6 style="color: black;">¿Estás seguro de que deseas eliminar este material?</h6>
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
  </div>



  <?php include('./components/footer.php'); ?>

</body>

<?php include_once "./libs/jqueryJS.php" ?>
<?php include_once "./libs/bootstrapJS.php" ?>
<?php include_once "./libs/sweetalertJS.php" ?>
<!-- Agrega el siguiente enlace en la sección head de tu HTML -->

<script src="./js/chat4.js"></script>
<!-- <script type="module" src="./js/chat4.js"></script> -->

</html>