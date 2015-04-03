<?php /**
 * @author:Jorge Eduardo Garza
 * @since: 02/Dic/2014
 * @version BETA SOPORTE DE COOKIES
 */
require_once 'View/Twig/Autoloader.php';

Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('view/plantillas');
$twig = new Twig_Environment($loader, array(
//'cache' => '/path/to/compilation_cache',
));
$diccionario= array();

/*
 //creamos la sesion
 if (session_id() == '')session_start();
 //validamos si se ha hecho o no el inicio de sesion correctamente
 //si no se ha hecho la sesion nos regresará a login.php
 if (!isset($_SESSION['codigo'])) {

 //checar si existe cokie
 //si existe cargar sesion con la informacion de la cookie

 //si no dirigerse a login
 header('Location: view/formularios/login.html');
 } else {*/
if (session_id() == '')session_start();
if (!isset($_GET['controlador']) && empty($_GET['controlador'])) {
	if (isset($_SESSION['codigo'])){		
		$diccionario['codigo']=$_SESSION['codigo'];
		$diccionario['idUsuario']=$_SESSION['idUsuario'];
		$diccionario['rol']=min($_SESSION['roles']);
		echo $twig -> render('index.html', $diccionario);
	}else echo $twig -> render('index.html', array());
} else {
	$controlador = $_GET['controlador'] . 'Ctrl';
	if (preg_match("/[A-Za-z]+/", $_GET['controlador'])) {
		if (file_exists("Ctrl/$controlador.php")) {
			require_once ("Ctrl/$controlador.php");
			$ctrl = new $controlador();
			$ctrl -> ejecutar();
		} else {
			$error = "$controlador no es un controlador valido";
			require_once ('VISTAS/ERRORES/opcionInvalida.html');
		}
	} else {
		if (isset($_SESSION['codigo'])) echo $twig -> render('index.html', $diccionario);
		else echo $twig -> render('index.html', array());
	}
}

//}
?>
