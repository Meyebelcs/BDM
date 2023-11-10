------------insert TipoPago------------
DELIMITER //

CREATE PROCEDURE sp_InsertTipoPago(
    IN p_idStatus INT,
    IN p_nombre VARCHAR(100)
)
BEGIN
    INSERT INTO TipoPago (
        idStatus,
        Nombre
    )
    VALUES (
        p_idStatus,
        p_nombre
    );
END //

DELIMITER ;
------------find TipoPago------------

DELIMITER //
CREATE PROCEDURE sp_FindTipoPagoById(
    IN p_idTipoPago INT
)
BEGIN
    SELECT
        idTipoPago,
        idStatus,
        Nombre
    FROM TipoPago
    WHERE idTipoPago = p_idTipoPago
    LIMIT 1;
END //

DELIMITER ;
------------update TipoPago------------
DELIMITER //

CREATE PROCEDURE sp_UpdateTipoPago(
    IN p_idTipoPago INT,
    IN p_idStatus INT,
    IN p_nombre VARCHAR(100)
)
BEGIN
    UPDATE TipoPago
    SET
        idStatus = p_idStatus,
        Nombre = p_nombre
    WHERE idTipoPago = p_idTipoPago;
END //

DELIMITER ;




