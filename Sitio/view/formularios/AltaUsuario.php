<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SIAAD</title>
		<link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
		<script src="jquery/jquery-1.8.3.min.js"></script>
	</head>

	<body>
		<a href="index.php?controlador=Admin&accion=consulta&objeto=usuarios">Lista de Usuarios</a>
		<div>
			<form class="span8" name="form01" method="post" action="index.php?controlador=Admin&accion=alta&objeto=usuario">
				<fieldset>
					<legend>Alta Usuario</legend>
					<label for="nombreUsuario">Codigo</label>
					<input type="text" name="nombreUsuario" id="nombreUsuario" placeholder="Codigo" onkeypress="validar(event)"/>
					<label for="correo">Correo</label>
					<input type="email" name="correo" id="correo" placeholder="Correo" >
					<p>Roles</p>
					<label for="maestro">Maestro</label>
					<input type="checkbox" name="maestro" id="maestro" />
					<label for="asistente">Asistente</label>
					<input type="checkbox" name="asistente" id="asistente"/>
					<label for="revisor">Revisor</label>
					<input type="checkbox" name="revisor" id="revisor" />
					<label for="jefe">Jefe de Departamento</label>
					<input type="checkbox" name="jefe" id="jefe" />
					<input type="submit" name="enviar" id="enviar" />
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
	</script>
</html>
