<?php
//require "sesion.php";

function listarCategorias(){
    iniciarSesion();
    require_once "model/model_categorie.php";


    $categoria1 = new categorie(null);
    $categorias = $categoria1->mostrarCategorias();
    include "view/index_categorie.php";

}

/*function listarCategoriaAddTema()
{
    iniciarSesion();
    require_once "model/model_categorie.php";


    $categoria1 = new categorie(null);
    $categorias = $categoria1->mostrarCategorias();
    include "view/index_categorie.php";

}*/

function eliminarCategoriaController(){
    iniciarSesion();
    require "model/model_categorie.php";
    require_once "model/model_usuario.php";
    include "view/index_categorie.php";


    $usuario = new usuario(null, null, null);
    $categoria1 = new categorie(null, null);

    if (isset($_GET['id_categoria'])) {
            if ($_SESSION['u_level'] == 0) {
                $id_categoria = $_GET['id_categoria'];
                $categoria1->eliminarCategoria($id_categoria);
                echo '<script>alert("Categoría Eliminada");window.location.href="index2.php?action=listarCategorias&controller=controller_categorie"</script>';
//                header("Location:view/index_topic.php");
            } /*else {

                echo '<script>alert("Solo puede borrar el tema si se registra como administrador");
                        window.location.href="index2.php?action=listarCategorias&controller=controller_categorie"</script>';

            }*/

    }

}

function iniciarSesion(){
    require "sesion.php";
    $sesion = new Sesion();


}

function formularioAnadirCategoria(){
    iniciarSesion();
    require "view/new_categorie.php";
}

function anadirCategoria() {
    iniciarSesion();
    require_once "model/model_categorie.php";
    require_once "model/model_usuario.php";

    if (isset($_SESSION['user'])) {                                //Comprueba que la sesion este iniciada
        if (isset($_POST['submit']) && !empty($_POST['titulo'])) {   ////Comprueba que hay texto en el titulo y que se ha pulsado el boton de submit
            $usuario = new usuario(null, null, null);
            $id_usuario = $usuario->getId($_SESSION['user']);
            $categoria = new categorie($_POST['titulo']);
            $categoria->crearCategoria();
            echo '<script>alert("Categoría creada");window.location.href="index2.php?action=listarCategorias&controller=controller_categorie"</script>';
            //header("Location:index2.php");
        } else {
            echo '<script>alert("Debes ponerle un título a la categoría");window.location.href="index2.php?action=formularioAnadirCategoria&controller=controller_categorie"</script>';
        }
    }

}

function formularioModificarCategoria(){
    iniciarSesion();
    require "view/mod_categorie.php";
}

function modificarCategoriaController(){
    iniciarSesion();
    require "model/model_categorie.php";
    require_once "model/model_usuario.php";
//    require "view/index_categorie.php";



    $usuario = new usuario(null, null, null);
    $categoria1 = new categorie(null, null);

    if (isset($_GET['id_categoria'])) {
        if ($_SESSION['u_level'] == 0) {
            $id_categoria = $_GET['id_categoria'];
            $cat_name = $_POST['cat_name']; // Obtener el valor del título de la categoría modificado
            $categoria1->modificarCategoria($id_categoria, $cat_name);
            echo '<script>alert("Categoría modificada");window.location.href="index2.php?action=listarCategorias&controller=controller_categorie"</script>';
//                header("Location:view/index_topic.php");
        } /*else {

                echo '<script>alert("Solo puede borrar el tema si se registra como administrador");
                        window.location.href="index2.php?action=listarCategorias&controller=controller_categorie"</script>';

            }*/

    }

}




