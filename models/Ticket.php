<?php
class Ticket
{


    private $idProducto;
    private $Nombre;
    private $Precio;
    private $Descripción;
    private $Tipo;
    private $FechaHr_registro;
    private $Cantidad;
    private $Total;








/* 

    
    public function __construct(
        $idVenta,
        $idUsuarioCliente,
        $idProducto,
        $Nombre,
        $Precio,
        $Descripción,
        $Tipo,
        $FechaHr_registro,
        $Total,
        $Total,
        $sumaTotal
    ) {
        $this->idVenta = $idVenta;
        $this->idUsuarioCliente = $idUsuarioCliente;
        $this->idProducto = $idProducto;
        $this->nombreProducto = $Nombre;
        $this->precio = $Precio;
        $this->idCarrito = $Descripción;
        $this->idStatus = $Tipo;
        $this->fechaHoraRegistro = $FechaHr_registro;
        $this->total = $Total;
        $this->cantidad = $Total;
        $this->sumaTotal = $sumaTotal;
    }

    // Método estático para parsear desde JSON
    static public function parseJson($json)
    {
        $miObjeto = new Ticket(
            isset($json["idVenta"]) ? $json["idVenta"] : null,
            isset($json["idUsuarioCliente"]) ? $json["idUsuarioCliente"] : null,
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["Nombre_Producto"]) ? $json["Nombre_Producto"] : null,
            isset($json["Precio"]) ? $json["Precio"] : null,
            isset($json["idCarrito"]) ? $json["idCarrito"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["FechaHr_registro"]) ? $json["FechaHr_registro"] : null,
            isset($json["Total"]) ? $json["Total"] : null,
            isset($json["Cantidad"]) ? $json["Cantidad"] : null,
            isset($json["Suma_Total"]) ? $json["Suma_Total"] : null
        );

        return $miObjeto;
    }


    static public function finTicketByidProduct($mysqli, $idProducto)
    {
        $stmt = $mysqli->prepare("CALL ObtenerDatosReciboVenta(?)");
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        $result = $stmt->get_result();
        $ticketinfo = $result->fetch_assoc();

        return $ticketinfo ? self::parseJson($ticketinfo) : null;
    }

    public static function findTicketByidProduct($mysqli, $idProducto)
    {
        $products = array();

        $stmt = $mysqli->prepare("CALL ObtenerDatosReciboVenta(?)");
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $producto = new Ticket(
                $row['idVenta'],
                $row['idUsuarioCliente'],
                $row['idProducto'],
                $row['nombreProducto'],
                $row['precio'],
                $row['idCarrito'],
                $row['idStatus'],
                $row['fechaHoraRegistro'],
                $row['total'],
                $row['cantidad'],
                $row['sumaTotal'],
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
    } */
}
