
<?php
require "sesion.php";
//global $Sesion;

function registrarUsuario()
    {
        require('model/model_usuario.php');
        require ('view/user_register.php');

            $sesion = new Sesion();
            $sesion->borrar_sesion();
        if (isset($_POST['submit'])) {
            $usuario = new Usuario($_POST['user'], $_POST['password'], $_POST['email']);
            //$usuario->nuevo($usuario);
           if (empty($_POST['user']) || empty($_POST['password']) || empty($_POST['email'])) {
            echo '<script>alert("Debe rellenar todos los campos");window.location.href="index2.php?action=mostrarRegister&controller=controller_usuario"</script>';

        }
        //Comprobamos que la dirección de correo sea valida
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo '<script>alert("Introduzca un formato de correo electrónico válido");window.location.href="index2.php?action=mostrarRegister&controller=controller_usuario"</script>';
        }else {
            $usuario->nuevo($usuario);
            echo '<script>alert("Registro Realizado con Exito");window.location.href="index2.php?action=mostrarLogIn&controller=controller_usuario"</script>';
        }

    }
    }


function logIn()
{
    require('model/model_usuario.php');

    //Verificacion de que el usuario existe al hacer login y se crea una nueva sesion
    if (isset($_POST['submit'])) {
        if (empty($_POST['user']) || empty($_POST['password'])) {
            echo '<script>alert("Por favor ingrese un nombre de usuario y contraseña");window.location.href="index2.php?action=mostrarLogIn&controller=controller_usuario"</script>';
            return;
        }

        //Verificamos usuario, contraseña y creamos la sesión
        $usuario = new usuario($_POST['user'], $_POST['password'], null);
        if ($usuario->verificar($_POST['user'], $_POST['password'])) {
            $user_lv = $usuario->getUserLevel($_POST['user']);
            $sesion = new Sesion();
            $sesion->set('user', ($_POST['user']), 'u_level', $user_lv);
            header("Location:index2.php");
        } else {
            echo '<script>alert("Nombre de usuario o contraseña incorrectos");window.location.href="index2.php?action=mostrarLogIn&controller=controller_usuario"</script>';
        }
    }
}

function mostrarLogin()
{

    require "view/user_login.php";
}

function mostrarRegister()
{
    require "view/user_register.php";
}

function cerrarSesion(){
    $sesion = new Sesion();
    $sesion->borrar_sesion();
}


