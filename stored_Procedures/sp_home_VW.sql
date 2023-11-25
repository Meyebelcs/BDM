

CREATE VIEW ObtenerProducMejorCalifiStock  AS
    SELECT 
        p.idProducto AS idProducto,
        p.idAdminAutorización AS idAdminAutorización,
        p.idStatus AS idStatus,
        p.idUsuarioCreador AS idUsuarioCreador,
        p.Nombre AS Nombre,
        p.Descripción AS Descripción,
        p.Precio AS Precio,
        p.Inventario AS Inventario,
        p.Fecha_publicación AS Fecha_publicación,
        p.Fecha_actualizacion AS Fecha_actualizacion,
        p.Tipo AS Tipo
    FROM Producto p
    INNER JOIN PromedioCalificacion pc ON p.idProducto = pc.idProducto
    WHERE p.Tipo = 'Stock'
    ORDER BY pc.promedio DESC
    LIMIT 6;


DELIMITER //


CREATE PROCEDURE ObtenerProductosMejorCalificadosYTipoStock()
BEGIN
    SELECT 
        idProducto,
        idAdminAutorización,
        idStatus,
        idUsuarioCreador,
        Nombre,
        Descripción,
        Precio,
        Inventario,
        Fecha_publicación,
        Fecha_actualizacion,
        Tipo
    FROM ObtenerProducMejorCalifiStock
END // 

DELIMITER ;



CREATE VIEW ObtenerProducMasReciStock AS
    SELECT 
        p.idProducto AS idProducto,
        p.idAdminAutorización AS idAdminAutorización,
        p.idStatus AS idStatus,
        p.idUsuarioCreador AS idUsuarioCreador,
        p.Nombre AS Nombre,
        p.Descripción AS Descripción,
        p.Precio AS Precio,
        p.Inventario AS Inventario,
        p.Fecha_publicación AS Fecha_publicación,
        p.Fecha_actualizacion AS Fecha_actualizacion,
        p.Tipo AS Tipo
    FROM Producto p
    WHERE p.Tipo = 'Stock'
    ORDER BY p.Fecha_publicación DESC
    LIMIT 6;



DELIMITER //

CREATE PROCEDURE ObtenerProductosMasRecientesYTipoStock()
BEGIN
    SELECT 
        idProducto,
        idAdminAutorización,
        idStatus,
        idUsuarioCreador,
        Nombre,
        Descripción,
        Precio,
        Inventario,
        Fecha_publicación,
        Fecha_actualizacion,
        Tipo
    FROM ObtenerProducMasReciStock
END //

DELIMITER ;


CREATE VIEW ObtenerProductosMasVendiStock AS
    SELECT
        p.idProducto AS idProducto,
        p.idAdminAutorización AS idAdminAutorización,
        p.idStatus AS idStatus,
        p.idUsuarioCreador AS idUsuarioCreador,
        p.Nombre AS Nombre,
        p.Descripción AS Descripción,
        p.Precio AS Precio,
        p.Inventario AS Inventario,
        p.Fecha_publicación AS Fecha_publicación,
        p.Fecha_actualizacion AS Fecha_actualizacion,
        p.Tipo AS Tipo,
        SUM(v.Cantidad) AS TotalVendido
    FROM Producto p
    LEFT JOIN Venta v ON p.idProducto = v.idProducto
    WHERE p.Tipo = 'Stock'
    GROUP BY p.idProducto, p.idAdminAutorización, p.idStatus, p.idUsuarioCreador, p.Nombre, p.Descripción, p.Precio, p.Inventario, p.Fecha_publicación, p.Fecha_actualizacion, p.Tipo
    ORDER BY TotalVendido DESC
    LIMIT 6;



DELIMITER //

CREATE PROCEDURE ObtenerProductosMasVendidosTipoStock()
BEGIN
    SELECT
        idProducto,
        idAdminAutorización,
        idStatus,
        idUsuarioCreador,
        Nombre,
        Descripción,
        Precio,
        Inventario,
        Fecha_publicación,
        Fecha_actualizacion,
        Tipo,
        TotalVendido
    FROM ObtenerProductosMasVendiStock
END //

DELIMITER ;




CREATE VIEW ObtenerProduCMejorCalifiCotizacion AS
    SELECT 
        p.idProducto AS idProducto,
        p.idAdminAutorización AS idAdminAutorización,
        p.idStatus AS idStatus,
        p.idUsuarioCreador AS idUsuarioCreador,
        p.Nombre AS Nombre,
        p.Descripción AS Descripción,
        p.Precio AS Precio,
        p.Inventario AS Inventario,
        p.Fecha_publicación AS Fecha_publicación,
        p.Fecha_actualizacion AS Fecha_actualizacion,
        p.Tipo AS Tipo,
        pc.promedio AS promedio
    FROM Producto p
    JOIN PromedioCalificacion pc ON p.idProducto = pc.idProducto
    WHERE p.Tipo = 'Cotización'
    ORDER BY pc.promedio DESC
    LIMIT 6;



DELIMITER //

CREATE PROCEDURE ObtenerProductosMejorCalificadosYTipoCotizacion()
BEGIN
    SELECT 
        idProducto,
        idAdminAutorización,
        idStatus,
        idUsuarioCreador,
        Nombre,
        Descripción,
        Precio,
        Inventario,
        Fecha_publicación,
        Fecha_actualizacion,
        Tipo,
        promedio
    FROM ObtenerProduCMejorCalifiCotizacion
END //

DELIMITER ;




CREATE VIEW ObtenerProduCMasReciCotizacion AS
    SELECT 
        p.idProducto AS idProducto,
        p.idAdminAutorización AS idAdminAutorización,
        p.idStatus AS idStatus,
        p.idUsuarioCreador AS idUsuarioCreador,
        p.Nombre AS Nombre,
        p.Descripción AS Descripción,
        p.Precio AS Precio,
        p.Inventario AS Inventario,
        p.Fecha_publicación AS Fecha_publicación,
        p.Fecha_actualizacion AS Fecha_actualizacion,
        p.Tipo AS Tipo
    FROM Producto p
    WHERE p.Tipo = 'Cotización'
    ORDER BY p.Fecha_publicación DESC
    LIMIT 6;



DELIMITER //

CREATE PROCEDURE ObtenerProductosMasRecientesYTipoCotizacion()
BEGIN
    SELECT 
        idProducto,
        idAdminAutorización,
        idStatus,
        idUsuarioCreador,
        Nombre,
        Descripción,
        Precio,
        Inventario,
         Fecha_publicación,
        Fecha_actualizacion,
        Tipo
    FROM ObtenerProduCMasReciCotizacion
END //

DELIMITER ;




CREATE VIEW ObtenerProducMasVendCotizacion AS
    SELECT
        p.idProducto AS idProducto,
        p.idAdminAutorización AS idAdminAutorización,
        p.idStatus AS idStatus,
        p.idUsuarioCreador AS idUsuarioCreador,
        p.Nombre AS Nombre,
        p.Descripción AS Descripción,
        p.Precio AS Precio,
        p.Inventario AS Inventario,
        p.Fecha_publicación AS Fecha_publicación,
        p.Fecha_actualizacion AS Fecha_actualizacion,
        p.Tipo AS Tipo,
        SUM(v.Cantidad) AS TotalVendido
    FROM Producto p
    LEFT JOIN Venta v ON p.idProducto = v.idProducto
    WHERE p.Tipo = 'Cotización'
    GROUP BY p.idProducto, p.idAdminAutorización, p.idStatus, p.idUsuarioCreador, p.Nombre, p.Descripción, p.Precio, p.Inventario, p.Fecha_publicación, p.Fecha_actualizacion, p.Tipo
    ORDER BY TotalVendido DESC
    LIMIT 6;





DELIMITER //

CREATE PROCEDURE ObtenerProductosMasVendidosTipoCotizacion()
BEGIN
    SELECT
        idProducto,
        idAdminAutorización,
        idStatus,
        idUsuarioCreador,
        Nombre,
        Descripción,
        Precio,
        Inventario,
        Fecha_publicación,
        Fecha_actualizacion,
        Tipo,
        TotalVendido
    FROM ObtenerProducMasVendCotizacion
END //

DELIMITER ;







