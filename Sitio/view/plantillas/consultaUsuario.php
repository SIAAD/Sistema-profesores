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
	
		$codigo = $_SESSION['codigo'];
		$contenido = parent::generarHead();
		$contenido .= parent::generaHeader($codigo);
		$contenido .= parent::generarNav2();
		$contenido .= '<h1>Usuario</h1><br><table class="table table-striped"><tr>';
		
		if(CtrlStr::esAdmin($_SESSION['roles'])){
			$contenido.='<th>Eliminar</th>';
		}
		$contenido.='<th>Usuario</th><th>Correo</th><th>Roles</th></tr>';
		$idUsuario = '';
		while ($fila = $res -> fetch_assoc()) {
			if(CtrlStr::esAdmin($_SESSION['roles'])){
				if($idUsuario!=$fila['idUsuarios']){
					$contenido.='<tr><td><input type="checkbox" id="idUsuarios" name="idUsuarios[]" value="'.$fila['idUsuarios'].'" onclick="marca();">'.'</td><td>'.$fila['nombre'].'</td><td>'.$fila['correo'].'</td><td>'.$fila['descripcion'].'</td>';	
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
		
		$contenido.='</table></br><div id="mensaje"></div>';
		
		
		if(CtrlStr::esAdmin($_SESSION['roles'])){
			$contenido.='<button type="eliminar" onclick="eliminar();">Eliminar Seleccionados</button><br>';	
			$contenido.='<a href="index.php?controlador=Admin&accion=alta&objeto=usuario">Vinculo alta usuario</a></br>';
		}
		$contenido.='<a href="index.php">Vinculo pagina principal</a>';
		$res -> free();
		$contenido .=parent::generaFooter();
		
		$contenido .="<script>
				var eliminados = new Array();
				
				function marca(checkbox){
					$(\"input[name='idUsuarios[]']:checked\").each(function() {
						eliminados.push($(this).val());
					});
				}
				
				
				function eliminar(){
						//Probar que muestre los checkboxes, sus valores
					if(confirm(\"Desea Eliminar Los Registros?\")){
						$.ajax({
							url		: 'index.php?controlador=Admin&accion=baja&objeto=usuarios',
							type	: 'post',
							dataType: 'text',
							data	: 'idUsuarios='+eliminados,
							success : function(res){
								$(\"input[name='idUsuarios[]']:checked\").each(function() {
									$(this).parent().parent().hide();
									$('#mensaje').html(res);	
								});
								
							},error: function(){
								//alert('No se encontro el archivo');
							}
						})
					}
				}
				
				function editar(id){
					$('#contenido').load(\"editar_admin.php?idA=\"+id+\"\");
				}
				
				function ver(id){
					$('#contenido').load(\"ver_admin.php?idA=\"+id+\"\");
				}
				
				
				
				
		</script>";
		
		return $contenido;
	}
}
?>