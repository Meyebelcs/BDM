-----------INGRESO VENTAS STOCK--------------
CREATE VIEW VistaVentasStock AS
SELECT
    p.idUsuarioCreador,
    SUM(v.Total) AS SumaTotalesVentas
FROM
    Venta v
JOIN
    Producto p ON v.idProducto = p.idProducto
WHERE
    p.Tipo = 'Stock'
GROUP BY
    p.idUsuarioCreador;

DELIMITER //
CREATE PROCEDURE GetSellsTotalByUserStock(IN p_idUsuario INT)
BEGIN
    SELECT
        SumaTotalesVentas
    FROM
        VistaVentasStock
    WHERE
        idUsuarioCreador = p_idUsuario;
END //
DELIMITER ;



----------INGRESO VENTAS COTIZACIONES--------------
CREATE VIEW VistaVentasCotizacion AS
SELECT
    p.idUsuarioCreador,
    SUM(v.Total) AS SumaTotalesVentas
FROM
    Venta v
JOIN
    Producto p ON v.idProducto = p.idProducto
WHERE
    p.Tipo = 'Cotizacion'
GROUP BY
    p.idUsuarioCreador;

DELIMITER //
CREATE PROCEDURE GetSellsTotalByUserCotizacion(IN p_idUsuario INT)
BEGIN
    SELECT
        SumaTotalesVentas
    FROM
        VistaVentasCotizacion
    WHERE
        idUsuarioCreador = p_idUsuario;
END //
DELIMITER ;



-----------categorias-------------
CREATE VIEW VistaCategoriasPorProducto AS
SELECT
    pc.idProducto,
    c.idCategoria,
    c.Nombre AS NombreCategoria,
    c.Descripcion AS DescripcionCategoria,
    c.Fecha_creacion AS FechaCreacionCategoria
FROM
    ProductosConCategoria pc
JOIN
    Categoria c ON pc.idCategoria = c.idCategoria;

DELIMITER //
CREATE PROCEDURE GetCategoriasPorProducto(IN p_idProducto INT)
BEGIN
    SELECT
        idCategoria,
        NombreCategoria,
        DescripcionCategoria,
        FechaCreacionCategoria
    FROM
        VistaCategoriasPorProducto
    WHERE
        idProducto = p_idProducto;
END //
DELIMITER ;
