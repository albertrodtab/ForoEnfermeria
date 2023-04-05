<?php include "header2.php"; ?>

<!--Página que muestra un formulario para contactar con el CAU del Foro-->
<body>
<div id="contenedor">
    <header>
        <h1>Contacto</h1>
    </header>
    <form action="" method="post">
        <div class="formulario">
            <form action="" method="post">
                <div class="form">
                    <input type="text" name="user" placeholder="Alias" class="form-input"><br/>
                    <input type="password" name="password" placeholder="Contraseña" class="form-input"><br/>
                    <input type="text" name="email" placeholder="Email" class="form-input"><br/>
                    <input type="text" name="descripcion" placeholder="Escriba aquí su consulta" class="form-input"><br/>
                    <input type='submit' name='submit' value='Enviar' class="form-boton">
                </div>
                <?php
                include "../controller/sesion.php";
                include "../controller/consulta.php";

                //Con esto evito que me lance un warning cuando el formulario aún no tiene datos.
                if($_SERVER["REQUEST_METHOD"] == "POST") {

                    $consulta = new consulta($_POST['user'], $_POST['password'], $_POST['email'], $_POST['descripcion']);
                    //Comprobamos que los campos no estén vacíos
                    if ($_POST['user'] == '' || $_POST['password'] == '' || $_POST['email'] == '') {
                        echo "<div class='form'>Por favor, introduce todos los campos requeridos</div>";
                    }
                    //Comprobamos que la dirección de correo sea valida
                    if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                        echo "<div class='form'> La dirección de correo electrónico " . $_POST['email'] . " es inválida. Por favor, introduzca una correcta.</div>";
                    }else {

                        $consulta->enviar($consulta);
                        echo "<div class='form'> Su consulta ha sido registrada con éxito, le haremos llegar una respuesta al correo indicado.</div>";

                    }
                }

                ?>
            </form>
        </div>
</div>
</body>
</html>

