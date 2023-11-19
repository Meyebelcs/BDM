<?php
require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Producto.php';
require_once __DIR__ . '/../../models/Archivo.php';
$json = $_POST;
$mysqli = db::connect();
$producto = Product::parseJson($json);
$nombreProducto = $producto->getNombre();


try {
    // Insertar el producto
    $producto->insertProducto($mysqli);

    $idProducto = $producto->getLastidProducto($mysqli);

    $uploadedFiles = $_FILES['imagenesStock'];

    //alta de producto con categoria tambien----------------------


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
        $json_response["msg"] = "Se ha creado el producto $nombreProducto y archivos";
    } else {
        //echo "No se cargaron archivos.";
        $json_response = ["success" => true];
        $json_response["msg"] = "Se ha creado el producto $nombreProducto pero nooo archivos";
        exit;
    }

} catch (Exception $e) {
    $json_response = ["success" => false, "msg" => "Error al crear el producto: " . $e->getMessage()];
    exit;
}

header('Content-Type: application/json');

echo json_encode($json_response);

/* 
require_once __DIR__ . '/../db.php';
require_once __DIR__ . '/../models/Producto.php';
require_once __DIR__ . '/../models/Archivo.php';

$json = $_POST;
$mysqli = db::connect();
$producto = Product::parseJson($json);
$nombreProducto = $producto->getNombre();


try {
    // Insertar el producto
    $producto->insertProducto($mysqli);

    // Obtener el ID del producto recién insertado
    
    $idProducto = $producto->getLastidProducto($mysqli);
   // echo 'id= ' . $idProducto->getIdProducto();

    $uploadedFiles = $_FILES['imagenesStock'];

    // Ruta donde se guardarán los archivos
    $uploadDirectory = '../Files/';

    // Verifica si se enviaron archivos
    if (!empty($uploadedFiles['name'][0])) {
        $uploadedFileCount = count($uploadedFiles['name']);

        for ($i = 0; $i < $uploadedFileCount; $i++) {
            // Verifica si el archivo se cargó correctamente
            if ($uploadedFiles["error"][$i] === UPLOAD_ERR_OK) {
                // Genera un identificador único
                $uniqueIdentifier = uniqid();

                // Construye la ruta de destino con identificador único
                $destination = $uploadDirectory . $uniqueIdentifier . '_' . basename($uploadedFiles["name"][$i]);
                $filename = $uniqueIdentifier . '_' . basename($uploadedFiles["name"][$i]);

                // Mueve el archivo a la carpeta de destino
                move_uploaded_file($uploadedFiles["tmp_name"][$i], $destination);

                // Guarda el contenido binario en la base de datos
                $archivo = new Archivo($idProducto->getIdProducto(), '1', $filename);
                $archivo->insertArchivo($mysqli);

                //echo "El archivo se ha guardado en la carpeta: $destination";
            } else {
                //echo "Error al cargar el archivo: " . $uploadedFiles["error"][$i];
            }
        }

        $json_response = ["success" => true];
        $json_response["msg"] = "Se ha creado el producto $nombreProducto y archivos";
    } else {
        //echo "No se cargaron archivos.";
        $json_response = ["success" => true];
        $json_response["msg"] = "Se ha creado el producto $nombreProducto pero nooo archivos";
        exit;
    }

} catch (Exception $e) {
    $json_response = ["success" => false, "msg" => "Error al crear el producto: " . $e->getMessage()];
    exit;
}

header('Content-Type: application/json');
echo json_encode($json_response);

 */


?>