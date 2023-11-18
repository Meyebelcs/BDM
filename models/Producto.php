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
    private $fechaActualizacion;
    private $tipo;

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
    }

    static public function parseJson($json)
    {
        $product = new Product(
            isset($json["idAdminAutorizacion"]) ? $json["idAdminAutorizacion"] : null,
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

        if ($stmt->execute()) {
            $this->idProducto = (int) $stmt->insert_id;
            return true; // Éxito en la inserción
        } else {
            return false; // Error en la inserción
        }
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

    public function updateProducto($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateProducto(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssssssssss",
            $this->idProducto,
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

        if ($stmt->execute()) {
            return true; // Éxito en la actualización
        } else {
            return false; // Error en la actualización
        }
    }

  
    public function toJSON()
    {
        return get_object_vars($this);
    }
}
