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
------------------sp_GetMaterialCarritoInfo
DELIMITER //

CREATE PROCEDURE sp_GetMaterialCarritoInfo(
    IN idProductParam INT
)
BEGIN
    SELECT
        MC.idMaterialCarrito AS idMaterialCarrito,
        MC.idCarrito AS idCarrito,
        MC.idMaterial AS idMaterial,
        MI.idProducto AS idProducto,
        MC.idStatus AS idStatus,
        MC.Fecha_agregado AS Fecha_creacion,
        MI.Nombre AS Nombre,
        MC.Cantidad AS CantidadEnCarrito
    FROM
        Material_Carrito MC
    LEFT JOIN
        Material_Inventario MI ON MC.idMaterial = MI.idMaterial
    WHERE
        MI.idProducto = idProductParam
        AND MC.idStatus = 1 
    GROUP BY MC.idMaterialCarrito;
END//

DELIMITER ;


