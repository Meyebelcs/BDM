<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . '/../../db.php';
    require_once __DIR__ . '/../../models/User.php';

    // Obtiene el valor de la variable de sesión "AUTH" y lo asigna a la variable $idUser
    session_start();
    $idUser = isset($_SESSION['AUTH']) ? $_SESSION['AUTH'] : '';


    // Obtener JSON
    $json = json_decode(file_get_contents('php://input'), true);
    $mysqli = db::connect();

    // Crear un objeto User a partir de JSON
    $user = User::parseJson($json);

    // Actualizar las propiedades del objeto User con nuevos valores
    $user->setIdUsuario($idUser);
    $user->setUsername($json["editUsername"]);
    $user->setModo($json["editMod"]);
    $user->setNombres($json["editName"]);
    $user->setApellidos($json["editLastname"]);
    $user->setSexo($json["editGender"]);
    $user->setFechaNacimiento($json["editBirthday"]);
    $user->setEmail($json["editEmail"]);
    $user->setContrasena($json["editPassword"]);
    $user->setFechaModificacion($json["editFechaModificacion"]);

    try {
        // Llamar al método de actualización
        $resultado = $user->update($mysqli);

        if ($resultado) {
            // Éxito en la actualización
            $json_response = ["success" => true];
            $json_response["msg"] = "Usuario actualizado con éxito.";
        } else {
            // Error en la actualización
            $json_response = ["success" => false, "msg" => "No se pudo actualizar el usuario."];
        }
    } catch (Exception $e) {
        // Error en la actualización
        $json_response = ["success" => false, "msg" => "Error al actualizar el usuario: " . $e->getMessage()];
    }

    header('Content-Type: application/json');
    echo json_encode($json_response);

}
