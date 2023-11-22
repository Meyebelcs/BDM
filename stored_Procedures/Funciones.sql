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

