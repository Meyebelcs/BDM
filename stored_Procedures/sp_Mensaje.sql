------------insert Mensaje------------
DELIMITER //

CREATE PROCEDURE sp_InsertMensaje(
    IN p_idStatus INT,
    IN p_idChat INT,
    IN p_idUsuarioCreador INT,
    IN p_mensaje TEXT,
    IN p_fechaCreacion DATETIME
)
BEGIN
    INSERT INTO Mensaje (
        idStatus,
        idChat,
        idUsuarioCreador,
        Mensaje,
        Fecha_creacion
    )
    VALUES (
        p_idStatus,
        p_idChat,
        p_idUsuarioCreador,
        p_mensaje,
        p_fechaCreacion
    );
END //

DELIMITER ;
------------find Mensaje------------

DELIMITER //
CREATE PROCEDURE sp_FindMensajeById(
    IN p_idMensaje INT
)
BEGIN
    SELECT
        idMensaje,
        idStatus,
        idChat,
        idUsuarioCreador,
        Mensaje,
        Fecha_creacion
    FROM Mensaje
    WHERE idMensaje = p_idMensaje
    LIMIT 1;
END //

DELIMITER ;
------------update Mensaje------------
DELIMITER //

CREATE PROCEDURE sp_UpdateMensaje(
    IN p_idMensaje INT,
    IN p_idStatus INT,
    IN p_idChat INT,
    IN p_mensaje TEXT
)
BEGIN
    UPDATE Mensaje
    SET
        idStatus = p_idStatus,
        idChat = p_idChat,
        Mensaje = p_mensaje
    WHERE idMensaje = p_idMensaje;
END //

DELIMITER ;
---------------------
DELIMITER //

CREATE PROCEDURE ObtenerMensajesDeChat(IN chat_id INT)
BEGIN
    SELECT
        idMensaje,
        idStatus,
        idChat,
        idUsuarioCreador,
        Mensaje,
        Fecha_creacion
    FROM Mensaje
    WHERE idChat = chat_id
    ORDER BY Fecha_creacion ASC;
END //

DELIMITER ;