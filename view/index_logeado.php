<?php
include "header.php";
?>

    <div class="body">

        <h1>Bienvenido al Foro de Enfermeria En Casa</h1>

        <div>
            <p>Estos son los temas actuales del Foro</p>
        </div>
        <div class="zonas-centrales">
            <div class="texto">
                <h2>Temas</h2>
            </div>
            <div class="tabla">
                <?php
                require_once "../model/tema.php";
                $tema1 = new tema(null, null);
                $mensajes = $tema1->mostrarTemas();
                $usuario = new usuario(null, null, null);
                //Recorre mediante foreach todos los temas del foro y los pinta por pantalla
                if (count($mensajes)) {
                    foreach ($mensajes as $tema) {
                        $topic_id = $tema['topic_id'];
                        echo '<form action="" method="post">
                        <div class="tabla-elemento">
                            <div class="elemento"> 
                                <a class="titulo-tema" href="index_mensajes.php?topic_id=',$topic_id,'" >', $tema['topic_subject'], '</a>
                                <p name="usuario">Creado por: ', $usuario->getAliasById($tema['topic_by']), '</p>
                                <p name="fecha">Fecha:  ', $tema['topic_date'], '</p>
                            </div>
                            <div class="elemento"> 
                                <input type="submit" class="boton" name="',$tema['topic_id'],'" value="Borrar">
                            </div> 
                        </div>
                     </form>';
                        //Comprueba que botón de borrar se ha pulsado y elimina el tema correspondiente
                        if (isset($_POST[$tema['topic_id']])) {
                            if  (isset($_SESSION['user'])) {
                                if ($_SESSION['user'] == $usuario->getAliasById($tema['topic_by'])) {
                                    $id_tema = $tema['topic_id'];
                                    $tema1->eliminarTema($id_tema);
                                    header("Location:index_logeado.php");
                                } else {
                                    echo '<div> No se puede borrar porque ha sido creado por otro usuario </div>';
                                }
                            }else{
                                echo '<div> Debes iniciar sesion para modificar los temas </div>';
                            }
                        }
                    }
                }
                ?>
            </div>
            <div class="boton-anadir">
                <a class="boton" href="new_topic.php">Añadir tema</a>
            </div>

        </div>


    </div>



</section>

<?php include "footer.php";
