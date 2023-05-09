<?php
require_once "header1.php";

?>


    <div class="body">

        <h1>Foro Enfermeria <br> Cuidados en el Domicilio</h1>

        <div>
            <p>
                Este foro está pensado para poder resolver y dar soluciones sencillas a las dudas que los
                pacientes puedan tener en su domicilio.<br>
                Como en cualquier foro encontrará distintos temas sobre los que consultar o preguntar y
                otros pacientes le podrán ir respondiendo. <br>
                Puede estar tranquilo nuestros profesionales intervendrán en caso de ser necesario para aclarar cualquier tema.<br>
            </p>

            <p>
                Para acceder a la página debes conectarte primero desde el botón del menú <a href="index2.php?action=mostrarLogin&controller=controller_usuario">Unete</a><br>
                <br>
                Si no cuentas con una cuenta de usuario todavía puedes crear una desde el botón del menú <a href="index2.php?action=mostrarRegister&controller=controller_usuario">Registrate</a><br>

            </p>
        </div>

        <div class="zonas-centrales">
            <div class="texto">
                <h2>Categorías Del Foro</h2>
            </div>
        </div>

<?php if (isset($_SESSION['u_level']))
    if($_SESSION['u_level'] == 0 ): ?>
    <div class="boton-anadir">
        <a class="boton" href="index2.php?action=formularioAnadirCategoria&controller=controller_categorie">Añadir Categoría</a>
    </div>
<?php endif; ?>
    <div class="tabla">
        <?php
        //Recorre mediante foreach todos los temas del foro y los pinta por pantalla
        if (!empty($categorias)) {
            echo '<table>';
            echo '<tr><th>Título de la Categoría</th><!--<th>Acción</th>--></tr>';
            foreach ($categorias as $categoria) {
                $cat_id = $categoria['cat_id'];
                $cat_name = $categoria['cat_name'];
                echo '<form action="" method="post">';
                echo '<tr>';
                echo '<td><a class="titulo-Categoría" href="index2.php?action=listarTemas&controller=controller_tema&id_categoria='.$cat_id.'&cat_name='.$cat_name.'" >', $categoria['cat_name'], '</a></td>';
                if (isset($_SESSION['u_level']))
                    if($_SESSION['u_level'] == 0 ):
                        echo '<td><a class="boton"  type="submit" href="index2.php?id_categoria=' . $cat_id . '&action=eliminarCategoriaController&controller=controller_categorie">Borrar</a></td>';
                        echo '<td><a class="boton"  type="submit" href="index2.php?id_categoria=' . $cat_id . '&cat_name='.$cat_name.'&action=formularioModificarCategoria&controller=controller_categorie">Modificar</a></td>';
                    endif;
                echo '</tr>';
                echo '</form>';
            }
            echo '</table>';

        }

        ?>
    </div>
    </div>

<?php include "footer.php";
