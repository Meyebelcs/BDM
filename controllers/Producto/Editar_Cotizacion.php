<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . '/../../db.php';
    require_once __DIR__ . '/../../models/Producto.php';

    session_start();

    // Obtener JSON
    $json = $_POST;
    $mysqli = db::connect();


    $Producto = Product::parseJson($json);
    $Productoinfo = Product::findProductoById($mysqli, (int) $_POST['idProducto']);


    $Producto->setNombre($_POST['Nombre']);
    $Producto->setDescripcion($_POST['Descripción']);
    $Producto->setFechaActualizacion($_POST['Fecha_actualizacion']);
    $Producto->setIdStatus($_POST['idStatus']);
    $Producto->setPrecio(0);
    $Producto->setInventario(0);
    
    /* // Verificar si el nuevo nombre de usuario es diferente al actual
    if ($json["editUsername"] !== $user->getUsername()) {
        // El nuevo nombre de usuario es diferente, verificamos si ya existe
        if (User::doesUsernameExist($mysqli, $json["editUsername"])) {
            // El nombre de usuario ya existe, devolvemos un mensaje de error
            $json_response = ["success" => false, "msg" => "El nombre de usuario ya existe"];
            header('Content-Type: application/json');
            echo json_encode($json_response);
            exit; // Detenemos la ejecución del script
        }
    } */

  
    try {
        // Llamar al método de actualización
        $resultado = $Producto->updateProducto($mysqli);

        if ($resultado) {
            // Éxito en la actualización
            $json_response = ["success" => true];
            $json_response["msg"] = "Producto actualizado con éxito.";
        } else {
            // Error en la actualización
            $json_response = ["success" => false, "msg" => "No se pudo actualizar el Producto."];
        }
    } catch (Exception $e) {
        // Error en la actualización
        $json_response = ["success" => false, "msg" => "Error al actualizar el Producto: " . $e->getMessage()];
    }

    header('Content-Type: application/json');
    echo json_encode($json_response);

}