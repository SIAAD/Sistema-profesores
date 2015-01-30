<?php

/** @author:Jesus Alberto Ley Ayón & Jorge Eduardo Garza Martinez
 * @since: 20/Oct/2014
 * @version ALFA
 */
 
if (file_exists('View/plantillas/PlantillaStr.php')) {
	require_once 'View/plantillas/PlantillaStr.php';
} else {
	exit();
}
class PaguinaPrincipal extends PlantillaStr {
	public function generaPagina($res) {

	}

}
if (session_id() == '')session_start();
$codigo = $_SESSION['codigo'];
$roles = $_SESSION['roles'];

echo "<h1>BIENVENIDO $codigo</h1><a href='../../logout.php'>Cerrar Sesion</a>";
echo "<h2>Cargando pagina de inicio personalizada</h2>";

var_dump($_COOKIE);
?>
<a href="../../index.php?controlador=Estructura&accion=alta&objeto=carrera">Vinculo alta carrera</a>
<br/>
<a href="../../index.php?controlador=Estructura&accion=consulta&objeto=carreras">Vinculo mostrar Carreras</a>
<br/>
<a href="../index.php?controlador=Admin">Vinculo para admin con accion alta</a>

