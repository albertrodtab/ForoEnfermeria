<?php
require "header2.php" ?>

<!--Página que muestra un formulario para iniciar sesion-->

<div id="contenedor">
    <header>
        <h1>Login de usuario</h1>
    </header>
    <body>
    <p>
        Para acceder a la página debes iniciar sesión primero con tu nombre de usuario y contraseña.<br>
    </p>
    <form action="" method="post">
        <div class="formulario">
            <form action="" method="post">
                <div class="form">
                    <input type="text" name="user" placeholder="Usuario" class="form-input"><br/>
                    <input type="password" name="password" placeholder="Contraseña" class="form-input"><br/>
                    <input type='submit' name='submit' value='Iniciar sesión' class="form-boton">
                </div>

                <?php
                include "../controller/sesion.php";
                include "../model/usuario.php";

                //Con esto evito que me lance un warning cuando el formulario aún no tiene datos.
                if($_SERVER["REQUEST_METHOD"] == "POST") {

                    $user = new usuario($_POST['user'], $_POST['password'], null);

                    $user->verificar($_POST['user'], $_POST['password']);
                    $sesion = new Sesion();
                    $sesion->set('user', $_POST['user']);
                    header("Location:index_logeado.php");
                }

                ?>

            </form>
        </div>
    </form>
    </body>
</div>


<?php require "footer.php" ?>
</html>

