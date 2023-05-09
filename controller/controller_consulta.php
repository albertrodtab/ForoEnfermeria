<?php


function mostrarFormContacto()
{

    require "view/user_contacto.php";
}
$name = '';
$message = '';
function contact()
{
    require_once "model/model_consulta.php";

    //Con esto evito que me lance un warning cuando el formulario aún no tiene datos.
    if (isset($_POST['submit'])) {

        $consulta = new consulta($_POST['user'], $_POST['password'], $_POST['email'], $_POST['descripcion']);
        $name = $_POST['user'];
        $email =$_POST['email'];
        $password = $_POST['password'];
        //Comprobamos que los campos no estén vacíos
        if ($_POST['user'] == '' || $_POST['password'] == '' || $_POST['email'] == '') {
            echo '<script>alert("Debe rellenar todos los campos");window.location.href="index2.php?action=mostrarFormContacto&controller=controller_consulta"</script>';

        }
        //Comprobamos que la dirección de correo sea valida
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("Introduzca un formato de correo electrónico válido");window.location.href="index2.php?action=mostrarFormContacto&controller=controller_consulta"</script>';
        } else {

            $consulta->enviar($consulta);
            echo '<script>alert("Su consulta se ha enviado correctamente.");window.location.href="index2.php?action=mostrarFormContacto&controller=controller_consulta"</script>';

        }
    }

}



