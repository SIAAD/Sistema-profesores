<?php
/** @author:Jesus Alberto Ley Ayón & Jorge Eduardo Garza Martinez
 * @since: 20/Oct/2014
 * @version 1.0
 */
//Crear sesión
session_start();
//Vaciar sesión
$_SESSION = array();
//Destruir Sesión
session_destroy();
//Redireccionar a login.php
header("location: view/formularios/login.html");
?>