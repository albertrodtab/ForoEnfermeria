<?php
include "header1.php";
?>

<section>

    <div class="body">

        <h1>Modificar Categoría de consulta al foro</h1>
        <?php $id_tema = $_GET['id_tema'] ?>
        <form class="formulario" action="index2.php?id_tema=<?php echo urlencode($_GET['id_tema']) ?>&topicBy=<?php echo urlencode($_GET['topicBy']) ?>&action=modificarTemaController&controller=controller_tema" method="post">
            <div class="form">
                <input type="text" name="topic_name" placeholder="Titulo del tema" value="<?php echo $_GET['titulo_tema'] ?>" class="form-input">
                <input type="submit" name="submit" value="Modificar Categoría" class="form-boton">
            </div>
        </form>

    </div>

</section>

<?php include "footer.php";
