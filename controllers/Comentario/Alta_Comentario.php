<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Comentario.php';

$json = $_POST;
$mysqli = db::connect();
$newComent = Comentario::parseJson($json);

try {
    // Insertar el producto
    $newComent->insertComentario($mysqli);

    $comentarios = Comentario::getCommentsByProduct($mysqli, $_POST['idProducto']);


    // Éxito al insertar la lista
    $json_response["success"] = true;
    $json_response["msg"] = "Comentario creado correctamente.";
    $json_response["comentarios"] = $comentarios;

} catch (Exception $e) {
    // Manejar excepciones
    $json_response["msg"] = "Error al crear Comentario: " . $e->getMessage();
}

header('Content-Type: application/json');

echo json_encode($json_response);

?>