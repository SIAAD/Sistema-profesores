<!DOCTYPE html>
<html lang="en">
	<head>
		<title>SIAAD</title>
		<link href="bootstrap-3.2.0-dist/css/bootstrap.min.css" rel="stylesheet">
		<script src="bootstrap-3.2.0-dist/js/bootstrap.min.js"></script>
	</head>

	<body>
		<div class="span2 offset2">
			<form class="span8" name="form01" method="post" action="index.php?controlador=Estructura&accion=alta&objeto=departamento">
				<fieldset>
					<legend>
						Alta Departamento
					</legend>
					<label for="nombreDepartamento">Nombre</label>
					<input type="text" name="nombreDepartamento" id="nombreDepartamento" placeholder="Nombre" maxlength="45" required="required"/>
					<label for="claveDepartamento">Clave</label>
					<input type="text" name="claveDepartamento" id="claveDepartamento" placeholder="Clave" maxlength="5" required="required"/>
					<label for="abreviacionDepartamento">Abreviacion</label>
					<input type="text" name="abreviacionDepartamento" id="abreviacionDepartamento" placeholder="Abreviacion" maxlength="7" required="required"/>
					<label for="idMaestro">Jefe Departamento</label>
					
					<?php
					if (file_exists("Objetos/dbConfig.inc"))require("Objetos/dbConfig.inc");
					else exit();
					
					$cnx =  mysqli_connect($host, $usr, $pass, $db);
					if(mysqli_connect_error($cnx)){
						echo "error no se pudo conectar a la base de datos";
					}else{
						$seleccion='<select name="datosMaestro">';
						$sql = "SELECT * FROM datosmaestros WHERE estatus = '1' AND descripcion = 'Activo'";
						$res = mysqli_query($cnx,$sql);
						while($row=mysqli_fetch_assoc($res)){
							$seleccion.='<option>';
							$seleccion.=$row['nombres']." ".$row['apellidos']." ( ".$row['codigo'].' )';
							$seleccion.='</option>';
						}
						$seleccion.='</select>';
						echo $seleccion;
					}
					mysqli_close($cnx);
					?>
					
					<input type="submit" name="enviar" id="enviar" value="enviar"/>
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