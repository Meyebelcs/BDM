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
DELIMITER //

CREATE PROCEDURE sp_UpdateProducto(
    IN p_idProducto INT,
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
    UPDATE Producto
    SET
        idAdminAutorización = p_idAdminAutorizacion,
        idStatus = p_idStatus,
        idUsuarioCreador = p_idUsuarioCreador,
        Nombre = p_nombre,
        Descripción = p_descripcion,
        Precio = p_precio,
        Inventario = p_inventario,
        Fecha_publicación = p_fechaPublicacion,
        Fecha_actualizacion = p_fechaActualizacion,
        Tipo = p_tipo
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
