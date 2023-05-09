<?php
include "header1.php";
?>

<section>

    <div class="body">

        <h1>Añadir un nuevo tema de consulta al foro</h1>

        <form class="formulario" method="post" action="index2.php?action=anadirTema&controller=controller_tema&id_categoria=<?php echo $_GET['id_categoria']?>&cat_name=<?php echo $_GET['cat_name']?>">
            <div class="form">
                <input type="text" name="titulo" placeholder="Titulo del tema" class="form-input">
                <input type="submit" name="submit" value="Añadir tema" class="form-boton">
            </div>
        </form>

    </div>

</section>

<?php include "footer.php";
