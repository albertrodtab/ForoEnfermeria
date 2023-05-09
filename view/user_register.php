<?php
require_once "header1.php" ?>

<!--Pagina que muestra un formulario para iniciar sesion-->

<section>
    <div class=="body">

            <h1>Registro de Usuario</h1>


        <p>
            Para registrarte necesitarás un nombre de usuario, una contraseña y una cuenta de correo electrónico.<br>
        </p>
            <div class="formulario">
                <form action="index2.php?action=registrarUsuario&controller=controller_usuario" method="post">
                    <div class="form">
                        <input type="text" name="user" placeholder="Usuario" class="form-input"><br/>
                        <input type="password" name="password" placeholder="Contraseña" class="form-input"><br/>
                        <input type="text" name="email" placeholder="Email" class="form-input"><br/>
                        <input type='submit' name='submit' value='Registrarse' class="form-boton">
                    </div>
                </form>

            </div>


    </div>
</section>


<?php require "footer.php" ?>


