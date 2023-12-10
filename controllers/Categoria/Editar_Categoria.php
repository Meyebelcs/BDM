<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    require_once __DIR__ . '/../../db.php';
    require_once __DIR__ . '/../../models/Categoria.php';

    session_start();

    // Obtener JSON
    $json = $_POST;
    $mysqli = db::connect();

    $Categoria = Categoria::parseJson($json);
    $Categoriainfo = Categoria::findCategoriaById($mysqli, $_POST['idCategoria']);

    $Categoria->setNombre($_POST['Nombre']);
    $Categoria->setDescripcion($_POST['Descripción']);
    $Categoria->setIdCategoria($_POST['idCategoria']);
    $Categoria->setIdStatus(1);

    try {
        if ($_POST['Nombre'] != $Categoriainfo->getNombre()) {
            // Verificar si ya existe una categoría con ese nombre
            $existeCategoria = Categoria::categoriaExists($mysqli, $_POST['Nombre']);

            if ($existeCategoria) {
                // La categoría ya existe, puedes manejarlo según tus necesidades
                $json_response = ["success" => false, "msg" => "La categoría ya existe con el nombre {$_POST['Nombre']}"];
                echo json_encode($json_response);
                exit;
            }
        }

        // Llamar al método de actualización
        $resultado = $Categoria->updateCategoria($mysqli);

        if ($resultado) {
            // Éxito en la actualización
            $json_response = ["success" => true, "msg" => "Categoria actualizada con éxito."];
        } else {
            // Error en la actualización
            $json_response = ["success" => false, "msg" => "No se pudo actualizar la categoría."];
        }
    } catch (Exception $e) {
        // Error en la actualización
        $json_response = ["success" => false, "msg" => "Error al actualizar la categoría: " . $e->getMessage()];
    }

    header('Content-Type: application/json');
    echo json_encode($json_response);
    exit;
}
