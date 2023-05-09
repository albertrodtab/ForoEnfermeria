<?php include "header1.php"; ?>

<!--Página que muestra un formulario para contactar con el CAU del Foro-->
<section></section>
    <div class=="body">

            <h1>Contacto</h1>

            <div class="formulario">
                    <form action="index2.php?action=contact&controller=controller_consulta" method="post">
                    <div class="form">
                        <input type="text" name="user" placeholder="Alias" class="form-input"><br/>
                        <input type="password" name="password" placeholder="Contraseña" class="form-input"><br/>
                        <input type="text" name="email" placeholder="Email" class="form-input"><br/>
                        <input type="text" name="descripcion" placeholder="Escriba aquí su consulta" class="form-input"><br/>
                        <input type='submit' name='submit' value='Enviar' class="form-boton">
                    </div>
                </form>
            </div>
    </div>
</section>

<?php require_once "footer.php" ?>


