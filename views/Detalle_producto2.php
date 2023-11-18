<?php
session_start();

require_once './components/menu.php';

require_once "../models/Producto.php";
require_once "../models/Comentario.php";


$producto = Product::findProductoById($mysqli, 2);

$comentarios = Comentario::getCommentsByProduct($mysqli, 2);

// Verificar si $comments está definido
if (isset($comentarios)) {
    foreach ($comentarios as $comment) {
        // Acceder a las propiedades del comentario
        echo $comment->getCalificacion();
        echo $comment->getFechaPublicacion();
        echo $comment->getComentario();
    }
} else {
    echo "No hay comentarios disponibles.";
}

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
                        <?php echo $titulo; ?>
                    </h1>
                    <a href="Perfil_Vendedor.php" style="text-decoration: none; color: inherit;">
                        <h4>Vendedor:
                            <?php echo $username; ?>
                        </h4>
                    </a>
                    <div class="d-flex justify-content-center mt-4">
                        <?php

                        // Conexión a la base de datos
                        $servername = "localhost";
                        $username = "root";
                        $password = "Ldmg1920";
                        $dbname = "stockcustom";

                        $conn = new mysqli($servername, $username, $password, $dbname);

                        if ($conn->connect_error) {
                            die("Connection failed: " . $conn->connect_error);
                        }

                        // ID del producto que deseas mostrar (sustitúyelo por el ID correcto)
                        //$idProducto = 2;
                        $queryArchivos = "SELECT CONCAT('../Files/', Archivo) AS ArchivoCompleto FROM Archivo WHERE idProducto = $idProducto";
                        $resultArchivos = $conn->query($queryArchivos);

                        if ($resultArchivos->num_rows > 0) {
                            // Mostrar las imágenes con un identificador único para cada una
                        
                            $index = 0;
                            echo "<div id='contenedorImagenes'>";
                            while ($rowArchivo = $resultArchivos->fetch_assoc()) {
                                echo "<img id='imagen_$index' src='" . $rowArchivo['ArchivoCompleto'] . "' alt='Imagen' style='display: none; max-width: 500px; max-height: 500px;'><br>";
                                $index++;
                            }
                            echo "<div style='margin-top: 10px; display: inline-block;'>";
                            echo "<button style='border-radius: 50%; width: 50px; height: 50px; margin-left: 130px;' onclick='cambiarImagen()'>></button>"; // Ajusta el margen izquierdo
                            echo "</div>";
                            echo "</div>"; // Cerrar el contenedor
                        } else {
                            echo "No hay imágenes asociadas a este producto.<br>";
                        }
                        ?>
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

                                // Conexión a la base de datos
                                $servername = "localhost";
                                $username = "root";
                                $password = "";
                                $dbname = "stockcustom";

                                $conn = new mysqli($servername, $username, $password, $dbname);

                                if ($conn->connect_error) {
                                    die("Connection failed: " . $conn->connect_error);
                                }


                                $sql = "SELECT c.*, u.Username, u.Imagen as ImagenUsuario
                                FROM Comentario c
                                INNER JOIN Usuario u ON c.idUsuarioCreador = u.idUsuario
                                WHERE c.idProducto = $idProducto";


                                $result = $conn->query($sql);

                                if ($result->num_rows > 0) {
                                    // Mostrar los comentarios y la información del usuario correspondiente
                                    while ($row = $result->fetch_assoc()) {
                                        $sumCalificaciones = 0;
                                        $numComentarios = 0;

                                        // Recorrer los comentarios y calcular la suma de las calificaciones
                                        while ($row = $result->fetch_assoc()) {
                                            $sumCalificaciones += intval($row["Calificacion"]);
                                            $numComentarios++;
                                        }

                                        // Calcular el promedio
                                        if ($numComentarios > 0) {
                                            $promedio = $sumCalificaciones / $numComentarios;


                                            for ($i = 1; $i <= 5; $i++) {
                                                if ($i <= $promedio) {
                                                    echo "<span style='color: black; font-size: 1.5em;'>&#9733;</span>"; // Estrella llena (código HTML del símbolo de estrella)
                                                } else {
                                                    echo "<span style='font-size: 1.5em;'>&#9734;</span>"; // Estrella vacía (código HTML del símbolo de estrella)
                                                }
                                            }
                                            echo "<br>";
                                        } else {
                                            echo "No hay calificaciones disponibles<br>";
                                        }

                                    }
                                } else {
                                    echo "No se encontraron comentarios para el producto con ID $idProducto";
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

                // Conexión a la base de datos
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "stockcustom";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }


                $sql = "SELECT c.*, u.Username, u.Imagen as ImagenUsuario
    FROM Comentario c
    INNER JOIN Usuario u ON c.idUsuarioCreador = u.idUsuario
    WHERE c.idProducto = $idProducto";


                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Mostrar los comentarios y la información del usuario correspondiente
                    while ($row = $result->fetch_assoc()) {
                        echo "<br>";
                        echo "<img src='../Files/" . $row["ImagenUsuario"] . "' alt='Imagen de perfil del usuario' style='width: 45px; height: 45px; border-radius: 50%;'><br>";
                        echo "<br>";
                        echo "<strong>Usuario: " . $row["Username"] . "</strong><br>";

                        $calificacion = intval($row["Calificacion"]); // Convertir la calificación a un número entero
                
                        echo "Calificación: ";
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $calificacion) {
                                echo "<span style='color: black;'>&#9733;</span>"; // Estrella llena (código HTML del símbolo de estrella)
                            } else {
                                echo "<span>&#9734;</span>"; // Estrella vacía (código HTML del símbolo de estrella)
                            }
                        }
                        echo "<br>";

                        $fecha_publicacion = date('d M Y', strtotime($row["Fecha_publicacion"]));
                        echo "Fecha: " . $fecha_publicacion . "<br>";
                        echo "Comentario: " . $row["Comentario"] . "<br>";

                        echo "<br>";
                        echo "<br>";
                    }
                } else {
                    echo "No se encontraron comentarios para el producto con ID $idProducto";
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


        <!-- <script src="./Scripts/03_Perfil_Cliente.js"></script> -->

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