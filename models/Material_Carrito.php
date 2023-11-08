<?php

class MaterialCarrito
{
    private $idMaterialCarrito;
    private $idCarrito;
    private $idMaterial;
    private $idStatus;
    private $cantidad;

    public function getIdMaterialCarrito()
    {
        return $this->idMaterialCarrito;
    }

    public function setIdMaterialCarrito($idMaterialCarrito)
    {
        $this->idMaterialCarrito = $idMaterialCarrito;
    }

    public function getIdCarrito()
    {
        return $this->idCarrito;
    }

    public function setIdCarrito($idCarrito)
    {
        $this->idCarrito = $idCarrito;
    }

    public function getIdMaterial()
    {
        return $this->idMaterial;
    }

    public function setIdMaterial($idMaterial)
    {
        $this->idMaterial = $idMaterial;
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

    // Constructor
    public function __construct(
        $idMaterialCarrito,
        $idCarrito,
        $idMaterial,
        $idStatus,
        $cantidad
    ) {
        $this->idMaterialCarrito = $idMaterialCarrito;
        $this->idCarrito = $idCarrito;
        $this->idMaterial = $idMaterial;
        $this->idStatus = $idStatus;
        $this->cantidad = $cantidad;
    }

    static public function parseJson($json)
    {
        $materialCarrito = new MaterialCarrito(
            isset($json["idMaterialCarrito"]) ? $json["idMaterialCarrito"] : null,
            isset($json["idCarrito"]) ? $json["idCarrito"] : null,
            isset($json["idMaterial"]) ? $json["idMaterial"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["Cantidad"]) ? $json["Cantidad"] : null
        );
        if (isset($json["idMaterialCarrito"])) {
            $materialCarrito->setIdMaterialCarrito((int) $json["idMaterialCarrito"]);
        }
        
        return $materialCarrito;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
