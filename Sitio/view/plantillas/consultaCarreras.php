<?php
/** @author:Jorge Eduardo Garza Martinez
 * @since: 26/Ene/2015
 * @version BETA
 */ 
if(file_exists('View/plantillas/PlantillaStr.php'))require_once 'View/plantillas/PlantillaStr.php';
else exit();

class ConsultaCarreras extends PlantillaStr {
	public function generaPagina($res) {
	
		$codigo = $_SESSION['codigo'];
		
		$contenido = parent::generarHead();
		$contenido .= parent::generaHeader($codigo);
		$contenido .= parent::generarNav2();
		
		$contenido .= '<h3>Carreras</h3><hr><table><thead><tr>';
		
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
		$contenido.='</tbody></table></br>';
		
		$contenido.="Total de Carreras en el sistemas: ".$res->num_rows."<br>";
		
		$contenido.='<a href="index.php">Vinculo pagina principal</a></br>';
		if(CtrlStr::esAdmin($_SESSION['roles'])|| CtrlStr::esAsis($_SESSION['roles']) || CtrlStr::esJefDep($_SESSION['roles'])){
			$contenido.='<button type="eliminar">Eliminar Seleccionados</button><br>';	
			$contenido.='<a href="index.php?controlador=Estructura&accion=alta&objeto=carrera">Vinculo alta carrera</a>';
		}
		$res -> free();
		
		$contenido.=parent::generaFooter();
		return $contenido;
	}
}
?>