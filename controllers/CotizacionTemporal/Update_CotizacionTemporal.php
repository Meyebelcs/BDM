<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . '/../../db.php';
    require_once __DIR__ . '/../../models/Chat.php';

    session_start();

    // Obtener JSON
    $json = $_POST;
    $mysqli = db::connect();


    try {

        Chat::updateCotizacionTemporalStatus($mysqli, $_POST["idChat"] , $_POST["idProducto"]);
        $json_response = ["success" => true, "msg" => 'se cambió el status a visible'];

    } catch (Exception $e) {
        // Error en la actualización
        $json_response = ["success" => false, "msg" => "Error al actualizar el status a visible: " . $e->getMessage()];
    }

    header('Content-Type: application/json');
    echo json_encode($json_response);

}