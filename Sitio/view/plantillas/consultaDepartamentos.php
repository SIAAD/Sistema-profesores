<?php
/** @author:Jorge Eduardo Garza Martinez
 * @since: 26/Ene/2015
 * @version BETA
 */ 
if(file_exists('View/plantillas/PlantillaStr.php'))require_once 'View/plantillas/PlantillaStr.php';
else exit();

class ConsultaDepartamento extends PlantillaStr {
	public function generaPagina($res) {
	
		$codigo = $_SESSION['codigo'];
		
		$contenido = parent::generarHead();
		$contenido .= parent::generaHeader($codigo);
		$contenido .= parent::generarNav2();
		$contenido .= '<h3>Departamentos</h3><hr><br><div class="table-responsive"><table class="table table-striped"><tr>';
		
		if(CtrlStr::esAdmin($_SESSION['roles'])|| CtrlStr::esAsis($_SESSION['roles']) || CtrlStr::esJefDep($_SESSION['roles'])){
			$contenido.='<th>Eliminar</th>';
		}
		$contenido.='<th>Departamento</th><th>Clave</th><th>Abreviacion</th><th>Jefe</th></tr>';

		while ($fila = $res -> fetch_assoc()) {
			//var_dump($fila);
			$contenido.='<tr>';
			if(CtrlStr::esAdmin($_SESSION['roles'])|| CtrlStr::esAsis($_SESSION['roles']) || CtrlStr::esJefDep($_SESSION['roles'])){
				$contenido.='<td><input type="checkbox" id="'.$fila['idDepto'].'" name="'.$fila['idDepto'].'" value="'.$fila['idDepto'].'">'.'</td>';
			}
			$contenido.='<td>'.$fila['nombreDepto'].'</td><td>'.$fila['claveDepto'].'</td><td>'.$fila['abreviacionDepto'].'</td><td>'.$fila['nombresMaestro'].' '.$fila['apellidosMaestro'].' ( '.$fila['codigoMaestro'].' )</td></tr>';
			
		}
		$contenido.='</table></div></br>';
		
		$contenido.='<a href="index.php">Vinculo pagina principal</a></br>';
		if(CtrlStr::esAdmin($_SESSION['roles'])|| CtrlStr::esAsis($_SESSION['roles']) || CtrlStr::esJefDep($_SESSION['roles'])){
			$contenido.='<button type="eliminar">Eliminar Seleccionados</button><br>';	
			$contenido.='<a href="index.php?controlador=Estructura&accion=alta&objeto=departamento">Vinculo alta departamento</a>';
		}
		$res -> free();
		
		$contenido.=parent::generaFooter();
		return $contenido;
	}
}
?>