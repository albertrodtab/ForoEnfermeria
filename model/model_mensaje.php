<?php
require_once "controller/conexion.php";
require_once "controller/sesion.php";
require_once "model_usuario.php";
class mensaje
{
    public $id_usuario;         //Usuario que crea el Mensaje
    public $id_tema;            //Tema en el que es creado el Mensaje
    public $texto;              //Cuerpo del Mensaje
    public $data;               //Fecha de creación del Mensaje
    public $conexion;           //Objeto que conecta con la bbdd

    //Constructor de la clase
    public function __construct($id_usuario, $id_tema, $texto)
    {
        $this->conexion = new Conexion();
        $this->id_usuario = $id_usuario;
        $this->id_tema = $id_tema;
        $this->texto = $texto;
        $currentDate = new DateTime();
        $currentDateTime = $currentDate->format('Y-m-d H:i:s');
        $this->data = $currentDateTime;
    }

    //Metodo que permite listar todos los mensajes de un modelTema
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

    public function modificarMensaje($id_post, $post_content)
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("UPDATE posts SET post_content = '$post_content' WHERE post_id = '$id_post'");
        $this->conexion->desconectar();
    }

    public function getPostTopicById($id_mensaje)
    {
        $this->conexion->conectar();
        $mensaje = $this->conexion->consultar("SELECT post_topic FROM posts WHERE post_id = '$id_mensaje'");
        if (count($mensaje)) {
            return $mensaje[0] ['post_topic'];
        }
        $this->conexion->desconectar();
    }
}