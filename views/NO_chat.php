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

    <!-- navbar.php -->
    <?php include('./components/navbar.php'); ?>

    <!-- Contenido -->
    <div class="container-fluid m-0 p-0 mt-4 mb-4">
        <input type="text" id='loggedUserId' hidden value="<?php echo $_SESSION['usuario']['idUsuario'] ?>"
            rol="<?php echo $_SESSION['usuario']['rol_usuario']; ?>">
        <div class="row m-0 p-0">
            <div class="col-3 d-sm-none d-xs-none d-md-block" id="">
                <form class="search-form" role="search">
                    <input type="search" class="form-control " placeholder="Search..." aria-label="Search"
                        onkeyup="showResults(this.value,'<?php echo $_SESSION['usuario']['rol_usuario']; ?>')">
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