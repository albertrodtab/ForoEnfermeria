<?php
require_once "../controller/conexion.php";
require_once "usuario.php";

class tema
{

    public $id_usuario;         //Id del usuario que crea el tema
    public $titulo;             //Título del tema
    public $data;               //Fecha de creación del tema
    public $conexion;           //Objeto que permite conectar con la bbdd

    //Constructor de la clase
    public function __construct($id_usuario, $titulo, )
    {
        $this->conexion = new Conexion();
        $this->id_usuario = $id_usuario;
        $this->data = date_default_timezone_get();
        $this->titulo = $titulo;
    }

    //Metodo que permite listar todos los temas
    public function mostrarTemas()
    {
        $this->conexion->conectar();
        $temas = $this->conexion->consultar("SELECT * FROM topics");
        return $temas;
        $this->conexion->desconectar();

    }

    //Metodo que permite crear los temas
    public function crearTema()
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("INSERT INTO topics(topic_subject, topic_date, topic_by) VALUES ('$this->titulo','$this->data','$this->id_usuario')");
        $this->conexion->desconectar();
    }

    //Metodo que permite eliminar los temas
    public function eliminarTema($tema)
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("DELETE FROM topics WHERE topic_id = '$tema'");
        $this->conexion->desconectar();
    }
}