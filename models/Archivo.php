<?php

class Archivo
{
    private $idArchivo;
    private $idProducto;
    private $idStatus;
    private $archivo;

    public function getIdArchivo()
    {
        return $this->idArchivo;
    }

    public function setIdArchivo($idArchivo)
    {
        $this->idArchivo = $idArchivo;
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

    public function getArchivo()
    {
        return $this->archivo;
    }

    public function setArchivo($archivo)
    {
        $this->archivo = $archivo;
    }

    // Constructor
    public function __construct(
        $idProducto,
        $idStatus,
        $archivo
    ) {
        $this->idProducto = $idProducto;
        $this->idStatus = $idStatus;
        $this->archivo = $archivo;
    }

    static public function parseJson($json)
    {
        $archivo = new Archivo(
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["Archivo"]) ? $json["Archivo"] : null
        );
        if (isset($json["idArchivo"])) {
            $archivo->setIdArchivo((int) $json["idArchivo"]);
        }
        
        return $archivo;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
