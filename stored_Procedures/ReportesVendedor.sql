---------POV Vendedor Stock------
DELIMITER //

CREATE PROCEDURE getAllProductPOVStock(IN idUsuarioCreadorParam INT)
BEGIN
   SELECT
    P.idProducto AS idProducto,
    P.Nombre AS Nombre,
    P.Descripción AS Descripción,
    P.Precio AS Precio,
    P.Inventario AS Inventario,
    P.Fecha_Publicación AS Fecha_Hr,
    ( SELECT Archivo.Archivo
        FROM Archivo 
        WHERE Archivo.idProducto = P.idProducto
        ORDER BY Archivo.idArchivo DESC
        LIMIT 1
    ) AS Imagen,
    ( 
        SELECT COALESCE(SUM(Venta.Cantidad), 0)
        FROM Venta
        WHERE Venta.idProducto = P.idProducto
    ) AS CantidadVendida,
    (   SELECT COALESCE(SUM(Venta.Total), 0) 
        FROM Venta 
        WHERE Venta.idProducto = P.idProducto
    ) AS TotalIngresos,
    ROUND(COALESCE(AVG(C.Calificacion), 0)) AS PromedioCalificacion
    FROM
        Producto P
    LEFT JOIN
        Venta V ON P.idProducto = V.idProducto
    LEFT JOIN
        Comentario C ON P.idProducto = C.idProducto
    WHERE
        P.idUsuarioCreador = idUsuarioCreadorParam and P.Tipo= 'Stock'
    GROUP BY
        P.idProducto;

END //

DELIMITER ;
---------POV Vendedor Cotizacion------
DELIMITER //

CREATE PROCEDURE getAllProductPOVCotizacion(IN idUsuarioCreadorParam INT)
BEGIN
   SELECT
    P.idProducto AS idProducto,
    P.Nombre AS Nombre,
    P.Descripción AS Descripción,
    P.Fecha_Publicación AS Fecha_Hr,
    ( 
        SELECT COALESCE(SUM(Venta.Cantidad), 0)
        FROM Venta
        WHERE Venta.idProducto = P.idProducto
    ) AS CantidadVendida,
    (   SELECT COALESCE(SUM(Venta.Total), 0) 
        FROM Venta 
        WHERE Venta.idProducto = P.idProducto
    ) AS TotalIngresos,
    ROUND(COALESCE(AVG(C.Calificacion), 0)) AS PromedioCalificacion
    FROM
        Producto P
    LEFT JOIN
        Venta V ON P.idProducto = V.idProducto
    LEFT JOIN
        Comentario C ON P.idProducto = C.idProducto
    WHERE
        P.idUsuarioCreador = idUsuarioCreadorParam and P.Tipo= 'Cotizacion'
    GROUP BY
        P.idProducto;

END //

DELIMITER ;

--------filtro Stock-----------

 DELIMITER //

CREATE PROCEDURE sp_FiltroPOVVendedor(
    IN idUsuarioCreadorParam INT,
    IN fechaParam DATETIME,
    IN horaParam TIME,
    IN categoriaParam INT,
    IN nombreProductoParam VARCHAR(255),
    IN calificacionParam INT,
    IN tipo VARCHAR(255)
)
BEGIN
    DECLARE query VARCHAR(2000);
    DECLARE filtro BOOLEAN;
    DECLARE `where` VARCHAR(2000);

    SET filtro = FALSE;
    SET `where` = '';

    SET query = 'SELECT
        P.idProducto AS idProducto,
        P.Nombre AS Nombre,
        P.Descripción AS Descripción,
        P.Precio AS Precio,
        P.Inventario AS Inventario,
        P.Fecha_Publicación AS Fecha_Hr,
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
        (
            SELECT COALESCE(SUM(Venta.Total), 0)
            FROM Venta
            WHERE Venta.idProducto = P.idProducto
        ) AS TotalIngresos,
        ROUND(COALESCE(AVG(C.Calificacion), 0)) AS PromedioCalificacion
        FROM Producto P
        LEFT JOIN Venta V ON P.idProducto = V.idProducto
        LEFT JOIN Comentario C ON P.idProducto = C.idProducto
        LEFT JOIN promediocalificacion PCA ON P.idProducto = PCA.idProducto
        LEFT JOIN ProductosConCategoria PC ON P.idProducto = PC.idProducto ';

    IF (idUsuarioCreadorParam <> 0 OR fechaParam IS NOT NULL OR horaParam IS NOT NULL OR categoriaParam <> 0 OR nombreProductoParam IS NOT NULL OR calificacionParam <> 0) THEN
        SET `where` = 'WHERE ';
    END IF;

    IF (idUsuarioCreadorParam <> 0) THEN
        SET filtro = TRUE;
        SET `where` = CONCAT(`where`, 'P.idUsuarioCreador = ', idUsuarioCreadorParam);
         SET `where` = CONCAT(`where`, ' AND P.Tipo = \'', tipo, '\'');
    END IF;

    IF (fechaParam IS NOT NULL) THEN
        IF filtro THEN
            SET `where` = CONCAT(`where`, ' AND ');
        END IF;
        SET `where` = CONCAT(`where`, 'DATE(P.Fecha_Publicación) = DATE(', QUOTE(fechaParam), ')');
        SET filtro = TRUE;
    END IF;

    IF (horaParam IS NOT NULL) THEN
        IF filtro THEN
            SET `where` = CONCAT(`where`, ' AND ');
        END IF;
        
        -- Extrae solo la parte de la hora de la fecha
        SET `where` = CONCAT(`where`, 'HOUR(P.Fecha_Publicación) = HOUR(', QUOTE(horaParam), ')');
        
        SET filtro = TRUE;
    END IF;


    IF (categoriaParam <> 0) THEN
        IF filtro THEN
            SET `where` = CONCAT(`where`, ' AND ');
        END IF;
        SET `where` = CONCAT(`where`, 'PC.idCategoria = ', categoriaParam);
        SET filtro = TRUE;
    END IF;

    IF (nombreProductoParam IS NOT NULL) THEN
        IF filtro THEN
            SET `where` = CONCAT(`where`, ' AND ');
        END IF;
        SET `where` = CONCAT(`where`, 'P.Nombre LIKE CONCAT(\'%\', ', QUOTE(nombreProductoParam), ', \'%\')');
        SET filtro = TRUE;
    END IF;

    IF (calificacionParam <> 0) THEN
        IF filtro THEN
            SET `where` = CONCAT(`where`, ' AND ');
        END IF;
        SET `where` = CONCAT(`where`, 'PCA.promedio = ', calificacionParam);
        SET filtro = TRUE;
    END IF;

    SET query = CONCAT(query, `where`, ' GROUP BY P.idProducto');

    -- Ejecuta la consulta dinámica
    PREPARE stmt FROM query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //

DELIMITER ;
 


/* DELIMITER //

CREATE PROCEDURE getAllProductPOVStockFiltro(
    IN idUsuarioCreadorParam INT,
    IN fechaParam DATETIME,
    IN horaParam TIME,
    IN categoriaParam INT,
    IN nombreProductoParam VARCHAR(255),
    IN calificacionParam INT
)
BEGIN
    SELECT
        P.idProducto AS idProducto,
        P.Nombre AS Nombre,
        P.Descripción AS Descripción,
        P.Precio AS Precio,
        P.Inventario AS Inventario,
        P.Fecha_Publicación AS Fecha_Hr,
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
        (
            SELECT COALESCE(SUM(Venta.Total), 0)
            FROM Venta
            WHERE Venta.idProducto = P.idProducto
        ) AS TotalIngresos,
        ROUND(COALESCE(AVG(C.Calificacion), 0)) AS PromedioCalificacion
    FROM
        Producto P
    LEFT JOIN
        Venta V ON P.idProducto = V.idProducto
    LEFT JOIN
        Comentario C ON P.idProducto = C.idProducto
    LEFT JOIN
        ProductosConCategoria PC ON P.idProducto = PC.idProducto
    WHERE
        P.idUsuarioCreador = idUsuarioCreadorParam
        AND P.Tipo = 'Stock'
        AND (fechaParam IS NULL OR DATE(P.Fecha_Publicación) = DATE(fechaParam))
        AND (horaParam IS NULL OR TIME(P.Fecha_Publicación) = TIME(horaParam))
        AND (categoriaParam IS NULL OR PC.idCategoria = categoriaParam)
        AND (nombreProductoParam IS NULL OR P.Nombre LIKE CONCAT('%', nombreProductoParam, '%'))
        AND (calificacionParam IS NULL OR ROUND(COALESCE(AVG(C.Calificacion), 0)) = calificacionParam)
    GROUP BY
        P.idProducto;
END //

DELIMITER ;
 */


/* ---------POV Vendedor Stock------
DELIMITER //

CREATE PROCEDURE getAllSellsProductPOVStock(IN idUsuarioCreadorParam INT)
BEGIN
   SELECT
    P.idProducto AS idProducto,
    P.Nombre AS Nombre,
    P.Descripción AS Descripción,
    P.Precio AS Precio,
    P.Fecha_Publicación AS Fecha_Hr,
    ( SELECT Archivo.Archivo
        FROM Archivo 
        WHERE Archivo.idProducto = P.idProducto
        ORDER BY Archivo.idArchivo DESC
        LIMIT 1
    ) AS Imagen,
    ( SELECT SUM(Venta.Cantidad) 
        FROM Venta 
        WHERE Venta.idProducto = P.idProducto
    ) AS CantidadVendida,
    ( SELECT SUM(Venta.Total) 
        FROM Venta 
        WHERE Venta.idProducto = P.idProducto
    ) AS TotalIngresos,
    ROUND(COALESCE(AVG(C.Calificacion), 0)) AS PromedioCalificacion
    FROM
        Producto P
    JOIN
        Venta V ON P.idProducto = V.idProducto
    LEFT JOIN
        Comentario C ON P.idProducto = C.idProducto
    WHERE
        P.idUsuarioCreador = idUsuarioCreadorParam and P.Tipo= 'Stock'
    GROUP BY
        P.idProducto;

END //

DELIMITER ;

---------POV Vendedor Cotizacion------
DELIMITER //

CREATE PROCEDURE getAllSellsProductPOVCotizacion(IN idUsuarioCreadorParam INT)
BEGIN
   SELECT
    P.idProducto AS idProducto,
    P.Nombre AS Nombre,
    P.Descripción AS Descripción,
    P.Precio AS Precio,
    P.Fecha_Publicación AS Fecha_Hr,
    ( SELECT Archivo.Archivo
        FROM Archivo 
        WHERE Archivo.idProducto = P.idProducto
        ORDER BY Archivo.idArchivo DESC
        LIMIT 1
    ) AS Imagen,
    ( SELECT SUM(Venta.Cantidad) 
        FROM Venta 
        WHERE Venta.idProducto = P.idProducto
    ) AS CantidadVendida,
    ( SELECT SUM(Venta.Total) 
        FROM Venta 
        WHERE Venta.idProducto = P.idProducto
    ) AS TotalIngresos,
    ROUND(COALESCE(AVG(C.Calificacion), 0)) AS PromedioCalificacion
    FROM
        Producto P
    JOIN
        Venta V ON P.idProducto = V.idProducto
    LEFT JOIN
        Comentario C ON P.idProducto = C.idProducto
    WHERE
        P.idUsuarioCreador = idUsuarioCreadorParam and P.Tipo= 'Cotizacion'
    GROUP BY
        P.idProducto;

END //

DELIMITER ;
 */

