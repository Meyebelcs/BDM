------------insert Chat------------
DELIMITER //

CREATE PROCEDURE sp_InsertChat(
    IN p_idUsuarioCliente INT,
    IN p_idUsuarioVendedor INT,
    IN p_idStatus INT,
    IN p_idProducto INT,
    IN p_fechaCreacion DATETIME
)
BEGIN
    INSERT INTO Chat (
        idUsuarioCliente,
        idUsuarioVendedor,
        idStatus,
        idProducto,
        Fecha_creacion
    )
    VALUES (
        p_idUsuarioCliente,
        p_idUsuarioVendedor,
        p_idStatus,
        p_idProducto,
        p_fechaCreacion
    );
END //

DELIMITER ;
------------find Chat------------

DELIMITER //

CREATE PROCEDURE sp_FindChatById(
    IN p_idChat INT
)
BEGIN
    SELECT
        idChat,
        idUsuarioCliente,
        idUsuarioVendedor,
        idStatus,
        idProducto,
        Fecha_creacion
    FROM Chat
    WHERE idChat = p_idChat
    LIMIT 1;
END //

DELIMITER ;
------------update Chat------------
DELIMITER //

CREATE PROCEDURE sp_UpdateChat(
    IN p_idChat INT,
    IN p_idStatus INT,
    IN p_idProducto INT
)
BEGIN
    UPDATE Chat
    SET
        idStatus = p_idStatus,
        idProducto = p_idProducto
    WHERE idChat = p_idChat;
END //

DELIMITER ;
------------
DELIMITER //

CREATE PROCEDURE ObtenerChatsPorUsuario(IN usuario_id INT)
BEGIN
    SELECT
        idChat,
        idUsuarioCliente,
        idUsuarioVendedor,
        idStatus,
        idProducto,
         (SELECT Archivo.Archivo
            FROM Archivo
            WHERE Archivo.idProducto = C.idProducto
            ORDER BY Archivo.idArchivo DESC
            LIMIT 1) AS Imagen,
        Fecha_creacion
    FROM Chat C
    WHERE idUsuarioCliente = usuario_id OR idUsuarioVendedor = usuario_id;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE ObtenerChatsPorUsuario(IN usuario_id INT)
BEGIN
    SELECT
        C.idChat,
        C.idUsuarioCliente,
        C.idUsuarioVendedor,
        C.idStatus,
        C.idProducto,
        (SELECT U.Username FROM Usuario U WHERE U.idUsuario = C.idUsuarioVendedor) AS NombreVendedor,
        (SELECT U.Username FROM Usuario U WHERE U.idUsuario = C.idUsuarioCliente) AS NombreCliente,
        (SELECT U.Imagen FROM Usuario U WHERE U.idUsuario = C.idUsuarioCliente) AS ImagenCliente,
        (SELECT U.Imagen FROM Usuario U WHERE U.idUsuario = C.idUsuarioVendedor) AS ImagenVendedor,
        C.Fecha_creacion
    FROM Chat C
    WHERE C.idUsuarioCliente = usuario_id OR C.idUsuarioVendedor = usuario_id;
END //

DELIMITER ;

