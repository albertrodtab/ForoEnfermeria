<?php
require_once("../controller/conexion.php");
require_once "../controller/sesion.php";
require_once "usuario.php";

class mensaje
{

    public $id_usuario;         //Usuario que crea el mensaje
    public $id_tema;            //Tema en el que es creado el mensaje
    public $texto;              //Cuerpo del mensaje
    public $data;               //Fecha de creación del mensaje
    public $conexion;           //Objeto que conecta con la bbdd

    //Constructor de la clase
    public function __construct($id_usuario, $id_tema, $texto)
    {
        $this->conexion = new Conexion();
        $this->id_usuario = $id_usuario;
        $this->id_tema = $id_tema;
        $this->texto = $texto;
        $this->data = date_default_timezone_get();
    }

    //Metodo que permite listar todos los mensajes de un tema
    public function mostrarMensajes($id_tema)
    {
        $this->conexion->conectar();
        $mensajes = $this->conexion->consultar("SELECT * FROM posts WHERE post_topic = '$id_tema'");
        return $mensajes;
        $this->conexion->desconectar();

    }

    //Metodo que permite crear mensajes
    public function crearMensaje()
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("INSERT INTO posts (post_by, post_topic, post_content, post_date) VALUES ('$this->id_usuario', '$this->id_tema', '$this->texto','$this->data')");
        $this->conexion->desconectar();
    }

    //Metodo que permite eliminar los mensajes
    public function eliminarMensaje($id_mensaje)
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("DELETE FROM posts WHERE post_id = '$id_mensaje'");
        $this->conexion->desconectar();
    }
}