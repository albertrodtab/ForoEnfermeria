<?php
include "header1.php";
?>

    <div class="body">
        <h1>Foro Enfermeria <br> Cuidados en el Domicilio</h1>
        <!--<div>
            <p>Estos son los mensajes de este Tema</p>
        </div>-->
    <div class="zonas-centrales">
        <div class="texto">
            <h2>Mensajes del tema: "<?php echo $_GET['titulo_tema']?></h2>
        </div>
        <?php
            //Botón para añadir nuevo tema
            if (isset($_SESSION['u_level']))
                if ($_SESSION['u_level'] == 0 || $_SESSION['u_level'] == 1):
                    if (!empty($_GET['id_tema'])) {
                        $id_getTema = $_GET['id_tema'];
                        echo '<div class="boton-anadir">';
                        echo '<a class="boton" href="index2.php?action=formularioAnadirMensaje&controller=controller_mensaje&id_tema=' . $id_getTema . '&titulo_tema=' . $_GET['titulo_tema'] . '">Añadir mensaje</a>';
                        echo '</div>';
                    }
                endif;
                    ?>
    </div>
        <div class="tabla">
            <?php
            if (!empty($mensajes)) {
            //Comenzar la tabla
            echo '<table>';
            echo '<caption>Tema: '. $_GET['titulo_tema']. '</caption>';
            //Mostrar encabezados de la tabla
                echo '<tr>';
                    echo '<th>Mensaje</th>';
                    echo '<th>Creado por</th>';
                    echo '<th>Fecha</th>';
                    /*echo '<th>Borrar</th>';*/
                echo '</tr>';

                //Recorre mediante foreach todos los mensajes y los muestra en la tabla

                    foreach ($mensajes as $mensaje) {
                        $id_getPost = $mensaje['post_id'];
                        if (!empty($usuario)) {
                            //Mostrar una fila de la tabla
                            echo ' <tr>';
                                echo ' <td>' . $mensaje ['post_content'] . '</td>';
                                echo ' <td>' . $usuario->getAliasById($mensaje['post_by']) . '</td>';
                                echo ' <td>' . $mensaje['post_date'] . '</td>';
                            if (isset($_SESSION['u_level']))
                                if($_SESSION['u_level'] == 0 || $_SESSION['u_level'] == 1):
                                echo ' <td><a href="index2.php?post_id=' . $mensaje['post_id'] . '&post_by=' . urlencode($mensaje['post_by']) .'&titulo_tema=' . $_GET['titulo_tema'] . '&action=' . "eliminarMensajeController" . '&controller=' . "controller_mensaje" . '" type="submit" class="boton">Borrar</a></td>';
                            endif;
                            if (isset($_SESSION['u_level']))
                                if($_SESSION['u_level'] == 0 || $_SESSION['u_level'] == 1):
                                    echo '<td><a class="boton"  type="submit" href="index2.php?post_id=' . $mensaje['post_id'] . '&post_content='.$mensaje['post_content'].'&postBy=' . $mensaje['post_by'] . '&action=formularioModificarMensaje&controller=controller_mensaje">Modificar</a></td>';
                                endif;
                            echo ' </tr>';
                        }
                    }
                    //Cerrar la tabla
                    echo '</table>';

                    /*//Botón para añadir nuevo tema
                    if (!empty($_GET['id_tema'])) {
                        $id_getTema = $_GET['id_tema'];
                        echo '<div class="boton-anadir">';
                        echo '<a class="boton" href="index2.php?action=formularioAnadirMensaje&controller=controller_mensaje&id_tema=' . $id_getTema . '">Añadir mensaje</a>';
                        echo '</div>';
                    }*/
                }else{
                //Comenzar la tabla
                echo '<table>';
                echo '<caption>Tema: '. $_GET['titulo_tema']. '</caption>';

                //Mostrar encabezados de la tabla
                echo '<tr>';
                echo '<th>Mensaje</th>';
                echo '<th>Creado por</th>';
                echo '<th>Fecha</th>';
                /*echo '<th></th>';*/
                echo '</tr>';
                echo '<td>No hay mensajes disponibles para esta tema</td>';
                echo '<td></td>';
                echo '<td></td>';
                echo '</table>';
            }
                ?>
    </div>
    </div>

<?php include "footer.php";
