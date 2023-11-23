<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Lista.php';

$json = $_POST;
$mysqli = db::connect();
$Lista = Lista::parseJson($json);
$nombreLista = $Lista->getNombre();

try {
    // Verificar si se proporcionó una imagen
    if (isset($_FILES["Imagen"])) {
        // Obtener la información del archivo
        $fileInfo = $_FILES["Imagen"];

        // Validar si ocurrieron errores durante la carga del archivo
        if ($fileInfo["error"] !== UPLOAD_ERR_OK) {
            $json_response["msg"] = "Error al cargar la imagen.";
            throw new Exception("Error al cargar la imagen.");
        }

        $imgContenido = file_get_contents($fileInfo["tmp_name"]);

        $Lista->setImagen($imgContenido);
        // Insertar el producto
        $Lista->insertLista($mysqli);

        // Éxito al insertar la lista
        $json_response["success"] = true;
        $json_response["msg"] = "Lista creada correctamente.";

    } else {
        // No se proporcionó ninguna imagen
        $json_response["msg"] = "No se ha proporcionado ninguna imagen.";
    }
} catch (Exception $e) {
    // Manejar excepciones
    $json_response["msg"] = "Error al crear la lista: " . $e->getMessage();
}

header('Content-Type: application/json');

echo json_encode($json_response);

?>