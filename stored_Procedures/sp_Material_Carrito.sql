------------insert Material_Carrito------------
DELIMITER //

CREATE PROCEDURE sp_InsertMaterialCarrito(
    IN p_idCarrito INT,
    IN p_idMaterial INT,
    IN p_idStatus INT,
    IN p_cantidad INT
)
BEGIN
    INSERT INTO Material_Carrito (
        idCarrito,
        idMaterial,
        idStatus,
        Cantidad
    )
    VALUES (
        p_idCarrito,
        p_idMaterial,
        p_idStatus,
        p_cantidad
    );
END //

DELIMITER ;
------------find Material_Carrito------------

DELIMITER //

CREATE PROCEDURE sp_FindMaterialCarritoById(
    IN p_idMaterialCarrito INT
)
BEGIN
    SELECT
        idMaterialCarrito,
        idCarrito,
        idMaterial,
        idStatus,
        Cantidad
    FROM Material_Carrito
    WHERE idMaterialCarrito = p_idMaterialCarrito
    LIMIT 1;
END //

DELIMITER ;
------------update Material_Carrito------------
DELIMITER //

CREATE PROCEDURE sp_UpdateMaterialCarrito(
    IN p_idMaterialCarrito INT,
    IN p_idCarrito INT,
    IN p_idMaterial INT,
    IN p_idStatus INT,
    IN p_cantidad INT
)
BEGIN
    UPDATE Material_Carrito
    SET
        idCarrito = p_idCarrito,
        idMaterial = p_idMaterial,
        idStatus = p_idStatus,
        Cantidad = p_cantidad
    WHERE idMaterialCarrito = p_idMaterialCarrito;
END //

DELIMITER ;
