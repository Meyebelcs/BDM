<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . '/../../db.php';
    require_once __DIR__ . '/../../models/Producto.php';

    session_start();

    // Obtener JSON
    $json = $_POST;
    $mysqli = db::connect();


    $Producto = Product::parseJson($json);
    $Productoinfo = Product::findProductoById($mysqli, (int) $_POST['idProducto']);


 
    $Producto->setIdStatus( $_POST['idStatus']);
    $Producto->setPrecio(0);
    $Producto->setInventario(0);
    $Producto->setNombre($Productoinfo->getNombre());
    $Producto->setDescripcion($Productoinfo->getDescripcion());
    $Producto->setFechaActualizacion($Productoinfo->getFechaActualizacion());

  
    try {
        // Llamar al método de actualización
        $resultado = $Producto->updateProducto($mysqli);

        if ($resultado) {
            // Éxito en la actualización
            $json_response = ["success" => true];
            $json_response["msg"] = "Producto actualizado con éxito.";
        } else {
            // Error en la actualización
            $json_response = ["success" => false, "msg" => "No se pudo actualizar el Producto."];
        }
    } catch (Exception $e) {
        // Error en la actualización
        $json_response = ["success" => false, "msg" => "Error al actualizar el Producto: " . $e->getMessage()];
    }

    header('Content-Type: application/json');
    echo json_encode($json_response);

}