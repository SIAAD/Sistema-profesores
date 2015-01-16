<?php
    while ($fila = $res->fetch_assoc()) {
		var_dump($fila);
        echo "///".$fila['nombre']."->".$fila['clave'];
	}
	$res->free();
?>