------------INSERT USER------------
DELIMITER //

CREATE PROCEDURE sp_insert_user(
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
    INSERT INTO Usuario (idStatus, Email, Username, Contrase�a, Rol, Imagen, Nombres, Apellidos, Fecha_nacimiento, Sexo, Fecha_registro, Modo, Fecha_modificaci�n)
    VALUES (p_idStatus, p_email, p_username, p_contrasena, p_rol, p_imagen, p_nombres, p_apellidos, p_fechaNacimiento, p_sexo, p_fechaRegistro, p_modo, p_fechaModificacion);
END //

DELIMITER ;

------------FIND USER BY NAME-------------
DELIMITER //

CREATE PROCEDURE sp_findUserByUsername(
    IN p_username VARCHAR(255),
    IN p_password VARCHAR(255)
)
BEGIN
    SELECT
        idUsuario, idStatus, Email, Username, Imagen, Nombres, Apellidos, Rol, Fecha_nacimiento, Sexo, Modo, Fecha_registro, Fecha_modificaci�n
    FROM
        Usuario
    WHERE
        Username = p_username
        AND Contrase�a = p_password
    LIMIT 1;
END //

DELIMITER ;

-------------FIND USER BY ID----------------
DELIMITER //

CREATE PROCEDURE sp_FindUserById(
    IN p_idUsuario INT
)
BEGIN
    SELECT idUsuario, idStatus, Email, Username, Imagen, Nombres, Apellidos, Rol, Fecha_nacimiento, Sexo, Modo, Fecha_registro, Fecha_modificaci�n
    FROM Usuario
    WHERE idUsuario = p_idUsuario
    LIMIT 1;
END //

DELIMITER ;
---------------UPDATE USER------------------
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
        Contrase�a = p_contrasena,
        Nombres = p_nombres,
        Apellidos = p_apellidos,
        Sexo = p_sexo,
        Fecha_nacimiento = p_fechaNacimiento,
        Modo = p_modo,
        Fecha_modificaci�n = p_fechaModificacion
    WHERE idUsuario = p_idUsuario;
END //

DELIMITER ;
------------CHECK USERNAME EXISTS---------
DELIMITER //

CREATE PROCEDURE sp_CheckUsernameExists(
    IN p_username VARCHAR(255),
    OUT p_exists INT
)
BEGIN
    SELECT COUNT(*) INTO p_exists FROM Usuario WHERE Username = p_username;
END //

DELIMITER ;

