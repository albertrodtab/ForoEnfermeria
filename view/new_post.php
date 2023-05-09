<?php
include "header1.php";
?>

<section>

    <div class="body">

        <h1>Añadir un nuevo mensaje al tema.</h1>

        <!--Formulario para anadir los mensajes-->
        <form class="formulario" method="post" action="index2.php?action=anadirMensaje&controller=controller_mensaje&id_tema=<?php echo $_GET['id_tema']?>&titulo_tema=<?php echo $_GET['titulo_tema']?>">
            <div class="form">
                <textarea name="texto" class="form-input-area" placeholder="Introduce el comentario"></textarea>
                <input type="submit" name="submit" value="Añadir mensaje" class="form-boton">
            </div>
        </form>
    </div>



</section>

<?php include "footer.php";
