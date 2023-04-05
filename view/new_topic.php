<?php
include "header.php";
require_once "../model/usuario.php";
require_once "../model/tema.php";
?>

<section>

    <div class="body">

        <h1>Añadir un nuevo tema de consulta al foro</h1>

        <form class="formulario" action="", method="post">
            <div class="form">
                <input type="text" name="titulo" placeholder="Titulo del tema" class="form-input">
                <input type="submit" name="submit" value="Añadir tema" class="form-boton">
            </div>
            <?php
            if (isset($_SESSION['user'])) {                                //Comprueba que la sesion esté iniciada
                if (isset($_POST['submit']) && isset($_POST['titulo'])) {   ////Comprueba que hay texto en el título y que se ha pulsado el botón de submit
                    $usuario = new usuario(null, null, null);
                    $id_usuario = $usuario->getId($_SESSION['user']);
                    $tema = new tema($id_usuario, $_POST['titulo']);
                    $tema->crearTema();
                    header("Location:index_logeado.php");
                } else {
                    echo "<div>Debes ponerle un titulo al tema</div>";
                }
            } else {
                echo "<div>Debes iniciar sesión para poder continuar</div>";
            }
            ?>
        </form>

    </div>

</section>

<?php include "footer.php";
