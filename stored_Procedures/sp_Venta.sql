------------insert Venta ------------
DELIMITER //

CREATE PROCEDURE sp_InsertVenta(
    IN p_idStatus INT,
    IN p_idUsuarioCliente INT,
    IN p_fechaHrRegistro DATETIME,
    IN p_total DECIMAL(10, 2)
)
BEGIN
    INSERT INTO Venta (
        idStatus,
        idUsuarioCliente,
        FechaHr_registro,
        Total
    )
    VALUES (
        p_idStatus,
        p_idUsuarioCliente,
        p_fechaHrRegistro,
        p_total
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
        idStatus,
        idUsuarioCliente,
        FechaHr_registro,
        Total
    FROM Venta
    WHERE idVenta = p_idVenta
    LIMIT 1;
END //

DELIMITER ;
------------update Venta ------------
DELIMITER //

CREATE PROCEDURE sp_UpdateVenta(
    IN p_idVenta INT,
    IN p_idStatus INT,
    IN p_idUsuarioCliente INT,
    IN p_fechaHrRegistro DATETIME,
    IN p_total DECIMAL(10, 2)
)
BEGIN
    UPDATE Venta
    SET
        idStatus = p_idStatus,
        idUsuarioCliente = p_idUsuarioCliente,
        FechaHr_registro = p_fechaHrRegistro,
        Total = p_total
    WHERE idVenta = p_idVenta;
END //

DELIMITER ;
