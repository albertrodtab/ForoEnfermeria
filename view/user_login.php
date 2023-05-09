<?php
require_once "header1.php" ?>

<!--Página que muestra un formulario para iniciar sesion-->

<section></section>
    <div class=="body">

            <h1>Login de usuario</h1>


        <p>
            Para acceder a la página debes iniciar sesión primero con tu nombre de usuario y contraseña.<br>
        </p>
            <div class="formulario">
                <form action="index2.php?action=logIn&controller=controller_usuario" method="post">
                    <div class="form">
                        <input type="text" name="user" placeholder="Usuario" class="form-input"><br/>
                        <input type="password" name="password" placeholder="Contraseña" class="form-input"><br/>
                        <input type='submit' name='submit' value='Iniciar sesión' class="form-boton">
                    </div>
                </form>
            </div>

    </div>
</section>


<?php require_once "footer.php" ?>


