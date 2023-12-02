<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . '/../../db.php';
    require_once __DIR__ . '/../../models/Carrito.php';

    session_start();

    // Obtener JSON
    $json = $_POST;
    $mysqli = db::connect();


    try {

        $result = Carrito::updateCarritoStatus($mysqli, $_POST["idCarrito"]);
        $json_response = ["success" => true, "msg" => 'se agregó a carrito'];

    } catch (Exception $e) {
        // Error en la actualización
        $json_response = ["success" => false, "msg" => "Error al actualizar Carrito: " . $e->getMessage()];
    }

    header('Content-Type: application/json');
    echo json_encode($json_response);

}