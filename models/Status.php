<?php
class Status
{
    private $idStatus;
    private $nombre;

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
    public function __construct( $nombre)
    {
        $this->nombre = $nombre;
    }

    static public function parseJson($json)
    {
        $estatus = new Status(
            isset($json["Nombre"]) ? $json["Nombre"] : null
        );

        if (isset($json["idStatus"])) {
            $estatus->setIdStatus((int) $json["idStatus"]);
        }


        return $estatus;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
