<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Carrito.php';
require_once __DIR__ . '/../../models/Producto.php';
$json = $_POST;
$mysqli = db::connect();
$carrito = Carrito::parseJson($json);
session_start();
$idUser = $_SESSION["AUTH"];
$producto = Product::findProductoById($mysqli, $_POST['idProducto']);

$carrito->setCantidad(0);
$carrito->setDescripcion('');
$carrito->setFechaAgregado($_POST['fECHA']);
$carrito->setCantidad(0);
$carrito->setIdProducto($_POST['idProducto']);
$carrito->setIdStatus(5);
$carrito->setIdUsuarioCliente($idUser);
$carrito->setPrecioUnitario($producto ->getPrecio());
$carrito->setSubtotal(0);
$carrito->setTipo('Stock');


try {
    // Insertar la categoría
    $carrito->insertCarrito($mysqli);

    $json_response = ["success" => true];
    $json_response["msg"] = "Se agregó a carrito con éxito";


} catch (Exception $e) {
    $json_response = ["success" => false, "msg" => "Error al crear carrito" . $e->getMessage()];
    exit;
}

header('Content-Type: application/json');

echo json_encode($json_response);

