<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/ProductoEnLista.php';

$json = $_POST;
$mysqli = db::connect();
$producto = ProductoEnLista::parseJson($json);
session_start();
$idUser = $_SESSION["AUTH"];
$json_response = [];

try {
    $producto->setIdUsuarioCreador($idUser);

    // Verificar si el producto ya existe en la lista
    if ($producto->productoEnListaExists($mysqli)) {
        // El producto ya existe en la lista
        $json_response["success"] = false;
        $json_response["msg"] = "El producto ya está en la lista.";
    } else {
        // Insertar el producto solo si no existe en la lista
        $producto->insertProductoEnLista($mysqli);

        // Éxito al insertar la lista
        $json_response["success"] = true;
        $json_response["msg"] = "Se agregó a la lista correctamente.";
    }
} catch (Exception $e) {
    // Manejar excepciones
    $json_response["success"] = false;
    $json_response["msg"] = "Error al agregar producto a la lista: " . $e->getMessage();
}

header('Content-Type: application/json');
echo json_encode($json_response);
?>
