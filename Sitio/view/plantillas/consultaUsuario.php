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
					$contenido.='<tr id="'.$fila['idUsuarios'].'"><td><input type="checkbox" id="idUsuarios" name="idUsuarios[]" value="'.$fila['idUsuarios'].'" onclick="marca();">'.'</td>
					<td><input type="text" name="nombreUsuario" id="nombreUsuario" value="'.$fila['nombre'].'" placeholder="Codigo" maxlength="7" disabled="" onkeypress="return validar(event);"/></td>
					<td><input type="email" name="correo" id="correo" value="'.$fila['correo'].'" placeholder="Correo" required="required" disabled=""></td>
					<td>'.$fila['descripcion'].'</td>';	
				}
				else{
					$contenido.='<td>'.$fila['descripcion'].'</td>';
					
				}
			}else{
				if($idUsuario!=$fila['idUsuarios']){
					$contenido.='<tr id="'.$fila['idUsuarios'].'">
					<td><input type="text" name="nombreUsuario" id="nombreUsuario" value="'.$fila['nombre'].'" placeholder="Codigo" maxlength="7" disabled="" onkeypress="return validar(event);"/></td>
					<td><input type="email" name="correo" id="correo" value="'.$fila['correo'].'" placeholder="Correo" required="required" disabled=""></td>
					<td>'.$fila['descripcion'].'</td>';	
				}
				else{
					$contenido.='<td>'.$fila['descripcion'].'</td>';
					
				}
			}
			$idUsuario = $fila['idUsuarios'];
		}
		
		$contenido.='</table></br><div id="mensaje"></div>';
		
		
		if(CtrlStr::esAdmin($_SESSION['roles'])){
			$contenido.='<button onclick="eliminar();">Eliminar Seleccionados</button><br>';	
			$contenido.='<button id="editar">Editar</button><br>';	
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
				/*
				$('input[type=text]').click(function(){
					var campo = $(this);
					console.log('asdasd');
					campo.attr('disabled','disabled');
					//campo.removeAttr('disabled');
				});*/
				
				/*$('input[type=email]').dblclick(function(){
					var campo = $(this);
					//console.log('asdasd');
					//campo.attr('disabled','disabled');
					//campo.prop('disabled',false);
					$('input[type=text]').prop('disabled',false);
				});*/
				
				$('#editar').click(function(){
					var boton = $(this);
					console.log('asdasd');
					$('input[type=text]').prop('disabled',false);
					$('input[type=email]').prop('disabled',false);
				})
				
				
				function validar(evento) {
					//propiedad which regresa cual tecla o boton de raton fue presionada
					evento = (evento) ? evento : window.event;
				    var charCode = (evento.which) ? evento.which : evt.keyCode;
				    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
				        return false;
				    }
				    return true;
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
				
				$('input').blur(function(){
			        var campo = $(this);
			        var parent = field.parent().attr('id');
			        field.css('background-color','#F3F3F3');
					/*efectos de edicion
			        if($('#'+parent).find('.ok').length){
			            $('#'+parent+' .ok').remove();
			            $('#'+parent+' .loader').remove();
			            $('#'+parent).append('<div><img src='images/loader.gif'/></div>').fadeIn('slow');
			        }else{
			            $('#'+parent).append('<div><img src='images/loader.gif'/></div>').fadeIn('slow');
			        }*/
			
			        var datos = 'valor='+campo.val()+'&campo='+campo.attr('name');
			        $.ajax({
			            type: 'POST',
			            url: 'edit.php',
			            data: datos,
			            success: function(res) {
			                field.val(res);//ver como hacerle para verificar las variables con funcion usada o una nueva
			            }
			        });
			    });
			});
				
				
				
				
		</script>";
		
		return $contenido;
	}
}
?>