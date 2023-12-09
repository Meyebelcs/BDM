------------insert ProductoEnLista------------

DELIMITER //

CREATE PROCEDURE sp_InsertProductoEnLista(
    IN p_idProducto INT,
    IN p_idUsuarioCreador INT,
    IN p_idLista INT
)
BEGIN
    INSERT INTO ProductoEnLista (
        idProducto,
        idUsuarioCreador,
        idLista
    )
    VALUES (
        p_idProducto,
        p_idUsuarioCreador,
        p_idLista
    );
END //

DELIMITER ;
------------find ProductoEnLista------------

DELIMITER //

CREATE PROCEDURE sp_FindProductoEnListaById(
    IN p_idProductoEnLista INT
)
BEGIN
    SELECT
        idProductoEnLista,
        idProducto,
        idUsuarioCreador,
        idLista
    FROM ProductoEnLista
    WHERE idProductoEnLista = p_idProductoEnLista
    LIMIT 1;
END //

DELIMITER ;
------------update ProductoEnLista------------

DELIMITER //

CREATE PROCEDURE sp_UpdateProductoEnLista(
    IN p_idProductoEnLista INT,
    IN p_idProducto INT,
    IN p_idLista INT
)
BEGIN
    UPDATE ProductoEnLista
    SET
        idProducto = p_idProducto,
        idLista = p_idLista
    WHERE idProductoEnLista = p_idProductoEnLista;
END //

DELIMITER ;

-----------------
DELIMITER //
CREATE PROCEDURE sp_VerificarProductoEnLista(IN p_idProducto INT, IN p_idLista INT, OUT p_existe BOOLEAN)
BEGIN
    SELECT COUNT(*) > 0 INTO p_existe
    FROM ProductoEnLista
    WHERE idProducto = p_idProducto AND idLista = p_idLista;
END //
DELIMITER ;

