<?php /**
 * @author:Jorge Eduardo Garza
 * @since: 02/Dic/2014
 * @version BETA SOPORTE DE COOKIES
 */
//require_once('view/plantillas/paginaInicio.php');
//$inicio= new PaginaInicio();

require_once 'View/Twig/Autoloader.php';
Twig_Autoloader::register();
$loader = new Twig_Loader_Filesystem('view/plantillas');
$twig = new Twig_Environment($loader, array(
//'cache' => '/path/to/compilation_cache',
));

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
	//header("Location: view/plantillas/paginaInicio.php");
	//$inicio->generaPagina(NULL);
	if (isset($_SESSION['codigo'])){
		//var_dump($_SESSION);
		//exit();
		
		$codigo=$_SESSION['codigo'];
		$idUsuario=$_SESSION['idUsuario'];
		$rol=$_SESSION['roles'];
		echo $twig -> render('index.html', array('codigo'=>$codigo,'idUsuario'=>$idUsuario,'rol'=>min($rol)));
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
		if (isset($_SESSION['codigo'])) echo $twig -> render('index.html', array('codigo'=>$_SESSION['codigo'],'idUsuario'=>$_SESSION['idUsuario'],'rol'=>min($_SESSION['roles'])));
		else echo $twig -> render('index.html', array());
		//header("Location: view/plantillas/paginaInicio.php");
		//ctrl default
		//require_once ('ctrl/alumnosCtrl.php');
		//$ctrl = new alumnosCtrl();
	}
}

//}
?>
