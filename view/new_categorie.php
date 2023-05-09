<?php
include "header1.php";
?>

<section>

    <div class="body">

        <h1>Añadir una nueva Categoría de consulta al foro</h1>

        <form class="formulario" action="index2.php?action=anadirCategoria&controller=controller_categorie" method="post">
            <div class="form">
                <input type="text" name="titulo" placeholder="Titulo de la Categoria" class="form-input">
                <input type="submit" name="submit" value="Añadir Categoría" class="form-boton">
            </div>
        </form>

    </div>

</section>

<?php include "footer.php";
