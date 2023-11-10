------------insert status------------
DELIMITER //

CREATE PROCEDURE sp_InsertEstatus(
    IN p_nombre VARCHAR(50)
)
BEGIN
    INSERT INTO Estatus (Nombre)
    VALUES (p_nombre);
END //

DELIMITER ;
------------find status------------
DELIMITER //

CREATE PROCEDURE sp_FindEstatusById(
    IN p_idStatus INT
)
BEGIN
    SELECT idStatus, Nombre
    FROM Estatus
    WHERE idStatus = p_idStatus
    LIMIT 1;
END //

DELIMITER ;

------------update status------------
DELIMITER //

CREATE PROCEDURE sp_UpdateEstatus(
    IN p_idStatus INT,
    IN p_nombre VARCHAR(50)
)
BEGIN
    UPDATE Estatus
    SET Nombre = p_nombre
    WHERE idStatus = p_idStatus;
END //

DELIMITER ;

