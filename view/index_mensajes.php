<?php
include "header.php";
include "../model/mensaje.php";
?>

    <div class="body">

        <h1>Bienvenido al Foro de Enfermeria En Casa</h1>

        <div>
            <p>Estos son los mensajes de este Tema</p>
        </div>
    <div class="zonas-centrales">
        <div class="texto">
            <h2>Mensajes</h2>
        </div>
        <div class="tabla">
        <?php
            require_once "../model/tema.php";
            $mensaje1 = new mensaje(null, null, null);
            if (isset($_GET["topic_id"])) {
                $id_getTema = $_GET["topic_id"];
            }
            $mensajes = $mensaje1->mostrarMensajes($_GET["topic_id"]);
            $usuario = new usuario(null, null, null);
            //Recorre mediante foreach todos los mensajes del foro y los pinta por pantalla
            if (count($mensajes)) {
                foreach ($mensajes as $mensaje) {
                    $id_getTema = $mensaje['post_topic'];
                    echo '<form action="" method="post">
                            <div class="tabla-elemento">
                                <div class="elemento-texto">
                                    <p name="texto">', $mensaje['post_content'], '</p>
                                </div>
                                <div class="elemento"> 
                                    <p name="usuario">Creado por: ', $usuario->getAliasById($mensaje['post_by']), '</p>
                                    <p name="fecha">Fecha:  ', $mensaje['post_date'], '</p>
                                </div>
                                <div class="elemento"> 
                                    <input type="submit" class="boton" name="', $mensaje['post_id'], '" value="Borrar">
                                </div> 
                            </div>
                    </form>';
                //Comprueba que boton de borrar se ha pulsado y elimina el mensaje correspondiente
                if (isset($_POST[$mensaje['post_id']])) {
                    if  (isset($_SESSION['user'])) {
                        if ($_SESSION['user'] == $usuario->getAliasById($mensaje['post_by'])) {
                            $id_mensaje = $mensaje['post_id'];
                            $mensaje1->eliminarMensaje($id_mensaje);
                            header("Location:index_mensaje.php?topic_id=$id_getTema");
                        } else {
                            echo '<div> No se puede borrar porque ha sido creado por otro usuario </div>';
                        }
                    } else {
                        echo '<div> Debes iniciar sesion para modificar los mensajes </div>';
                    }
                }
            }
        }
        echo '</div>
    <div class="boton-anadir">    
        <a class="boton" href="new_post.php?topic_id=',$id_getTema,'">Añadir mensaje</a>
    </div>
</div>';
        ?>



    </div>
    </div>
    </div>



</section>

<?php include "footer.php";
