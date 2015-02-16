<?php
/** @author:Jesus Alberto Ley Ayon
 * @since: 26/Ene/2015
 * @version BETA
 */ 
if(file_exists('View/plantillas/PlantillaStr.php'))require_once 'View/plantillas/PlantillaStr.php';
else exit();

class ConsultaCarreras extends PlantillaStr {
	public function generaPagina($res) {

		$contenido = '<table><tr><th>Carrera</th><th>Clave</th><th>Acciones</th></tr>';

		while ($fila = $res -> fetch_assoc()) {
			$contenido=$contenido.'<tr><td>'.$fila['nombre'].'</td><td>'.$fila['clave'].'</td></tr>';
		}
		$contenido=$contenido.'</table></br>';
		$contenido=$contenido.'<a href="index.php">Vinculo pagina principal</a></br>';
		if(CtrlStr::esAdmin($_SESSION['roles'])|| CtrlStr::esAsis($_SESSION['roles']) || CtrlStr::esJefDep($_SESSION['roles'])){
			$contenido=$contenido.'<a href="index.php?controlador=Estructura&accion=alta&objeto=carrera">Vinculo alta carrera</a>';
		}
		$res -> free();
		return $contenido;
	}
}
?>