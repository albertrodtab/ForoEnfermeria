<?php

require_once "controller/conexion.php";
require_once "model_usuario.php";


class tema{

    public $id_usuario;         //Id del modelUsuario que crea el Tema
    public $titulo;             //Título del Tema
    public $id_categoria;       //Categoría en el que es creado el tema
    public $data;               //Fecha de creación del Tema
    public $conexion;           //Objeto que permite conectar con la bbdd

    //Constructor de la clase
    public function __construct($id_usuario, $cat_id, $titulo)
    {
        $this->conexion = new Conexion();
        $this->id_usuario = $id_usuario;
        $this->id_categoria = $cat_id;
        $currentDate = new DateTime();
        $currentDateTime = $currentDate->format('Y-m-d H:i:s');
        $this->data = $currentDateTime;
        $this->titulo = $titulo;
    }

    //Metodo que permite listar todos los temas
    public function mostrarTemas($id_categoria)
    {
        $this->conexion->conectar();
        $temas = $this->conexion->consultar("SELECT * FROM topics WHERE topic_cat = '".$id_categoria."'");
        return $temas;
        $this->conexion->desconectar();

    }

    //Metodo que permite crear los temas
    public function crearTema()
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("INSERT INTO topics(topic_subject, topic_date, topic_by, topic_cat) VALUES ('$this->titulo','$this->data','$this->id_usuario','$this->id_categoria')");
        $this->conexion->desconectar();
    }

    //Metodo que permite eliminar los temas
    public function eliminarTema($tema)
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("DELETE FROM topics WHERE topic_id = '$tema'");
        $this->conexion->desconectar();
    }

    public function modificarTema($id_topic, $topicName)
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("UPDATE topics SET topic_subject = '$topicName' WHERE topic_id = '$id_topic'");
        $this->conexion->desconectar();
    }

    /*public function getTopicCatById($id_mensaje)
    {
        $this->conexion->conectar();
        $mensaje = $this->conexion->consultar("SELECT topic_cat FROM topics WHERE topic_id = '$id_mensaje'");
        if (count($mensaje)) {
            $mensaje[0] ['topic_cat'];
        }
        $this->conexion->desconectar();
        return $mensaje[0] ['topic_cat'];
    }*/
    public function getTopicCatById($id_tema)
    {
        try {
            $this->conexion->conectar();
            $resultado = $this->conexion->consultar("SELECT topic_cat FROM topics WHERE topic_id = '$id_tema'");
            $this->conexion->desconectar();

            if (count($resultado)) {
                return $resultado[0]['topic_cat'];
            } else {
                throw new Exception("No se encontró ningún tema con el ID proporcionado.");
            }
        } catch (Exception $e) {
            error_log("Error en la función getTopicCatById: " . $e->getMessage());
            return null;
        }
    }
    public function getTopicById($id_topic)
    {
        $this->conexion->conectar();
        $tema = $this->conexion->consultar("SELECT topic_subject FROM topics WHERE topic_id = '$id_topic'");
        if (count($tema)) {
            $tema[0] ['topic_subject'];
        }
        $this->conexion->desconectar();
        return $tema[0] ['topic_subject'];
    }

}
