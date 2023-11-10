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

    public function insertEstatus($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertEstatus(?)");
        $stmt->bind_param("s", $this->nombre);
    
        if ($stmt->execute()) {
            $this->idStatus = (int) $stmt->insert_id;
            return true; 
        } else {
            return false; 
        }
    }
    public function findEstatusById($mysqli, $idStatus)
    {
        $stmt = $mysqli->prepare("CALL sp_FindEstatusById(?)");
        $stmt->bind_param("i", $idStatus);
        $stmt->execute();
        $result = $stmt->get_result();
        $estatus = $result->fetch_assoc();
        return $estatus ? User::parseJson($estatus) : null;
       
    }

    public function updateEstatus($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateEstatus(?, ?)");
        $stmt->bind_param("ss", $this->idStatus, $this->nombre);
    
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
