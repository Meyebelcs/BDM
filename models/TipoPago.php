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
        $idTipoPago,
        $idStatus,
        $nombre
    ) {
        $this->idTipoPago = $idTipoPago;
        $this->idStatus = $idStatus;
        $this->nombre = $nombre;
    }

    static public function parseJson($json)
    {
        $tipoPago = new TipoPago(
            isset($json["idTipoPago"]) ? $json["idTipoPago"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["Nombre"]) ? $json["Nombre"] : null
        );
        if (isset($json["idTipoPago"])) {
            $tipoPago->setIdTipoPago((int) $json["idTipoPago"]);
        }
        return $tipoPago;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
