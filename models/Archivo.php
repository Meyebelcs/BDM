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

    public function insertArchivo($mysqli, )
    {

        /* $encodeImagen = base64_encode($this->archivo); */

        $stmt = $mysqli->prepare("CALL sp_InsertArchivo(?, ?, ?)");
        $stmt->bind_param(
            "sss",
            $this->idProducto,
            $this->idStatus,
            $this->archivo
        );
        $stmt->execute();
        $this->idArchivo = (int) $stmt->insert_id;
        

    }

    public static function findArchivoById($mysqli, $idArchivo)
    {
        $stmt = $mysqli->prepare("CALL sp_FindArchivoById(?)");
        $stmt->bind_param("i", $idArchivo);
        $stmt->execute();
        $result = $stmt->get_result();
        $archivo = $result->fetch_assoc();

        return $archivo ? self::parseJson($archivo) : null;
    }

    public function updateArchivo($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateArchivo(?, ?, ?, ?)");
        $stmt->bind_param(
            "ssss",
            $this->idArchivo,
            $this->idProducto,
            $this->idStatus,
            $this->archivo
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
