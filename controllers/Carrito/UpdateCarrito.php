<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . '/../../db.php';
    require_once __DIR__ . '/../../models/Carrito.php';

    session_start();

    // Obtener JSON
    $json = $_POST;
    $mysqli = db::connect();


    try {
        $result = Carrito::updateCarritoCantidad($mysqli, $_POST["idCarrito"], $_POST["accion"]);
    
        if ($result["success"]) {
            $json_response = ["success" => true, "msg" => $result["msg"]];
        } else {
            $json_response = ["success" => false, "msg" => $result["msg"]];
        }
    } catch (Exception $e) {
        // Error en la actualización
        $json_response = ["success" => false, "msg" => "Error al actualizar Cantidad Carrito: " . $e->getMessage()];
    }

    header('Content-Type: application/json');
    echo json_encode($json_response);

}