------------insert Producto------------

DELIMITER //

CREATE PROCEDURE sp_InsertProducto(
    IN p_idAdminAutorizacion INT,
    IN p_idStatus INT,
    IN p_idUsuarioCreador INT,
    IN p_nombre VARCHAR(255),
    IN p_descripcion TEXT,
    IN p_precio DECIMAL(10, 2),
    IN p_inventario INT,
    IN p_fechaPublicacion DATETIME,
    IN p_fechaActualizacion DATETIME,
    IN p_tipo VARCHAR(50)
)
BEGIN
    INSERT INTO Producto (
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
    )
    VALUES (
        p_idAdminAutorizacion,
        p_idStatus,
        p_idUsuarioCreador,
        p_nombre,
        p_descripcion,
        p_precio,
        p_inventario,
        p_fechaPublicacion,
        p_fechaActualizacion,
        p_tipo
    );
END //

DELIMITER ;
------------find Producto------------
DELIMITER //

CREATE PROCEDURE sp_FindProductoById(
    IN p_idProducto INT
)
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
    FROM Producto
    WHERE idProducto = p_idProducto
    LIMIT 1;
END //

DELIMITER ;
------------find Producto------------
/* DELIMITER //

CREATE PROCEDURE sp_UpdateProductoCotizacion(
    IN p_idProducto INT,
    
    IN p_idStatus INT,
  
    IN p_nombre VARCHAR(255),
    IN p_descripcion TEXT,
  
    IN p_fechaActualizacion DATETIME
   
)
BEGIN
    UPDATE Producto
    SET
      
        idStatus = p_idStatus,
        
        Nombre = p_nombre,
        Descripción = p_descripcion,
        Precio = p_precio,
        Inventario = p_inventario,
       
        Fecha_actualizacion = p_fechaActualizacion
        
    WHERE idProducto = p_idProducto;
END //

DELIMITER ; */
------------find Producto------------
DELIMITER //

CREATE PROCEDURE sp_UpdateProducto(
    IN p_idProducto INT,
    
    IN p_idStatus INT,
  
    IN p_nombre VARCHAR(255),
    IN p_descripcion TEXT,
    IN p_precio DECIMAL(10, 2),
    IN p_inventario INT,
   
    IN p_fechaActualizacion DATETIME
   
)
BEGIN
    UPDATE Producto
    SET
      
        idStatus = p_idStatus,
        
        Nombre = p_nombre,
        Descripción = p_descripcion,
        Precio = p_precio,
        Inventario = p_inventario,
       
        Fecha_actualizacion = p_fechaActualizacion
        
    WHERE idProducto = p_idProducto;
END //

DELIMITER ;
-------LAST---------------
DELIMITER //

CREATE PROCEDURE getLastIdProducto()
BEGIN
    DECLARE ultimoId INT;

    SELECT idProducto INTO ultimoId
    FROM Producto
    ORDER BY idProducto DESC
    LIMIT 1;

    SELECT ultimoId AS 'idProducto';
END //

DELIMITER ;

--------------
DELIMITER //

CREATE PROCEDURE sp_getInfoProductCoti(
    IN idProducto_Param INT,
    IN idChatParam INT
)
BEGIN
   SELECT
        P.idProducto AS idProducto,
        P.Nombre AS Nombre,
        P.Descripción AS Descripción,
        P.Inventario AS Inventario
    FROM Producto P
    JOIN Chat C ON P.idProducto = C.idProducto
    WHERE P.idProducto = idProducto_Param AND C.idChat = idChatParam;

END //

DELIMITER ;

----------------
DELIMITER //

CREATE PROCEDURE sp_getInfoProductCoti(
    IN idProducto_Param INT,
    IN idChatParam INT
)
BEGIN
   SELECT
        P.idProducto AS idProducto,
        P.Nombre AS Nombre,
        P.Descripción AS Descripción,
        P.Inventario AS Inventario
    FROM Producto P
    JOIN Chat C ON P.idProducto = C.idProducto
    WHERE P.idProducto = idProducto_Param AND C.idChat = idChatParam;

END //

DELIMITER ;
--------------
DELIMITER //

CREATE PROCEDURE sp_ifExistCarritoProduct(
    IN idProducto_Param INT,
    IN idChatParam INT
)
BEGIN
    DECLARE carritoExists INT DEFAULT 0;

    -- Verifica si existe un registro en la tabla Carrito
    SELECT COUNT(*) INTO carritoExists
    FROM Carrito C
    WHERE C.idProducto = idProducto_Param
    AND (C.idUsuarioCliente = (SELECT idUsuarioVendedor FROM Chat WHERE idChat = idChatParam)
        OR C.idUsuarioCliente = (SELECT idUsuarioCliente FROM Chat WHERE idChat = idChatParam));

    -- Devuelve 1 si encuentra coincidencia en Carrito, 0 si no encuentra
    SELECT carritoExists AS CoincidenciaEnCarrito;
END //

DELIMITER ;

DELIMITER //
-----------
DELIMITER //

CREATE PROCEDURE sp_ifExistCarritoProduct2(
    IN idProducto_Param INT,
    IN idChatParam INT
)
BEGIN
    DECLARE carritoExists INT DEFAULT 0;
    DECLARE carritoId INT;

    -- Verifica si existe un registro en la tabla Carrito
    SELECT COUNT(*) INTO carritoExists
    FROM Carrito C
    WHERE C.idProducto = idProducto_Param
    AND (C.idUsuarioCliente = (SELECT idUsuarioVendedor FROM Chat WHERE idChat = idChatParam)
        OR C.idUsuarioCliente = (SELECT idUsuarioCliente FROM Chat WHERE idChat = idChatParam));

    -- Obtén el idCarrito si hay una coincidencia
    SELECT idCarrito INTO carritoId
    FROM Carrito
    WHERE idProducto = idProducto_Param
    AND (idUsuarioCliente = (SELECT idUsuarioVendedor FROM Chat WHERE idChat = idChatParam)
        OR idUsuarioCliente = (SELECT idUsuarioCliente FROM Chat WHERE idChat = idChatParam))
    LIMIT 1;

    -- Devuelve 1 y el idCarrito si encuentra coincidencia en Carrito, 0 si no encuentra
    SELECT carritoExists AS CoincidenciaEnCarrito, carritoId AS idCarrito;
END //

DELIMITER ;
------------
DELIMITER //

CREATE PROCEDURE getProductsListCotizacion2(IN p_idUsuarioCreador INT, IN p_idLista INT)
BEGIN
    SELECT
        P.idProducto AS idProducto,
        P.Nombre AS Nombre,
        P.Descripción AS Descripción,
        PEL.idLista AS idLista,
        PEL.idUsuarioCreador AS idUsuarioCreador,
        P.Precio AS Precio,
        P.Fecha_Publicación AS Fecha_Hr,
        (SELECT Archivo.Archivo
            FROM Archivo
            WHERE Archivo.idProducto = P.idProducto
            ORDER BY Archivo.idArchivo DESC
            LIMIT 1) AS Imagen,
        COALESCE(SUM(V.Cantidad), 0) AS CantidadVendida,
        COALESCE(AVG(C.promedio), 0) AS PromedioCalificacion
    FROM Producto P
    JOIN ProductoEnLista PEL ON PEL.idProducto = P.idProducto
    LEFT JOIN Venta V ON P.idProducto = V.idProducto
    LEFT JOIN PromedioCalificacion C ON P.idProducto = C.idProducto
    WHERE  P.Tipo = 'Cotizacion'
        AND PEL.idUsuarioCreador = p_idUsuarioCreador
        AND PEL.idLista = p_idLista
    GROUP BY P.idProducto;
END //

DELIMITER ;
------------
DELIMITER //

CREATE PROCEDURE getProductsListStock2(IN p_idUsuarioCreador INT, IN p_idLista INT)
BEGIN
    SELECT
        P.idProducto AS idProducto,
        P.Nombre AS Nombre,
        P.Descripción AS Descripción,
        PEL.idLista AS idLista,
        PEL.idUsuarioCreador AS idUsuarioCreador,
        P.Precio AS Precio,
        P.Fecha_Publicación AS Fecha_Hr,
        (SELECT Archivo.Archivo
            FROM Archivo
            WHERE Archivo.idProducto = P.idProducto
            ORDER BY Archivo.idArchivo DESC
            LIMIT 1) AS Imagen,
        COALESCE(SUM(V.Cantidad), 0) AS CantidadVendida,
        COALESCE(AVG(C.promedio), 0) AS PromedioCalificacion
    FROM Producto P
    JOIN ProductoEnLista PEL ON PEL.idProducto = P.idProducto
    LEFT JOIN Venta V ON P.idProducto = V.idProducto
    LEFT JOIN PromedioCalificacion C ON P.idProducto = C.idProducto
    WHERE  P.Tipo = 'Stock'
        AND PEL.idUsuarioCreador = p_idUsuarioCreador
        AND PEL.idLista = p_idLista
    GROUP BY P.idProducto;
END //

DELIMITER ;
------------
DELIMITER //

CREATE PROCEDURE getProductsbyVendedor(IN p_idUsuarioCreador INT, IN p_tipo VARCHAR(50))
BEGIN
    SELECT
        P.idProducto AS idProducto,
        P.Nombre AS Nombre,
        P.Descripción AS Descripción,
        P.Precio AS Precio,
        P.Fecha_Publicación AS Fecha_Hr,
        P.Inventario AS Inventario,
        (SELECT Archivo.Archivo
            FROM Archivo
            WHERE Archivo.idProducto = P.idProducto
            ORDER BY Archivo.idArchivo DESC
            LIMIT 1) AS Imagen,
        COALESCE(SUM(V.Cantidad), 0) AS CantidadVendida,
        COALESCE(AVG(C.promedio), 0) AS PromedioCalificacion
    FROM Producto P
    LEFT JOIN Venta V ON P.idProducto = V.idProducto
    LEFT JOIN PromedioCalificacion C ON P.idProducto = C.idProducto
    WHERE  P.Tipo = p_tipo
        AND P.idUsuarioCreador = p_idUsuarioCreador
    GROUP BY P.idProducto;
END //

DELIMITER ;

------------find Producto------------
DELIMITER //

CREATE PROCEDURE sp_FindProductoByStatus(
    IN p_idstatus INT
)
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
    FROM Producto
    WHERE idStatus = p_idstatus and Tipo= 'Cotizacion';
   
END //

DELIMITER ;
