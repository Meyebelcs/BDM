<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once "../db.php";
    require_once "../models/User.php";

    $json = $_POST; // Para los campos que no son archivos
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
            
            // Subir la imagen
            $fileDirectory = "../Files/"; // Ruta de la carpeta donde deseas guardar las imágenes
            $originalFileName = basename($_FILES['Imagen']['name']); // Nombre del archivo original con extensión
            $extension = pathinfo($originalFileName, PATHINFO_EXTENSION); // Obtener la extensión del archivo
            $uniqueIdentifier = uniqid(); // Generar un identificador único
            $fileName = $username . '_' . $uniqueIdentifier . '.' . $extension; // Nombre del archivo con identificador único


            if (move_uploaded_file($_FILES['Imagen']['tmp_name'], $fileDirectory . $fileName)) {
                // La imagen se ha subido correctamente, ahora puedes guardar el nombre del archivo en la base de datos
                $user->setImagen($fileName);
                try {
                    // Si el nombre de usuario no existe y la contraseña es válida, guarda el nuevo usuario
                    $user->save($mysqli);
                    $json_response = ["success" => true];
                    $json_response["msg"] = "Se ha creado el usuario $username";
                } catch (Exception $e) {
                    $json_response = ["success" => false, "msg" => "Error al crear el usuario: " . $e->getMessage()];
                }
            } else {
                $json_response = ["success" => false, "msg" => "Error al subir la imagen"];
            }
        }
    }

    header('Content-Type: application/json');
    echo json_encode($json_response);
}

// Función para validar la contraseña
function validatePassword($password)
{
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
