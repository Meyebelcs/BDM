<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../db.php";
    require_once "../models/User.php";

    //Obtener Json
    $json = json_decode(file_get_contents('php://input'),true);
    
    $mysqli = db::connect();
    $user = User::parseJson($json);

    try {
        $user->save($mysqli);
        $username = $user->getUsername();
        $json_response = ["success" => true, "msg" => "Se ha creado el usuario $username"];
    } catch (Exception $e) {
        $json_response = ["success" => false, "msg" => "Error al crear el usuario: " . $e->getMessage()];
    }

    header('Content-Type: application/json');
    echo json_encode($json_response);
}
