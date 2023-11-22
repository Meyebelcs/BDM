<?php

class POV_ReportesVendedor
{
    private $idProducto;
    private $Nombre;
    private $Descripcion;
    private $Precio;
    private $Inventario;
    private $Fecha_Hr;
    private $CantidadVendida;
    private $Imagen;
    private $TotalIngresos;
    private $PromedioCalificacion;
    private $Fecha;
    private $Hora;


    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    public function getInventario()
    {
        return $this->Inventario;
    }

    public function setInventario($Inventario)
    {
        $this->Inventario = $Inventario;
    }


    public function getImagen()
    {
        return $this->Imagen;
    }

    public function setImagen($Imagen)
    {
        $this->Imagen = $Imagen;
    }

    public function getNombre()
    {
        return $this->Nombre;
    }
    public function setFecha_Hr($Fecha_Hr)
    {
        $this->Fecha_Hr = $Fecha_Hr;
    }

    public function getFecha_Hr()
    {
        return $this->Fecha_Hr;
    }
    public function setFecha($Fecha)
    {
        $this->Fecha = $Fecha;
    }

    public function getFecha()
    {
        return $this->Fecha;
    }
    public function setHora($Hora)
    {
        $this->Hora = $Hora;
    }

    public function getHora()
    {
        return $this->Hora;
    }

    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    public function getDescripcion()
    {
        return $this->Descripcion;
    }

    public function setDescripcion($Descripcion)
    {
        $this->Descripcion = $Descripcion;
    }

    public function getPrecio()
    {
        return $this->Precio;
    }

    public function setPrecio($Precio)
    {
        $this->Precio = $Precio;
    }

    public function getCantidadVendida()
    {
        return $this->CantidadVendida;
    }

    public function setCantidadVendida($CantidadVendida)
    {
        $this->CantidadVendida = $CantidadVendida;
    }

    public function getTotalIngresos()
    {
        return $this->TotalIngresos;
    }

    public function setTotalIngresos($TotalIngresos)
    {
        $this->TotalIngresos = $TotalIngresos;
    }

    public function getPromedioCalificacion()
    {
        return $this->PromedioCalificacion;
    }

    public function setPromedioCalificacion($PromedioCalificacion)
    {
        $this->PromedioCalificacion = $PromedioCalificacion;
    }

    // Constructor
    public function __construct(
        $idProducto,
        $Nombre,
        $Descripcion,
        $Precio,
        $Inventario,
        $Fecha_Hr,
        $Imagen,
        $CantidadVendida,
        $TotalIngresos,
        $PromedioCalificacion
    ) {
        $this->idProducto = $idProducto;
        $this->Nombre = $Nombre;
        $this->Descripcion = $Descripcion;
        $this->Precio = $Precio;
        $this->Inventario = $Inventario;
        $this->Fecha_Hr = $Fecha_Hr;
        $this->Imagen = $Imagen;
        $this->CantidadVendida = $CantidadVendida;
        $this->TotalIngresos = $TotalIngresos;
        $this->PromedioCalificacion = $PromedioCalificacion;

        // Divide la cadena en fecha y hora
        list($this->Fecha, $this->Hora) = explode(' ', $this->Fecha_Hr);
    }

    static public function parseJson($json)
    {
        $reporte = new POV_ReportesVendedor(
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["Nombre"]) ? $json["Nombre"] : null,
            isset($json["Descripcion"]) ? $json["Descripcion"] : null,
            isset($json["Precio"]) ? $json["Precio"] : null,
            isset($json["Inventario"]) ? $json["Inventario"] : null,
            isset($json["Fecha_Publicación"]) ? $json["Fecha_Publicación"] : null,
            isset($json["Imagen"]) ? $json["Imagen"] : null,
            isset($json["CantidadVendida"]) ? $json["CantidadVendida"] : null,
            isset($json["TotalIngresos"]) ? $json["TotalIngresos"] : null,
            isset($json["PromedioCalificacion"]) ? $json["PromedioCalificacion"] : null
        );

        return $reporte;
    }

    public static function getAllSellsProductsStock($mysqli, $idUsuarioCreador)
    {
        $products = array();

        $stmt = $mysqli->prepare("CALL getAllProductPOVStock(?)");
        $stmt->bind_param("i", $idUsuarioCreador);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $producto = new POV_ReportesVendedor(
                $row['idProducto'],
                $row['Nombre'],
                $row['Descripción'],
                $row['Precio'],
                $row['Inventario'],
                $row['Fecha_Hr'],
                $row['Imagen'],
                $row['CantidadVendida'],
                $row['TotalIngresos'],
                $row['PromedioCalificacion']
            );

            // Agregar el comentario directamente al array
            $products[] = $producto;
        }

        $stmt->close();

        return $products;
    }

    public static function getAllSellsProductsCotizacion($mysqli, $idUsuarioCreador)
    {
        $products = array();

        $stmt = $mysqli->prepare("CALL getAllProductPOVCotizacion(?)");
        $stmt->bind_param("i", $idUsuarioCreador);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $producto = new POV_ReportesVendedor(
                $row['idProducto'],
                $row['Nombre'],
                $row['Descripción'],
                0,
                0,
                $row['Fecha_Hr'],
                0,
                $row['CantidadVendida'],
                $row['TotalIngresos'],
                $row['PromedioCalificacion']
            );

            // Agregar el comentario directamente al array
            $products[] = $producto;
        }

        $stmt->close();

        return $products;
    }

    public static function GetSellsTotalByUserStock($mysqli, $idUsuarioCreador)
    {
        $total = 0;

        $stmt = $mysqli->prepare("CALL GetSellsTotalByUserStock(?)");
        $stmt->bind_param("i", $idUsuarioCreador);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $total = $row['SumaTotalesVentas'];
        }

        $stmt->close();

        return $total;
    }

    public static function GetSellsTotalByUserCotizacion($mysqli, $idUsuarioCreador)
    {
        $total = 0;

        $stmt = $mysqli->prepare("CALL GetSellsTotalByUserCotizacion(?)");
        $stmt->bind_param("i", $idUsuarioCreador);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($row = $result->fetch_assoc()) {
            $total = $row['SumaTotalesVentas'];
        }

        $stmt->close();

        return $total;
    }

    public static function getAllProductsFiltro($mysqli, $idUsuarioCreador, $fecha, $hora, $categoria, $nombreProducto, $calificacion)
    {
        $tipo=  'Stock';
        $products = array();
    
        // Ajusta el nombre del procedimiento almacenado y el número de parámetros
        $stmt = $mysqli->prepare("CALL sp_FiltroPOVVendedor(?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssss", $idUsuarioCreador, $fecha, $hora, $categoria, $nombreProducto, $calificacion, $tipo); 
        $stmt->execute();
        $result = $stmt->get_result();
    
        while ($row = $result->fetch_assoc()) {
            $producto = new POV_ReportesVendedor(
                $row['idProducto'],
                $row['Nombre'],
                $row['Descripción'],
                $row['Precio'],
                $row['Inventario'],
                $row['Fecha_Hr'],
                $row['Imagen'],
                $row['CantidadVendida'],
                $row['TotalIngresos'],
                $row['PromedioCalificacion']
            );

            // Agregar el comentario directamente al array
            $products[] = $producto;
        }
    
        $stmt->close();
    
        return $products;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }
}