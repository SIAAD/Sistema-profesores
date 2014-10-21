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

if (!isset($_POST['controlador'])) {
	echo '<h1>BIENVENIDO</h1><a href="logout.php">Cerrar Sesion</a>';
	//echo '<h2>Cargando pagina de inicio personalizada</h2>';
	//var_dump($_SESSION);
	header("Location: view/paginaInicio.php");
} else {
	if (isset($_POST['ctrl']) && preg_match("/[A-Za-z]+/")) {
		$controlador = $_GET['ctrl'] . 'Ctrl';
		if (file_exists("ctrls/{$controlador}.php")) {
			require_once ("ctrls/{$controlador}.php");
			$ctrl = new $controlador();
		} else {
			$error = "{$_GET['ctrl']} no es un controlador valido";
			require_once ('VISTAS/ERRORES/opcionInvalida.html');
		}
	} else {
		//ctrl default
		require_once ('ctrls/alumnosCtrl.php');
		$ctrl = new alumnosCtrl();
	}
}
?>



