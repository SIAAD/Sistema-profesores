<?php
$path=dirname(dirname(__FILE__)).'\plantillas\plantillas viejas\PlantillaStr.php';

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
			<div id='mensaje'></div>
		</div>
		
		
	</body>";
	
	$contenido .=parent::generaFooter();
	
	$contenido .= "	
	<script>
	
		function validar(evento) {
			//propiedad which regresa cual tecla o boton de raton fue presionada
			evento = (evento) ? evento : window.event;
		    var charCode = (evento.which) ? evento.which : evento.keyCode;
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
				alert('checarRoles dio true y se da de alta');
				return true;
			}
			else{
				return false;
			}	
		  });
		});
		
		
		function checarRoles(roles){
			var error1 = ['maestro','asistente','revisor','jefe'];
			var error2 = ['asistente','jefe'];
			var error3 = ['revisor','jefe'];
			var error4 = ['maestro','revisor'];
			var error5 = ['jefe'];
			var error6 = ['revisor'];
			
			if (isArray(roles) && roles.length !=0 ) {
				if(roles.equals(error1) || roles.equals(error2) || roles.equals(error3) || roles.equals(error4) || roles.equals(error5) || roles.equals(error6)){
					$('#mensaje').html('Combinacion de roles invalidas');
					return false;
				}else{
					$('#mensaje').html('Dando de alta');
								
					//return true;	
				}
			}
			else {
				$('#mensaje').html('Seleccione roles');
				return false;
			}
		}
		
		function isArray(myArray) {
		    return myArray.constructor.toString().indexOf('Array') > -1;
		}
		
		
		//funcion para saber si 2 arrays son identicos
		Array.prototype.equals = function (array) {
		    // if the other array is a falsy value, return
		    if (!array)
		        return false;
		
		    // compare lengths - can save a lot of time 
		    if (this.length != array.length)
		        return false;
		
		    for (var i = 0, l=this.length; i < l; i++) {
		        // Check if we have nested arrays
		        if (this[i] instanceof Array && array[i] instanceof Array) {
		            // recurse into the nested arrays
		            if (!this[i].equals(array[i]))
		                return false;       
		        }           
		        else if (this[i] != array[i]) { 
		            // Warning - two different object instances will never be equal: {x:20} != {x:20}
		            return false;   
		        }           
		    }       
		    return true;
		}   
		
		
		</script>";
		
		
		
		return $contenido;
	}
}
?>


