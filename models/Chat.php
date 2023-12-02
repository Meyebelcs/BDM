<?php
class Chat
{
    private $idChat;
    private $idUsuarioCliente;
    private $idUsuarioVendedor;
    private $idStatus;
    private $idProducto;
    private $fechaCreacion;
    private $ImagenCliente;
    private $ImagenVendedor;
    private $NombreVendedor;

    private $NombreCliente;
    private $idCarrito;

    public function getidCarrito()
    {
        return $this->idCarrito;
    }

    public function setidCarrito($idCarrito)
    {
        $this->idCarrito = $idCarrito;
    }
    public function getNombreVendedor()
    {
        return $this->NombreVendedor;
    }

    public function setNombreVendedor($NombreVendedor)
    {
        $this->NombreVendedor = $NombreVendedor;
    }
    public function getNombreCliente()
    {
        return $this->NombreCliente;
    }

    public function setNombreCliente($NombreCliente)
    {
        $this->NombreCliente = $NombreCliente;
    }
    public function getImagenVendedor()
    {
        return $this->ImagenVendedor;
    }

    public function setImagenVendedor($ImagenVendedor)
    {
        $this->ImagenVendedor = $ImagenVendedor;
    }
    public function getImagenCliente()
    {
        return $this->ImagenCliente;
    }

    public function setImagenCliente($ImagenCliente)
    {
        $this->ImagenCliente = $ImagenCliente;
    }


    public function getIdChat()
    {
        return $this->idChat;
    }

    public function setIdChat($idChat)
    {
        $this->idChat = $idChat;
    }

    public function getIdUsuarioCliente()
    {
        return $this->idUsuarioCliente;
    }

    public function setIdUsuarioCliente($idUsuarioCliente)
    {
        $this->idUsuarioCliente = $idUsuarioCliente;
    }

    public function getIdUsuarioVendedor()
    {
        return $this->idUsuarioVendedor;
    }

    public function setIdUsuarioVendedor($idUsuarioVendedor)
    {
        $this->idUsuarioVendedor = $idUsuarioVendedor;
    }

    public function getIdStatus()
    {
        return $this->idStatus;
    }

    public function setIdStatus($idStatus)
    {
        $this->idStatus = $idStatus;
    }

    public function getIdProducto()
    {
        return $this->idProducto;
    }

    public function setIdProducto($idProducto)
    {
        $this->idProducto = $idProducto;
    }

    public function getFechaCreacion()
    {
        return $this->fechaCreacion;
    }

    public function setFechaCreacion($fechaCreacion)
    {
        $this->fechaCreacion = $fechaCreacion;
    }

    // Constructor
    public function __construct(
        $idUsuarioCliente,
        $idUsuarioVendedor,
        $idStatus,
        $idProducto,
        $fechaCreacion
    ) {
        $this->idUsuarioCliente = $idUsuarioCliente;
        $this->idUsuarioVendedor = $idUsuarioVendedor;
        $this->idStatus = $idStatus;
        $this->idProducto = $idProducto;
        $this->fechaCreacion = $fechaCreacion;
    }

    static public function parseJson($json)
    {
        $chat = new Chat(
            isset($json["idUsuarioCliente"]) ? $json["idUsuarioCliente"] : null,
            isset($json["idUsuarioVendedor"]) ? $json["idUsuarioVendedor"] : null,
            isset($json["idStatus"]) ? $json["idStatus"] : null,
            isset($json["idProducto"]) ? $json["idProducto"] : null,
            isset($json["Fecha_creacion"]) ? $json["Fecha_creacion"] : null
        );

        if (isset($json["idChat"])) {
            $chat->setIdChat((int) $json["idChat"]);
        }


        return $chat;
    }

    public function insertChat($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_InsertChat(?, ?, ?, ?, ?)");
        $stmt->bind_param(
            "sssss",
            $this->idUsuarioCliente,
            $this->idUsuarioVendedor,
            $this->idStatus,
            $this->idProducto,
            $this->fechaCreacion
        );

        if ($stmt->execute()) {
            $this->idChat = (int) $stmt->insert_id;
            return true; // Éxito en la inserción
        } else {
            return false; // Error en la inserción
        }
    }

    public function findChatById($mysqli, $idChat)
    {
        $stmt = $mysqli->prepare("CALL sp_FindChatById(?)");
        $stmt->bind_param("i", $idChat);
        $stmt->execute();
        $result = $stmt->get_result();
        $chat = $result->fetch_assoc();

        return $chat ? self::parseJson($chat) : null;
    }

    public static function findifexist($mysqli, $idChat, $idProduct)
    {
        $stmt = $mysqli->prepare("CALL sp_ifExistCarritoProduct(?, ?)");
        $stmt->bind_param("ii", $idProduct, $idChat);  // Cambio en esta línea
        $stmt->execute();
        $result = $stmt->get_result();
        $chat = $result->fetch_assoc();

        return $chat ? self::parseJson($chat) : null;
    }

    public static function findifexist2($mysqli, $idChat, $idProduct)
    {
        $products = array();

        // Ajusta el nombre del procedimiento almacenado y el número de parámetros
        $stmt = $mysqli->prepare("CALL sp_ifExistCarritoProduct2(?, ?)");
        $stmt->bind_param("ii", $idProduct, $idChat);  // Cambio en esta línea
        $stmt->execute();
        $result = $stmt->get_result();



        while ($row = $result->fetch_assoc()) {
            $producto = new Chat(
                0,
                0,
                0,
                0,
                0
            );
            $producto->setidCarrito($row['idCarrito']);


            // Agregar el comentario directamente al array
            $products[] = $producto;
        }

        $stmt->close();

        return $products;
    }




    public function updateChat($mysqli)
    {
        $stmt = $mysqli->prepare("CALL sp_UpdateChat(?, ?, ?)");
        $stmt->bind_param(
            "sss",
            $this->idChat,
            $this->idStatus,
            $this->idProducto
        );

        if ($stmt->execute()) {
            return true; // Éxito en la actualización
        } else {
            return false; // Error en la actualización
        }
    }

    public static function getChatsByUser($mysqli, $idUser)
    {
        $products = array();

        // Ajusta el nombre del procedimiento almacenado y el número de parámetros
        $stmt = $mysqli->prepare("CALL ObtenerChatsPorUsuario(?)");
        $stmt->bind_param("i", $idUser);
        $stmt->execute();
        $result = $stmt->get_result();



        while ($row = $result->fetch_assoc()) {
            $producto = new Chat(
                $row['idUsuarioCliente'],
                $row['idUsuarioVendedor'],
                $row['idStatus'],
                $row['idProducto'],
                $row['Fecha_creacion']
            );
            $producto->setIdChat($row['idChat']);
            $producto->setImagenCliente($row['ImagenCliente']);
            $producto->setImagenVendedor($row['ImagenVendedor']);
            $producto->setNombreCliente($row['NombreCliente']);
            $producto->setNombreVendedor($row['NombreVendedor']);


            // Agregar el comentario directamente al array
            $products[] = $producto;
        }

        $stmt->close();

        return $products;
    }
    public static function getLastidChat($mysqli)
    {
        $stmt = $mysqli->prepare("CALL GetLastChatId()");

        $stmt->execute();
        $result = $stmt->get_result();
        $chat = $result->fetch_assoc();
        $stmt->close();
        return $chat ? Chat::parseJson($chat) : null;
    }


    public function toJSON()
    {
        return get_object_vars($this);
    }
}
