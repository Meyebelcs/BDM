<?php

class MaterialCarrito
{
    private $idMaterialCarrito;
    private $idCarrito;
    private $idMaterial;
    private $idStatus;
    private $cantidad;
    private $Fecha_creacion;
    private $Nombre;


    public function getIdMaterialCarrito()
    {
        return $this->idMaterialCarrito;
    }

    public function setIdMaterialCarrito($idMaterialCarrito)
    {
        $this->idMaterialCarrito = $idMaterialCarrito;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }

    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    public function getFecha_creacion()
    {
        return $this->Fecha_creacion;
    }

    public function setFecha_creacion($Fecha_creacion)
    {
        $this->Fecha_creacion = $Fecha_creacion;
    }


    public function getIdCarrito()
    {
        return $this->idCarrito;
    }

    public function setIdCarrito($idCarrito)
    {
        $this->idCarrito = $idCarrito;
    }

    public function getIdMaterial()
    {
        return $this->idMaterial;
    }

    public function setIdMaterial($idMaterial)
    {
        $this->idMaterial = $idMaterial;
    }

    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;
    }

    public function getCantidad()
    {
        return $this->cantidad;
    }

    public function setCantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }

    // Constructor
    public function __construct(
        $idCarrito,
        $idMaterial,
        $idStatus,
        $cantidad
    ) {
        $this->idCarrito = $idCarrito;
        $this->idMaterial = $idMaterial;
        $this->idStatus = $idStatus;
        $this->cantidad = $cantidad;
    }

    static public function parseJson($json)
    {
        $materialCarrito = new MaterialCarrito(
            isset($json["idCarrito"]) ? $json["idCarrito"] : null,
            isset($json["idMaterial"]) ? $json["idMaterial"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["Cantidad"]) ? $json["Cantidad"] : null
        );
        if (isset($json["idMaterialCarrito"])) {
            $materialCarrito->setIdMaterialCarrito((int) $json["idMaterialCarrito"]);
        }

        return $materialCarrito;
    }

    public function insertMaterialCarrito($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertMaterialCarrito(?, ?, ?, ?)");
        $stmt->bind_param(
            "ssss",
            $this->idCarrito,
            $this->idMaterial,
            $this->idStatus,
            $this->cantidad
        );

        if ($stmt->execute()) {
            $this->idMaterialCarrito = (int) $stmt->insert_id;
            return true; // Éxito en la inserción
        } else {
            return false; // Error en la inserción
        }
    }

    public function findMaterialCarritoById($mysqli, $idMaterialCarrito)
    {
        $stmt = $mysqli->prepare("CALL sp_FindMaterialCarritoById(?)");
        $stmt->bind_param("i", $idMaterialCarrito);
        $stmt->execute();
        $result = $stmt->get_result();
        $materialCarrito = $result->fetch_assoc();

        return $materialCarrito ? self::parseJson($materialCarrito) : null;
    }

    public function updateMaterialCarrito($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateMaterialCarrito(?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssss",
            $this->idMaterialCarrito,
            $this->idCarrito,
            $this->idMaterial,
            $this->idStatus,
            $this->cantidad
        );

        if ($stmt->execute()) {
            return true; // Éxito en la actualización
        } else {
            return false; // Error en la actualización
        }
    }

    public static function GetMaterialesPorProducto($mysqli, $idProducto)
    {
        $materiales = array();

        $stmt = $mysqli->prepare("CALL sp_GetMaterialCarritoInfo(?)");
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $material = new MaterialCarrito(
                $row['idCarrito'],
                $row['idMaterial'],
                $row['idStatus'],
                $row['CantidadEnCarrito']
            );

            $material->setIdMaterialCarrito($row['idMaterialCarrito']);
            $material->setFecha_creacion($row['Fecha_creacion']);
            $material->setNombre($row['Nombre']);

            // Agregar el comentario directamente al array
            $materiales[] = $material;
        }

        $stmt->close();

        return $materiales;
    }


    public function toJSON()
    {
        return get_object_vars($this);
    }
}
