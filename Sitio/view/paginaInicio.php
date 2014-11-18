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

?>
	<a href="../index.php?controlador=Estructura&accion=alta&objeto=carrera">Vinculo alta carrera</a>
	<br/>

	<a href="../index.php?controlador=Admin&accion=alta&objeto=usuario">Vinculo para admin con accion alta</a>
	<br />
	<a href="../Objetos/conexion.php">Vinculo conexion</a>

