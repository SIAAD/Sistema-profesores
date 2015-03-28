<?php
/** @author:Jorge Eduardo Garza Martinez
 * @since: 26/Ene/2015
 * @version BETA
 * @see PlantillaStr.php
 */ 
if(file_exists('View/plantillas/PlantillaStr.php'))require_once 'View/plantillas/PlantillaStr.php';
else exit();

class ConsultaCarreras extends PlantillaStr {
	public function generaPagina($res) {
		
		$contenido = parent::generarHead();
		$contenido .= parent::generaHeader($_SESSION['codigo']);
		$contenido .= parent::generarNav2();
		
		$contenido .= '<h3 class="sub-header">Carreras</h3><hr><div class="table-responsive"><table class="table table-striped"><thead><tr>';
		
		if(CtrlStr::esAdmin($_SESSION['roles'])|| CtrlStr::esAsis($_SESSION['roles']) || CtrlStr::esJefDep($_SESSION['roles'])){
			$contenido.='<th>Eliminar</th>';
		}
		$contenido.='<th>Carrera</th><th>Clave</th></tr></thead><tbody>';

		while ($fila = $res -> fetch_assoc()) {
			
			$contenido.='<tr>';
			if(CtrlStr::esAdmin($_SESSION['roles'])|| CtrlStr::esAsis($_SESSION['roles']) || CtrlStr::esJefDep($_SESSION['roles'])){
				$contenido.='<td><input type="checkbox" id="'.$fila['idCarreras'].'" name="id_carrera" value="'.$fila['idCarreras'].'">';
			}
			$contenido.='<td><a href="index.php?controlador=Estructura&accion=consulta&objeto=carrera&idCarrera='.$fila['idCarreras'].'&nombreCarrera='.$fila['nombre'].'">'.$fila['nombre'].'</td><td>'.$fila['clave'].'</td></tr>';
		}
		$contenido.='</tbody><tfoot><tr>';
		if(CtrlStr::esAdmin($_SESSION['roles'])|| CtrlStr::esAsis($_SESSION['roles']) || CtrlStr::esJefDep($_SESSION['roles'])){
			$contenido.='<th colspan="2">Total de Carreras</th><td>';
		}else{
			$contenido.='<th>Total de Carreras</th><td>';
		}
		$contenido.=$res->num_rows.'</td></tr></tfood></table></div></br>';
		
		if(CtrlStr::esAdmin($_SESSION['roles'])|| CtrlStr::esAsis($_SESSION['roles']) || CtrlStr::esJefDep($_SESSION['roles'])){
			$contenido.='<button class="btn btn-lg btn-primary btn-block" type="eliminar">Eliminar Seleccionados</button><br>';	
			$contenido.='<a class="btn btn-lg btn-primary btn-block" href="index.php?controlador=Estructura&accion=alta&objeto=carrera">Vinculo alta carrera</a>';
		}
		$res -> free();
		
		$contenido.=parent::generaFooter();
		return $contenido;
	}
}
?>