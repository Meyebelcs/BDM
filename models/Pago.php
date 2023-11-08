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
        $idPago,
        $idTipoPago,
        $idVenta,
        $idStatus,
        $monto
    ) {
        $this->idPago = $idPago;
        $this->idTipoPago = $idTipoPago;
        $this->idVenta = $idVenta;
        $this->idStatus = $idStatus;
        $this->monto = $monto;
    }

    static public function parseJson($json)
    {
        $pago = new Pago(
            isset($json["idPago"]) ? $json["idPago"] : null,
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

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
