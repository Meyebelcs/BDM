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

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
