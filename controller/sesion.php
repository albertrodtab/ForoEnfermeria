<?php
class Sesion {

    //Iniciamos la sesión
    function __construct() {
        session_start();
    }

    //Método para registrar las variables de la sesión.
    public function set($nombre, $valor, $u_level, $valor2) {
        $_SESSION[$nombre] = $valor;
        $_SESSION[$u_level] = $valor2;
        }

    //Borra la sesión y vuelve a la página inicial
    public function borrar_sesion() {
        $_SESSION = array();
        session_destroy();
        header("Location: index2.php");
    }
}

