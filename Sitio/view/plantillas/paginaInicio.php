<?php
/** @author:Jorge Eduardo Garza Martinez
 * @author: Jesus Alberto Ley Ayón
 * @since: 26/Ene/2014
 * @version BETA
 */ 
 
require_once 'PlantillaStr.php';

if (session_id() == '')session_start();
$codigo = $_SESSION['codigo'];
$roles = $_SESSION['roles'];

echo "<h1>BIENVENIDO $codigo</h1><a href='../../logout.php'>Cerrar Sesion</a>";

var_dump($_COOKIE);

echo PlantillaStr::generarNav();
?>
