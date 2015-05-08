<?php
$path=dirname(dirname(__FILE__)).'\plantillas\PlantillaStr.php';
if(file_exists($path))require_once $path;
else exit();
class AltaUsuario extends PlantillaStr {
	public function generaPagina($datos) {
		$codigo = $_SESSION['codigo'];
		$contenido = parent::generarHead();
		$contenido .= parent::generaHeader($codigo);
		$contenido .= parent::generarNav2();
		
		$contenido .= "<body>
		<h2><a href='index.php?controlador=Admin&accion=consulta&objeto=usuarios'>Lista de Usuarios</a></h2>
		<div>
			<form class='span8' name='form01' id='form01' method='post' action='index.php?controlador=Admin&accion=alta&objeto=usuario'>
				<fieldset>
					<legend>Alta Usuario</legend>
					<label for='nombreUsuario'>Codigo</label>
					<input type='text' name='nombreUsuario' id='nombreUsuario' placeholder='Codigo' maxlength='7' onkeypress='return validar(event);' required='required'/>
					<label for='correo'>Correo</label>
					<input type='email' name='correo' id='correo' placeholder='Correo' required='required'>
					<h4>Roles</h4>
					<label for='maestro'>Maestro</label>
					<input type='checkbox' name='maestro' id='maestro' value='maestro' />
					<label for='asistente'>Asistente</label>
					<input type='checkbox' name='asistente' id='asistente' value='asistente'/>
					<label for='revisor'>Revisor</label>
					<input type='checkbox' name='revisor' id='revisor' value='revisor'/>
					<label for='jefe'>Jefe de Departamento</label>
					<input type='checkbox' name='jefe' id='jefe' value='jefe'/><br>
					<input type='submit' class='btn btn-default' name='enviar' id='enviar' />
				</fieldset>
			</form>
		</div>
		
		
	</body>";
	
	$contenido .=parent::generaFooter();
	
	$contenido .= "	
	<script>
	
		function validar(evento) {
			//propiedad which regresa cual tecla o boton de raton fue presionada
			evento = (evento) ? evento : window.event;
		    var charCode = (evento.which) ? evento.which : evt.keyCode;
		    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
		        return false;
		    }
		    return true;
		}
		
		//$('input[type=checkbox]').on('click',checkbox);
		var roles = new Array();
		
		
		
		
		$(document).ready(function(){
		  $('#form01').submit(function() {
		  	roles.length = 0;
		    $(\"input[type=checkbox]:checked\").each(function() {
				roles.push($(this).val());
			});
			var campo = $(this);
			//campo.attr('disabled','disabled');
			campo.removeAttr('disabled');
			console.log(roles);
			if(checarRoles(roles)){
				
			}
			else{
				return false;
			}	
		  });
		});
		
		
		function checarRoles(roles){
			
		}
		
		
		
		</script>";
		
		
		
		return $contenido;
	}
}
?>


