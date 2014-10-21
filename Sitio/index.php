<?php /**
 * @author:Jesus Alberto Ley Ayón & Jorge Eduardo Garza
 * @since: 09/Oct/2014
 * @version ALFA
 * @param usuario This describes to where the controller is passed to, there are 3 users 'alumno' 'maestro' 'admin'
 * @param accion This describes what action is taking depends on each user
 */

//creamos la sesion
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if (!isset($_SESSION['codigo'])) {
	header('Location: view/login.html');
	exit();
}
if(!isset($_SESSION['controlador'])){
	//echo '<h1>BIENVENIDO</h1><a href="logout.php">Cerrar Sesion</a>';
	header("Location: view/paginaInicio.php");
	//var_dump($_SESSION);
}

?>



