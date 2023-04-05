<?php
//Cierra la sesion iniciada
require_once "../controller/sesion.php";
$sesion = new Sesion();
$sesion->borrar_sesion();
?>
