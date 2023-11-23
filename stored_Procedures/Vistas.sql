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

-----------------materiales--------------
CREATE VIEW VistaMaterialesPorProducto AS
SELECT
    mi.idMaterial,
    mi.idProducto,
    mi.Nombre,
    mi.Cantidad,
    mi.Fecha_creacion
FROM
    material_inventario mi
JOIN
    Producto p ON p.idProducto = mi.idProducto;




DELIMITER //
CREATE PROCEDURE GetMaterialesPorProducto(IN p_idProducto INT)
BEGIN
    SELECT
        idMaterial,
        idProducto,
        Nombre,
        Cantidad,
        Fecha_creacion
    FROM
        VistaMaterialesPorProducto
    WHERE
        idProducto = p_idProducto;
END //
DELIMITER ;

-----------------search--------------
CREATE VIEW VistaSearchProducto AS
  SELECT
        P.idProducto AS idProducto,
        P.Nombre AS Nombre,
        P.Descripción AS Descripción,
        P.Precio AS Precio,
        (SELECT Archivo.Archivo
            FROM Archivo
            WHERE Archivo.idProducto = P.idProducto
            ORDER BY Archivo.idArchivo DESC
            LIMIT 1) AS Imagen,
        (
            SELECT COALESCE(SUM(Venta.Cantidad), 0)
            FROM Venta
            WHERE Venta.idProducto = P.idProducto
        ) AS CantidadVendida,
        COALESCE(PCA.promediocalificacion, 0) AS PromedioCalificacion
        FROM Producto P
        LEFT JOIN Venta V ON P.idProducto = V.idProducto
        LEFT JOIN Comentario C ON P.idProducto = C.idProducto
        LEFT JOIN promediocalificacion PCA ON P.idProducto = PCA.idProducto
        LEFT JOIN ProductosConCategoria PC ON P.idProducto = PC.idProducto 

DELIMITER //

CREATE PROCEDURE SearchProductos(
    IN categoriaParam INT,
    IN nombreProductoParam VARCHAR(255),
    IN tipobusqueda VARCHAR(20), /* //categoria o nombre */
    IN tipoproducto VARCHAR(20) /* //cotizacion o stock */

)
BEGIN
    IF tipobusqueda = 'categoria' THEN
        -- Filtrar por categoría
        SELECT
            idProducto,
            Nombre,
            Descripción,
            Precio,
            Imagen,
            CantidadVendida,
            PromedioCalificacion
        FROM VistaSearchProducto
        WHERE PC.idCategoria = categoriaParam and P.Tipo = tipoproducto ;
    ELSEIF tipobusqueda = 'nombre' THEN
        -- Filtrar por nombre
        SELECT
            idProducto,
            Nombre,
            Descripción,
            Precio,
            Imagen,
            CantidadVendida,
            PromedioCalificacion
        FROM VistaSearchProducto
        WHERE P.Nombre LIKE CONCAT('%', nombreProductoParam, '%') and P.Tipo = tipoproducto ;
    ELSE
        -- Acción no reconocida
        SELECT 'Acción no reconocida' AS Resultado;
    END IF;
END //

DELIMITER ;

-------------------------------------