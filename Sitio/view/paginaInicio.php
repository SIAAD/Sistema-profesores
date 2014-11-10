<?php

/** @author:Jesus Alberto Ley Ayón & Jorge Eduardo Garza Martinez
 * @since: 20/Oct/2014
 * @version ALFA
 */
    session_start();
	$codigo=$_SESSION['codigo'];
    $roles = $_SESSION['roles'];
	
	echo "<h1>BIENVENIDO $codigo</h1><a href='../logout.php'>Cerrar Sesion</a>";
	echo "<h2>Cargando pagina de inicio personalizada</h2>";
	//var_dump($_SESSION);
	//var_dump($_SERVER);
	//$menuPrincipal=

?>
	<a href="../index.php?controlador=Estructura&accion=alta">Vinculo alta carrera</a>
	<br/>
	<a href="../ctrl/AdminCtrl.php?accion='alta'">Vinculo para admin con accion alta</a>