<?php
include "header1.php";
?>

<section>

    <div class="body">

        <h1>modificar Categoría de consulta al foro</h1>
        <?php $id_categoria = $_GET['id_categoria'] ?>
        <form class="formulario" action="index2.php?id_categoria=<?php echo urlencode($_GET['id_categoria']) ?>&action=modificarCategoriaController&controller=controller_categorie" method="post">
            <div class="form">
                <input type="text" name="cat_name" placeholder="Titulo de la Categoria" value="<?php echo $_GET['cat_name'] ?>" class="form-input">
                <input type="submit" name="submit" value="Modificar Categoría" class="form-boton">
            </div>
        </form>

    </div>

</section>

<?php include "footer.php";
