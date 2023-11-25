------------insert Venta ------------
DELIMITER //

CREATE PROCEDURE sp_InsertVenta(
    IN p_idUsuarioCliente INT,
    IN p_idProducto INT,
    IN p_idCarrito INT,
    IN p_idStatus INT,
    IN p_fechaHrRegistro DATETIME,
    IN p_total DECIMAL(10, 2),
    IN p_cantidad INT,
    IN p_identificador INT
)
BEGIN
    INSERT INTO Venta (
        idUsuarioCliente,
        idProducto,
        idCarrito,
        idStatus,
        FechaHr_registro,
        Total,
        Cantidad,
        identificador
    )
    VALUES (
        p_idUsuarioCliente,
        p_idProducto,
        p_idCarrito,
        p_idStatus,
        p_fechaHrRegistro,
        p_total,
        p_cantidad,
        p_identificador
    );
END //

DELIMITER ;

------------find Venta ------------
DELIMITER //

CREATE PROCEDURE sp_FindVentaById(
    IN p_idVenta INT
)
BEGIN
    SELECT
        idVenta,
        idUsuarioCliente,
        idProducto,
        idCarrito,
        idStatus,
        FechaHr_registro,
        Total,
        Cantidad
    FROM Venta
    WHERE idVenta = p_idVenta
    LIMIT 1;
END //

DELIMITER ;

------------update Venta ------------
DELIMITER //

CREATE PROCEDURE sp_UpdateVenta(
    IN p_idVenta INT,
    IN p_idUsuarioCliente INT,
    IN p_idProducto INT,
    IN p_idCarrito INT,
    IN p_idStatus INT,
    IN p_total DECIMAL(10, 2),
    IN p_cantidad INT
)
BEGIN
    UPDATE Venta
    SET
        idUsuarioCliente = p_idUsuarioCliente,
        idProducto = p_idProducto,
        idCarrito = p_idCarrito,
        idStatus = p_idStatus,
        Total = p_total,
        Cantidad = p_cantidad
    WHERE idVenta = p_idVenta;
END //

DELIMITER ;
