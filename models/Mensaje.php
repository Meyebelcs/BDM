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

    public function insertMensaje($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertMensaje(?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssss",
            $this->idStatus,
            $this->idChat,
            $this->idUsuarioCreador,
            $this->mensaje,
            $this->fechaCreacion
        );

        if ($stmt->execute()) {
            $this->idMensaje = (int) $stmt->insert_id;
            return true; // Éxito en la inserción
        } else {
            return false; // Error en la inserción
        }
    }

    public function findMensajeById($mysqli, $idMensaje)
    {
        $stmt = $mysqli->prepare("CALL sp_FindMensajeById(?)");
        $stmt->bind_param("i", $idMensaje);
        $stmt->execute();
        $result = $stmt->get_result();
        $mensaje = $result->fetch_assoc();

        return $mensaje ? self::parseJson($mensaje) : null;
    }

    public function updateMensaje($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateMensaje(?, ?, ?, ?)");
        $stmt->bind_param(
            "ssss",
            $this->idMensaje,
            $this->idStatus,
            $this->idChat,
            $this->mensaje
        );

        if ($stmt->execute()) {
            return true; // Éxito en la actualización
        } else {
            return false; // Error en la actualización
        }
    }


    public function toJSON()
    {
        return get_object_vars($this);
    }
}
