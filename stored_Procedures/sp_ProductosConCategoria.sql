------------insert ProductosConCategoria------------

DELIMITER //

CREATE PROCEDURE sp_InsertProductosConCategoria(
    IN p_idCategoria INT,
    IN p_idProducto INT,
    IN p_idStatus INT
)
BEGIN
    INSERT INTO ProductosConCategoria (
        idCategoria,
        idProducto,
        idStatus
    )
    VALUES (
        p_idCategoria,
        p_idProducto,
        p_idStatus
    );
END //

DELIMITER ;

------------find ProductosConCategoria------------

DELIMITER //

CREATE PROCEDURE sp_FindProductosConCategoriaById(
    IN p_idProductosConCategoria INT
)
BEGIN
    SELECT
        idProductosConCategoria,
        idCategoria,
        idProducto,
        idStatus
    FROM ProductosConCategoria
    WHERE idProductosConCategoria = p_idProductosConCategoria
    LIMIT 1;
END //

DELIMITER ;

------------update ProductosConCategoria------------
DELIMITER //

CREATE PROCEDURE sp_UpdateProductosConCategoria(
    IN p_idProductosConCategoria INT,
    IN p_idCategoria INT,
    IN p_idProducto INT,
    IN p_idStatus INT
)
BEGIN
    UPDATE ProductosConCategoria
    SET
        idCategoria = p_idCategoria,
        idProducto = p_idProducto,
        idStatus = p_idStatus
    WHERE idProductosConCategoria = p_idProductosConCategoria;
END //

DELIMITER ;
