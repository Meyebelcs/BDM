<?php
class DetalleVenta
{
    private $idDetalleVenta;
    private $idVenta;
    private $idProducto;
    private $idCarrito;
    private $idStatus;

    public function getIdDetalleVenta()
    {
        return $this->idDetalleVenta;
    }

    public function setIdDetalleVenta($idDetalleVenta)
    {
        $this->idDetalleVenta = $idDetalleVenta;
    }

    public function getIdVenta()
    {
        return $this->idVenta;
    }

    public function setIdVenta($idVenta)
    {
        $this->idVenta = $idVenta;
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

    // Constructor
    public function __construct(
        $idVenta,
        $idProducto,
        $idCarrito,
        $idStatus
    ) {
        $this->idVenta = $idVenta;
        $this->idProducto = $idProducto;
        $this->idCarrito = $idCarrito;
        $this->idStatus = $idStatus;
    }

    static public function parseJson($json)
    {
        $detalleVenta = new DetalleVenta(
            isset($json["idVenta"]) ? $json["idVenta"] : null,
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["idCarrito"]) ? $json["idCarrito"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null
        );
        if (isset($json["idDetalleVenta"])) {
            $detalleVenta->setIdDetalleVenta((int) $json["idDetalleVenta"]);
        }

        return $detalleVenta;
    }

    public function insertDetalleVenta($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertDetalleVenta(?, ?, ?, ?)");
        $stmt->bind_param(
            "ssss",
            $this->idVenta,
            $this->idProducto,
            $this->idCarrito,
            $this->idStatus
        );

        if ($stmt->execute()) {
            return true; // Éxito en la inserción
        } else {
            return false; // Error en la inserción
        }
    }

    public function findDetalleVentaById($mysqli, $idDetalleVenta)
    {
        $stmt = $mysqli->prepare("CALL sp_FindDetalleVentaById(?)");
        $stmt->bind_param("i", $idDetalleVenta);
        $stmt->execute();
        $result = $stmt->get_result();
        $detalleVenta = $result->fetch_assoc();

        return $detalleVenta ? self::parseJson($detalleVenta) : null;
    }

    public function updateDetalleVenta($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateDetalleVenta(?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssss",
            $this->idDetalleVenta,
            $this->idVenta,
            $this->idProducto,
            $this->idCarrito,
            $this->idStatus
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
