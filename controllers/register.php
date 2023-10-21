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
        // Realiza la validación de la contraseña 
        $password = $user->getContrasena();
        if (!validatePassword($password)) {
            $json_response = ["success" => false, "msg" => "La contraseña no cumple con los requisitos"];
        } else {
            try {
                // Si el nombre de usuario no existe y la contraseña es válida, guarda el nuevo usuario
                $user->save($mysqli);
                $json_response = ["success" => true];
                $json_response["msg"] = "Se ha creado el usuario $username";
            } catch (Exception $e) {
                $json_response = ["success" => false, "msg" => "Error al crear el usuario: " . $e->getMessage()];
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode($json_response);
}

// Función para validar la contraseña
function validatePassword($password) {
    if (strlen($password) < 8) {
        return false;
    }
    if (!preg_match('/[0-9]/', $password)) {
        return false;
    }
    if (!preg_match('/[A-Z]/', $password)) {
        return false;
    }
    if (!preg_match('/[°|¬!"#$%&\/()=?¡\'¿¨*\]´+}~`{[^;:_,.\-<>@\\\\]/', $password)) {
        return false;
    }    
    
    return true;
}
