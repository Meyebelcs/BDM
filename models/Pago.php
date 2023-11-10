<?php
class Pago
{
    private $idPago;
    private $idTipoPago;
    private $idVenta;
    private $idStatus;
    private $monto;

    public function getIdPago()
    {
        return $this->idPago;
    }

    public function setIdPago($idPago)
    {
        $this->idPago = $idPago;
    }

    public function getIdTipoPago()
    {
        return $this->idTipoPago;
    }

    public function setIdTipoPago($idTipoPago)
    {
        $this->idTipoPago = $idTipoPago;
    }

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

    public function getMonto()
    {
        return $this->monto;
    }

    public function setMonto($monto)
    {
        $this->monto = $monto;
    }

    // Constructor
    public function __construct(
        $idTipoPago,
        $idVenta,
        $idStatus,
        $monto
    ) {
        $this->idTipoPago = $idTipoPago;
        $this->idVenta = $idVenta;
        $this->idStatus = $idStatus;
        $this->monto = $monto;
    }

    static public function parseJson($json)
    {
        $pago = new Pago(
            isset($json["idTipoPago"]) ? $json["idTipoPago"] : null,
            isset($json["idVenta"]) ? $json["idVenta"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["Monto"]) ? $json["Monto"] : null
        );
        if (isset($json["idPago"])) {
            $pago->setIdPago((int) $json["idPago"]);
        }

        return $pago;
    }

    public function insertPago($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertPago(?, ?, ?, ?)");
        $stmt->bind_param(
            "ssss",
            $this->idTipoPago,
            $this->idVenta,
            $this->idStatus,
            $this->monto
        );

        if ($stmt->execute()) {
            return true; // Éxito en la inserción
        } else {
            return false; // Error en la inserción
        }
    }

    public function findPagoById($mysqli, $idPago)
    {
        $stmt = $mysqli->prepare("CALL sp_FindPagoById(?)");
        $stmt->bind_param("i", $idPago);
        $stmt->execute();
        $result = $stmt->get_result();
        $pago = $result->fetch_assoc();

        return $pago ? self::parseJson($pago) : null;
    }

    public function updatePago($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdatePago(?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssss",
            $this->idPago,
            $this->idTipoPago,
            $this->idVenta,
            $this->idStatus,
            $this->monto
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
