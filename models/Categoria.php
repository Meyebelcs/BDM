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
        $idUsuarioCreador,
        $idStatus,
        $nombre,
        $descripcion,
        $fechaCreacion
    ) {
        $this->idUsuarioCreador = $idUsuarioCreador;
        $this->idStatus = $idStatus;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->fechaCreacion = $fechaCreacion;
    }

    public function insertCategoria($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertCategoria(?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssss",
            $this->idUsuarioCreador,
            $this->idStatus,
            $this->nombre,
            $this->descripcion,
            $this->fechaCreacion
        );
    
        if ($stmt->execute()) {
            $this->idCategoria = (int) $stmt->insert_id;
            return true; // Éxito en la inserción
        } else {
            return false; // Error en la inserción
        }
    }
    
    public function findCategoriaById($mysqli, $idCategoria)
    {
        $stmt = $mysqli->prepare("CALL sp_FindCategoriaById(?)");
        $stmt->bind_param("i", $idCategoria);
        $stmt->execute();
        $result = $stmt->get_result();
        $categoria = $result->fetch_assoc();
    
        return $categoria ? self::parseJson($categoria) : null;
    }

    public static function getAllCategorias($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_GetAllCategorias()");
        $stmt->execute();
        $result = $stmt->get_result();
        $categorias = array();

        while ($row = $result->fetch_assoc()) {
            $categorias[] = $row;
        }

        return $categorias;
    }
    
    public function updateCategoria($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateCategoria(?, ?, ?, ?)");
        $stmt->bind_param(
            "ssss",
            $this->idCategoria,
            $this->idStatus,
            $this->nombre,
            $this->descripcion,
        );
    
        if ($stmt->execute()) {
            return true; // Éxito en la actualización
        } else {
            return false; // Error en la actualización
        }
    }
    

    static public function parseJson($json)
    {
        $categoria = new Categoria(
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
