<?php
/** @author:Jorge Eduardo Garza Martinez
 * @since: 26/Ene/2015
 * @version BETA
 */ 
if(file_exists('View/plantillas/PlantillaStr.php'))require_once 'View/plantillas/PlantillaStr.php';
else exit();

class ConsultaCarreras extends PlantillaStr {
	public function generaPagina($res) {
	
		$contenido = parent::generarHead();
		$contenido .= '<h1>Carreras</h1><br><table><tr>';
		
		if(CtrlStr::esAdmin($_SESSION['roles'])|| CtrlStr::esAsis($_SESSION['roles']) || CtrlStr::esJefDep($_SESSION['roles'])){
			$contenido.='<th>Eliminar</th>';
		}
		$contenido.='<th>Carrera</th><th>Clave</th></tr>';

		while ($fila = $res -> fetch_assoc()) {
			
			if(CtrlStr::esAdmin($_SESSION['roles'])|| CtrlStr::esAsis($_SESSION['roles']) || CtrlStr::esJefDep($_SESSION['roles'])){
				$contenido.='<tr><td><input type="checkbox" id="idCarrera" name="id_carrera" value="'.$fila['idCarreras'].'">'.'</td><td>'.$fila['nombre'].'</td><td>'.$fila['clave'].'</td></tr>';
			}else{
				$contenido.='<tr><td>'.$fila['nombre'].'</td><td>'.$fila['clave'].'</td></tr>';
			}
		}
		$contenido.='</table></br>';
		
		$contenido.='<a href="index.php">Vinculo pagina principal</a></br>';
		if(CtrlStr::esAdmin($_SESSION['roles'])|| CtrlStr::esAsis($_SESSION['roles']) || CtrlStr::esJefDep($_SESSION['roles'])){
			$contenido.='<button type="eliminar">Eliminar Seleccionados</button><br>';	
			$contenido.='<a href="index.php?controlador=Estructura&accion=alta&objeto=carrera">Vinculo alta carrera</a>';
		}
		$res -> free();
		return $contenido;
	}
}
?>