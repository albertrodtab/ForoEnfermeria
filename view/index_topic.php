<?php
require_once "header1.php";

?>

    <div class="body">
        <h1>Foro Enfermeria <br> Cuidados en el Domicilio</h1>
        <!--<div>
            <p>Estos son los temas de la Categoría</p>
        </div>
-->
        <div class="zonas-centrales">
            <div class="texto">
                <h2>Temas de la categoría: "<?php echo $_GET['cat_name']?>"</h2>
            </div>
            <?php
                //Botón para añadir nuevo tema
                if (isset($_SESSION['u_level']))
                    if ($_SESSION['u_level'] == 0 || $_SESSION['u_level'] == 1):
                        if (!empty($_GET['id_categoria'])) {
                        $idCategoria = $_GET['id_categoria'];
                        echo '<div class="boton-anadir">';
                        echo '<a class="boton" href="index2.php?action=formularioAnadir&controller=controller_tema&id_categoria=' . $idCategoria . '&cat_name=' . $_GET['cat_name'] .'">Añadir Tema</a>';
                        echo '</div>';
                                    }
                    endif;
                        ?>
        </div>
            <div class="tabla">
                <?php
                if (!empty($temas)) {
                    //Recorrer los temas y mostrarlos en la tabla

                //Comenzar la tabla
                echo '<table>';
                echo '<caption>Categoría: '. $_GET['cat_name']. '</caption>';

               //Mostrar encabezados de la tabla
                echo '<tr>';
                echo '<th>Título del Tema</th>';
                echo '<th>Creado por</th>';
                echo '<th>Fecha</th>';
                /*echo '<th></th>';*/
                echo '</tr>';

                //Recorrer los temas y mostrarlos en la tabla

                    foreach ($temas as $tema) {
                        $id_getTema = $tema['topic_id'];
                          if (!empty($usuario)||!empty($categoria)) {

                        //Obtener el usuario que creó el tema
                        $creadoPor = $usuario->getAliasById($tema['topic_by']);

                        $categoriaName = $categoria->getCatById($tema['topic_cat']);

                        //Mostrar una fila de la tabla
                        echo '<tr>';
                        echo '<td><a class="titulo-Tema" href="index2.php?action=listarMensajes&controller=controller_mensaje&id_tema='.$tema['topic_id'].'&titulo_tema='.$tema['topic_subject'].'">'.$tema['topic_subject'].'</a></td>';
                        echo '<td>'.$creadoPor.'</td>';
                        echo '<td>'.$tema['topic_date'].'</td>';
                        if (isset($_SESSION['u_level']))
                                  if($_SESSION['u_level'] == 0 ):
                        echo '<td><a href="index2.php?topic_id='.$tema['topic_id'].'&cat_name='. $_GET['cat_name']. '&action='."eliminarTemaController".'&controller='."controller_tema".'" type="submit" class="boton">Borrar</a></td>';
                                  endif;
                        if (isset($_SESSION['u_level']))
                                  if($_SESSION['u_level'] == 0 || $_SESSION['u_level'] == 1):
                              echo '<td><a class="boton"  type="submit" href="index2.php?id_tema=' . $tema['topic_id'] . '&titulo_tema='.$tema['topic_subject'].'&topicBy=' . $tema['topic_by'] . '&action=formularioModificarTema&controller=controller_tema">Modificar</a></td>';
                                  endif;
                        echo '</tr>';
                    }
                }

                //Cerrar la tabla
                echo '</table>';

                /*//Botón para añadir nuevo tema
                if (!empty($_GET['id_categoria'])) {
                    $idCategoria = $_GET['id_categoria'];
                    echo '<div class="boton-anadir">';
                    echo '<a class="boton" href="index2.php?action=formularioAnadir&controller=controller_tema&id_categoria='.$idCategoria.'">Añadir Tema</a>';
                    echo '</div>';
                }*/
                }else{
                    //Comenzar la tabla
                    echo '<table>';
                    echo '<caption>Categoría: '. $_GET['cat_name']. '</caption>';

                    //Mostrar encabezados de la tabla
                    echo '<tr>';
                    echo '<th>Título del Tema</th>';
                    echo '<th>Creado por</th>';
                    echo '<th>Fecha</th>';
                    /*echo '<th></th>';*/
                    echo '</tr>';
                    echo '<td>No hay temas disponibles para esta categoría</td>';
                    echo '<td></td>';
                    echo '<td></td>';
                    echo '</table>';
                }
                ?>
            </div>
    </div>

<?php include "footer.php";
