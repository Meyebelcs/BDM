<?php
class Venta
{
    private $idVenta;
    private $idStatus;
    private $idUsuarioCliente;
    private $fechaRegistro;
    private $total;

    public function getIdVenta()
    {
        return $this->idVenta;
    }

    public function setIdVenta($idVenta)
    {
        $this->idVenta = $idVenta;
    }

    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;
    }

    public function getIdUsuarioCliente()
    {
        return $this->idUsuarioCliente;
    }

    public function setIdUsuarioCliente($idUsuarioCliente)
    {
        $this->idUsuarioCliente = $idUsuarioCliente;
    }

    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    }

    public function getTotal()
    {
        return $this->total;
    }

    public function setTotal($total)
    {
        $this->total = $total;
    }

    // Constructor
    public function __construct(
        $idStatus,
        $idUsuarioCliente,
        $fechaRegistro,
        $total
    ) {
        $this->idStatus = $idStatus;
        $this->idUsuarioCliente = $idUsuarioCliente;
        $this->fechaRegistro = $fechaRegistro;
        $this->total = $total;
    }

    static public function parseJson($json)
    {
        $venta = new Venta(
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["idUsuarioCliente"]) ? $json["idUsuarioCliente"] : null,
            isset($json["FechaHr_registro"]) ? $json["FechaHr_registro"] : null,
            isset($json["Total"]) ? $json["Total"] : null
        );
        if (isset($json["idVenta"])) {
            $venta->setIdVenta((int) $json["idVenta"]);
        }

        return $venta;
    }

    public function insertVenta($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertVenta(?, ?, ?, ?)");
        $stmt->bind_param(
            "ssss",
            $this->idStatus,
            $this->idUsuarioCliente,
            $this->fechaRegistro,
            $this->total
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
        $stmt = $mysqli->prepare("CALL sp_UpdateVenta(?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssss",
            $this->idVenta,
            $this->idStatus,
            $this->idUsuarioCliente,
            $this->fechaRegistro,
            $this->total
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
