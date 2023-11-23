/* -- Crear una vista------------------------
CREATE VIEW vista_ProductoFiltrado AS
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
FROM Producto P
LEFT JOIN Venta V ON P.idProducto = V.idProducto
LEFT JOIN Comentario C ON P.idProducto = C.idProducto
LEFT JOIN promediocalificacion PCA ON P.idProducto = PCA.idProducto
LEFT JOIN ProductosConCategoria PC ON P.idProducto = PC.idProducto;

--------sp---------
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

    SET query = 'SELECT * FROM vista_ProductoFiltrado';

    SET `where` = CONCAT(`where`, ' WHERE Tipo = \'', tipo, '\'');

    IF (idUsuarioCreadorParam <> 0) THEN
        SET `where` = CONCAT(`where`, ' AND idUsuarioCreador = ', idUsuarioCreadorParam);
    END IF;

    IF (fechaParam IS NOT NULL) THEN
        SET `where` = CONCAT(`where`, ' AND DATE(Fecha_Hr) = DATE(', QUOTE(fechaParam), ')');
    END IF;

    IF (horaParam IS NOT NULL) THEN
        SET `where` = CONCAT(`where`, ' AND HOUR(Fecha_Hr) = HOUR(', QUOTE(horaParam), ')');
    END IF;

    IF (categoriaParam <> 0) THEN
        SET `where` = CONCAT(`where`, ' AND idCategoria = ', categoriaParam);
    END IF;

    IF (nombreProductoParam IS NOT NULL) THEN
        SET `where` = CONCAT(`where`, ' AND Nombre LIKE CONCAT(\'%\', ', QUOTE(nombreProductoParam), ', \'%\')');
    END IF;

    IF (calificacionParam <> 0) THEN
        SET `where` = CONCAT(`where`, ' AND PromedioCalificacion = ', calificacionParam);
    END IF;

    SET query = CONCAT(query, `where`);

    -- Ejecuta la consulta dinámica
    PREPARE stmt FROM query;
    EXECUTE stmt;
    DEALLOCATE PREPARE stmt;
END //

DELIMITER ;
 */