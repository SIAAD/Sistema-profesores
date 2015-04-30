<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SIAAD</title>
		<link href="view/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<script src="view/bootstrap/js/jquery.js"></script>
		<script src="view/bootstrap/js/bootstrap.js"></script>
	</head>

	<body>
		<h2><a href="index.php?controlador=Admin&accion=consulta&objeto=usuarios">Lista de Usuarios</a></h2>
		<div>
			<form class="span8" name="form01" method="post" action="index.php?controlador=Admin&accion=alta&objeto=usuario">
				<fieldset>
					<legend>Alta Usuario</legend>
					<label for="nombreUsuario">Codigo</label>
					<input type="text" name="nombreUsuario" id="nombreUsuario" placeholder="Codigo" maxlength="7" onkeypress="return validar(event);" required="required"/>
					<label for="correo">Correo</label>
					<input type="email" name="correo" id="correo" placeholder="Correo" >
					<h4>Roles</h4>
					<label for="maestro">Maestro</label>
					<input type="checkbox" name="maestro" id="maestro" onclick="altaMaestro(this);" />
					<label for="asistente">Asistente</label>
					<input type="checkbox" name="asistente" id="asistente" on/>
					<label for="revisor">Revisor</label>
					<input type="checkbox" name="revisor" id="revisor" />
					<label for="jefe">Jefe de Departamento</label>
					<input type="checkbox" name="jefe" id="jefe" />
					<input type="submit" class="btn btn-default" name="enviar" id="enviar" />
				</fieldset>
			</form>
		</div>
		
		
	</body>
	
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
		
		function altaMaestro(casilla){
			//var marcado = $(casilla).prop("checked") ? true : false;
			
			//$(casilla).prop("checked"); 
			console.log($(casilla).prop("checked"));
		}
		
		
	</script>
</html>
