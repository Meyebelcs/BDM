<?php
class ProductoEnLista
{
    private $idProductoEnLista;
    private $idProducto;
    private $idUsuarioCreador;
    private $idLista;

    public function getIdProductoEnLista()
    {
        return $this->idProductoEnLista;
    }

    public function setIdProductoEnLista($idProductoEnLista)
    {
        $this->idProductoEnLista = $idProductoEnLista;
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

    public function getIdLista()
    {
        return $this->idLista;
    }

    public function setIdLista($idLista)
    {
        $this->idLista = $idLista;
    }

    // Constructor
    public function __construct(
        $idProducto,
        $idUsuarioCreador,
        $idLista
    ) {
        $this->idProducto = $idProducto;
        $this->idUsuarioCreador = $idUsuarioCreador;
        $this->idLista = $idLista;
    }

    static public function parseJson($json)
    {
        $productoEnLista = new ProductoEnLista(
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["idUsuarioCreador"]) ? $json["idUsuarioCreador"] : null,
            isset($json["idLista"]) ? $json["idLista"] : null
        );

        if (isset($json["idProductoEnLista"])) {
            $productoEnLista->setIdProductoEnLista((int) $json["idProductoEnLista"]);
        }

        return $productoEnLista;
    }

    public function insertProductoEnLista($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertProductoEnLista(?, ?, ?)");
        $stmt->bind_param(
            "iii",
            $this->idProducto,
            $this->idUsuarioCreador,
            $this->idLista
        );

        if ($stmt->execute()) {
            $this->idProductoEnLista = (int) $stmt->insert_id;
            return true; // Éxito en la inserción
        } else {
            return false; // Error en la inserción
        }
    }

    public function findProductoEnListaById($mysqli, $idProductoEnLista)
    {
        $stmt = $mysqli->prepare("CALL sp_FindProductoEnListaById(?)");
        $stmt->bind_param("i", $idProductoEnLista);
        $stmt->execute();
        $result = $stmt->get_result();
        $productoEnLista = $result->fetch_assoc();

        return $productoEnLista ? self::parseJson($productoEnLista) : null;
    }

    public function updateProductoEnLista($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateProductoEnLista(?, ?, ?)");
        $stmt->bind_param(
            "iii",
            $this->idProductoEnLista,
            $this->idProducto,
            $this->idLista
        );

        if ($stmt->execute()) {
            return true; // Éxito en la actualización
        } else {
            return false; // Error en la actualización
        }
    }

    public function productoEnListaExists($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_VerificarProductoEnLista(?, ?, @existe)");
        $stmt->bind_param("ii", $this->idProducto, $this->idLista);
        $stmt->execute();
        
        $result = $mysqli->query("SELECT @existe as existe");
        $row = $result->fetch_assoc();
        $existe = $row['existe'];
    
        return $existe > 0;
    }
    

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
