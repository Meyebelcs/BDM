
/* DELIMITER //

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
-----------------
DELIMITER //

CREATE PROCEDURE ObtenerListasPublicas(IN creador INT)
BEGIN
    SELECT 
        idLista AS idLista,
        idStatus AS idStatus,
        idUsuarioCreador AS idUsuarioCreador,
        Nombre AS Nombre,
        Descripción AS Descripción,
        Imagen AS Imagen,
        Fecha_creacion AS Fecha_creacion
    FROM Lista
    WHERE idUsuarioCreador = creador AND Modo = 'Publico';
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE ObtenerListasPrivado(IN creador INT)
BEGIN
    SELECT 
        idLista AS idLista,
        idStatus AS idStatus,
        idUsuarioCreador AS idUsuarioCreador,
        Nombre AS Nombre,
        Descripción AS Descripción,
        Imagen AS Imagen,
        Fecha_creacion AS Fecha_creacion
    FROM Lista
    WHERE idUsuarioCreador = creador AND Modo = 'Privado';
END //

DELIMITER ; */