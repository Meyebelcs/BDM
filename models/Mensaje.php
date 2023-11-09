<?php
class Mensaje
{
    private $idMensaje;
    private $idStatus;
    private $idChat;
    private $idUsuarioCreador;
    private $mensaje;
    private $fechaCreacion;

    public function getIdMensaje()
    {
        return $this->idMensaje;
    }

    public function setIdMensaje($idMensaje)
    {
        $this->idMensaje = $idMensaje;
    }

    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;
    }

    public function getIdChat()
    {
        return $this->idChat;
    }

    public function setIdChat($idChat)
    {
        $this->idChat = $idChat;
    }

    public function getIdUsuarioCreador()
    {
        return $this->idUsuarioCreador;
    }

    public function setIdUsuarioCreador($idUsuarioCreador)
    {
        $this->idUsuarioCreador = $idUsuarioCreador;
    }

    public function getMensaje()
    {
        return $this->mensaje;
    }

    public function setMensaje($mensaje)
    {
        $this->mensaje = $mensaje;
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
        $idStatus,
        $idChat,
        $idUsuarioCreador,
        $mensaje,
        $fechaCreacion
    ) {
        $this->idStatus = $idStatus;
        $this->idChat = $idChat;
        $this->idUsuarioCreador = $idUsuarioCreador;
        $this->mensaje = $mensaje;
        $this->fechaCreacion = $fechaCreacion;
    }

    static public function parseJson($json)
    {
        $mensaje = new Mensaje(
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["idChat"]) ? $json["idChat"] : null,
            isset($json["idUsuarioCreador"]) ? $json["idUsuarioCreador"] : null,
            isset($json["Mensaje"]) ? $json["Mensaje"] : null,
            isset($json["Fecha_creacion"]) ? $json["Fecha_creacion"] : null
        );
        if (isset($json["idMensaje"])) {
            $mensaje->setIdMensaje((int) $json["idMensaje"]);
        }
        

        return $mensaje;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
