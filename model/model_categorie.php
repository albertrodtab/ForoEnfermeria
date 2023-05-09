<?php

require_once "controller/conexion.php";
require_once "model_usuario.php";


class categorie{


    public $cat_name;             //Título de la categoría

    public $conexion;           //Objeto que permite conectar con la bbdd

    //Constructor de la clase
    public function __construct($cat_name)
    {
        $this->conexion = new Conexion();
        $this->cat_name = $cat_name;

    }

    //Metodo que permite listar todos las categorias
    public function mostrarCategorias()
    {
        $this->conexion->conectar();
        $categorias = $this->conexion->consultar("SELECT * FROM categories");

        $this->conexion->desconectar();
        return $categorias;

    }

    //Metodo que permite crear las categorias
    public function crearCategoria()
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("INSERT INTO categories(cat_name) VALUES ('$this->cat_name')");
        $this->conexion->desconectar();
    }

    //Metodo que permite eliminar las categorias
    public function eliminarCategoria($categoria)
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("DELETE FROM categories WHERE cat_id = '$categoria'");
        $this->conexion->desconectar();
    }

    public function modificarCategoria($categoria, $catName)
    {
        $this->conexion->conectar();
        $this->conexion->ejecutar("UPDATE categories SET cat_name = '$catName' WHERE cat_id = '$categoria'");
        $this->conexion->desconectar();
    }


    public function getCatById($id_cat)
    {
        $this->conexion->conectar();
        $categoria = $this->conexion->consultar("SELECT cat_name FROM categories WHERE cat_id = '$id_cat'");
        if (count($categoria)) {
            $categoria[0] ['cat_name'];
        }
        $this->conexion->desconectar();
        return $categoria[0] ['cat_name'];
    }
}
