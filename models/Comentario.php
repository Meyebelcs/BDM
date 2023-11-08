<?php
class Comentario
{
    private $idComentario;
    private $idProducto;
    private $idUsuarioCreador;
    private $idStatus;
    private $calificacion;
    private $fechaPublicacion;
    private $comentario;

    public function getIdComentario()
    {
        return $this->idComentario;
    }

    public function setIdComentario($idComentario)
    {
        $this->idComentario = $idComentario;
    }

    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
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

    public function getCalificacion()
    {
        return $this->calificacion;
    }

    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    }

    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    // Constructor
    public function __construct(
        $idComentario,
        $idProducto,
        $idUsuarioCreador,
        $idStatus,
        $calificacion,
        $fechaPublicacion,
        $comentario
    ) {
        $this->idComentario = $idComentario;
        $this->idProducto = $idProducto;
        $this->idUsuarioCreador = $idUsuarioCreador;
        $this->idStatus = $idStatus;
        $this->calificacion = $calificacion;
        $this->fechaPublicacion = $fechaPublicacion;
        $this->comentario = $comentario;
    }

    static public function parseJson($json)
    {
        $comentario = new Comentario(
            isset($json["idComentario"]) ? $json["idComentario"] : null,
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["idUsuarioCreador"]) ? $json["idUsuarioCreador"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["Calificacion"]) ? $json["Calificacion"] : null,
            isset($json["Fecha_publicacion"]) ? $json["Fecha_publicacion"] : null,
            isset($json["Comentario"]) ? $json["Comentario"] : null
        );

        if (isset($json["idComentario"])) {
            $comentario->setIdComentario((int) $json["idComentario"]);
        }

        return $comentario;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
