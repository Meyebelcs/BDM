<?php
class Venta
{
    private $idVenta;
    private $idUsuarioCliente;
    private $idProducto;
    private $idCarrito;
    private $idStatus;
    private $fechaHrRegistro;
    private $total;
    private $cantidad;

    public function getIdVenta()
    {
        return $this->idVenta;
    }

    public function setIdVenta($idVenta)
    {
        $this->idVenta = $idVenta;
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

    public function getIdCarrito()
    {
        return $this->idCarrito;
    }

    public function setIdCarrito($idCarrito)
    {
        $this->idCarrito = $idCarrito;
    }

    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;
    }

    public function getFechaHrRegistro()
    {
        return $this->fechaHrRegistro;
    }

    public function setFechaHrRegistro($fechaHrRegistro)
    {
        $this->fechaHrRegistro = $fechaHrRegistro;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }


    // Constructor
    public function __construct(
        $idUsuarioCliente,
        $idProducto,
        $idCarrito,
        $idStatus,
        $fechaHrRegistro,
        $total,
        $cantidad
    ) {
        $this->idUsuarioCliente = $idUsuarioCliente;
        $this->idProducto = $idProducto;
        $this->idCarrito = $idCarrito;
        $this->idStatus = $idStatus;
        $this->fechaHrRegistro = $fechaHrRegistro;
        $this->total = $total;
        $this->cantidad = $cantidad;
    }
    static public function parseJson($json)
    {
        $venta = new Venta(
            isset($json["idUsuarioCliente"]) ? $json["idUsuarioCliente"] : null,
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["idCarrito"]) ? $json["idCarrito"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["FechaHr_registro"]) ? $json["FechaHr_registro"] : null,
            isset($json["Total"]) ? $json["Total"] : null,
            isset($json["Cantidad"]) ? $json["Cantidad"] : null
        );
        if (isset($json["idVenta"])) {
            $venta->setIdVenta((int) $json["idVenta"]);
        }

        return $venta;
    }

    public function insertVenta($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertVenta(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssssss",
            $this->idUsuarioCliente,
            $this->idProducto,
            $this->idCarrito,
            $this->idStatus,
            $this->fechaHrRegistro,
            $this->total,
            $this->cantidad
        );

        if ($stmt->execute()) {
            $this->idVenta = (int) $stmt->insert_id;
            return true; // Éxito en la inserción
        } else {
            return false; // Error en la inserción
        }
    }
    public function findVentaById($mysqli, $idVenta)
    {
        $stmt = $mysqli->prepare("CALL sp_FindVentaById(?)");
        $stmt->bind_param("i", $idVenta);
        $stmt->execute();
        $result = $stmt->get_result();
        $venta = $result->fetch_assoc();

        return $venta ? self::parseJson($venta) : null;
    }
    public function updateVenta($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateVenta(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssssss",
            $this->idVenta,
            $this->idStatus,
            $this->idUsuarioCliente,
            $this->idProducto,
            $this->idCarrito,
            $this->total,
            $this->cantidad
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
