<?php
if (file_exists('View/plantillas/PlantillaStr.php')) {
	require_once 'View/plantillas/PlantillaStr.php';
} else {
	exit();
}
class ConsultaCarreras extends PlantillaStr {
	public function generaPagina($res) {

		$contenido = '<table><tr><th>Departamento</th><th>Clave</th><th>Acciones</th></tr>';

		while ($fila = $res -> fetch_assoc()) {
			$contenido=$contenido.'<tr><td>'.$fila['nombre'].'</td><td>'.$fila['clave'].'</td></tr>';
		}
		$contenido=$contenido.'</table>';
		$res -> free();
		return $contenido;
	}

}
?>