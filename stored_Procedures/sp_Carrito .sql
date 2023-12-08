------------insert Carrito ------------
DELIMITER //

CREATE PROCEDURE sp_InsertCarrito(
    IN p_idUsuarioCliente INT,
    IN p_idProducto INT,
    IN p_idStatus INT,
    IN p_cantidad INT,
    IN p_precioUnitario DECIMAL(10, 2),
    IN p_subtotal DECIMAL(10, 2),
    IN p_descripcion TEXT,
    IN p_fechaAgregado DATE,
    IN p_tipo VARCHAR(50)
)
BEGIN
    INSERT INTO Carrito (
        idUsuarioCliente,
        idProducto,
        idStatus,
        Cantidad,
        PrecioUnitario,
        Subtotal,
        Descripcion,
        Fecha_agregado,
        Tipo
    )
    VALUES (
        p_idUsuarioCliente,
        p_idProducto,
        p_idStatus,
        p_cantidad,
        p_precioUnitario,
        p_subtotal,
        p_descripcion,
        p_fechaAgregado,
        p_tipo
    );
END //

DELIMITER ;
------------find Carrito ------------

DELIMITER //
CREATE PROCEDURE sp_FindCarritoById(
    IN p_idCarrito INT
)
BEGIN
    SELECT
        idCarrito,
        idUsuarioCliente,
        idProducto,
        idStatus,
        Cantidad,
        PrecioUnitario,
        Subtotal,
        Descripcion,
        Fecha_agregado,
        Tipo
    FROM Carrito
    WHERE idCarrito = p_idCarrito
    LIMIT 1;
END //

DELIMITER ;
------------update Carrito ------------
DELIMITER //

CREATE PROCEDURE sp_UpdateCarrito(
    IN p_idCarrito INT,                     
    IN p_idProducto INT,
    IN p_idStatus INT,
    IN p_cantidad INT,
    IN p_precioUnitario DECIMAL(10, 2),
    IN p_subtotal DECIMAL(10, 2),
    IN p_descripcion TEXT,
    IN p_fechaAgregado DATE,
    IN p_tipo VARCHAR(50)

)
BEGIN
    UPDATE Carrito
    SET
        idProducto = p_idProducto,
        idStatus = p_idStatus,
        Cantidad = p_cantidad,
        PrecioUnitario = p_precioUnitario,
        Subtotal = p_subtotal,
        Descripcion = p_descripcion,
        Fecha_agregado = p_fechaAgregado,
        Tipo = p_tipo
    WHERE idCarrito = p_idCarrito;
END //

DELIMITER ;

--------
DELIMITER //

CREATE PROCEDURE ObtenerInfoProductoEnCarrito(
    IN p_IdUsuario INT,
    IN p_Tipo VARCHAR(50)
)
BEGIN
    SELECT
    P.idProducto AS idProducto,
        P.Nombre AS Nombre,
        P.Descripción AS Descripción,
        P.Precio AS Precio,
        P.Inventario AS Inventario,
        P.Fecha_Publicación AS Fecha_Hr,
        (SELECT Archivo.Archivo
            FROM Archivo
            WHERE Archivo.idProducto = P.idProducto
            ORDER BY Archivo.idArchivo DESC
            LIMIT 1) AS Imagen,
        (
            SELECT COALESCE(SUM(Venta.Cantidad), 0)
            FROM Venta
            WHERE Venta.idProducto = P.idProducto
        ) AS CantidadVendida,
        COALESCE(PCA.promedio, 0) AS PromedioCalificacion
    FROM Producto P
    JOIN Carrito C ON P.idProducto = C.idProducto
    LEFT JOIN promediocalificacion PCA ON P.idProducto = PCA.idProducto
    WHERE C.idUsuarioCliente = p_IdUsuario
    AND C.Tipo = p_Tipo
    AND P.idStatus = 1;

END //

DELIMITER ;

---update cantidad-----
DELIMITER //

CREATE PROCEDURE sp_UpdateCarritoCantidad(
    IN p_idCarrito INT,
    IN p_operacion VARCHAR(5) -- 'suma' o 'resta'
)
BEGIN
    DECLARE nuevaCantidad INT;
    DECLARE nuevoInventario INT;
    DECLARE nuevoPrecioUnitario DECIMAL(10, 2);
    DECLARE nuevoSubtotal DECIMAL(10, 2);
    DECLARE productoEliminado BOOLEAN DEFAULT FALSE;

    -- Obtener la cantidad actual, precio unitario y el producto asociado al carrito
    SELECT Cantidad, PrecioUnitario, idProducto INTO nuevaCantidad, nuevoPrecioUnitario, @idProducto FROM Carrito WHERE idCarrito = p_idCarrito;

    -- Actualizar la cantidad según la operación
    IF p_operacion = 'suma' THEN
        SET nuevaCantidad = nuevaCantidad + 1;

        -- Verificar el inventario antes de la actualización en Carrito
        SET nuevoInventario = (SELECT Inventario - 1 FROM Producto WHERE idProducto = @idProducto);
        IF nuevoInventario >= 0 THEN
            -- Calcular el nuevo subtotal
            SET nuevoSubtotal = nuevaCantidad * nuevoPrecioUnitario;

            -- Actualizar la cantidad y subtotal en la tabla Carrito
            UPDATE Carrito
            SET Cantidad = nuevaCantidad,
                Subtotal = nuevoSubtotal,
                idStatus = CASE WHEN nuevaCantidad = 0 THEN 3 ELSE idStatus END
            WHERE idCarrito = p_idCarrito;
            
            -- Actualizar el inventario en la tabla Producto
            UPDATE Producto SET Inventario = nuevoInventario WHERE idProducto = @idProducto;
            
            -- Si la cantidad es 0, se ha eliminado el producto del carrito
            IF nuevaCantidad = 0 THEN
                SET productoEliminado = TRUE;
            END IF;
        ELSE
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'No hay suficiente inventario para realizar la suma en Producto';
        END IF;
    ELSEIF p_operacion = 'resta' THEN
        IF nuevaCantidad > 0 THEN
            SET nuevaCantidad = nuevaCantidad - 1;

            -- Verificar el inventario antes de la actualización en Carrito
            SET nuevoInventario = (SELECT Inventario + 1 FROM Producto WHERE idProducto = @idProducto);
            
            -- Calcular el nuevo subtotal
            SET nuevoSubtotal = nuevaCantidad * nuevoPrecioUnitario;

            -- Actualizar la cantidad y subtotal en la tabla Carrito
            UPDATE Carrito
            SET Cantidad = nuevaCantidad,
                Subtotal = nuevoSubtotal,
                idStatus = CASE WHEN nuevaCantidad = 0 THEN 3 ELSE idStatus END
            WHERE idCarrito = p_idCarrito;

            -- Actualizar el inventario en la tabla Producto
            UPDATE Producto SET Inventario = nuevoInventario WHERE idProducto = @idProducto;

            -- Si la cantidad es 0, se ha eliminado el producto del carrito
            IF nuevaCantidad = 0 THEN
                SET productoEliminado = TRUE;
            END IF;
        ELSE
            SIGNAL SQLSTATE '45000'
            SET MESSAGE_TEXT = 'La cantidad en Carrito ya es cero, no se puede restar más';
        END IF;
    END IF;

    -- Enviar mensaje indicando que el producto se eliminó del carrito
    IF productoEliminado THEN
        SIGNAL SQLSTATE '01000'
        SET MESSAGE_TEXT = 'El producto se eliminó del carrito';
    END IF;
    
END //

DELIMITER ;

-------------
DELIMITER //

CREATE PROCEDURE ObtenerInfoProductoEnCarritobyID(
    IN p_idCarrito INT
)
BEGIN 
    SELECT
    C.idProducto AS idProducto,
    P.Nombre AS Nombre,
    C.Tipo AS Tipo,
    C.idCarrito AS idCarrito,
    C.Cantidad AS Cantidad,
    C.PrecioUnitario AS PrecioUnitario,
    C.Subtotal AS Subtotal,
    C.Descripcion AS Descripcion,
    C.Fecha_agregado AS Fecha_agregado,
    C.idStatus AS idStatus,
    C.idUsuarioCliente AS idUsuarioCliente, 
    (SELECT Archivo.Archivo
        FROM Archivo
        WHERE Archivo.idProducto = P.idProducto
        ORDER BY Archivo.idArchivo DESC
        LIMIT 1) AS Imagen
    FROM Carrito C
    JOIN Producto P ON P.idProducto = C.idProducto
    WHERE C.idCarrito = p_idCarrito;

END //

DELIMITER ;



/* DELIMITER //

CREATE PROCEDURE sp_UpdateCarritoCantidad(
    IN p_idCarrito INT,
    IN p_operacion VARCHAR(5) -- 'suma' o 'resta'
)
BEGIN
    DECLARE newCantidad INT;
    
    -- Obtener la cantidad actual del carrito
    SELECT Cantidad INTO newCantidad FROM Carrito WHERE idCarrito = p_idCarrito;
    
    -- Actualizar la cantidad según la operación
    IF p_operacion = 'suma' THEN
        SET newCantidad = newCantidad + 1;
    ELSEIF p_operacion = 'resta' THEN
        SET newCantidad = newCantidad - 1;
    END IF;

    -- Actualizar la cantidad en la tabla Carrito
    UPDATE Carrito
    SET Cantidad = newCantidad,
        idStatus = CASE WHEN newCantidad = 0 THEN 3 ELSE idStatus END
    WHERE idCarrito = p_idCarrito;
    
END //

DELIMITER ; */
------
DELIMITER //

CREATE PROCEDURE sp_UpdateCarritostatus(
    IN p_idCarrito INT
)
BEGIN
    UPDATE Carrito
    SET
        idStatus = 6
    WHERE idCarrito = p_idCarrito;
END //

DELIMITER ;

--------------
BEGIN
    DECLARE carritoExists INT DEFAULT 0;

    -- Verifica si existe un registro en la tabla Carrito
    SELECT COUNT(*) INTO carritoExists
    FROM Carrito C
    WHERE C.idProducto = idProducto_Param
    AND (C.idUsuarioCliente = (SELECT idUsuarioVendedor FROM Chat WHERE idChat = idChatParam)
        OR C.idUsuarioCliente = (SELECT idUsuarioCliente FROM Chat WHERE idChat = idChatParam));

    -- Devuelve 1 si encuentra coincidencia en Carrito, 0 si no encuentra
    SELECT carritoExists AS CoincidenciaEnCarrito;
END

BEGIN
    DECLARE carritoExists INT DEFAULT 0;
    DECLARE carritoId INT;

    -- Verifica si existe un registro en la tabla Carrito
    SELECT COUNT(*) INTO carritoExists
    FROM Carrito C
    WHERE C.idProducto = idProducto_Param
    AND (C.idUsuarioCliente = (SELECT idUsuarioVendedor FROM Chat WHERE idChat = idChatParam)
        OR C.idUsuarioCliente = (SELECT idUsuarioCliente FROM Chat WHERE idChat = idChatParam));

    -- Obtén el idCarrito si hay una coincidencia
    SELECT idCarrito INTO carritoId
    FROM Carrito
    WHERE idProducto = idProducto_Param
    AND (idUsuarioCliente = (SELECT idUsuarioVendedor FROM Chat WHERE idChat = idChatParam)
        OR idUsuarioCliente = (SELECT idUsuarioCliente FROM Chat WHERE idChat = idChatParam))
    LIMIT 1;

    -- Devuelve 1 y el idCarrito si encuentra coincidencia en Carrito, 0 si no encuentra
    SELECT carritoExists AS CoincidenciaEnCarrito, carritoId AS idCarrito;
END

------------------------------------------------
DELIMITER //

CREATE PROCEDURE sp_getidCarritoByProductChat(
    IN idProducto_Param INT,
    IN idChatParam INT
)
BEGIN
    DECLARE carritoId INT;

    -- Busca el idCarrito en la tabla Carrito
    SELECT MAX(idCarrito) INTO carritoId
    FROM Carrito C
    WHERE C.idProducto = idProducto_Param
    AND (C.idUsuarioCliente = (SELECT idUsuarioVendedor FROM Chat WHERE idChat = idChatParam)
        OR C.idUsuarioCliente = (SELECT idUsuarioCliente FROM Chat WHERE idChat = idChatParam));

    -- Devuelve el idCarrito si encuentra coincidencia en Carrito, o NULL si no encuentra
    IF carritoId IS NOT NULL THEN
        SELECT carritoId AS idCarrito;
    ELSE
        SELECT NULL AS idCarrito;
    END IF;
END//

DELIMITER ;
