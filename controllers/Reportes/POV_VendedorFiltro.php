<?php

require_once __DIR__ . '/../../db.php';
require_once __DIR__ . '/../../models/Reportes/POV_ReportesVendedor.php';
require_once __DIR__ . '/../../models/Categoria.php';
require_once __DIR__ . '/../../models/Archivo.php';
session_start();
$mysqli = db::connect();
$idUser = $_SESSION["AUTH"];


try {
    // Captura los valores del POST
    $fecha = !empty($_POST['fecha']) ? $_POST['fecha'] : null;
    $hora = !empty($_POST['hora']) ? $_POST['hora'] : null;
    $idcategoria = !empty($_POST['idcategoria']) ? $_POST['idcategoria'] : 0;
    $nombreProducto = !empty($_POST['nombreProducto']) ? $_POST['nombreProducto'] : null;
    $calificacion = !empty($_POST['calificacion']) ? $_POST['calificacion'] : 0;
    $action = !empty($_POST['action']) ? $_POST['action'] : null;

    // Realiza las acciones según el valor de 'action'
    $tipo = ($action === 'Stock') ? 'Stock' : 'Cotizacion';

    $productos = POV_ReportesVendedor::getAllProductsFiltro($mysqli, $idUser, $fecha, $hora, $idcategoria, $nombreProducto, $calificacion, $tipo);
    // Convertir objetos a arrays asociativos
    $formattedProductos = [];

    foreach ($productos as $producto) {
        $categoriasProducto = Categoria::GetCategoriasPorProducto($mysqli, $producto->getIdProducto());
        $archivos = Archivo::getArchivoByProduct($mysqli, $producto->getIdProducto());
       

        $formattedProductos[] = [
            'idProducto' => $producto->getIdProducto(),
            'Nombre' => $producto->getNombre(),
            'Descripción' => $producto->getDescripcion(),
            'Precio' => $producto->getPrecio(),
            'Inventario' => $producto->getInventario(),
            'Fecha_Hr' => $producto->getFecha_Hr(),
            'Fecha' => $producto->getFecha(),
            'Hora' => $producto->getHora(),
            'Imagen' => base64_encode($producto->getImagen()),
            'CantidadVendida' => $producto->getCantidadVendida(),
            'TotalIngresos' => $producto->getTotalIngresos(),
            'PromedioCalificacion' => $producto->getPromedioCalificacion(),
            'Categorias' => obtenerNombresCategorias($categoriasProducto),
            'Archivos' => obtenerArhivosProducto($archivos)
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

