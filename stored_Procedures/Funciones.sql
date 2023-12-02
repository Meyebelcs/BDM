-----------LAST idProducto----------
DELIMITER //

CREATE FUNCTION getLastIdProducto() RETURNS INT
BEGIN
    DECLARE ultimoId INT;

    -- Seleccionar el último idProducto 
    SELECT idProducto INTO ultimoId
    FROM Producto
    ORDER BY idProducto DESC
    LIMIT 1;

    RETURN ultimoId;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE GetLastProductId()
BEGIN
    DECLARE result INT;
    
    -- Llamar a la función 
    SET result = getLastIdProducto();
    
    SELECT result AS 'idProducto';
END //

DELIMITER ;

------------agotado-------------
-- Crear la función para verificar si el producto está agotado
DELIMITER //

CREATE FUNCTION ProductoAgotado(idProd INT) RETURNS INT
BEGIN
    DECLARE inventario_actual INT;

    -- Obtener el inventario del producto
    SELECT Inventario INTO inventario_actual
    FROM Producto
    WHERE idProducto = idProd;

    -- Devolver 1 si el inventario es 0, 0 en caso contrario
    IF inventario_actual = 0 THEN
        RETURN 1;
    ELSE
        RETURN 0;
    END IF;
END //

DELIMITER ;

-- Crear el procedimiento almacenado que llama a la función
DELIMITER //

CREATE PROCEDURE VerificarProductoAgotado(IN idProdParam INT)
BEGIN
    DECLARE agotado INT;

    -- Llamar a la función para verificar si el producto está agotado
    SET agotado = ProductoAgotado(idProdParam);

    -- Devolver el resultado (1 si está agotado, 0 si hay existencias)
    SELECT agotado AS EstaAgotado;
END //

DELIMITER ;

-----------LAST idProducto----------
DELIMITER //

CREATE FUNCTION getLastIdChat() RETURNS INT
BEGIN
    DECLARE ultimoId INT;

    -- Seleccionar el último idProducto 
    SELECT idChat INTO ultimoId
    FROM Chat
    ORDER BY idChat DESC
    LIMIT 1;

    RETURN ultimoId;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE GetLastChatId()
BEGIN
    DECLARE result INT;
    
    -- Llamar a la función 
    SET result = getLastIdChat();
    
    SELECT result AS 'idChat';
END //

DELIMITER ;
---------------
DELIMITER //

CREATE FUNCTION getLastIdCarrito() RETURNS INT
BEGIN
    DECLARE ultimoId INT;

    -- Seleccionar el último idProducto 
    SELECT idCarrito INTO ultimoId
    FROM Carrito
    ORDER BY idCarrito DESC
    LIMIT 1;

    RETURN ultimoId;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE GetLastCarritoId()
BEGIN
    DECLARE result INT;
    
    -- Llamar a la función 
    SET result = getLastIdCarrito();
    
    SELECT result AS 'idCarrito';
END //

DELIMITER ;