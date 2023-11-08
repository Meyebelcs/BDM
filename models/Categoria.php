<?php

class Categoria
{
    private $idCategoria;
    private $idUsuarioCreador;
    private $idStatus;
    private $nombre;
    private $descripcion;
    private $fechaCreacion;

    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
    }

    public function getIdUsuarioCreador()
    {
        return $this->idUsuarioCreador;
    }

    public function setIdUsuarioCreador($idUsuarioCreador)
    {
        $this->idUsuarioCreador = $idUsuarioCreador;
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

    public function getDescripcion()
    {
        return $this->descripcion;
    }

    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }

    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    // Constructor
    public function __construct(
        $idCategoria,
        $idUsuarioCreador,
        $idStatus,
        $nombre,
        $descripcion,
        $fechaCreacion
    ) {
        $this->idCategoria = $idCategoria;
        $this->idUsuarioCreador = $idUsuarioCreador;
        $this->idStatus = $idStatus;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->fechaCreacion = $fechaCreacion;
    }

    static public function parseJson($json)
    {
        $categoria = new Categoria(
            isset($json["idCategoria"]) ? $json["idCategoria"] : null,
            isset($json["idUsuarioCreador"]) ? $json["idUsuarioCreador"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["Nombre"]) ? $json["Nombre"] : null,
            isset($json["Descripcion"]) ? $json["Descripcion"] : null,
            isset($json["Fecha_creacion"]) ? $json["Fecha_creacion"] : null
        );

        if (isset($json["idCategoria"])) {
            $categoria->setIdCategoria((int) $json["idCategoria"]);
        }

        return $categoria;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
