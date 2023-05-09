<?php

function formularioAnadir(){
    iniciarSesion();
    require "view/new_topic.php";
}

function anadirTema()
{
    iniciarSesion();
    require_once "model/model_tema.php";
    require_once "model/model_usuario.php";

    $id_categoria = $_GET["id_categoria"];
    $cat_name = $_GET['cat_name'];
    if (isset($_SESSION['user'])) {                                //Comprueba que la sesion este iniciada
        if (isset($_POST['submit']) && !empty($_POST['titulo'])) {   ////Comprueba que hay texto en el titulo y que se ha pulsado el boton de submit
            $usuario = new usuario(null, null, null);
            $id_usuario = $usuario->getId($_SESSION['user']);
            $tema = new tema($id_usuario, $_GET['id_categoria'], $_POST['titulo']);
            $tema->crearTema();
            echo '<script>alert("Tema Creado Correctamente");window.location.href="index2.php?action=listarTemas&controller=controller_tema&id_categoria=' . $id_categoria . '&cat_name=' . $cat_name . '"</script>';
            exit();
        } else {
            echo '<script>alert("Debes ponerle un titulo al tema");window.location.href="index2.php"</script>';
        }
    } else {
        echo '<script>alert("Debes iniciar sesion para poder continuar");window.location.href="index2.php?action=mostrarLogIn&controller=controller_usuario"</script>';
    }
}

function listarTemas(){
    iniciarSesion();
    require_once "model/model_tema.php";
    require_once "model/model_usuario.php";
    require_once "model/model_categorie.php";
    $id_categoria = $_GET["id_categoria"];
//    $cat_name = $_GET["cat_name"];
    $usuario = new usuario(null, null, null);
    $tema = new tema(null, null, null);
    $categoria = new categorie(null);
    $temas = $tema->mostrarTemas($id_categoria);
    include "view/index_topic.php";


}

function eliminarTemaController(){
    iniciarSesion();
    require "model/model_tema.php";
    require_once "model/model_usuario.php";
    require "view/index_topic.php";

    $usuario = new usuario(null, null, null);
    $tema = new tema(null, null, null);

    if (isset($_GET['topic_id'])) {
        if ($_SESSION['u_level'] == 0 ) {
                $id_tema = $_GET['topic_id'];
                $id_cat = $tema->getTopicCatById($id_tema);
                $tema->eliminarTema($id_tema);
                echo '<script>alert("Tema Borrado");window.location.href="index2.php?action=listarTemas&controller=controller_tema&id_categoria=' . $id_cat . '&cat_name=' . $_GET['cat_name']. '"</script>';
            }
        }
}

function iniciarSesion(){
    require "sesion.php";
    $Sesion = new Sesion();
}

function formularioModificarTema(){
    iniciarSesion();
    require "view/mod_topic.php";
}

function modificarTemaController()
{
    iniciarSesion();
    require "model/model_tema.php";
    require_once "model/model_usuario.php";
    require_once "model/model_categorie.php";



    $usuario = new usuario(null, null, null);
    $topic = new tema(null, null, null,);
    $categoria = new categorie(null);

    if (isset($_GET['id_tema'])) {
        $id_tema = $_GET['id_tema'];
        $topic_name = $_POST['topic_name']; // Obtener el valor del título de la categoría modificado
        $id_cat = $topic->getTopicCatById($id_tema);
        $cat_name = $categoria->getCatById($id_cat);


        if ($_SESSION['u_level'] == 0) {
            /*$id_tema = $_GET['id_tema'];
            $topic_name = $_POST['topic_name']; // Obtener el valor del título de la categoría modificado*/
            $topic->modificarTema($id_tema, $topic_name);
            echo '<script>alert("Tema modificado");window.location.href="index2.php?action=listarTemas&controller=controller_tema&id_categoria=' . $id_cat . '&cat_name=' . $cat_name .'"</script>';
//                header("Location:view/index_topic.php");
        } elseif ($_SESSION['user'] == $usuario->getAliasById($_GET['topicBy'])) {
            /*$id_tema = $_GET['id_tema'];
            $topic_name = $_POST['topic_name'];*/
            $topic->modificarTema($id_tema, $topic_name);
            echo '<script>alert("Tema Modificado");window.location.href="index2.php?action=listartemas&controller=controller_tema&id_categoria=' . $id_cat . '&cat_name=' . $cat_name .'"</script>';
        } else {
           /* $id_tema = $_GET['id_tema'];*/
            echo '<script>alert("Solo puede modificar el tema el usuario que lo ha creado");window.location.href="index2.php?action=listarTemas&controller=controller_tema&id_categoria=' . $id_cat . '&cat_name=' . $cat_name .'"</script>';
        }/*else {

                echo '<script>alert("Solo puede borrar el tema si se registra como administrador");
                        window.location.href="index2.php?action=listarCategorias&controller=controller_categorie"</script>';

            }*/

    }


}




