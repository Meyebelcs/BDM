<?php
class MaterialInventario
{
    private $idMaterial;
    private $idProducto;
    private $idStatus;
    private $fechaCreacion;
    private $nombre;
    private $cantidad;

    public function getIdMaterial()
    {
        return $this->idMaterial;
    }

    public function setIdMaterial($idMaterial)
    {
        $this->idMaterial = $idMaterial;
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

    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
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
        $idMaterial,
        $idProducto,
        $idStatus,
        $fechaCreacion,
        $nombre,
        $cantidad
    ) {
        $this->idMaterial = $idMaterial;
        $this->idProducto = $idProducto;
        $this->idStatus = $idStatus;
        $this->fechaCreacion = $fechaCreacion;
        $this->nombre = $nombre;
        $this->cantidad = $cantidad;
    }

    static public function parseJson($json)
    {
        $materialInventario = new MaterialInventario(
            isset($json["idMaterial"]) ? $json["idMaterial"] : null,
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["Fecha_creacion"]) ? $json["Fecha_creacion"] : null,
            isset($json["Nombre"]) ? $json["Nombre"] : null,
            isset($json["Cantidad"]) ? $json["Cantidad"] : null
        );

        if (isset($json["idMaterial"])) {
            $materialInventario->setIdMaterial((int) $json["idMaterial"]);
        }

        return $materialInventario;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
