<?php
class Chat
{
    private $idChat;
    private $idUsuarioCliente;
    private $idUsuarioVendedor;
    private $idStatus;
    private $idProducto;
    private $fechaCreacion;

    public function getIdChat()
    {
        return $this->idChat;
    }

    public function setIdChat($idChat)
    {
        $this->idChat = $idChat;
    }

    public function getIdUsuarioCliente()
    {
        return $this->idUsuarioCliente;
    }

    public function setIdUsuarioCliente($idUsuarioCliente)
    {
        $this->idUsuarioCliente = $idUsuarioCliente;
    }

    public function getIdUsuarioVendedor()
    {
        return $this->idUsuarioVendedor;
    }

    public function setIdUsuarioVendedor($idUsuarioVendedor)
    {
        $this->idUsuarioVendedor = $idUsuarioVendedor;
    }

    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;
    }

    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
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
        $idUsuarioCliente,
        $idUsuarioVendedor,
        $idStatus,
        $idProducto,
        $fechaCreacion
    ) {
        $this->idUsuarioCliente = $idUsuarioCliente;
        $this->idUsuarioVendedor = $idUsuarioVendedor;
        $this->idStatus = $idStatus;
        $this->idProducto = $idProducto;
        $this->fechaCreacion = $fechaCreacion;
    }

    static public function parseJson($json)
    {
        $chat = new Chat(
            isset($json["idUsuarioCliente"]) ? $json["idUsuarioCliente"] : null,
            isset($json["idUsuarioVendedor"]) ? $json["idUsuarioVendedor"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["Fecha_creacion"]) ? $json["Fecha_creacion"] : null
        );

        if (isset($json["idChat"])) {
            $chat->setIdChat((int) $json["idChat"]);
        }
        

        return $chat;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
