<?php
/* require_once __DIR__ . '/../db.php';
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
    $idProducto = $producto->getIdProducto();

    $uploadedFiles = $_FILES['imagenesStock'];

    // Verifica si se enviaron archivos
    if (!empty($uploadedFiles['name'][0])) {
        $uploadedFileCount = count($uploadedFiles['name']);

        for ($i = 0; $i < $uploadedFileCount; $i++) {
            // Verifica si el archivo se cargó correctamente
            if ($uploadedFiles["error"][$i] === UPLOAD_ERR_OK) {



                // Subir la imagen
                $fileDirectory = "../Files/"; // Ruta de la carpeta donde deseas guardar las imágenes
                $originalFileName = basename($uploadedFiles['name'][$i]); // Nombre del archivo original con extensión
                $extension = pathinfo($originalFileName, PATHINFO_EXTENSION); // Obtener la extensión del archivo
                $uniqueIdentifier = uniqid(); // Generar un identificador único
                $fileName = $originalFileName . '_' . $uniqueIdentifier . '.' . $extension; // Nombre del archivo con identificador único
                $sizearchivo = $uploadedFiles['size'][$i];

                move_uploaded_file($uploadedFiles["tmp_name"][$i], $fileDirectory . $fileName);


                $archivo = fopen($fileDirectory.$filename, "r");
                $contenido = addslashes($contenido);
                $contenido = fread($archivo,$sizearchivo );
                fclose($archivo);

                // Lee el contenido binario del archivo
                $imgContenido = file_get_contents($uploadedFiles["tmp_name"][$i]);

                // Guarda el contenido binario en la base de datos
                $archivo = new Archivo($producto->getIdProducto(), '1', $contenido);
                $archivo->insertArchivo($mysqli);

                echo "El archivo se ha guardado en la base de datos.";
            } else {
                echo "Error al cargar el archivo: " . $uploadedFiles["error"][$i];
            }
        }

        $json_response = ["success" => true];
        $json_response["msg"] = "Se ha creado el producto $nombreProducto y archivos";
    } else {
        echo "No se cargaron archivos.";
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
    $idProducto = $producto->getIdProducto();

    $uploadedFiles = $_FILES['imagenesStock'];

    // Verifica si se enviaron archivos
    if (!empty($uploadedFiles['name'][0])) {
        $uploadedFileCount = count($uploadedFiles['name']);

        for ($i = 0; $i < $uploadedFileCount; $i++) {
            // Verifica si el archivo se cargó correctamente
            if ($uploadedFiles["error"][$i] === UPLOAD_ERR_OK) {
                // Lee el contenido binario del archivo
                $imgContenido = file_get_contents($uploadedFiles["tmp_name"][$i]);

                // Guarda el contenido binario en la base de datos
                $archivo = new Archivo($producto->getIdProducto(), '1', $imgContenido);
                $archivo->insertArchivo($mysqli);

                echo "El archivo se ha guardado en la base de datos.";
            } else {
                echo "Error al cargar el archivo: " . $uploadedFiles["error"][$i];
            }
        }

        $json_response = ["success" => true];
        $json_response["msg"] = "Se ha creado el producto $nombreProducto y archivos";
    } else {
        echo "No se cargaron archivos.";
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
