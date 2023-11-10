<?php
class ProductosConCategoria
{
    private $idProductosConCategoria;
    private $idCategoria;
    private $idProducto;
    private $idStatus;

    public function getIdProductosConCategoria()
    {
        return $this->idProductosConCategoria;
    }

    public function setIdProductosConCategoria($idProductosConCategoria)
    {
        $this->idProductosConCategoria = $idProductosConCategoria;
    }

    public function getIdCategoria()
    {
        return $this->idCategoria;
    }

    public function setIdCategoria($idCategoria)
    {
        $this->idCategoria = $idCategoria;
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

    // Constructor
    public function __construct(
        $idCategoria,
        $idProducto,
        $idStatus
    ) {
        $this->idCategoria = $idCategoria;
        $this->idProducto = $idProducto;
        $this->idStatus = $idStatus;
    }

    static public function parseJson($json)
    {
        $productosConCategoria = new ProductosConCategoria(
            isset($json["idCategoria"]) ? $json["idCategoria"] : null,
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null
        );

        if (isset($json["idProductosConCategoria"])) {
            $productosConCategoria->setIdProductosConCategoria((int) $json["idProductosConCategoria"]);
        }


        return $productosConCategoria;
    }

    public function insertProductosConCategoria($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertProductosConCategoria(?, ?, ?)");
        $stmt->bind_param(
            "iii",
            $this->idCategoria,
            $this->idProducto,
            $this->idStatus
        );

        if ($stmt->execute()) {
            $this->idProductosConCategoria = (int) $stmt->insert_id;
            return true; // Éxito en la inserción
        } else {
            return false; // Error en la inserción
        }
    }

    public function findProductosConCategoriaById($mysqli, $idProductosConCategoria)
    {
        $stmt = $mysqli->prepare("CALL sp_FindProductosConCategoriaById(?)");
        $stmt->bind_param("i", $idProductosConCategoria);
        $stmt->execute();
        $result = $stmt->get_result();
        $productosConCategoria = $result->fetch_assoc();

        return $productosConCategoria ? self::parseJson($productosConCategoria) : null;
    }

    public function updateProductosConCategoria($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateProductosConCategoria(?, ?, ?, ?)");
        $stmt->bind_param(
            "iiii",
            $this->idProductosConCategoria,
            $this->idCategoria,
            $this->idProducto,
            $this->idStatus
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
