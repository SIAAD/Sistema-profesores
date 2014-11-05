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


if(!isset($_SESSION['controlador'])){
	//echo '<h1>BIENVENIDO</h1><a href="logout.php">Cerrar Sesion</a>';
	//header("Location: view/paginaInicio.php");
	//var_dump($_SESSION);
	
}



if (!isset($_GET['controlador'])) {
	header("Location: view/paginaInicio.php");
} else {
	if (isset($_GET['controlador']) && preg_match("/[A-Za-z]+/",$_GET['controlador'])) {
		$controlador = $_GET['controlador'] . 'Ctrl';
		
		if (file_exists("ctrl/$controlador.php")) {
			require_once("ctrl/$controlador.php");
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



