
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
					<legend>MEGA FORMULARIO</legend><br></br>
					<legend>USUARIO</legend>
					<label for="nombreUsuario">Codigo</label>
					<input type="text" name="nombreUsuario" id="nombreUsuario" placeholder="Codigo"/>
					<label for="correo">Correo</label>
					<input type="email" name="correo" id="correo" placeholder="Correo" >
					<label for="pass">Password</label>
					<input type="text" name="pass" id="pass" placeholder="Password" />
					<!--CONSULTAR SU ROL-->
					<legend>PRIVILEGIOS</legend>
					<label for="tipo">Tipo</label>
					<input type="text" name="tipo" id="tipo" placeholder="Tipo" />
					<label for="descripcionPrivilegio">Descripcion</label>
					<input type="text" name="descripcionPrivilegio" id="descripcionPrivilegio" placeholder="Descripcion" />
					<legend>NOMBRAMIENTOS</legend>
					<label for="codigoNombramiento">Codigo Nombramiento</label>
					<input type="text" name="codigoNombramiento" id="codigoNombramiento" placeholder="Codigo Nombramiento"/>
					<label for="nombreNombramiento">Nombre Nombramiento</label>
					<input type="text" name="nombreNombramiento" id="nombreNombramiento" placeholder="Nombre Nombramiento" />
					<label for="horasNombramiento">Horas Nombramiento</label>
					<input type="text" name="horasNombramiento" id="horasNombramiento" placeholder="Horas Nombramiento" />
					<legend>ESTATUS</legend>
					<label for="estatus">Estatus</label>
					<input type="text" name="estatus" id="estatus" placeholder="estatus" />
					<label for="descripcionEstatus">Descripcion Estatus</label>
					<input type="text" name="descripcionEstatus" id="descripcionEstatus" placeholder="Descripcion Estatus" />
					<legend>MAESTROS</legend>
					<label for="codigoMaestros">Codigo Maestros</label>
					<input type="text" name="codigoMaestros" id="codigoMaestros" placeholder="codigoMaestros" />
					<label for="nombresMaestros">Nombres Maestros</label>
					<input type="text" name="nombresMaestros" id="nombresMaestros" placeholder="nombresMaestros" />
					<label for="apellidosMaestros">Apellidos Maestros</label>
					<input type="text" name="apellidosMaestros" id="apellidosMaestros" placeholder="apellidosMaestros" />
					<!--CONSULTAR ESTATUS-->
					<legend>CURSO</legend>
					<!--Consultar idCiclo-->
					<!--Consultar idMateria-->
					<label for="nrc">NRC</label>
					<input type="text" name="nrc" id="nrc" placeholder="NRC" />
					<label for="seccion">Seccion</label>
					<input type="text" name="seccion" id="seccion" placeholder="Seccion" />
					<legend>CICLO</legend>
					<label for="ciclo">Ciclo</label>
					<input type="text" name="ciclo" id="ciclo" placeholder="ciclo" />
					<label for="inicioCiclo">Inicio Ciclo</label>
					<input type="text" name="inicioCiclo" id="inicioCiclo" placeholder="inicioCiclo" />
					<label for="finCiclo">Fin Ciclo</label>
					<input type="text" name="finCiclo" id="finCiclo" placeholder="finCiclo" />
					<legend>MATERIA</legend>
					<label for="nombreMateria">Nombre Materia</label>
					<input type="text" name="nombreMateria" id="nombreMateria" placeholder="nombreMateria" />
					<label for="claveMateria">Clave Materia</label>
					<input type="text" name="claveMateria" id="claveMateria" placeholder="claveMateria" />
					<!--Consultar idAcademia-->
					<legend>ACADEMIA</legend>
					<label for="abreviacionAcademia">Abreviacion Academia</label>
					<input type="text" name="abreviacionAcademia"/>
					<label for="nombreAcademia">Nombre Academia</label>
					<input type="text" name="nombreAcademia" id="nombreAcademia" placeholder="nombreAcademia" />
					<label for="claveAcademia">Clave Academia</label>
					<input type="text" name="claveAcademia" id="claveAcademia" placeholder="claveAcademia" />
					<!--consultar id Maestros-->
					<!--consultar id Departamento-->
					<legend>DEPARTAMENTO</legend>
					<label for="nombreDepartamento">Nombre Departamento</label>
					<input type="text" name="nombreDepartamento" id="nombreDepartamento" placeholder="nombreDepartamento" />
					<label for="claveDepartamento">Clave Departamento</label>
					<input type="text" name="claveDepartamento" id="claveDepartamento" placeholder="claveDepartamento" />
					<label for="abreviacionDepartamento">Abreviacion Departamento</label>
					<input type="text" name="abreviacionDepartamento" id="abreviacionDepartamento" placeholder="abreviacionDepartamento" />
					<!--consultar id Maestros-->
					<legend>CARRERAS</legend>
					<label for="nombreCarreras">Nombre Carreras</label>
					<input type="text" name="nombreCarreras" id="nombreCarerras" placeholder="nombreCarreras" />
					<label for="claveCarreras">Clave Carreras</label>
					<input type="text" name="claveCarreras" id="claveCarreras" placeholder="claveCarreras" />
					<legend>AULAS</legend>
					<label for="aula">Aula</label>
					<input type="text" name="aula" id="aula" placeholder="aula" />
					<legend>EDIFICIOS</legend>
					<label for="nombreEdificio">nombreEdificio</label>
					<input type="text" name="nombreEdificio" id="nombreEdificio" placeholder="nombreEdificio" />
					<legend>HORARIOS</legend>
					<!--consultar id Curso-->
					<label for="diaHorario">Dia Horario</label>
					<input type="text" name="diaHorario" id="diaHorario" placeholder="diaHorario" />
					<label for="inicioHorario">Inicio Horario</label>
					<input type="text" name="inicioHorario" id="inicioHorario" placeholder="inicioHorario"/>
					<label for="finHorario">Fin Horario</label>
					<input type="text" name="finHorario" id="finHorario" placeholder="finHorario" />
					<label for="horasHorario">Horas Horario</label>
					<input type="text" name="horasHorario" id="horasHorario" placeholder="horasHorario" />
					<label for="teoriaPractica">Teoria/Practica</label>
					<input type="text" name="teoriaPractica" id="teoriaPractica" placeholder="teoriaPractica"/>
					<!--consultar id Edificio-->
					<!--consultar id Aulas-->
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
