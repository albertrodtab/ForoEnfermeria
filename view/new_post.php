<?php
include "header.php";
require_once "../model/usuario.php";
require_once "../model/mensaje.php";
?>

<section>

    <div class="body">

        <h1>Añadir un nuevo mensaje al tema.</h1>

        <!--Formulario para anadir los mensajes-->
        <form class="formulario" action="", method="post">
            <div class="form">
                <textarea name="texto" class="form-input-area" placeholder="Introduce el comentario"></textarea>
                <input type="submit" name="submit" value="Añadir mensaje" class="form-boton">
            </div>
            <?php
            $id_tema = $_GET["topic_id"];
            if (isset($_SESSION['user'])) {                                //Comprueba que la sesion esté iniciada
                if (isset($_POST['submit']) && isset($_POST['texto'])) {    //Comprueba que hay texto en el txtarea y que se ha pulsado el botón de submit
                    $usuario = new usuario(null, null, null);
                    $id_usuario = $usuario->getId($_SESSION['user']);
                    $mensaje = new mensaje($id_usuario, $_GET["topic_id"] , $_POST['texto']);
                    $mensaje->crearMensaje();
                    header("Location:index_mensajes.php?topic_id=$id_tema");
                } else {
                    echo "<p>Debes introducir texto</p>";
                }
            } else {
                echo "<p>Debes iniciar sesión para poder continuar</p>";
            }
            ?>
        </form>
    </div>



</section>

<?php include "footer.php";
