
<?php
function listarMensajes(){

    iniciarSesion();
    require "model/model_usuario.php";
    require "model/model_mensaje.php";
    $usuario = new usuario(null, null, null);
    $mensaje = new mensaje(null, null, null);
    $mensajes = $mensaje->mostrarMensajes($_GET['id_tema']);
    include "view/index_mensajes.php";
}

function eliminarMensajeController(){
    iniciarSesion();
    require "model/model_mensaje.php";
    require_once "model/model_usuario.php";
    require "view/index_mensajes.php";

    $usuario = new usuario(null, null, null);
    $mensaje = new mensaje(null, null, null);

    if (isset($_GET['post_id']) && isset($_GET['post_by'])) {
        $id_mensaje = $_GET['post_id'];
        $titulo_tema = $_GET['titulo_tema'];
        $id_tema = $mensaje->getPostTopicById($id_mensaje);
        if ($_SESSION['u_level'] == 0 ) {
            $mensaje->eliminarMensaje($id_mensaje);
            echo '<script>alert("Mensaje borrado con éxito");window.location.href="index2.php?action=listarMensajes&controller=controller_mensaje&id_tema=' . $id_tema . '&titulo_tema=' . $titulo_tema . '"</script>';
            }elseif ($_SESSION['user'] == $usuario->getAliasById($_GET['post_by'])) {
            $mensaje->eliminarMensaje($id_mensaje);
                echo '<script>alert("Mensaje borrado con éxito");window.location.href="index2.php?action=listarMensajes&controller=controller_mensaje&id_tema=' . $id_tema . '&titulo_tema=' . $titulo_tema . '"</script>';
            } else {
            echo '<script>alert("Solo puede borrar el mensaje el usuario que lo ha creado");window.location.href="index2.php?action=listarMensajes&controller=controller_mensaje&id_tema=' . $id_tema .'&titulo_tema=' . $titulo_tema . '"</script>';
            }
        }
}

function iniciarSesion(){
    require "sesion.php";
    $Sesion = new Sesion();
}

function formularioAnadirMensaje(){
    iniciarSesion();
    require "view/new_post.php";
}

function anadirMensaje() {
    iniciarSesion();
    require "model/model_mensaje.php";
    require_once "model/model_usuario.php";

    $id_tema = $_GET["id_tema"];
    $titulo_tema =$_GET['titulo_tema'];
    if (isset($_SESSION['user'])) {                                //Comprueba que la sesion este iniciada
        if (isset($_POST['submit']) && !empty($_POST['texto'])) {    //Comprueba que el hay texto en el txtarea y que se ha pulsado el boton de submit
            $usuario = new usuario(null, null, null);
            $id_usuario = $usuario->getId($_SESSION['user']);
            $mensaje = new mensaje($id_usuario, $_GET["id_tema"], $_POST['texto']);
            $mensaje->crearMensaje();
            echo '<script>alert("Mensaje creado correctamente");window.location.href="index2.php?action=listarMensajes&controller=controller_mensaje&id_tema=' . $id_tema . '&titulo_tema=' . $titulo_tema .'"</script>';
            exit();
        } else {
            echo '<script>alert("Debes introducir texto en el mensaje");window.location.href="index2.php?action=listarMensajes&controller=controller_mensaje"</script>';
        }
    } else {
        echo '<script>alert("Debes iniciar sesion para continuar");window.location.href="index2.php?action=listarMensajes&controller=controller_mensaje"</script>';
    }


}

function formularioModificarMensaje(){
    iniciarSesion();
    require "view/mod_post.php";
}

function modificarMensajeController()
{
    iniciarSesion();
    require "model/model_mensaje.php";
    require_once "model/model_usuario.php";
    require_once "model/model_tema.php";



    $usuario = new usuario(null, null, null);
    $topic = new tema(null, null, null,);
    $mensaje = new mensaje(null, null, null);

    if (isset($_GET['id_post'])) {
        $id_post = $_GET['id_post'];
        $post_content = $_POST['post_name']; // Obtener el valor del texto del mensaje modificado
        $id_tema = $mensaje->getPostTopicById($id_post);
        $titulo_tema = $topic->getTopicById($id_tema);


//        if ($_SESSION['u_level'] == 0) {
//            /*$id_tema = $_GET['id_tema'];
//            $topic_name = $_POST['topic_name']; // Obtener el valor del título de la categoría modificado*/
//            $mensaje->modificarMensaje($id_post, $post_content);
//            echo '<script>alert("Mensaje modificado");window.location.href="index2.php?action=listarMensajes&controller=controller_mensaje&id_tema=' . $id_tema . '&titulo_tema=' . $titulo_tema .'"</script>';
////                header("Location:view/index_topic.php");
//        } else

            if ($_SESSION['user'] == $usuario->getAliasById($_GET['postBy'])) {
            /*$id_tema = $_GET['id_tema'];
            $topic_name = $_POST['topic_name'];*/
            $mensaje->modificarMensaje($id_post, $post_content);
            echo '<script>alert("Mensaje Modificado");window.location.href="index2.php?action=listarMensajes&controller=controller_mensaje&id_tema=' . $id_tema . '&titulo_tema=' . $titulo_tema .'"</script>';
        } else {
            /* $id_tema = $_GET['id_tema'];*/
            echo '<script>alert("Solo puede modificar el mensaje el usuario que lo ha creado");window.location.href="index2.php?action=listarMensajes&controller=controller_mensaje&id_tema=' . $id_tema . '&titulo_tema=' . $titulo_tema .'"</script>';
        }/*else {

                echo '<script>alert("Solo puede borrar el tema si se registra como administrador");
                        window.location.href="index2.php?action=listarCategorias&controller=controller_categorie"</script>';

            }*/

    }


}
