<?php
session_start();

require_once './components/menu.php';

//Sereedirige a home si no ha seleccionado ningun producto para mostrar
if (!isset($_GET['idProductoIndex'])) {
    header('Location: home.php');
    exit;
}

require_once "../models/Producto.php";
require_once "../models/user.php";
require_once "../models/Comentario.php";
require_once "../models/Archivo.php";
$idProductoSelected = $_GET['idProductoIndex'];
$producto = Product::findProductoById($mysqli, $idProductoSelected);
$archivos = Archivo::getArchivoByProduct($mysqli, $idProductoSelected);
$comentarios = Comentario::getCommentsByProduct($mysqli, $idProductoSelected);
$agotado = Product::validateExist($mysqli, $idProductoSelected);


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
    <!-- navbar.php -->
    <?php include('./components/navbar.php'); ?>

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
                    <h1>
                        <?php echo $producto->getNombre() . "<br>"; ?>
                    </h1>
                    <a href="Perfil_Vendedor.php" style="text-decoration: none; color: inherit;">
                        <h4>Vendedor:
                            <?php echo $producto->getIdUsuarioCreador(); ?>
                        </h4>
                    </a>
                    <div class="d-flex justify-content-center mt-4">
                        <h1>
                            <?php

                            $index = 0;
                            echo "<div id='contenedorImagenes'>";
                            if ($archivos) {
                                foreach ($archivos as $archivo) {
                                    echo "<img id='imagen_$index' src='data:image/jpeg;base64," . base64_encode($archivo->getArchivo()) . "' alt='Imagen' style='display: none; max-width: 500px; max-height: 500px;'><br>";
                                    $index++;
                                }
                            } else {
                                echo "No se encontraron archivos.";
                            }
                            echo "<div style='margin-top: 10px; display: inline-block;'>";
                            echo "<button style='border-radius: 50%; width: 50px; height: 50px; margin-left: 130px;' onclick='cambiarImagen()'>></button>"; // Ajusta el margen izquierdo
                            echo "</div>";

                            ?>
                        </h1>
                    </div>

                    <div class="mt-4">
                        <h4>Descripción</h4>
                        <h6>
                            <?php echo $producto->getDescripcion(); ?>
                        </h6>
                    </div>
                    <div class="mt-4" style="color: cadetblue;">
                        <h2> Cantidad Disponible:
                            <?php echo $producto->getInventario(); ?>
                        </h2>
                    </div>

                </div>

                <div class="col-md-4">
                    <div class="card h-200 w-200 border-0 shadow-sm mb-3">
                        <div class="card-body">
                            <div class="d-flex text-center align-items-center mb-3">
                                <h2 class="m-0"> Precio:
                                    <?php echo $producto->getPrecio(); ?>
                                </h2>
                                <p class="m-0 ms-2">MXN</p>
                            </div>

                            <div class="valoracion p-2">
                                Calificación:
                                <?php
                                echo "<br>";
                                // Verificar si $comentarios está definido
                                if (isset($comentarios) && !empty($comentarios)) {
                                    $total_calificaciones = count($comentarios);
                                    $suma_calificaciones = 0;

                                    // Sumar todas las calificaciones de los comentarios
                                    foreach ($comentarios as $comment) {
                                        $suma_calificaciones += $comment->getCalificacion();
                                    }

                                    // Calcular el promedio
                                    $promedio = $total_calificaciones > 0 ? $suma_calificaciones / $total_calificaciones : 0;

                                    for ($i = 1; $i <= 5; $i++) {
                                        if ($i <= $promedio) {
                                            echo '<span style="font-size: 3em;">★</span>'; // Estrella llena si $i <= $promedio, tres veces más grande
                                        } else {
                                            echo '<span style="font-size: 3em;">☆</span>';
                                        }
                                    }
                                    echo "<br>";
                                } else {
                                    for ($i = 1; $i <= 5; $i++) {
                                        echo '<span style="font-size: 3em;">☆</span>';
                                    }
                                    echo "<br>Aún no hay calificaciones";
                                }
                                ?>
                            </div>
                            <?php
                            if ($rol != 'Vendedor') {
                                if ($producto->getTipo() == 'Cotizacion') { ?>

                                    <a id="<?php echo $idProductoSelected ?>" class="btn w-100"
                                        onclick="capturarClicCotizacion(this)">
                                        <i class="bi bi-cart-fill"></i> Enviar Mensaje
                                    </a>

                                <?php } else if ($agotado['EstaAgotado'] == 1) { ?>
                                        <a class="btn w-100" style="color:red;">
                                            AGOTADO
                                        </a>

                                <?php } else { ?>
                                        <a id="<?php echo $idProductoSelected ?>" class="btn w-100" onclick="capturarClic(this)">
                                            <i class="bi bi-cart-fill"></i> Agregar al carrito
                                        </a>
                                <?php }
                            } ?>



                        </div>
                    </div>
                </div>

            </div>

            <div class="row">
                <h4 class="mt-4">Deja tu reseña</h4>
                <div class="valoracion pt-0 fs-5 rating">
                    <i class="bi bi-star" star="1"></i>
                    <i class="bi bi-star" star="2"></i>
                    <i class="bi bi-star" star="3"></i>
                    <i class="bi bi-star" star="4"></i>
                    <i class="bi bi-star" star="5"></i>
                </div>
                <form id="makeReview">
                    <input type="hidden" name="ReviewidProduct" value="<?php echo $idProductoSelected; ?>">
                    <input type="hidden" name="ReviewidUsuario" value="<?php echo $idUser; ?>">
                    <textarea class="form-control" id="review" rows="3"></textarea>
                    <span class="text-danger" id="error_message"></span><br>
                    <button type="submit" class="btn btn-secondary mt-3 rounded-pill mb-3" style="width: auto;">Enviar
                        reseña</button>
                </form>
            </div>

            <div class="row w-100">
                <h4 class="mt-4 mb-0">Reseñas</h4>
            </div>

            <div class="mt-2 w-200 border-top" style="margin-top: 90px;" id="comentarioslist">

                <?php

                if (isset($comentarios)) {
                    foreach ($comentarios as $comment) {
                        // Acceder a las propiedades del comentario
                        echo "<br>";
                        echo '<img src="../Files/' . $comment->getimagenUsuario() . '" alt="Imagen de usuario" style="width: 35px; height: 35px; border-radius: 50%;">';

                        echo "<br>";
                        echo '<a href="Perfil_Cliente.php?idUsuario=' . $comment->getidUsuario() . '"><strong>' . $comment->getUsername() . '</strong></a><br>';

                        $calificacion = $comment->getCalificacion();
                        echo 'Calificación: ';
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $calificacion) {
                                echo '★'; // Estrella llena si $i <= $calificacion
                            } else {
                                echo '☆'; // Estrella vacía si $i > $calificacion
                            }
                        }
                        echo "<br>";
                        echo strftime('%d %b %Y', strtotime($comment->getFechaPublicacion())) . "<br>";
                        echo $comment->getComentario() . "<br>";
                        echo "<br>";
                    }
                } else {
                    echo "No hay comentarios disponibles.";
                }
                ?>
            </div>
        </div>
        <!-- Footer -->
        <?php include('./components/footer.php'); ?>

        <?php include_once "./libs/sweetalertJS.php" ?>
        <?php include_once "./libs/jqueryJS.php" ?>
        <?php include_once "./libs/swiperJS.php" ?>
        <?php include_once "./libs/bootstrapJS.php" ?>
        <script type="module" src="./js/Detalle_producto.js"></script>


    </main>

</body>
<script>
    let indiceImagenActual = 0;
    const imagenes = document.querySelectorAll("#contenedorImagenes img");

    // Función para mostrar la primera imagen al cargar la página
    window.onload = function () {
        console.log("Página cargada");
        mostrarImagenActual();
    };

    function mostrarImagenActual() {
        console.log("Mostrando imagen actual");
        // Ocultar todas las imágenes
        imagenes.forEach(imagen => {
            imagen.style.display = "none";
        });

        // Mostrar la primera imagen
        imagenes[indiceImagenActual].style.display = "block";
    }

    function cambiarImagen() {
        if (indiceImagenActual < imagenes.length - 1) {
            imagenes[indiceImagenActual].style.display = "none";
            indiceImagenActual++;
        } else {
            // Volver al inicio si se alcanza la última imagen
            imagenes[indiceImagenActual].style.display = "none";
            indiceImagenActual = 0;
        }

        // Mostrar la imagen actualizada
        imagenes[indiceImagenActual].style.display = "block";
    }

    function capturarClic(enlace) {
        // Obtener el ID del enlace
        var idProducto = enlace.id;

        const now = new Date();

        const formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');

        var formData = new FormData();
        formData.append('idProducto', idProducto);
        formData.append('fECHA', formattedDate);



        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../controllers/Carrito/Alta_Carrito.php", true);
        xhr.onreadystatechange = function () {
            try {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    let res = JSON.parse(xhr.response);
                    if (res.success !== true) {
                        Swal.fire({
                            title: 'Error',
                            text: res.msg, // El mensaje de error que obtiene del servidor
                            icon: 'error',
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#F47B8F'
                        });
                        return;
                    }
                    Swal.fire({
                        title: res.msg,
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#F47B8F'
                    }).then((willDelete) => {
                        if (willDelete) {
                            window.location.href = "./Carrito.php";

                        } else {
                            alert("error");
                        }
                    });
                    console.log(res.msg);
                }
            } catch (error) {
                // Imprimir error del servidor
                console.error(xhr.response);
            }
        };

        // Enviar FormData en lugar de JSON
        xhr.send(formData);


    }
    function capturarClicCotizacion(enlace) {
        // Obtener el ID del enlace
        var idProducto = enlace.id;

        const now = new Date();

        const formattedDate = now.toISOString().slice(0, 19).replace('T', ' ');

        var formData = new FormData();
        formData.append('idProducto', idProducto);
        formData.append('fECHA', formattedDate);



        const xhr = new XMLHttpRequest();
        xhr.open("POST", "../controllers/Chat/Alta_Chat.php", true);
        xhr.onreadystatechange = function () {
            try {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    let res = JSON.parse(xhr.response);
                    if (res.success !== true) {
                        Swal.fire({
                            title: 'Error',
                            text: res.msg, // El mensaje de error que obtiene del servidor
                            icon: 'error',
                            confirmButtonText: 'Aceptar',
                            confirmButtonColor: '#F47B8F'
                        });
                        return;
                    }
                    Swal.fire({
                        title: res.msg,
                        icon: 'success',
                        confirmButtonText: 'Aceptar',
                        confirmButtonColor: '#F47B8F'
                    }).then((willDelete) => {
                        if (willDelete) {

                            window.location.href = `./chat.php?idChatSelected=${res.idNewChat}&idProductoSelected=${res.idProductChat}`;

                        } else {
                            alert("error");
                        }
                    });
                    console.log(res.msg);
                }
            } catch (error) {
                // Imprimir error del servidor
                console.error(xhr.response);
            }
        };

        // Enviar FormData en lugar de JSON
        xhr.send(formData);


    }      
</script>

</html>