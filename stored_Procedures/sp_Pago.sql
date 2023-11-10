------------insert Pago------------
DELIMITER //

CREATE PROCEDURE sp_InsertPago(
    IN p_idTipoPago INT,
    IN p_idVenta INT,
    IN p_idStatus INT,
    IN p_monto DECIMAL(10, 2)
)
BEGIN
    INSERT INTO Pago (
        idTipoPago,
        idVenta,
        idStatus,
        Monto
    )
    VALUES (
        p_idTipoPago,
        p_idVenta,
        p_idStatus,
        p_monto
    );
END //

DELIMITER ;
------------find Pago------------

DELIMITER //
CREATE PROCEDURE sp_FindPagoById(
    IN p_idPago INT
)
BEGIN
    SELECT
        idPago,
        idTipoPago,
        idVenta,
        idStatus,
        Monto
    FROM Pago
    WHERE idPago = p_idPago
    LIMIT 1;
END //

DELIMITER ;
------------update Pago------------
DELIMITER //

CREATE PROCEDURE sp_UpdatePago(
    IN p_idPago INT,
    IN p_idTipoPago INT,
    IN p_idVenta INT,
    IN p_idStatus INT,
    IN p_monto DECIMAL(10, 2)
)
BEGIN
    UPDATE Pago
    SET
        idTipoPago = p_idTipoPago,
        idVenta = p_idVenta,
        idStatus = p_idStatus,
        Monto = p_monto
    WHERE idPago = p_idPago;
END //

DELIMITER ;
