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
        $idVenta,
        $idStatus,
        $idUsuarioCliente,
        $fechaRegistro,
        $total
    ) {
        $this->idVenta = $idVenta;
        $this->idStatus = $idStatus;
        $this->idUsuarioCliente = $idUsuarioCliente;
        $this->fechaRegistro = $fechaRegistro;
        $this->total = $total;
    }

    static public function parseJson($json)
    {
        $venta = new Venta(
            isset($json["idVenta"]) ? $json["idVenta"] : null,
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

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
