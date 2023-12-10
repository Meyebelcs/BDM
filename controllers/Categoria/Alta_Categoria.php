<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Categoria.php';
$json = $_POST;
$mysqli = db::connect();
$categoria = Categoria::parseJson($json);
$nombrecategoria = $categoria->getNombre();



try {
    // Verificar si ya existe una categoría con ese nombre
    $existeCategoria = Categoria::categoriaExists($mysqli, $nombrecategoria);
  
    if ($existeCategoria) {
        // La categoría ya existe, puedes manejarlo según tus necesidades
        $json_response = ["success" => false, "msg" => "La categoría ya existe con el nombre $nombrecategoria"];
    } else {
        // La categoría no existe, puedes proceder con la inserción
        $categoria->insertCategoria($mysqli);

        // Obtener todas las categorías actualizadas después de la inserción
        $arraycategorias = Categoria::getAllCategorias($mysqli);

        $json_response = ["success" => true];
        $json_response["msg"] = "Se ha creado la categoría $nombrecategoria con éxito";
        $json_response["categorias"] = $arraycategorias;
    }

} catch (Exception $e) {
    $json_response = ["success" => false, "msg" => "Error al crear la categoría: " . $e->getMessage()];
    exit;
}

header('Content-Type: application/json');

echo json_encode($json_response);

