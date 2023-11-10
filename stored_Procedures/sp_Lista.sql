------------insert status------------
DELIMITER //

CREATE PROCEDURE sp_InsertLista(
    IN p_idStatus INT,
    IN p_idUsuarioCreador INT,
    IN p_nombre VARCHAR(255),
    IN p_descripcion TEXT,
    IN p_imagen VARCHAR(255),
    IN p_fechaCreacion DATETIME,
    IN p_modo VARCHAR(50)
)
BEGIN
    INSERT INTO Lista (
        idStatus,
        idUsuarioCreador,
        Nombre,
        Descripción,
        Imagen,
        Fecha_creacion,
        Modo
    )
    VALUES (
        p_idStatus,
        p_idUsuarioCreador,
        p_nombre,
        p_descripcion,
        p_imagen,
        p_fechaCreacion,
        p_modo
    );
END //

DELIMITER ;
------------find status------------
DELIMITER //

CREATE PROCEDURE sp_FindListaById(
    IN p_idLista INT
)
BEGIN
    SELECT
        idLista,
        idStatus,
        idUsuarioCreador,
        Nombre,
        Descripción,
        Imagen,
        Fecha_creacion,
        Modo
    FROM Lista
    WHERE idLista = p_idLista
    LIMIT 1;
END //

DELIMITER ;

------------update status------------
DELIMITER //

CREATE PROCEDURE sp_UpdateLista(
    IN p_idLista INT,
    IN p_idStatus INT,
    IN p_idUsuarioCreador INT,
    IN p_nombre VARCHAR(255),
    IN p_descripcion TEXT,
    IN p_imagen VARCHAR(255),
    IN p_modo VARCHAR(50)
)
BEGIN
    UPDATE Lista
    SET
        idStatus = p_idStatus,
        idUsuarioCreador = p_idUsuarioCreador,
        Nombre = p_nombre,
        Descripción = p_descripcion,
        Imagen = p_imagen,
        Modo = p_modo
    WHERE idLista = p_idLista;
END //

DELIMITER ;
