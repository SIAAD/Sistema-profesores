<?php
/** @author:Jorge Eduardo Garza Martinez
 * @author: Jesus Alberto Ley Ayón
 * @since: 26/Ene/2014
 * @version BETA
 */ 
if (file_exists('PlantillaStr.php'))require_once 'PlantillaStr.php';
else exit();

class PaguinaPrincipal extends PlantillaStr {
	public function generaPagina($res) {

	}

}
if (session_id() == '')session_start();
$codigo = $_SESSION['codigo'];
$roles = $_SESSION['roles'];

echo "<h1>BIENVENIDO $codigo</h1><a href='../../logout.php'>Cerrar Sesion</a>";

var_dump($_COOKIE);
?>
<ul>
	<li>
		<h2>Estructura</h2>
		<ul>
			<li><a href="../../index.php?controlador=Estructura&accion=alta&objeto=carrera">Vinculo alta carrera</a></li>
			<li><a href="../../index.php?controlador=Estructura&accion=consulta&objeto=carreras">Vinculo mostrar Carreras</a></li>
		</ul>		
	</li>
	<li>
		<h2>Usuarios</h2>
		<ul>
			<li>Alta Usuario</li>
			<li>Baja Usuario</li>
		</ul>
	</li>
</ul>



