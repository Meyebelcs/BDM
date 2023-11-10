------------insert user------------
DELIMITER //

CREATE PROCEDURE sp_InsertUser(
    IN p_idStatus INT,
    IN p_email VARCHAR(255),
    IN p_username VARCHAR(255),
    IN p_contrasena VARCHAR(255),
    IN p_rol VARCHAR(255),
    IN p_imagen VARCHAR(255),
    IN p_nombres VARCHAR(255),
    IN p_apellidos VARCHAR(255),
    IN p_fechaNacimiento DATE,
    IN p_sexo VARCHAR(255),
    IN p_fechaRegistro DATETIME,
    IN p_modo VARCHAR(255),
    IN p_fechaModificacion DATETIME
)
BEGIN
    INSERT INTO Usuario (idStatus, Email, Username, Contraseña, Rol, Imagen, Nombres, Apellidos, Fecha_nacimiento, Sexo, Fecha_registro, Modo, Fecha_modificación)
    VALUES (p_idStatus, p_email, p_username, p_contrasena, p_rol, p_imagen, p_nombres, p_apellidos, p_fechaNacimiento, p_sexo, p_fechaRegistro, p_modo, p_fechaModificacion);
END //

DELIMITER ;

------------busqueda user by username-------------
DELIMITER //

CREATE PROCEDURE sp_findUserByUsername(
    IN p_username VARCHAR(255),
    IN p_password VARCHAR(255)
)
BEGIN
    SELECT
        idUsuario, idStatus, Email, Username, Imagen, Nombres, Apellidos, Rol, Fecha_nacimiento, Sexo, Modo, Fecha_registro, Fecha_modificación
    FROM
        Usuario
    WHERE
        Username = p_username
        AND Contraseña = p_password
    LIMIT 1;
END //

DELIMITER ;

-------------busqueda user by id----------------
DELIMITER //

CREATE PROCEDURE sp_FindUserById(
    IN p_idUsuario INT
)
BEGIN
    SELECT idUsuario, idStatus, Email, Username, Imagen, Nombres, Apellidos, Rol, Fecha_nacimiento, Sexo, Modo, Fecha_registro, Fecha_modificación
    FROM Usuario
    WHERE idUsuario = p_idUsuario
    LIMIT 1;
END //

DELIMITER ;
----------update user---------------
DELIMITER //

CREATE PROCEDURE sp_UpdateUser(
    IN p_idUsuario INT,
    IN p_email VARCHAR(255),
    IN p_username VARCHAR(255),
    IN p_contrasena VARCHAR(255),
    IN p_nombres VARCHAR(255),
    IN p_apellidos VARCHAR(255),
    IN p_sexo VARCHAR(255),
    IN p_fechaNacimiento DATE,
    IN p_modo VARCHAR(255),
    IN p_fechaModificacion DATETIME
)
BEGIN
    UPDATE Usuario
    SET
        Email = p_email,
        Username = p_username,
        Contraseña = p_contrasena,
        Nombres = p_nombres,
        Apellidos = p_apellidos,
        Sexo = p_sexo,
        Fecha_nacimiento = p_fechaNacimiento,
        Modo = p_modo,
        Fecha_modificación = p_fechaModificacion
    WHERE idUsuario = p_idUsuario;
END //

DELIMITER ;
------------validar q no exista el username---------
DELIMITER //

CREATE PROCEDURE sp_CheckUsernameExists(
    IN p_username VARCHAR(255),
    OUT p_exists INT
)
BEGIN
    SELECT COUNT(*) INTO p_exists FROM Usuario WHERE Username = p_username;
END //

DELIMITER ;

---------update imagen----------
DELIMITER //

CREATE PROCEDURE sp_UpdateUserImage(
    IN p_idUsuario INT,
    IN p_imagen VARCHAR(255)
)
BEGIN
    UPDATE Usuario
    SET
        Imagen = p_imagen
    WHERE idUsuario = p_idUsuario;
END //

DELIMITER ;
