/* ---------POV Vendedor Stock-------no se usa
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
---------POV Vendedor Cotizacion-------no se usa
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

DELIMITER ;  */

--------filtro Stock-----------

/*  DELIMITER //

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
        SET `where` = CONCAT(`where`, 'P.Tipo = \'', tipo, '\'');
        SET filtro = TRUE;
    END IF;

    IF (idUsuarioCreadorParam <> 0) THEN
        IF filtro THEN
            SET `where` = CONCAT(`where`, ' AND ');
        END IF;
        SET `where` = CONCAT(`where`, 'P.idUsuarioCreador = ', idUsuarioCreadorParam);
        SET filtro = TRUE;
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

DELIMITER ; */
 
DELIMITER //

CREATE PROCEDURE sp_Filtro(
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
    DECLARE `where` VARCHAR(2000);

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

    SET `where` = CONCAT(`where`, 'WHERE P.Tipo = \'', tipo, '\'');

    IF (idUsuarioCreadorParam <> 0) THEN
        SET `where` = CONCAT(`where`, ' AND P.idUsuarioCreador = ', idUsuarioCreadorParam);
    END IF;

    IF (fechaParam IS NOT NULL) THEN
        SET `where` = CONCAT(`where`, ' AND DATE(P.Fecha_Publicación) = DATE(', QUOTE(fechaParam), ')');
    END IF;

    IF (horaParam IS NOT NULL) THEN
        SET `where` = CONCAT(`where`, ' AND HOUR(P.Fecha_Publicación) = HOUR(', QUOTE(horaParam), ')');
    END IF;

    IF (categoriaParam <> 0) THEN
        SET `where` = CONCAT(`where`, ' AND PC.idCategoria = ', categoriaParam);
    END IF;

    IF (nombreProductoParam IS NOT NULL) THEN
        SET `where` = CONCAT(`where`, ' AND P.Nombre LIKE CONCAT(\'%\', ', QUOTE(nombreProductoParam), ', \'%\')');
    END IF;

    IF (calificacionParam <> 0) THEN
        SET `where` = CONCAT(`where`, ' AND PCA.promedio = ', calificacionParam);
    END IF;

    SET query = CONCAT(query, `where`, ' GROUP BY P.idProducto');

    -- Ejecuta la consulta dinámica
    PREPARE stmt FROM query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //

DELIMITER ;

--------compras--------------
DELIMITER //

CREATE PROCEDURE sp_FiltroCompras(
    IN idUsuarioClienteParam INT,
    IN fechaParam DATETIME,
    IN horaParam TIME,
    IN categoriaParam INT,
    IN nombreProductoParam VARCHAR(255),
    IN calificacionParam INT,
    IN PrecioParam DECIMAL,
    IN tipo VARCHAR(255)
)
BEGIN
    DECLARE query VARCHAR(2000);
    DECLARE `where` VARCHAR(2000);

    SET `where` = '';

    SET query = 'SELECT
        P.idProducto AS idProducto,
        P.Nombre AS Nombre,
        P.Descripción AS Descripción,
        P.Precio AS Precio,
        V.FechaHr_registro AS Fecha_Hr,
        (SELECT Archivo.Archivo
            FROM Archivo
            WHERE Archivo.idProducto = P.idProducto
            ORDER BY Archivo.idArchivo DESC
            LIMIT 1) AS Imagen,
        ROUND(COALESCE(AVG(C.Calificacion), 0)) AS PromedioCalificacion,
        COALESCE(V.Total, 0) AS Total,
        COALESCE(V.Cantidad, 0) AS CantidadComprada,
        CA.Descripcion AS DescripcionCarrito
        FROM Venta V
        JOIN Producto P ON P.idProducto = V.idProducto
        LEFT JOIN Comentario C ON P.idProducto = C.idProducto
        LEFT JOIN promediocalificacion PCA ON P.idProducto = PCA.idProducto
        LEFT JOIN carrito CA ON P.idProducto = CA.idProducto
        LEFT JOIN ProductosConCategoria PC ON P.idProducto = PC.idProducto ';

    SET `where` = CONCAT(`where`, 'WHERE P.Tipo = \'', tipo, '\'');

    IF (idUsuarioClienteParam <> 0) THEN
        SET `where` = CONCAT(`where`, ' AND V.idUsuarioCliente = ', idUsuarioClienteParam);
    END IF;

    IF (fechaParam IS NOT NULL) THEN
        SET `where` = CONCAT(`where`, ' AND DATE(V.FechaHr_registro) = DATE(', QUOTE(fechaParam), ')');
    END IF;

    IF (horaParam IS NOT NULL) THEN
        SET `where` = CONCAT(`where`, ' AND HOUR(V.FechaHr_registro) = HOUR(', QUOTE(horaParam), ')');
    END IF;

    IF (categoriaParam <> 0) THEN
        SET `where` = CONCAT(`where`, ' AND PC.idCategoria = ', categoriaParam);
    END IF;

    IF (PrecioParam <> 0) THEN
        -- Ordenar primero por precio exacto
        SET `where` = CONCAT( `where`, ' AND V.Total = ', PrecioParam);
    END IF;

    IF (nombreProductoParam IS NOT NULL) THEN
        SET `where` = CONCAT(`where`, ' AND P.Nombre LIKE CONCAT(\'%\', ', QUOTE(nombreProductoParam), ', \'%\')');
    END IF;

    IF (calificacionParam <> 0) THEN
        SET `where` = CONCAT(`where`, ' AND PCA.promedio = ', calificacionParam);
    END IF;

    SET query = CONCAT(query, `where`, ' GROUP BY P.idProducto');

    -- Ejecuta la consulta dinámica
    PREPARE stmt FROM query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //

DELIMITER ;


------------
 
DELIMITER //

CREATE PROCEDURE sp_FiltroCotizacionBusqueda(
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
    DECLARE `where` VARCHAR(2000);

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

    SET `where` = CONCAT(`where`, 'WHERE P.idStatus = 1 AND P.Tipo = \'', tipo, '\'');
    

    IF (idUsuarioCreadorParam <> 0) THEN
        SET `where` = CONCAT(`where`, ' AND P.idUsuarioCreador = ', idUsuarioCreadorParam);
    END IF;

    IF (fechaParam IS NOT NULL) THEN
        SET `where` = CONCAT(`where`, ' AND DATE(P.Fecha_Publicación) = DATE(', QUOTE(fechaParam), ')');
    END IF;

    IF (horaParam IS NOT NULL) THEN
        SET `where` = CONCAT(`where`, ' AND HOUR(P.Fecha_Publicación) = HOUR(', QUOTE(horaParam), ')');
    END IF;

    IF (categoriaParam <> 0) THEN
        SET `where` = CONCAT(`where`, ' AND PC.idCategoria = ', categoriaParam);
    END IF;

    IF (nombreProductoParam IS NOT NULL) THEN
        SET `where` = CONCAT(`where`, ' AND P.Nombre LIKE CONCAT(\'%\', ', QUOTE(nombreProductoParam), ', \'%\')');
    END IF;

    IF (calificacionParam <> 0) THEN
        SET `where` = CONCAT(`where`, ' AND PCA.promedio = ', calificacionParam);
    END IF;

    SET query = CONCAT(query, `where`, ' GROUP BY P.idProducto');

    -- Ejecuta la consulta dinámica
    PREPARE stmt FROM query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //

DELIMITER ;

