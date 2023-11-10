<?php
class TipoPago
{
    private $idTipoPago;
    private $idStatus;
    private $nombre;

    public function getIdTipoPago()
    {
        return $this->idTipoPago;
    }

    public function setIdTipoPago($idTipoPago)
    {
        $this->idTipoPago = $idTipoPago;
    }

    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    // Constructor
    public function __construct(
        $idStatus,
        $nombre
    ) {
        $this->idStatus = $idStatus;
        $this->nombre = $nombre;
    }

    static public function parseJson($json)
    {
        $tipoPago = new TipoPago(
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["Nombre"]) ? $json["Nombre"] : null
        );
        if (isset($json["idTipoPago"])) {
            $tipoPago->setIdTipoPago((int) $json["idTipoPago"]);
        }
        return $tipoPago;
    }

    public function insertTipoPago($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertTipoPago(?, ?)");
        $stmt->bind_param(
            "ss",
            $this->idStatus,
            $this->nombre
        );

        if ($stmt->execute()) {
            return true; // Éxito en la inserción
        } else {
            return false; // Error en la inserción
        }
    }

    public function findTipoPagoById($mysqli, $idTipoPago)
    {
        $stmt = $mysqli->prepare("CALL sp_FindTipoPagoById(?)");
        $stmt->bind_param("i", $idTipoPago);
        $stmt->execute();
        $result = $stmt->get_result();
        $tipoPago = $result->fetch_assoc();

        return $tipoPago ? self::parseJson($tipoPago) : null;
    }

    public function updateTipoPago($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateTipoPago(?, ?, ?)");
        $stmt->bind_param(
            "sss",
            $this->idTipoPago,
            $this->idStatus,
            $this->nombre
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
