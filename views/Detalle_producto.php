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

$producto = Product::findProductoById($mysqli, $_GET['idProductoIndex']);
$archivos = Archivo::getArchivoByProduct($mysqli, $_GET['idProductoIndex']);
$comentarios = Comentario::getCommentsByProduct($mysqli, $_GET['idProductoIndex']);

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

                            <a href="Carrito.php" class="btn w-100"><i class="bi bi-cart-fill"></i>
                                Comprar
                            </a>

                        </div>
                    </div>
                </div>

            </div>
            <div class="stars" id="stars">
                <span class="star" onclick="rate(1)">&#9733;</span>
                <span class="star" onclick="rate(2)">&#9733;</span>
                <span class="star" onclick="rate(3)">&#9733;</span>
                <span class="star" onclick="rate(4)">&#9733;</span>
                <span class="star" onclick="rate(5)">&#9733;</span>
            </div>
            <p>Valor seleccionado: <span id="selectedValue">0</span></p>

            <div class="comment-box">
                <label for="comment">Comentario:</label><br>
                <textarea id="comment" rows="4" cols="50"></textarea><br>
                <button onclick="saveComment()">Enviar</button>
            </div>
            <script>
                let selectedValue = 0;

                function rate(value) {
                    selectedValue = value;
                    const stars = document.querySelectorAll('.star');
                    stars.forEach((star, index) => {
                        if (index < value) {
                            star.style.color = 'black';
                        } else {
                            star.style.color = '#ccc';
                        }
                    });
                    document.getElementById('selectedValue').innerText = value;
                }
            </script>
            <script>
                function saveComment() {
                    const comment = document.getElementById('comment').value;
                    const data = {
                        selectedValue: selectedValue,
                        comment: comment
                    };

                    fetch('guardar_comentario.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data),
                    })
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Hubo un problema con la solicitud');
                            }
                            return response.json();
                        })
                        .then(result => {
                            // Manejar la respuesta del servidor si es necesario
                            console.log('Comentario guardado:', result);
                            // Por ejemplo, podrías redirigir al usuario a la página del producto
                            // window.location.href = 'pagina_producto.php';
                        })
                        .catch(error => {
                            console.error('Error al guardar el comentario:', error);
                            // Manejar errores, mostrar un mensaje al usuario, etc.
                        });
                }
            </script>

            <div class="row w-100">
                <h4 class="mt-4 mb-0">Reseñas</h4>
            </div>

            <div class="mt-2 w-200 border-top" style="margin-top: 90px;">

                <?php

                if (isset($comentarios)) {
                    foreach ($comentarios as $comment) {
                        // Acceder a las propiedades del comentario
                        echo "<br>";
                        echo '<img src="../Files/' . $comment->getimagenUsuario() . '" alt="Imagen de usuario" style="width: 35px; height: 35px; border-radius: 50%;">';

                        echo "<br>";
                        echo '<strong>' . $comment->getusername() . "</strong><br>";
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



</script>

</html>