DELIMITER //

CREATE PROCEDURE ObtenerIdStatusCotizacionTemporal(IN p_idChat INT, IN p_idProducto INT)
BEGIN
    
    SELECT idStatus 
    FROM CotizacionTemporal
    WHERE idChat = p_idChat AND idProducto = p_idProducto;
END;

//

DELIMITER ;
--------------
DELIMITER //

CREATE PROCEDURE ActualizarIdStatusCotizacionTemporal(IN p_idChat INT, IN p_idProducto INT)
BEGIN
    
    UPDATE CotizacionTemporal
    SET idStatus = 8
    WHERE idChat = p_idChat AND idProducto = p_idProducto;
END;

//

DELIMITER ;

--------
DELIMITER //

CREATE PROCEDURE ActualizarIdStatusCotizacionTemporalActivo(IN p_idChat INT, IN p_idProducto INT)
BEGIN
    
    UPDATE CotizacionTemporal
    SET idStatus = 6
    WHERE idChat = p_idChat AND idProducto = p_idProducto;
END;

//

DELIMITER ;

