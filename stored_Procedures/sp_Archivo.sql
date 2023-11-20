------------insert Archivo------------
DELIMITER //

CREATE PROCEDURE sp_InsertArchivo(
    IN p_idProducto INT,
    IN p_idStatus INT,
    IN p_archivo LONGBLOB
)
BEGIN
    INSERT INTO Archivo (idProducto, idStatus, Archivo)
    VALUES (p_idProducto, p_idStatus, p_archivo);
END //

DELIMITER ;
------------find Archivo------------

DELIMITER //
CREATE PROCEDURE sp_FindArchivoById(
    IN p_idArchivo INT
)
BEGIN
    SELECT
        idArchivo,
        idProducto,
        idStatus,
        Archivo
    FROM Archivo
    WHERE idArchivo = p_idArchivo
    LIMIT 1;
END //

DELIMITER ;

------------update Archivo------------
DELIMITER //

CREATE PROCEDURE sp_UpdateArchivo(
    IN p_idArchivo INT,
    IN p_idProducto INT,
    IN p_idStatus INT,
    IN p_archivo LONGBLOB
)
BEGIN
    UPDATE Archivo
    SET
        idProducto = p_idProducto,
        idStatus = p_idStatus,
        Archivo = p_archivo
    WHERE idArchivo = p_idArchivo;
END //

DELIMITER ;
------------find Archivo by product------------
DELIMITER //
CREATE PROCEDURE sp_FindArchivoByProduct(
    IN p_idProduct INT
)
BEGIN
    SELECT
        idArchivo,
        idProducto,
        idStatus,
        Archivo
    FROM Archivo
    WHERE idProducto = p_idProduct;
END //
DELIMITER ;