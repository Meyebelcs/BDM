<?php
class Comentario
{
    private $idComentario;
    private $idProducto;
    private $idUsuarioCreador;
    private $idStatus;
    private $calificacion;
    private $fechaPublicacion;
    private $comentario;
    private $username;
    private $imagenUsuario;
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getusername()
    {
        return $this->username;
    }
    
    public function setImagenUsuario($imagenUsuario)
    {
        $this->imagenUsuario = $imagenUsuario;
    }

    public function getimagenUsuario()
    {
        return $this->imagenUsuario;
    }

    public function getIdComentario()
    {
        return $this->idComentario;
    }

    public function setIdComentario($idComentario)
    {
        $this->idComentario = $idComentario;
    }

    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    public function getIdUsuarioCreador()
    {
        return $this->idUsuarioCreador;
    }

    public function setIdUsuarioCreador($idUsuarioCreador)
    {
        $this->idUsuarioCreador = $idUsuarioCreador;
    }

    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;
    }

    public function getCalificacion()
    {
        return $this->calificacion;
    }

    public function setCalificacion($calificacion)
    {
        $this->calificacion = $calificacion;
    }

    public function getFechaPublicacion()
    {
        return $this->fechaPublicacion;
    }

    public function setFechaPublicacion($fechaPublicacion)
    {
        $this->fechaPublicacion = $fechaPublicacion;
    }

    public function getComentario()
    {
        return $this->comentario;
    }

    public function setComentario($comentario)
    {
        $this->comentario = $comentario;
    }

    // Constructor
    public function __construct(
        $idProducto,
        $idUsuarioCreador,
        $idStatus,
        $calificacion,
        $fechaPublicacion,
        $comentario
    ) {
        $this->idProducto = $idProducto;
        $this->idUsuarioCreador = $idUsuarioCreador;
        $this->idStatus = $idStatus;
        $this->calificacion = $calificacion;
        $this->fechaPublicacion = $fechaPublicacion;
        $this->comentario = $comentario;
    }

    static public function parseJson($json)
    {
        $comentario = new Comentario(
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["idUsuarioCreador"]) ? $json["idUsuarioCreador"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["Calificacion"]) ? $json["Calificacion"] : null,
            isset($json["Fecha_publicacion"]) ? $json["Fecha_publicacion"] : null,
            isset($json["Comentario"]) ? $json["Comentario"] : null
        );

        if (isset($json["idComentario"])) {
            $comentario->setIdComentario((int) $json["idComentario"]);
        }

        return $comentario;
    }

    public function insertComentario($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertComentario(?, ?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "ssssss",
            $this->idProducto,
            $this->idUsuarioCreador,
            $this->idStatus,
            $this->calificacion,
            $this->fechaPublicacion,
            $this->comentario
        );

        if ($stmt->execute()) {
            $this->idComentario = (int) $stmt->insert_id;
            return true; // Éxito en la inserción
        } else {
            return false; // Error en la inserción
        }
    }

    public function findComentarioById($mysqli, $idComentario)
    {
        $stmt = $mysqli->prepare("CALL sp_FindComentarioById(?)");
        $stmt->bind_param("i", $idComentario);
        $stmt->execute();
        $result = $stmt->get_result();
        $comentario = $result->fetch_assoc();

        return $comentario ? Comentario::parseJson($comentario) : null;
    }

    public function updateComentario($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateComentario(?, ?, ?, ?)");
        $stmt->bind_param(
            "ssss",
            $this->idComentario,
            $this->idStatus,
            $this->calificacion,
            $this->comentario
        );

        if ($stmt->execute()) {
            return true; // Éxito en la actualización
        } else {
            return false; // Error en la actualización
        }
    }

    public static function getCommentsByProduct($mysqli, $idProducto)
    {
        $comments = array();
    
        $stmt = $mysqli->prepare("CALL sp_getComentsbyProduct(?)");
        $stmt->bind_param("i", $idProducto);
        $stmt->execute();
        $result = $stmt->get_result();
    
        while ($row = $result->fetch_assoc()) {
            $comment = new Comentario(
                $row['idProducto'],
                $row['idUsuarioCreador'],
                $row['idStatus'],
                $row['Calificacion'],
                $row['Fecha_publicacion'],
                $row['Comentario']
            );
    
            $comment->setIdComentario($row['idComentario']);
            $comment->setUsername($row['Username']);
            $comment->setImagenUsuario($row['ImagenUsuario']);
    
            // Agregar el comentario directamente al array
            $comments[] = $comment;
        }
    
        $stmt->close();
    
        return $comments;
    }
    
    

    public function toJSON()
    {
        return get_object_vars($this);
    }
}
