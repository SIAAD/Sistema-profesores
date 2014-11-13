<?php /**
 * @author:Jesus Alberto Ley Ayón & Jorge Eduardo Garza
 * @since: 09/Oct/2014
 * @version ALFA
 */

//creamos la sesion
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if (!isset($_SESSION['codigo'])) {
	header('Location: view/login.html');
	exit();
}

if (!isset($_GET['controlador'])&& empty($_GET['controlador'])) {	
	header("Location: view/paginaInicio.php");
} else {
	$controlador = $_GET['controlador'] . 'Ctrl';
	if (preg_match("/[A-Za-z]+/",$_GET['controlador'])) {
		if (file_exists("Ctrl/$controlador.php")) {
			require_once("Ctrl/$controlador.php");
			$ctrl = new $controlador();
			//var_dump($ctrl);
			$ctrl -> ejecutar();
		} else {
			$error = "$controlador no es un controlador valido";
			require_once ('VISTAS/ERRORES/opcionInvalida.html');
		}
	} else {
		//ctrl default
		//require_once ('ctrl/alumnosCtrl.php');
		//$ctrl = new alumnosCtrl();
	}
}

?>
