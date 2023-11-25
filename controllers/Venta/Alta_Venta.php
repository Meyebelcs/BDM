<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Venta.php';
require_once __DIR__ . '/../../models/Carrito.php';

$json = $_POST;
$mysqli = db::connect();
session_start();
$idUser = $_SESSION["AUTH"];

$idCarritos = $_POST['idCarrito'];
$identificadorUnico = uniqid();


try {
    foreach ($idCarritos as $idCarrito) {

        $Venta = Venta::parseJson($json);
        $ProductoCarrito = Carrito::getAllProductsCarritoById($mysqli, $idCarrito);
        $Producto = $ProductoCarrito[0];

        $Venta->setIdUsuarioCliente($idUser);
        $Venta->setFechaHrRegistro($_POST['fechaHrRegistro']);
        $Venta->setIdProducto($Producto->getIdProducto());
        $Venta->setIdCarrito($Producto->getIdCarrito());
        $Venta->setidStatus(2);
        $Venta->settotal($Producto->getSubtotal());
        $Venta->setCantidad($Producto->getCantidad());
        $Venta->setidentificador($identificadorUnico);

        $Venta->insertVenta($mysqli);

        
    }
    // Éxito al insertar la lista
    $json_response["success"] = true;
    $json_response["msg"] = "Venta creada correctamente.";


} catch (Exception $e) {
    // Manejar excepciones
    $json_response["msg"] = "Error al crear la Venta: " . $e->getMessage();
}

header('Content-Type: application/json');

echo json_encode($json_response);

?>