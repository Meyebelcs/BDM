------------insert Carrito ------------
DELIMITER //

CREATE PROCEDURE sp_InsertCarrito(
    IN p_idUsuarioCliente INT,
    IN p_idProducto INT,
    IN p_idStatus INT,
    IN p_cantidad INT,
    IN p_precioUnitario DECIMAL(10, 2),
    IN p_subtotal DECIMAL(10, 2),
    IN p_descripcion TEXT,
    IN p_fechaAgregado DATE,
    IN p_tipo VARCHAR(50)
)
BEGIN
    INSERT INTO Carrito (
        idUsuarioCliente,
        idProducto,
        idStatus,
        Cantidad,
        PrecioUnitario,
        Subtotal,
        Descripcion,
        Fecha_agregado,
        Tipo
    )
    VALUES (
        p_idUsuarioCliente,
        p_idProducto,
        p_idStatus,
        p_cantidad,
        p_precioUnitario,
        p_subtotal,
        p_descripcion,
        p_fechaAgregado,
        p_tipo
    );
END //

DELIMITER ;
------------find Carrito ------------

DELIMITER //
CREATE PROCEDURE sp_FindCarritoById(
    IN p_idCarrito INT
)
BEGIN
    SELECT
        idCarrito,
        idUsuarioCliente,
        idProducto,
        idStatus,
        Cantidad,
        PrecioUnitario,
        Subtotal,
        Descripcion,
        Fecha_agregado,
        Tipo
    FROM Carrito
    WHERE idCarrito = p_idCarrito
    LIMIT 1;
END //

DELIMITER ;
------------update Carrito ------------
DELIMITER //

CREATE PROCEDURE sp_UpdateCarrito(
    IN p_idCarrito INT,                     
    IN p_idProducto INT,
    IN p_idStatus INT,
    IN p_cantidad INT,
    IN p_precioUnitario DECIMAL(10, 2),
    IN p_subtotal DECIMAL(10, 2),
    IN p_descripcion TEXT,
    IN p_fechaAgregado DATE,
    IN p_tipo VARCHAR(50)

)
BEGIN
    UPDATE Carrito
    SET
        idProducto = p_idProducto,
        idStatus = p_idStatus,
        Cantidad = p_cantidad,
        PrecioUnitario = p_precioUnitario,
        Subtotal = p_subtotal,
        Descripcion = p_descripcion,
        Fecha_agregado = p_fechaAgregado,
        Tipo = p_tipo
    WHERE idCarrito = p_idCarrito;
END //

DELIMITER ;
