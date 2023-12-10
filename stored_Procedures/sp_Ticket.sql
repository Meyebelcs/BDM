
DELIMITER //

CREATE PROCEDURE ObtenerDatosReciboVenta(IN identificadorVenta INT)
BEGIN
    DECLARE sumaTotal DECIMAL(10, 2);

    -- Calcular la suma total de ventas con el mismo identificador
    SELECT SUM(Total) INTO sumaTotal
    FROM Venta
    WHERE identificador = identificadorVenta;

    -- Obtener los detalles de las ventas con el mismo identificador, incluyendo el nombre y precio del producto
    SELECT v.idVenta, v.idUsuarioCliente, v.idProducto, p.Nombre AS 'Nombre_Producto', p.Precio,
           v.idCarrito, v.idStatus, v.FechaHr_registro, v.Total, v.Cantidad, sumaTotal AS 'Suma_Total'
    FROM Venta v
    JOIN Producto p ON v.idProducto = p.idProducto
    WHERE v.identificador = identificadorVenta;
END //

DELIMITER ;

------------find Producto------------
DELIMITER //

CREATE PROCEDURE sp_Ticket(
    IN p_identificador INT
)
BEGIN
    SELECT
        V.idProducto,
        P.Nombre,
        P.Descripción,
        P.Precio,
        P.Tipo,
        V.FechaHr_registro,
        V.Cantidad,
        V.Total
    FROM Producto P
    JOIN Venta V ON P.idProducto = V.idProducto
    WHERE  V.identificador = p_identificador
    GROUP BY P.idProducto;
   
END //

DELIMITER ;
