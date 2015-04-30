<?php
/** @author:Jesus Alberto Ley Ayon
 * @since: 17/Feb/2015
 * @version BETA
 */ 
if(file_exists('View/plantillas/PlantillaStr.php'))require_once 'View/plantillas/PlantillaStr.php';
else exit();

class ConsultaUsuarios extends PlantillaStr {
	public function generaPagina($res) {
		$codigo = $_SESSION['codigo'];
		$contenido = parent::generarHead();
		$contenido .= parent::generaHeader($codigo);
		$contenido .= parent::generarNav2();
		
		
		$contenido .= '<h1>Usuarios</h1><br><div class="table-responsive"><table class="table table-striped"><tr>';
		
		if(CtrlStr::esAdmin($_SESSION['roles'])){
			$contenido.='<th>Eliminar</th>';
		}
		$contenido.='<th>Usuario</th><th>Correo</th></tr>';

		while ($fila = $res -> fetch_assoc()) {
			
			if(CtrlStr::esAdmin($_SESSION['roles'])){
				$contenido.='<tr><td><input type="checkbox" id="idUsuarios'.$fila['idUsuarios'].'" name="idUsuarios[]" value="'.$fila['idUsuarios'].'" onclick="marca()">'.'</td><td><a href="index.php?controlador=Admin&accion=consulta&objeto=usuario&idUsuario='.$fila['idUsuarios'].'">'.$fila['nombre'].'</a></td><td>'.$fila['correo'].'</td></tr>';
			}else{
				$contenido.='<tr><td>'.$fila['nombre'].'</td><td>'.$fila['correo'].'</td></tr>';
			}
		}
		$contenido.='</table></div></br><div id="mensaje"></div>';
		
		$contenido.='<a href="index.php">Vinculo pagina principal</a></br>';
		if(CtrlStr::esAdmin($_SESSION['roles'])){
			$contenido.='<button onclick="eliminar()">Eliminar Seleccionados</button><br>';	
			$contenido.='<a href="index.php?controlador=Admin&accion=alta&objeto=usuario">Vinculo alta usuario</a>';
		}
		$res -> free();
		$contenido .=parent::generaFooter();
		
		$contenido .="<script>
		
				var eliminados = new Array();
				
				function marca(checkbox){
					
				}
				
				
				function eliminar(){
					$(\"input[name='idUsuarios[]']:checked\").each(function() {
						//eliminar elementos repetidos	
						eliminados.push($(this).val());
					});
					alert(eliminados);
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