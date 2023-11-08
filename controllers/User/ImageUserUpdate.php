<?php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . '/../../db.php';
    require_once __DIR__ . '/../../models/User.php';

    session_start();

    // Obtener JSON
    $json = $_POST; // Para los campos que no son archivos
    $mysqli = db::connect();

    $user = User::parseJson($json);
    $idUser = $_SESSION["AUTH"];
    $user = User::findUserById($mysqli, (int) $idUser);
    $username = $user->getUsername();

    // Accede a la imagen a través de la variable $_POST
    //$image = $_POST['Upload'];

    // Añade estas líneas para depurar
    $uploadedImage = $_POST['archivo'];
    $imageeeeeen = $_FILES['Upload']['name'];
    $php = 'entró a php';
    var_dump($php); // Muestra los datos del archivo
    var_dump($imageeeeeen); // Muestra los datos del archivo

    var_dump($uploadedImage); // Muestra los datos del archivo
    die(); // Detiene la ejecución del script para que puedas inspeccionar los datos


    if (!empty($image)) {

        // El campo del archivo no está vacío, lo que significa que se cargó un archivo.
        // Puedes continuar con el procesamiento aquí.

        // Subir la imagen
        $fileDirectory = "../Files/"; // Ruta de la carpeta donde deseas guardar las imágenes
        $originalFileName = basename($image); // Nombre del archivo original con extensión
        $extension = pathinfo($originalFileName, PATHINFO_EXTENSION); // Obtener la extensión del archivo
        $uniqueIdentifier = uniqid(); // Generar un identificador único
        $fileName = $username . '_' . $uniqueIdentifier . '.' . $extension; // Nombre del archivo con identificador único

        // Actualizar las propiedades del objeto User con nuevos valores
        $user->setIdUsuario($idUser);
        $user->setImagen($fileName);

        try {
            if ($user->updateImage($mysqli)) {
                $json_response = ["success" => true];
                $json_response["msg"] = "Imagen actualizada con éxito";
                exit;
            } else {
                $json_response = ["success" => false];
                $json_response["msg"] = "Error al actualizar la imagen";
            }
        } catch (Exception $e) {
            // Error en la actualización
            $json_response = ["success" => false, "msg" => "Error al actualizar la imagen: " . $e->getMessage()];
        }
    } else {
        // El campo del archivo está vacío, lo que significa que no se cargó ningún archivo.
        // Puedes mostrar un mensaje de error o realizar alguna acción en consecuencia.
        $json_response = ["success" => false, "msg" => "No se seleccionó ningún archivo para cargar."];
    }

    header('Content-Type: application/json');
    echo json_encode($json_response);
}
