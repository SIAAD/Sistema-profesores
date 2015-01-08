<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SIAAD</title>
		<link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
		<script src="jquery/jquery-1.8.3.min.js"></script>
	</head>

	<body>
		<div>
			<form class="span8" name="form01" method="post" action="index.php?controlador=Admin&accion=alta&objeto=usuario">
				<fieldset>
					<legend>Alta Usuario</legend>
					<label for="nombre">Codigo</label>
					<input type="text" name="nombre" id="nombre" placeholder="Codigo" maxlength="7" onkeypress="return validar(event);" required="required"/>
					<label for="pass">Password</label>
					<input type="text" name="pass" id="pass" placeholder="Password" required="required"/>
					<input type="submit" name="enviar" id="enviar" value="Registrar"/>
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
