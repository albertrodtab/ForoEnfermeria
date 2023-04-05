<?php
require "header2.php" ?>

<!--Pagina que muestra un formulario para iniciar sesion-->

<div id="contenedor">
    <header>
        <h1>Registro de Usuario</h1>
    </header>
    <body>
    <p>
        Para registrarte necesitarás un nombre de usuario, una contraseña y una cuenta de correo electrónico.<br>

    </p>
    <form action="" method="post">
        <div class="formulario">
            <form action="" method="post">
                <div class="form">
                    <input type="text" name="user" placeholder="Usuario" class="form-input"><br/>
                    <input type="password" name="password" placeholder="Contraseña" class="form-input"><br/>
                    <input type="text" name="email" placeholder="Email" class="form-input"><br/>
                    <input type='submit' name='submit' value='Registrarse' class="form-boton">
                </div>

                <?php
                include "../controller/sesion.php";
                include "../model/usuario.php";

                //Con esto evito que me lance un warning cuando el formulario aún no tiene datos.
                if($_SERVER["REQUEST_METHOD"] == "POST") {

                    $user = new usuario($_POST['user'], $_POST['password'], $_POST['email']);
                    $user ->comprobaciones();
                    $user ->nuevo($user);
                    header("Location:user_login.php");
                }

                ?>

            </form>
        </div>
    </form>
    </body>
</div>


<?php require "footer.php" ?>
</html>

