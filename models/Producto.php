<?php

class Product
{
    private $idProducto;
    private $idAdminAutorizacion;
    private $idStatus;
    private $idUsuarioCreador;
    private $nombre;
    private $descripcion;
    private $precio;
    private $inventario;
    private $fechaPublicacion;
    private $Fecha;
    private $Hora;
    private $fechaActualizacion;
    private $tipo;
    private $imagen;
    private $promedio;
    private $TotalVendido;
    public function getFecha()
    {
        return $this->Fecha;
    }
    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;
    }
    public function getHora()
    {
        return $this->Hora;
    }
    public function setHora($Hora)
    {
        $this->Hora = $Hora;
    }
    public function getTotalVendido()
    {
        return $this->TotalVendido;
    }

    public function setTotalVendido($TotalVendido)
    {
        $this->TotalVendido = $TotalVendido;
    }
    public function getimagen()
    {
        return $this->imagen;
    }

    public function setimagen($imagen)
    {
        $this->imagen = $imagen;
    }
    public function getpromedio()
    {
        return $this->promedio;
    }

    public function setpromedio($promedio)
    {
        $this->promedio = $promedio;
    }
    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    public function getIdAdminAutorizacion()
    {
        return $this->idAdminAutorizacion;
    }

    public function setIdAdminAutorizacion($idAdminAutorizacion)
    {
        $this->idAdminAutorizacion = $idAdminAutorizacion;
    }

    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;
    }

    public function getIdUsuarioCreador()
    {
        return $this->idUsuarioCreador;
    }

    public function setIdUsuarioCreador($idUsuarioCreador)
    {
        $this->idUsuarioCreador = $idUsuarioCreador;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getPrecio()
    {
        return $this->precio;
    }

    public function setPrecio($precio)
    {
        $this->precio = $precio;
    }

    public function getInventario()
    {
        return $this->inventario;
    }

    public function setInventario($inventario)
    {
        $this->inventario = $inventario;
    }

    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;
    }

    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }

    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    }

    // Constructor
    public function __construct(
        $idAdminAutorizacion,
        $idStatus,
        $idUsuarioCreador,
        $nombre,
        $descripcion,
        $precio,
        $inventario,
        $fechaPublicacion,
        $fechaActualizacion,
        $tipo
    ) {
        $this->idAdminAutorizacion = $idAdminAutorizacion;
        $this->idStatus = $idStatus;
        $this->idUsuarioCreador = $idUsuarioCreador;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->inventario = $inventario;
        $this->fechaPublicacion = $fechaPublicacion;
        $this->fechaActualizacion = $fechaActualizacion;
        $this->tipo = $tipo;

        if ($fechaPublicacion != null) {
            // Divide la cadena en fecha y hora
            list($this->Fecha, $this->Hora) = explode(' ', $this->fechaPublicacion);
        }


    }

    static public function parseJson($json)
    {
        $product = new Product(
            isset($json["idAdminAutorización"]) ? $json["idAdminAutorización"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["idUsuarioCreador"]) ? $json["idUsuarioCreador"] : null,
            isset($json["Nombre"]) ? $json["Nombre"] : null,
            isset($json["Descripción"]) ? $json["Descripción"] : null,
            isset($json["Precio"]) ? $json["Precio"] : null,
            isset($json["Inventario"]) ? $json["Inventario"] : null,
            isset($json["Fecha_publicación"]) ? $json["Fecha_publicación"] : null,
            isset($json["Fecha_actualizacion"]) ? $json["Fecha_actualizacion"] : null,
            isset($json["Tipo"]) ? $json["Tipo"] : null
        );

        if (isset($json["idProducto"])) {
            $product->setidProducto((int) $json["idProducto"]);
        }

        return $product;
    }
    public function insertProducto($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertProducto(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssssssss",
            $this->idAdminAutorizacion,
            $this->idStatus,
            $this->idUsuarioCreador,
            $this->nombre,
            $this->descripcion,
            $this->precio,
            $this->inventario,
            $this->fechaPublicacion,
            $this->fechaActualizacion,
            $this->tipo
        );

        $stmt->execute();
        $this->idProducto = (int) $stmt->insert_id;
    }

    public static function findProductoById($mysqli, $idProducto)
    {
        $stmt = $mysqli->prepare("CALL sp_FindProductoById(?)");
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        $result = $stmt->get_result();
        $producto = $result->fetch_assoc();

        return $producto ? Product::parseJson($producto) : null;
    }

    public static function getLastidProducto($mysqli)
    {
        $stmt = $mysqli->prepare("CALL GetLastProductId()");

        $stmt->execute();
        $result = $stmt->get_result();
        $producto = $result->fetch_assoc();
        $stmt->close();
        return $producto ? Product::parseJson($producto) : null;
    }

    public function updateProducto($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateProducto(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssssss",
            $this->idProducto,
          
            $this->idStatus,
           
            $this->nombre,
            $this->descripcion,
            $this->precio,
            $this->inventario,
           
            $this->fechaActualizacion,
          
        );

      

        if ($stmt->execute()) {
            return true; // Éxito en la actualización
        } else {
            return false; // Error en la actualización
        }
    }

    public static function validateExist($mysqli, $idProducto)
    {
        $stmt = $mysqli->prepare("CALL VerificarProductoAgotado(?)");
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        $result = $stmt->get_result();
        $agotado = $result->fetch_assoc();

        return $agotado;
    }

    public static function getMasRecStock($mysqli)
    {
        $products = array();

        // Ajusta el nombre del procedimiento almacenado y el número de parámetros
        $stmt = $mysqli->prepare("CALL ObtenerProductosMasRecientesYTipoStock()");
        $stmt->execute();
        $result = $stmt->get_result();


        while ($row = $result->fetch_assoc()) {
            $producto = new Product(
                $row['idAdminAutorización'],
                $row['idStatus'],
                $row['idUsuarioCreador'],
                $row['Nombre'],
                $row['Descripción'],
                $row['Precio'],
                $row['Inventario'],
                $row['Fecha_publicación'],
                $row['Fecha_actualizacion'],
                $row['Tipo']
            );
            $producto->setimagen($row['Imagen']);
            $producto->setTotalVendido($row['TotalVendido']);
            $producto->setIdProducto($row['idProducto']);
            $producto->setpromedio($row['promedio']);

            // Agregar el comentario directamente al array
            $products[] = $producto;
        }

        $stmt->close();

        return $products;
    }
    public static function getMasVendCoti($mysqli)
    {
        $products = array();

        // Ajusta el nombre del procedimiento almacenado y el número de parámetros
        $stmt = $mysqli->prepare("CALL ObtenerProductosMasVendidosTipoCotizacion()");
        $stmt->execute();
        $result = $stmt->get_result();


        while ($row = $result->fetch_assoc()) {
            $producto = new Product(
                $row['idAdminAutorización'],
                $row['idStatus'],
                $row['idUsuarioCreador'],
                $row['Nombre'],
                $row['Descripción'],
                $row['Precio'],
                $row['Inventario'],
                $row['Fecha_publicación'],
                $row['Fecha_actualizacion'],
                $row['Tipo']
            );
            $producto->setimagen($row['Imagen']);
            $producto->setTotalVendido($row['TotalVendido']);
            $producto->setIdProducto($row['idProducto']);
            $producto->setpromedio($row['promedio']);

            // Agregar el comentario directamente al array
            $products[] = $producto;
        }

        $stmt->close();

        return $products;
    }
    public static function getMasRecCoti($mysqli)
    {
        $products = array();

        // Ajusta el nombre del procedimiento almacenado y el número de parámetros
        $stmt = $mysqli->prepare("CALL ObtenerProductosMasRecientesYTipoCotizacion()");
        $stmt->execute();
        $result = $stmt->get_result();


        while ($row = $result->fetch_assoc()) {
            $producto = new Product(
                $row['idAdminAutorización'],
                $row['idStatus'],
                $row['idUsuarioCreador'],
                $row['Nombre'],
                $row['Descripción'],
                $row['Precio'],
                $row['Inventario'],
                $row['Fecha_publicación'],
                $row['Fecha_actualizacion'],
                $row['Tipo']
            );
            $producto->setimagen($row['Imagen']);
            $producto->setTotalVendido($row['TotalVendido']);
            $producto->setIdProducto($row['idProducto']);
            $producto->setpromedio($row['promedio']);

            // Agregar el comentario directamente al array
            $products[] = $producto;
        }

        $stmt->close();

        return $products;
    }
    public static function getMejorCalifStock($mysqli)
    {
        $products = array();

        // Ajusta el nombre del procedimiento almacenado y el número de parámetros
        $stmt = $mysqli->prepare("CALL ObtenerProductosMejorCalificadosYTipoStock()");
        $stmt->execute();
        $result = $stmt->get_result();


        while ($row = $result->fetch_assoc()) {
            $producto = new Product(
                $row['idAdminAutorización'],
                $row['idStatus'],
                $row['idUsuarioCreador'],
                $row['Nombre'],
                $row['Descripción'],
                $row['Precio'],
                $row['Inventario'],
                $row['Fecha_publicación'],
                $row['Fecha_actualizacion'],
                $row['Tipo']
            );
            $producto->setimagen($row['Imagen']);
            $producto->setTotalVendido($row['TotalVendido']);
            $producto->setIdProducto($row['idProducto']);
            $producto->setpromedio($row['promedio']);

            // Agregar el comentario directamente al array
            $products[] = $producto;
        }

        $stmt->close();

        return $products;
    }
    public static function getMejorCalifCoti($mysqli)
    {
        $products = array();

        // Ajusta el nombre del procedimiento almacenado y el número de parámetros
        $stmt = $mysqli->prepare("CALL ObtenerProductosMejorCalificadosYTipoCotizacion()");
        $stmt->execute();
        $result = $stmt->get_result();


        while ($row = $result->fetch_assoc()) {
            $producto = new Product(
                $row['idAdminAutorización'],
                $row['idStatus'],
                $row['idUsuarioCreador'],
                $row['Nombre'],
                $row['Descripción'],
                $row['Precio'],
                $row['Inventario'],
                $row['Fecha_publicación'],
                $row['Fecha_actualizacion'],
                $row['Tipo']
            );
            $producto->setimagen($row['Imagen']);
            $producto->setTotalVendido($row['TotalVendido']);
            $producto->setIdProducto($row['idProducto']);
            $producto->setpromedio($row['promedio']);

            // Agregar el comentario directamente al array
            $products[] = $producto;
        }

        $stmt->close();

        return $products;
    }
    public static function getMasVendStock($mysqli)
    {
        $products = array();

        // Ajusta el nombre del procedimiento almacenado y el número de parámetros
        $stmt = $mysqli->prepare("CALL ObtenerProductosMasVendidosTipoStock()");
        $stmt->execute();
        $result = $stmt->get_result();


        while ($row = $result->fetch_assoc()) {
            $producto = new Product(
                $row['idAdminAutorización'],
                $row['idStatus'],
                $row['idUsuarioCreador'],
                $row['Nombre'],
                $row['Descripción'],
                $row['Precio'],
                $row['Inventario'],
                $row['Fecha_publicación'],
                $row['Fecha_actualizacion'],
                $row['Tipo']
            );
            $producto->setimagen($row['Imagen']);
            $producto->setTotalVendido($row['TotalVendido']);
            $producto->setIdProducto($row['idProducto']);
            $producto->setpromedio($row['promedio']);

            // Agregar el comentario directamente al array
            $products[] = $producto;
        }

        $stmt->close();

        return $products;
    }

    public static function getInfoProductCoti($mysqli, $idProducto, $idChat)
    {
        $products = array();

        // Ajusta el nombre del procedimiento almacenado y el número de parámetros
        $stmt = $mysqli->prepare("CALL sp_getInfoProductCoti(?, ?)");

        // Cambia "ss" a "ii" para indicar que son enteros
        $stmt->bind_param("ii", $idProducto, $idChat);
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $producto = new Product(
                0,
                0,
                0,
                $row['Nombre'],
                $row['Descripción'],
                0,
                $row['Inventario'],
                '2023-11-15 34:34:34',
                0,
                0
            );

            $producto->setIdProducto($row['idProducto']);

            // Agregar el comentario directamente al array
            $products[] = $producto;
        }

        $stmt->close();

        return $products;
    }


    public static function sp_getInfoProductCoti($mysqli)
    {
        $products = array();

        // Ajusta el nombre del procedimiento almacenado y el número de parámetros
        $stmt = $mysqli->prepare("CALL sp_getInfoProductCoti()");
        $stmt->execute();
        $result = $stmt->get_result();


        while ($row = $result->fetch_assoc()) {
            $producto = new Product(
                $row['idAdminAutorización'],
                $row['idStatus'],
                $row['idUsuarioCreador'],
                $row['Nombre'],
                $row['Descripción'],
                $row['Precio'],
                $row['Inventario'],
                $row['Fecha_publicación'],
                $row['Fecha_actualizacion'],
                $row['Tipo']
            );
            $producto->setimagen($row['Imagen']);
            $producto->setTotalVendido($row['TotalVendido']);
            $producto->setIdProducto($row['idProducto']);
            $producto->setpromedio($row['promedio']);

            // Agregar el comentario directamente al array
            $products[] = $producto;
        }

        $stmt->close();

        return $products;
    }

    public static function getProductbyStatus($mysqli, $idStatus)
    {
        $products = array();

        // Ajusta el nombre del procedimiento almacenado y el número de parámetros
        $stmt = $mysqli->prepare("CALL sp_FindProductoByStatus(?)");

        // Cambia "ss" a "ii" para indicar que son enteros
        $stmt->bind_param("i", $idStatus);
        $stmt->execute();

        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $producto = new Product(
                $row['idAdminAutorización'],
                $row['idStatus'],
                $row['idUsuarioCreador'],
                $row['Nombre'],
                $row['Descripción'],
                $row['Precio'],
                $row['Inventario'],
                $row['Fecha_publicación'],
                $row['Fecha_actualizacion'],
                $row['Tipo']
            );

            $producto->setIdProducto($row['idProducto']);

            // Agregar el comentario directamente al array
            $products[] = $producto;
        }

        $stmt->close();

        return $products;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
