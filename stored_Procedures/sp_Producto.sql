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
        idAdminAutorizacion,
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
        idAdminAutorizacion,
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
        idAdminAutorizacion = p_idAdminAutorizacion,
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
