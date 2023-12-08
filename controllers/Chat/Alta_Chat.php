<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Chat.php';
require_once __DIR__ . '/../../models/Producto.php';
$json = $_POST;
$mysqli = db::connect();
$Chat = Chat::parseJson($json);
session_start();
$idUser = $_SESSION["AUTH"];
$producto = Product::findProductoById($mysqli, $_POST['idProducto']);

$Chat->setIdUsuarioCliente($idUser);
$Chat->setIdUsuarioVendedor($producto->getIdUsuarioCreador());
$Chat->setIdStatus(1);
$Chat->setIdProducto($_POST['idProducto']);
$Chat->setFechaCreacion($_POST['fECHA']);


try {
    // Insertar la categoría
    $Chat->insertChat($mysqli);

    $idNewChat = $Chat->getLastidChat($mysqli);


    $json_response = [
        "success" => true,
        "msg" => "Se agregó el chat con éxito",
        "idNewChat" => $idNewChat->getIdChat(),
        "idProductChat" => $_POST['idProducto']
    ];


} catch (Exception $e) {
    $json_response = ["success" => false, "msg" => "Error al crear chat" . $e->getMessage()];
    exit;
}

header('Content-Type: application/json');

echo json_encode($json_response);

