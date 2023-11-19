<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Categoria.php';
$json = $_POST;
$mysqli = db::connect();
$categoria = Categoria::parseJson($json);
$nombrecategoria = $categoria->getNombre();



try {
    // Insertar la categoría
    $categoria->insertCategoria($mysqli);

    // Obtener todas las categorías actualizadas después de la inserción
    $arraycategorias = Categoria::getAllCategorias($mysqli);

    $json_response = ["success" => true];
    $json_response["msg"] = "Se ha creado la categoría $nombrecategoria con éxito";
    $json_response["categorias"] = $arraycategorias;


} catch (Exception $e) {
    $json_response = ["success" => false, "msg" => "Error al crear la categoría: " . $e->getMessage()];
    exit;
}

header('Content-Type: application/json');

echo json_encode($json_response);

