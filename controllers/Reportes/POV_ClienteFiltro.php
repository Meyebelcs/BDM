<?php

require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Reportes/POV_Reportes.php';
require_once __DIR__ . '/../../models/Categoria.php';
require_once __DIR__ . '/../../models/Archivo.php';
require_once __DIR__ . '/../../models/Material_Carrito.php';

session_start();
$mysqli = db::connect();
$idUser = $_SESSION["AUTH"];


try {
    // Captura los valores del POST
    $fecha = !empty($_POST['fecha']) ? $_POST['fecha'] : null;
    $hora = !empty($_POST['hora']) ? $_POST['hora'] : null;
    $idcategoria = !empty($_POST['idcategoria']) ? $_POST['idcategoria'] : 0;
    $precio = !empty($_POST['precio']) ? $_POST['precio'] : 0;
    $nombreProducto = !empty($_POST['nombreProducto']) ? $_POST['nombreProducto'] : null;
    $calificacion = !empty($_POST['calificacion']) ? $_POST['calificacion'] : 0;
    $action = !empty($_POST['action']) ? $_POST['action'] : null;

    // Realiza las acciones según el valor de 'action'
    $tipo = ($action === 'Stock') ? 'Stock' : 'Cotizacion';


    $productos = POV_ReportesVendedor::getAllpurchasesFiltro($mysqli, $idUser, $fecha, $hora, $idcategoria, $nombreProducto, $calificacion, $precio, $tipo);

    // Convertir objetos a arrays asociativos
    $formattedProductos = [];

    foreach ($productos as $producto) {
        $categoriasProducto = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());
        $archivos = Archivo::getArchivoByProduct($mysqli, $producto->getIdProducto());

        if ($tipo == 'Cotizacion') {
            $materialesbyproduct = MaterialCarrito::GetMaterialesPorProducto($mysqli, $producto->getIdProducto());
            $materiales = obtenerMateriales($materialesbyproduct);
        } else {
           $materiales = null;
        }

        $formattedProductos[] = [
            'idProducto' => $producto->getIdProducto(),
            'Nombre' => $producto->getNombre(),
            'Descripción' => $producto->getDescripcion(),
            'DescripcionCarrito' => $producto->getDescripcionCarrito(),
            'Precio' => $producto->getPrecio(),
            'Fecha_Hr' => $producto->getFecha_Hr(),
            'Fecha' => $producto->getFecha(),
            'Hora' => $producto->getHora(),
            'Imagen' => base64_encode($producto->getImagen()),
            'CantidadComprada' => $producto->getCantidadComprada(),
            'Total' => $producto->getTotal(),
            'PromedioCalificacion' => $producto->getPromedioCalificacion(),
            'Categorias' => obtenerNombresCategorias($categoriasProducto),
            'Archivos' => obtenerArhivosProducto($archivos),
            'Materiales' => $materiales,
        ];
    }


    $json_response = [
        "success" => true,
        "msg" => "Se han cargado los productos con éxito",
        "tipo" => $tipo,
        "productosBD" => $formattedProductos,
    ];



} catch (Exception $e) {
    $json_response = ["success" => false, "msg" => "Error al cargar productosStock" . $e->getMessage()];
    exit;
}

function obtenerMateriales($materiales)
{
    $result = [];

    foreach ($materiales as $material) {
        $result[] = [
            'Nombre' => $material->getNombre(),
            'Cantidad' => $material->getCantidad(),
        ];
    }

    return $result;
}

function obtenerNombresCategorias($categorias)
{
    $nombresCategorias = [];

    foreach ($categorias as $category) {
        $nombresCategorias[] = $category->getNombre();
    }

    return $nombresCategorias;
}
function obtenerArhivosProducto($archivos)
{
    $imagenes = [];

    foreach ($archivos as $archivo) {
        $imagenes[] = base64_encode($archivo->getArchivo());
    }

    return $imagenes;
}



/* var_dump($json_response); */
header('Content-Type: application/json');
echo json_encode($json_response);

