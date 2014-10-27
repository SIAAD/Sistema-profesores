<?php

/** @author:Jesus Alberto Ley Ayón & Jorge Eduardo Garza Martinez
 * @since: 20/Oct/2014
 * @version ALFA
 */
    session_start();
	$codigo=$_SESSION['codigo'];
	echo "<h1>BIENVENIDO $codigo</h1><a href='../logout.php'>Cerrar Sesion</a>";
	echo '<h2>Cargando pagina de inicio personalizada</h2>';
	var_dump($_SESSION);
	
	//$menuPrincipal=

?>