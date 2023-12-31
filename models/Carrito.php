<?php
class Carrito
{
    private $idCarrito;
    private $idUsuarioCliente;
    private $idProducto;
    private $idStatus;
    private $cantidad;
    private $precioUnitario;
    private $subtotal;
    private $descripcion;
    private $fechaAgregado;
    private $tipo;

    public function getIdCarrito()
    {
        return $this->idCarrito;
    }

    public function setIdCarrito($idCarrito)
    {
        $this->idCarrito = $idCarrito;
    }

    public function getIdUsuarioCliente()
    {
        return $this->idUsuarioCliente;
    }

    public function setIdUsuarioCliente($idUsuarioCliente)
    {
        $this->idUsuarioCliente = $idUsuarioCliente;
    }

    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    public function getPrecioUnitario()
    {
        return $this->precioUnitario;
    }

    public function setPrecioUnitario($precioUnitario)
    {
        $this->precioUnitario = $precioUnitario;
    }

    public function getSubtotal()
    {
        return $this->subtotal;
    }

    public function setSubtotal($subtotal)
    {
        $this->subtotal = $subtotal;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getFechaAgregado()
    {
        return $this->fechaAgregado;
    }

    public function setFechaAgregado($fechaAgregado)
    {
        $this->fechaAgregado = $fechaAgregado;
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
        $idUsuarioCliente,
        $idProducto,
        $idStatus,
        $cantidad,
        $precioUnitario,
        $subtotal,
        $descripcion,
        $fechaAgregado,
        $tipo
    ) {
        $this->idUsuarioCliente = $idUsuarioCliente;
        $this->idProducto = $idProducto;
        $this->idStatus = $idStatus;
        $this->cantidad = $cantidad;
        $this->precioUnitario = $precioUnitario;
        $this->subtotal = $subtotal;
        $this->descripcion = $descripcion;
        $this->fechaAgregado = $fechaAgregado;
        $this->tipo = $tipo;
    }

    static public function parseJson($json)
    {
        $carrito = new Carrito(
            isset($json["idUsuarioCliente"]) ? $json["idUsuarioCliente"] : null,
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["Cantidad"]) ? $json["Cantidad"] : null,
            isset($json["PrecioUnitario"]) ? $json["PrecioUnitario"] : null,
            isset($json["Subtotal"]) ? $json["Subtotal"] : null,
            isset($json["Descripcion"]) ? $json["Descripcion"] : null,
            isset($json["Fecha_agregado"]) ? $json["Fecha_agregado"] : null,
            isset($json["Tipo"]) ? $json["Tipo"] : null
        );
        if (isset($json["idCarrito"])) {
            $carrito->setIdCarrito((int) $json["idCarrito"]);
        }

        return $carrito;
    }

    public function insertCarrito($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertCarrito(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssssssss",
            $this->idUsuarioCliente,
            $this->idProducto,
            $this->idStatus,
            $this->cantidad,
            $this->precioUnitario,
            $this->subtotal,
            $this->descripcion,
            $this->fechaAgregado,
            $this->tipo
        );

        if ($stmt->execute()) {
            $this->idCarrito = (int) $stmt->insert_id;
            return true; // Éxito en la inserción
        } else {
            return false; // Error en la inserción
        }
    }

    public function findCarritoById($mysqli, $idCarrito)
    {
        $stmt = $mysqli->prepare("CALL sp_FindCarritoById(?)");
        $stmt->bind_param("i", $idCarrito);
        $stmt->execute();
        $result = $stmt->get_result();
        $carrito = $result->fetch_assoc();

        return $carrito ? self::parseJson($carrito) : null;
    }

    public function updateCarrito($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateCarrito(?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssssssss",
            $this->idCarrito,
            $this->idProducto,
            $this->idStatus,
            $this->cantidad,
            $this->precioUnitario,
            $this->subtotal,
            $this->descripcion,
            $this->fechaAgregado,
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
