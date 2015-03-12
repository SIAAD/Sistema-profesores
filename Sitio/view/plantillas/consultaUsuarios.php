<?php
/** @author:Jesus Alberto Ley Ayon
 * @since: 17/Feb/2015
 * @version BETA
 */ 
if(file_exists('View/plantillas/PlantillaStr.php'))require_once 'View/plantillas/PlantillaStr.php';
else exit();

class ConsultaUsuarios extends PlantillaStr {
	public function generaPagina($res) {
	
		$contenido = parent::generarHead();
		$contenido .= '<h1>Usuarios</h1><br><table><tr>';
		
		if(CtrlStr::esAdmin($_SESSION['roles'])){
			$contenido.='<th>Eliminar</th>';
		}
		$contenido.='<th>Usuario</th><th>Correo</th></tr>';

		while ($fila = $res -> fetch_assoc()) {
			
			if(CtrlStr::esAdmin($_SESSION['roles'])){
				$contenido.='<tr><td><input type="checkbox" id="idUsuarios" name="idUsuarios" value="'.$fila['idUsuarios'].'">'.'</td><td>'.$fila['nombre'].'</td><td>'.$fila['correo'].'</td></tr>';
			}else{
				$contenido.='<tr><td>'.$fila['nombre'].'</td><td>'.$fila['correo'].'</td></tr>';
			}
		}
		$contenido.='</table></br>';
		
		$contenido.='<a href="index.php">Vinculo pagina principal</a></br>';
		if(CtrlStr::esAdmin($_SESSION['roles'])){
			$contenido.='<button type="eliminar">Eliminar Seleccionados</button><br>';	
			$contenido.='<a href="index.php?controlador=Admin&accion=alta&objeto=usuario">Vinculo alta usuario</a>';
		}
		$res -> free();
		return $contenido;
	}
}
?>