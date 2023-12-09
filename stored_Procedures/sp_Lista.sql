------------insert sp_InsertLista------------
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
------------find sp_FindListaById------------
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

------------update sp_UpdateLista------------
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

-----------------getlistbyuser
DELIMITER //

CREATE PROCEDURE sp_getlistbyuser(
    IN idUserParam INT
)
BEGIN
    SELECT
        idLista AS idLista,
        idStatus AS idStatus,
        idUsuarioCreador AS idUsuarioCreador,
        Nombre AS nombre,
        Descripción AS descripcion,
        Imagen AS imagen,
        Modo AS modo,
        Fecha_creacion AS fechaCreacion
   FROM Lista
    WHERE idUsuarioCreador = idUserParam;
END//

DELIMITER ;
--------------------
DELIMITER //

CREATE PROCEDURE ObtenerListasPublicas(IN creador INT)
BEGIN
    SELECT 

        idLista AS idLista,
        idStatus AS idStatus,
        idUsuarioCreador AS idUsuarioCreador,
        Nombre AS nombre,
        Descripción AS descripcion,
        Imagen AS imagen,
        Modo AS modo,
        Fecha_creacion AS fechaCreacion
    FROM Lista
    WHERE idUsuarioCreador = creador AND Modo = 'Publico';
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE ObtenerListasPrivado(IN creador INT)
BEGIN
    SELECT 
        idLista AS idLista,
        idStatus AS idStatus,
        idUsuarioCreador AS idUsuarioCreador,
        Nombre AS nombre,
        Descripción AS descripcion,
        Imagen AS imagen,
        Modo AS modo,
        Fecha_creacion AS fechaCreacion
    FROM Lista
    WHERE idUsuarioCreador = creador AND Modo = 'Privado';
END //

DELIMITER ; 

