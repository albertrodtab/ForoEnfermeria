<?php
include "header1.php";
?>

<section>

    <div class="body">

        <h1>Modificar mensaje</h1>
        <?php $id_post = $_GET['post_id'] ?>
        <form class="formulario" action="index2.php?id_post=<?php echo urlencode($_GET['post_id']) ?>&postBy=<?php echo urlencode($_GET['postBy']) ?>&action=modificarMensajeController&controller=controller_mensaje" method="post">
            <div class="form">
                <input type="text" name="post_name" placeholder="Titulo del tema" value="<?php echo $_GET['post_content'] ?>" class="form-input">
                <input type="submit" name="submit" value="Modificar Categoría" class="form-boton">
            </div>
        </form>

    </div>

</section>

<?php include "footer.php";
