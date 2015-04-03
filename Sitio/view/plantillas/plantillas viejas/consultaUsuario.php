<?php
/** @author:Jesus Alberto Ley Ayon
 * @since: 17/Feb/2015
 * @version BETA
 */ 
$path=dirname(__FILE__).'\PlantillaStr.php';
if(file_exists($path))require_once $path;
else exit();

class ConsultaUsuario extends PlantillaStr {
	public function generaPagina($res) {
	
		$contenido = parent::generarHead();
		$contenido .= '<h1>Usuario</h1><br><table><tr>';
		
		if(CtrlStr::esAdmin($_SESSION['roles'])){
			$contenido.='<th>Eliminar</th>';
		}
		$contenido.='<th>Usuario</th><th>Correo</th><th>Roles</th></tr>';
		$idUsuario = '';
		while ($fila = $res -> fetch_assoc()) {
			if(CtrlStr::esAdmin($_SESSION['roles'])){
				if($idUsuario!=$fila['idUsuarios']){
					$contenido.='<tr><td><input type="checkbox" id="idUsuarios" name="idUsuarios" value="'.$fila['idUsuarios'].'">'.'</td><td>'.$fila['nombre'].'</td><td>'.$fila['correo'].'</td><td>'.$fila['descripcion'].'</td>';	
				}
				else{
					$contenido.='<td>'.$fila['descripcion'].'</td>';
					
				}
			}else{
				if($idUsuario!=$fila['idUsuarios']){
					$contenido.='<tr id="'.$fila['idUsuarios'].'"><td>'.$fila['nombre'].'</td><td>'.$fila['correo'].'</td><td>'.$fila['descripcion'].'</td>';	
				}
				else{
					$contenido.='<td>'.$fila['descripcion'].'</td>';
					
				}
			}
			$idUsuario = $fila['idUsuarios'];
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