<?php
class Lista
{
    private $idLista;
    private $idStatus;
    private $idUsuarioCreador;
    private $nombre;
    private $descripcion;
    private $imagen;
    private $fechaCreacion;
    private $modo;

    public function getIdLista()
    {
        return $this->idLista;
    }

    public function setIdLista($idLista)
    {
        $this->idLista = $idLista;
    }

    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;
    }

    public function getIdUsuarioCreador()
    {
        return $this->idUsuarioCreador;
    }

    public function setIdUsuarioCreador($idUsuarioCreador)
    {
        $this->idUsuarioCreador = $idUsuarioCreador;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
    }

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    public function getModo()
    {
        return $this->modo;
    }

    public function setModo($modo)
    {
        $this->modo = $modo;
    }

    // Constructor
    public function __construct(
        $idLista,
        $idStatus,
        $idUsuarioCreador,
        $nombre,
        $descripcion,
        $imagen,
        $fechaCreacion,
        $modo
    ) {
        $this->idLista = $idLista;
        $this->idStatus = $idStatus;
        $this->idUsuarioCreador = $idUsuarioCreador;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->imagen = $imagen;
        $this->fechaCreacion = $fechaCreacion;
        $this->modo = $modo;
    }

    static public function parseJson($json)
    {
        $lista = new Lista(
            isset($json["idLista"]) ? $json["idLista"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["idUsuarioCreador"]) ? $json["idUsuarioCreador"] : null,
            isset($json["Nombre"]) ? $json["Nombre"] : null,
            isset($json["Descripción"]) ? $json["Descripción"] : null,
            isset($json["Imagen"]) ? $json["Imagen"] : null,
            isset($json["Fecha_creacion"]) ? $json["Fecha_creacion"] : null,
            isset($json["Modo"]) ? $json["Modo"] : null
        );

        if (isset($json["idLista"])) {
            $lista->setIdLista((int) $json["idLista"]);
        }

        return $lista;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}