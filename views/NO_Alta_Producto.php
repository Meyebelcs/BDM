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
    <title>Agregar Producto</title>

    <?php include_once "./libs/fonts.php" ?>
    <?php include_once "./libs/bootstrap.php" ?>
    <link rel="stylesheet" href="./css/pages/Alta_Producto.css">


</head>

<body>

    <!-- navbar.php -->
    <?php include('./components/navbar.php'); ?>

    <main m-0 p-0 class="background">

        <!-- Hero -->
        <div class="text-center mb-3">
            <h3 class="border-bottom p-2 pt-3" id="switchText">Añadir Productos</h3>
            <!-- Interruptor de bolita -->
            <label class="switch">
                <input type="checkbox" id="switchInput">
                <span class="slider round"></span>
            </label>
        </div>

        <!-- Contenido -->
        <div class="container">
            <div class="productosStock">
                <!-- Cards -->
                <h1 class="text-center">Nuevo Producto</h1>
                <form action="procesar_formulario.php" method="POST" enctype="multipart/form-data"
                    onsubmit="return validarFormularioStock();">
                    <label for="nombreStock">Nombre del Producto:</label>
                    <input type="text" id="nombreStock" name="nombreStock" required>
                    <br><br>

                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="2" required></textarea>
                    <br><br>

                    <label for="precio">Precio:</label>
                    <input type="number" id="precio" name="precio" step="0.01" required pattern="\d+(\.\d{2})?"
                        title="Ingrese un número válido con dos decimales (p.ej. 12.34)">
                    <br><br>

                    <label for="inventario">Inventario:</label>
                    <input type="number" id="inventario" name="inventario" required>

                    <br><br>

                    <label for="Categoria">Categoria:</label>
                    <input type="text" id="Categoria" name="Categoria" required>
                    <br><br>

                    <label for="imagenStock">Imágenes del Producto:</label>
                    <input type="file" id="imagenStock" name="imagenStock[]" accept="image/*" multiple>
                    <br><br>

                    <div id="previewStock" style="display: flex; flex-wrap: wrap;">
                        <!-- Aquí se mostrarán las imágenes seleccionadas por el usuario en la sección de stock -->
                    </div>

                    <div class="text-center">
                        <input type="submit" class="btn btn-orange" value="Agregar Producto">
                    </div>
                </form>
            </div>

            <div class="productosCotizacion">
                <!-- Cards COTIZACION--------->
                <h1 class="text-center">Nueva Cotizacion</h1>
                <form action="procesar_formulario.php" method="POST" enctype="multipart/form-data"
                    onsubmit="return validarFormularioCotizacion();">
                    <label for="nombreCotizacion">Nombre del Producto:</label>
                    <input type="text" id="nombreCotizacion" name="nombreCotizacion" required>
                    <br><br>

                    <label for="descripcion">Descripción:</label>
                    <textarea id="descripcion" name="descripcion" rows="4" required></textarea>
                    <br><br>

                    <label for="Categoria">Categoria:</label>
                    <input type="text" id="Categoria" name="Categoria" required>
                    <br><br>

                    <label for="imagenCotizacion">Imágenes del Producto:</label>
                    <input type="file" id="imagenCotizacion" name="imagenCotizacion[]" accept="image/*" multiple>
                    <br><br>

                    <div id="previewCotizacion" style="display: flex; flex-wrap: wrap;">
                        <!-- Aquí se mostrarán las imágenes seleccionadas por el usuario en la sección de cotización -->
                    </div>

                    <div class="text-center">
                        <input type="submit" class="add btn btn-orange " value="Agregar Producto">
                    </div>
                </form>
            </div>
        </div>

        <!-- Footer -->
        <?php include('./components/footer.php'); ?>

        <?php include_once "./libs/jqueryJS.php" ?>
        <?php include_once "./libs/bootstrapJS.php" ?>
        <?php include_once "./libs/sweetalertJS.php" ?>
        <script src="./js/Alta_Producto.js"></script>

    </main>

</body>


</html>