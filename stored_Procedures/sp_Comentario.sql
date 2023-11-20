------------insert Comentario ------------
DELIMITER //

CREATE PROCEDURE sp_InsertComentario(
    IN p_idProducto INT,
    IN p_idUsuarioCreador INT,
    IN p_idStatus INT,
    IN p_calificacion INT,
    IN p_fechaPublicacion DATETIME,
    IN p_comentario TEXT
)
BEGIN
    INSERT INTO Comentario (
        idProducto,
        idUsuarioCreador,
        idStatus,
        Calificacion,
        Fecha_publicacion,
        Comentario
    )
    VALUES (
        p_idProducto,
        p_idUsuarioCreador,
        p_idStatus,
        p_calificacion,
        p_fechaPublicacion,
        p_comentario
    );
END //

DELIMITER ;
------------find Comentario ------------

DELIMITER //
CREATE PROCEDURE sp_FindComentarioById(
    IN p_idComentario INT
)
BEGIN
    SELECT
        idComentario,
        idProducto,
        idUsuarioCreador,
        idStatus,
        Calificacion,
        Fecha_publicacion,
        Comentario
    FROM Comentario
    WHERE idComentario = p_idComentario
    LIMIT 1;
END //

DELIMITER ;
------------update Comentario ------------
DELIMITER //

CREATE PROCEDURE sp_UpdateComentario(
    IN p_idComentario INT,
    IN p_idStatus INT,
    IN p_calificacion INT,
    IN p_comentario TEXT
)
BEGIN
    UPDATE Comentario
    SET
        idStatus = p_idStatus,
        Calificacion = p_calificacion,
        Comentario = p_comentario
    WHERE idComentario = p_idComentario;
END //

DELIMITER ;

-----------get comentarios--------------
DELIMITER //

CREATE PROCEDURE sp_getComentsbyProduct(IN idProducto INT)
BEGIN
    SELECT
        c.*, 
        u.Username,
        u.Imagen AS ImagenUsuario
    FROM
        Comentario c
    INNER JOIN
        Usuario u ON c.idUsuarioCreador = u.idUsuario
    WHERE
        c.idProducto = idProducto;
END //

DELIMITER ;

