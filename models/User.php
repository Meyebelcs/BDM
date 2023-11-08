<?php

class User
{
    private $idUsuario;
    private $idStatus;
    private $email;
    private $username;
    private $contrasena;
    private $rol;
    private $imagen;
    private $nombres;
    private $apellidos;
    private $fechaNacimiento;
    private $sexo;
    private $fechaRegistro;
    private $modo;
    private $fechaModificacion;

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
    }

    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getContrasena()
    {
        return $this->contrasena;
    }

    public function setContrasena($contrasena)
    {
        $this->contrasena = $contrasena;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
    }

    public function getImagen()
    {
        return $this->imagen;
    }

    public function setImagen($imagen)
    {
        $this->imagen = $imagen;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function getFechaNacimiento()
    {
        return $this->fechaNacimiento;
    }

    public function setFechaNacimiento($fechaNacimiento)
    {
        $this->fechaNacimiento = $fechaNacimiento;
    }

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    }

    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    }

    public function getModo()
    {
        return $this->modo;
    }

    public function setModo($modo)
    {
        $this->modo = $modo;
    }

    public function getFechaModificacion()
    {
        return $this->fechaModificacion;
    }

    public function setFechaModificacion($fechaModificacion)
    {
        $this->fechaModificacion = $fechaModificacion;
    }

    // Constructor
    public function __construct($idStatus, $email, $username, $contrasena, $rol, $imagen, $nombres, $apellidos, $fechaNacimiento, $sexo, $fechaRegistro, $modo, $fechaModificacion)
    {
        $this->idStatus = $idStatus;
        $this->email = $email;
        $this->username = $username;
        $this->contrasena = $contrasena;
        $this->rol = $rol;
        $this->imagen = $imagen;
        $this->nombres = $nombres;
        $this->apellidos = $apellidos;
        $this->fechaNacimiento = $fechaNacimiento;
        $this->sexo = $sexo;
        $this->fechaRegistro = $fechaRegistro;
        $this->modo = $modo;
        $this->fechaModificacion = $fechaModificacion;
    }
    static public function parseJson($json)
    {
        $user = new User(
            isset($json["idStatus"]) ? $json["idStatus"] : "",
            isset($json["Email"]) ? $json["Email"] : "",
            isset($json["Username"]) ? $json["Username"] : "",
            isset($json["Contraseña"]) ? $json["Contraseña"] : "",
            isset($json["Rol"]) ? $json["Rol"] : "",
            isset($json["Imagen"]) ? $json["Imagen"] : "",
            isset($json["Nombres"]) ? $json["Nombres"] : "",
            isset($json["Apellidos"]) ? $json["Apellidos"] : "",
            isset($json["Fecha_nacimiento"]) ? $json["Fecha_nacimiento"] : "",
            isset($json["Sexo"]) ? $json["Sexo"] : "",
            isset($json["Fecha_registro"]) ? $json["Fecha_registro"] : "",
            isset($json["Modo"]) ? $json["Modo"] : "",
            isset($json["Fecha_modificación"]) ? $json["Fecha_modificación"] : ""
        );

        if (isset($json["idUsuario"])) {
            $user->setIdUsuario((int) $json["idUsuario"]);
        }

        return $user;
    }

    public function save($mysqli)
    {
        // Llamar al procedimiento almacenado
        $stmt = $mysqli->prepare("CALL sp_insert_user(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssssssssss", $this->idStatus, $this->email, $this->username, $this->contrasena, $this->rol, $this->imagen, $this->nombres, $this->apellidos, $this->fechaNacimiento, $this->sexo, $this->fechaRegistro, $this->modo, $this->fechaModificacion);
        $stmt->execute();
        $this->idUsuario = (int) $stmt->insert_id;
    }
    public static function findUserByUsername($mysqli, $username, $password)
    {
        // Llamar al procedimiento almacenado
        $stmt = $mysqli->prepare("CALL sp_findUserByUsername(?, ?)");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user ? User::parseJson($user) : null;
    }
    public static function findUserById($mysqli, $idUsuario)
    {
        // Llamar al procedimiento almacenado
        $stmt = $mysqli->prepare("CALL sp_FindUserById(?)");
        $stmt->bind_param("i", $idUsuario);
        $stmt->execute();
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();
        return $user ? User::parseJson($user) : null;
    }

    public function update($mysqli)
    {
        // Llamar al procedimiento almacenado
        $stmt = $mysqli->prepare("CALL sp_UpdateUser(?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssssssss",
            $this->idUsuario,
            $this->email,
            $this->username,
            $this->contrasena,
            $this->nombres,
            $this->apellidos,
            $this->sexo,
            $this->fechaNacimiento,
            $this->modo,
            $this->fechaModificacion
        );

        if ($stmt->execute()) {
            return true; // Éxito en la actualización
        } else {
            return false; // Error en la actualización
        }
    }
    public function updateImage($mysqli)
    {
        // Llamar al procedimiento almacenado
        $stmt = $mysqli->prepare("CALL sp_UpdateUserImage(?, ?)");
        $stmt->bind_param("ss", $this->idUsuario, $this->imagen);

        if ($stmt->execute()) {
            return true; // Éxito en la actualización de la imagen
        } else {
            return false; // Error en la actualización de la imagen
        }
    }

    public static function doesUsernameExist($mysqli, $username)
    {
        // Llamar al procedimiento almacenado
        $stmt = $mysqli->prepare("CALL sp_CheckUsernameExists(?, @exists)");
        $stmt->bind_param("s", $username);
        $stmt->execute();

        // Obtener el resultado
        $select = $mysqli->query('SELECT @exists as `exists`');
        $result = $select->fetch_assoc();

        return $result['exists'] == 1;
    }

    public function toJSON()
    {
        return get_object_vars($this);
    }

}