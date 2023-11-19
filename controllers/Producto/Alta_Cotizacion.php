<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Producto.php';
require_once __DIR__ . '/../../models/Archivo.php';
require_once __DIR__ . '/../../models/Material_Inventario.php';
require_once __DIR__ . '/../../models/ProductosConCategoria.php';
$json = $_POST;
$mysqli = db::connect();
$producto = Product::parseJson($json);
$nombreProducto = $producto->getNombre();


try {
    // Insertar el producto
    $producto->insertProducto($mysqli);

    $idProducto = $producto->getLastidProducto($mysqli);

    $uploadedFiles = $_FILES['imagenesCotizacion'];


    //alta de materiales ----------------------
    $materiales = $_POST["materiales"];

    // Iterar sobre los materiales
    foreach ($materiales as $material) {

        // Guarda el contenido en la base de datos
        $material = new MaterialInventario($idProducto->getIdProducto(), '1', $material['Fecha_creacion'], $material['Nombre'], $material['Cantidad']);
        $material->insertMaterialInventario($mysqli);

    }

    //alta de producto con categoria----------------------
    $categorias = $_POST["categorias"];

    // Iterar sobre los materiales
    foreach ($categorias as $idcategoria) {

        $categoria = new ProductosConCategoria($idcategoria, $idProducto->getIdProducto(), '2');
        $categoria->insertProductosConCategoria($mysqli);
    }
    

    // Verifica si se enviaron archivos
    if (!empty($uploadedFiles['name'][0])) {
        $uploadedFileCount = count($uploadedFiles['name']);

        for ($i = 0; $i < $uploadedFileCount; $i++) {
            // Verifica si el archivo se cargó correctamente
            if ($uploadedFiles["error"][$i] === UPLOAD_ERR_OK) {


                $imgSize = filesize($uploadedFiles["tmp_name"][$i]);

                // Define el tamaño máximo permitido para LONGBLOB (en bytes)
                $maxSizeAllowed = 4294967295;  // 4 GB

                // Verifica si el tamaño del archivo excede el límite
                if ($imgSize > $maxSizeAllowed) {
                    $json_response = ["success" => false];
                    $json_response["msg"] = "El archivo supera el tamaño máximo permitido.";
                    throw new Exception("El archivo supera el tamaño máximo permitido.");
                }

                // Lee el contenido binario del archivo
                $imgContenido = file_get_contents($uploadedFiles["tmp_name"][$i]);

                // Guarda el contenido binario en la base de datos
                $archivo = new Archivo($idProducto->getIdProducto(), '1', $imgContenido);
                $archivo->insertArchivo($mysqli);

                // echo "El archivo se ha guardado en la base de datos.";
            } else {
                //echo "Error al cargar el archivo: " . $uploadedFiles["error"][$i];
            }
        }

        $json_response = ["success" => true];
        $json_response["msg"] = "Se ha creado la cotización $nombreProducto y archivos";
    } else {
        //echo "No se cargaron archivos.";
        $json_response = ["success" => true];
        $json_response["msg"] = "Se ha creado la cotización $nombreProducto pero no archivos";
        exit;
    }

} catch (Exception $e) {
    $json_response = ["success" => false, "msg" => "Error al crear la cotización: " . $e->getMessage()];
    exit;
}

header('Content-Type: application/json');

echo json_encode($json_response);

