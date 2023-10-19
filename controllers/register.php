<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../db.php";
    require_once "../models/User.php";

    $json = json_decode(file_get_contents('php://input'), true);
    $mysqli = db::connect();
    $user = User::parseJson($json);
    $username = $user->getUsername();

    // Verificar si el nombre de usuario ya existe
    if (User::doesUsernameExist($mysqli, $username)) {
        $json_response = ["success" => false, "msg" => "Este nombre de usuario ya existe"];
    } else {
        try {
            // Si el nombre de usuario no existe, guarda el nuevo usuario
            $user->save($mysqli);
            $json_response = ["success" => true];
            $json_response["msg"] = "Se ha creado el usuario $username";
        } catch (Exception $e) {
            $json_response = ["success" => false, "msg" => "Error al crear el usuario: " . $e->getMessage()];
        }
    }

    header('Content-Type: application/json');
    echo json_encode($json_response);
}
