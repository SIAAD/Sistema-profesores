<?php
if (file_exists('View/plantillas/PlantillaStr.php')) {
	require_once 'View/plantillas/PlantillaStr.php';
} else {
	exit();
}
class ConsultaCarreras extends PlantillaStr {
	public function generaPagina($res) {
		$contenido='';
		while ($fila = $res -> fetch_assoc()) {
			$contenido=$contenido."<br>"."///" . $fila['nombre'] . "->" . $fila['clave'];
		}
		$res -> free();
		return $contenido;
	}

}
?>