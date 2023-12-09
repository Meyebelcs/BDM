<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Mensaje.php';

$json = $_POST;
$mysqli = db::connect();
$newMensaje = Mensaje::parseJson($json);

session_start();
$idUser = $_SESSION["AUTH"];


try {
    $newMensaje->setIdStatus(1);
    $newMensaje->setIdChat($_POST['idChat']);
    $newMensaje->setIdUsuarioCreador($idUser);
    $newMensaje->setMensaje($_POST['Mensaje']);
    $newMensaje->setFechaCreacion($_POST['FechaCreacion']);


    // Insertar el producto
    $newMensaje->insertMensaje($mysqli);


    // Éxito al insertar la lista
    $json_response["success"] = true;
    $json_response["msg"] = "mensaje creado correctamente.";

} catch (Exception $e) {
    // Manejar excepciones
    $json_response["msg"] = "Error al crear el mensaje: " . $e->getMessage();
}

header('Content-Type: application/json');

echo json_encode($json_response);

?>