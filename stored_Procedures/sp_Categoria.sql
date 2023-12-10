------------insert Categoria------------

DELIMITER //

CREATE PROCEDURE sp_InsertCategoria(
    IN p_idUsuarioCreador INT,
    IN p_idStatus INT,
    IN p_nombre VARCHAR(255),
    IN p_descripcion TEXT,
    IN p_fechaCreacion DATETIME
)
BEGIN
    INSERT INTO Categoria (
        idUsuarioCreador,
        idStatus,
        Nombre,
        Descripcion,
        Fecha_creacion
    )
    VALUES (
        p_idUsuarioCreador,
        p_idStatus,
        p_nombre,
        p_descripcion,
        p_fechaCreacion
    );
END //

DELIMITER ;
------------find Categoria------------

DELIMITER //


CREATE PROCEDURE sp_FindCategoriaById(
    IN p_idCategoria INT
)
BEGIN
    SELECT
        idCategoria,
        idUsuarioCreador,
        idStatus,
        Nombre,
        Descripcion,
        Fecha_creacion
    FROM Categoria
    WHERE idCategoria = p_idCategoria
    LIMIT 1;
END //

DELIMITER ;
------------update Categoria------------
DELIMITER //

CREATE PROCEDURE sp_UpdateCategoria(
    IN p_idCategoria INT,
    IN p_idStatus INT,
    IN p_nombre VARCHAR(255),
    IN p_descripcion TEXT
)
BEGIN
    UPDATE Categoria
    SET
        idStatus = p_idStatus,
        Nombre = p_nombre,
        Descripcion = p_descripcion
    WHERE idCategoria = p_idCategoria;
END //

DELIMITER ;

------------getall-----------------------

DELIMITER //

CREATE PROCEDURE sp_GetAllCategorias()
BEGIN
    SELECT idCategoria, Nombre, Descripcion, Fecha_creacion
    FROM Categoria;
 
END //

DELIMITER ;

--------------getall categories by product-----------
BEGIN
    SELECT
        idCategoria,
        NombreCategoria,
        DescripcionCategoria,
        FechaCreacionCategoria
    FROM
        VistaCategoriasPorProducto
    WHERE
        idProducto = p_idProducto;
END
---------
-- Crear procedimiento almacenado para verificar existencia de categoría por nombre
DELIMITER //

CREATE PROCEDURE sp_CheckCategoriaExists(IN p_nombre VARCHAR(255), OUT p_existe BOOLEAN)
BEGIN
    SELECT COUNT(*) > 0 INTO p_existe
    FROM Categoria
    WHERE Nombre = p_nombre;
END //

DELIMITER ;


----------------
DELIMITER //

CREATE PROCEDURE sp_getCategoriasbyuserCreador(IN p_idUsuario INT)
BEGIN
    SELECT
        idCategoria,
        Nombre,
        Descripcion,
        Fecha_creacion
    FROM
        Categoria
    WHERE
        idUsuarioCreador = p_idUsuario;
END//

DELIMITER ;
