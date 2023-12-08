----------alta producto da de alta promediocalif---
DELIMITER //

CREATE TRIGGER trg_AfterInsertProducto
AFTER INSERT ON Producto
FOR EACH ROW
BEGIN
    -- Insertar una entrada en la tabla PromedioCalificacion con promedio inicial 0
    INSERT INTO PromedioCalificacion (idProducto, promedio)
    VALUES (NEW.idProducto, 0);
END //

DELIMITER ;

------alta comentario update promediocalif----------
DELIMITER //

CREATE TRIGGER trg_AfterInsertComentario
AFTER INSERT ON Comentario
FOR EACH ROW
BEGIN
    DECLARE totalCalificacion INT;
    DECLARE numComentarios INT;
    DECLARE promedio FLOAT;

    -- Obtener el total de calificaciones y el número de comentarios para el producto
    SELECT SUM(Calificacion), COUNT(*) INTO totalCalificacion, numComentarios
    FROM Comentario
    WHERE idProducto = NEW.idProducto;

    -- Calcular el nuevo promedio
    IF numComentarios > 0 THEN
        SET promedio = totalCalificacion / numComentarios;
    ELSE
        SET promedio = 0;
    END IF;

    -- Actualizar la tabla PromedioCalificacion solo si ya existe una entrada
    UPDATE PromedioCalificacion
    SET promedio = promedio
    WHERE idProducto = NEW.idProducto;
END //

DELIMITER ;

---------INSERTAR VENTA ACTUALIZAR STATUS CARRITO---------
DELIMITER //

CREATE TRIGGER after_insert_venta
AFTER INSERT
ON Venta FOR EACH ROW

BEGIN
    -- Actualizar el idStatus en la tabla Carrito
    UPDATE Carrito
    SET idStatus = 4
    WHERE idCarrito = NEW.idCarrito;
    
END;

//

DELIMITER ;
---------
DELIMITER //

CREATE TRIGGER after_insert_carrito
AFTER INSERT
ON Carrito FOR EACH ROW

BEGIN

        -- Actualizar el inventario en la tabla Producto
        UPDATE Producto
        SET Inventario = Inventario - NEW.Cantidad
        WHERE idProducto = NEW.idProducto;
   
END //

DELIMITER ;
---------
DELIMITER //

CREATE TRIGGER tr_chat_after_insert
AFTER INSERT ON Chat
FOR EACH ROW
BEGIN
   
    -- Inserta un nuevo registro en CotizacionTemporal con la información del nuevo chat
    INSERT INTO CotizacionTemporal (idStatus, idChat, idProducto)
    VALUES (7, NEW.idChat, NEW.idProducto);

END;
//

DELIMITER ;

