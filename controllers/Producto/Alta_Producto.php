<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Producto.php';
require_once __DIR__ . '/../../models/Archivo.php';
$json = $_POST;
$mysqli = db::connect();
$producto = Product::parseJson($json);
$nombreProducto = $producto->getNombre();

try {
    // Insertar el producto
    $producto->insertProducto($mysqli);

    // Obtener el ID del producto recién insertado
    $idProducto = $producto->getIdProducto();

    /* // Verificar si se enviaron imágenes
    if (isset($_FILES['imagenesStock'])) {
        // Acceder a las imágenes
        $imagenesStock = $_FILES['imagenesStock'];

        // Iterar sobre las imágenes
        for ($i = 0; $i < count($imagenesStock['name']); $i++) {

            $tempImagen = $imagenesStock['tmp_name'][$i];

            //  la guardamos en la base de datos utilizando el modelo Archivo
            $archivo = new Archivo($producto->getIdProducto(), '2', file_get_contents($tempImagen));
            $archivo->insertArchivo($mysqli);
        }
    } */

    $json_response = ["success" => true];
    $json_response["msg"] = "Se ha creado el producto $nombreProducto";
} catch (Exception $e) {
    $json_response = ["success" => false, "msg" => "Error al crear el producto: " . $e->getMessage()];
}

header('Content-Type: application/json');
echo json_encode($json_response);
?>