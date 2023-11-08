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
        $idProductoEnLista,
        $idProducto,
        $idUsuarioCreador,
        $idLista
    ) {
        $this->idProductoEnLista = $idProductoEnLista;
        $this->idProducto = $idProducto;
        $this->idUsuarioCreador = $idUsuarioCreador;
        $this->idLista = $idLista;
    }

    static public function parseJson($json)
    {
        $productoEnLista = new ProductoEnLista(
            isset($json["idProductoEnLista"]) ? $json["idProductoEnLista"] : null,
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["idUsuarioCreador"]) ? $json["idUsuarioCreador"] : null,
            isset($json["idLista"]) ? $json["idLista"] : null
        );

        if (isset($json["idProductoEnLista"])) {
            $productoEnLista->setIdProductoEnLista((int) $json["idProductoEnLista"]);
        }
        
        return $productoEnLista;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
