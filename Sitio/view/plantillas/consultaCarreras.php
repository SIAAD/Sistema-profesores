<?php
if (file_exists('View/plantillas/PlantillaStr.php')) {
	require_once 'View/plantillas/PlantillaStr.php';
} else {
	exit();
}
class ConsultaCarreras extends PlantillaStr {
	public function generaPagina($res) {
		while ($fila = $res -> fetch_assoc()) {
			var_dump($fila);
			echo "///" . $fila['nombre'] . "->" . $fila['clave'];
		}
		$res -> free();
	}

}
?>