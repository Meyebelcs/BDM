------------insert DetalleVenta------------

DELIMITER //

CREATE PROCEDURE sp_InsertDetalleVenta(
    IN p_idVenta INT,
    IN p_idProducto INT,
    IN p_idCarrito INT,
    IN p_idStatus INT
)
BEGIN
    INSERT INTO DetalleVenta (
        idVenta,
        idProducto,
        idCarrito,
        idStatus
    )
    VALUES (
        p_idVenta,
        p_idProducto,
        p_idCarrito,
        p_idStatus
    );
END //

DELIMITER ;
------------find DetalleVenta------------

DELIMITER //
CREATE PROCEDURE sp_FindDetalleVentaById(
    IN p_idDetalleVenta INT
)
BEGIN
    SELECT
        idDetalleVenta,
        idVenta,
        idProducto,
        idCarrito,
        idStatus
    FROM DetalleVenta
    WHERE idDetalleVenta = p_idDetalleVenta
    LIMIT 1;
END //

DELIMITER ;
------------update DetalleVenta------------
DELIMITER //

CREATE PROCEDURE sp_UpdateDetalleVenta(
    IN p_idDetalleVenta INT,
    IN p_idVenta INT,
    IN p_idProducto INT,
    IN p_idCarrito INT,
    IN p_idStatus INT
)
BEGIN
    UPDATE DetalleVenta
    SET
        idVenta = p_idVenta,
        idProducto = p_idProducto,
        idCarrito = p_idCarrito,
        idStatus = p_idStatus
    WHERE idDetalleVenta = p_idDetalleVenta;
END //

DELIMITER ;
