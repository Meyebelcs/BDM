------------insert Material_Inventario------------

DELIMITER //

CREATE PROCEDURE sp_InsertMaterialInventario(
    IN p_idProducto INT,
    IN p_idStatus INT,
    IN p_fechaCreacion DATETIME,
    IN p_nombre VARCHAR(100),
    IN p_cantidad INT
)
BEGIN
    INSERT INTO Material_Inventario (
        idProducto,
        idStatus,
        Fecha_creacion,
        Nombre,
        Cantidad
    )
    VALUES (
        p_idProducto,
        p_idStatus,
        p_fechaCreacion,
        p_nombre,
        p_cantidad
    );
END //

DELIMITER ;
------------find Material_Inventario------------
DELIMITER //

CREATE PROCEDURE sp_FindMaterialInventarioById(
    IN p_idMaterial INT
)
BEGIN
    SELECT
        idMaterial,
        idProducto,
        idStatus,
        Fecha_creacion,
        Nombre,
        Cantidad
    FROM Material_Inventario
    WHERE idMaterial = p_idMaterial
    LIMIT 1;
END //

DELIMITER ;
------------update Material_Inventario------------
DELIMITER //

CREATE PROCEDURE sp_UpdateMaterialInventario(
    IN p_idMaterial INT,
    IN p_idProducto INT,
    IN p_idStatus INT,
    IN p_nombre VARCHAR(100),
    IN p_cantidad INT
)
BEGIN
    UPDATE Material_Inventario
    SET
        idProducto = p_idProducto,
        idStatus = p_idStatus,
        Nombre = p_nombre,
        Cantidad = p_cantidad
    WHERE idMaterial = p_idMaterial;
END //

DELIMITER ;
