<?php /**
 * @author:Jorge Eduardo Garza
 * @since: 02/Dic/2014
 * @version BETA SOPORTE DE COOKIES
 */

//creamos la sesion
session_start();
//validamos si se ha hecho o no el inicio de sesion correctamente
//si no se ha hecho la sesion nos regresará a login.php
if (!isset($_SESSION['codigo'])) {
	
	//checar si existe cokie
		//si existe cargar sesion con la informacion de la cookie
		
		//si no dirigerse a login
	header('Location: view/formularios/login.html');
}

if (!isset($_GET['controlador'])&& empty($_GET['controlador'])) {	
	header("Location: view/paginaInicio.php");
} else {
	$controlador = $_GET['controlador'] . 'Ctrl';
	if (preg_match("/[A-Za-z]+/",$_GET['controlador'])) {
		if (file_exists("Ctrl/$controlador.php")) {
			require_once("Ctrl/$controlador.php");
			$ctrl = new $controlador();
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
