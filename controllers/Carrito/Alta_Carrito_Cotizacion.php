<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Carrito.php';
require_once __DIR__ . '/../../models/Producto.php';
require_once __DIR__ . '/../../models/Chat.php';
require_once __DIR__ . '/../../models/Material_Carrito.php';
$json = $_POST;
$mysqli = db::connect();
$carrito = Carrito::parseJson($json);
session_start();
$idUser = $_SESSION["AUTH"];
$producto = Product::findProductoById($mysqli, $_POST['idProducto']);

$Chats = Chat::getChatsByUser($mysqli, $idUser);
$idUsuarioVendedor='';
$idUsuarioCliente='';

if ($Chats) {
    foreach ($Chats as $Chat) {
       
        if ( $_POST['idChat'] == $Chat->getIdChat()) {
            $idUsuarioVendedor = $Chat->getIdUsuarioVendedor();
            $idUsuarioCliente = $Chat->getIdUsuarioCliente();
        }
    }
}


$carrito->setIdUsuarioCliente($idUsuarioCliente);


$carrito->setCantidad($_POST['Cantidad']);
$carrito->setPrecioUnitario($_POST['precioProduct']);
$carrito->setDescripcion($_POST['Descripcion']);
$carrito->setFechaAgregado($_POST['fECHA']);
$carrito->setIdProducto($_POST['idProducto']);
$carrito->setIdStatus(7);

$SUBTOTAL= floatval($carrito->getPrecioUnitario()) * floatval($_POST['Cantidad']);

$carrito->setSubtotal($SUBTOTAL);
$carrito->setTipo('Cotizacion');



try {
    // Insertar la categoría
    $carrito->insertCarrito($mysqli);

    $idCarritonew = $carrito->getLastidCarrito($mysqli);

     //alta de materiales ----------------------
     $materiales = $_POST["materiales"];
   
     // Iterar sobre los materiales
     foreach ($materiales as $material) {
 
         // Guarda el contenido en la base de datos
         $material = new MaterialCarrito($idCarritonew->getIdCarrito(), $material['idMaterial'], 6, $material['Cantidad']);
         $material->insertMaterialCarrito($mysqli);
 
     }

    $json_response = ["success" => true];
    $json_response["msg"] = "Se agregó a carrito con éxito";


} catch (Exception $e) {
    $json_response = ["success" => false, "msg" => "Error al crear carrito" . $e->getMessage()];
    exit;
}

header('Content-Type: application/json');

echo json_encode($json_response);

