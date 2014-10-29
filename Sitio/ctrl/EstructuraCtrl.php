<?php
if (!file_exists("CtrlStr")) {
	exit();
} else {
	require_once ("CtrlStr");
}

class EstructuraCtrl implements CtrlStr {

	function __construct() {
		if (!file_exists('../model/EstructuraMdl')) {
			exit();
		} else {
			require_once ('../model/EstructuraMdl');
			$modelo = new EstructuraMdl();
			if (!file_exists('../Objetos/Verificador')) {
				exit();
			} else {
				require_once ('../Objetos/Verificador');
				$verificador = new Verificador();
			}
		}

	}

	function ejecutar() {
		session_start();
		if (isset($_SESSION)) {
			if (checarAcciones()) {
				$accion = $_POST['accion'];
				$objeto = $_POST['objeto'];
				switch ($accion) {
					case 'alta' :
						altas($objeto);
						break;

					case 'baja' :
						bajas();
						break;

					case 'consulta' :
						consultas();
						break;

					case 'modificacion' :
						modificaciones();
						break;

					default :
						break;
				}
			} else {
				echo "Error no se especificaron acciones ni objetos";
				ManejadorErrores::manejarError();
			}
		} else {
			//error sesion terminada por inactividad
			ManejadorErrores::manejarError();
		}

	}

	private function altas($objeto) {
		switch($objeto) {
			case 'carrera' :
				if (empty($_POST)) {
					require_once '../view/formularios/altaCarrera.html';
				} else {
					if (isset($_POST['nombre']) && !empty($_POST['nombre'])&&is_string($_POST['nombre'])) {
						$nombre = $_POST['nombre'];
						if (isset($_POST['clave']) && !empty($_POST['clave'])&&is_string($_POST['clave'])) {
							$clave = $_POST['clave'];
							$modelo -> altaCarrera($nombre, $clave);
						} else {
							ManejadorErrores::manejarError();
						}
					} else {
						ManejadorErrores::manejarError();
					}
				}
				break;

			case 'departamento' :
				break;

			case 'academia' :
				break;

			case 'materiaCarrera' :
				if (empty($_POST)) {
					require_once '../view/formularios/altaMateriaCarrera.html';
				} else {
					if (isset($_POST['codigoMateria']) && !empty($_POST['codigoMateria'])&&is_string($_POST['codigoMateria'])) {
						$materia = $_POST['codigoMateria'];
						if (isset($_POST['codigoCarrera']) && !empty($_POST['codigoCarrera'])&&is_string($_POST['codigoCarrera'])) {
							$carrera = $_POST['codigoCarrera'];
							$modelo -> altaMateriaCarrera($codigoCarrera, $codigoMateria);
						} else {
							ManejadorErrores::manejarError();
						}
					} else {
						ManejadorErrores::manejarError();
					}
				}
				break;

			case 'materia' :
				if (empty($_POST)) {
					require_once '../view/formularios/altaMateria.html';
				} else {
					if (isset($_POST['nombre']) && !empty($_POST['nombre'])&&is_string($_POST['nombre'])) {
						$nombre = $_POST['nombre'];
						if (isset($_POST['clave']) && !empty($_POST['clave'])&&is_string($_POST['clave'])) {
							$clave = $_POST['clave'];
							$modelo -> altaMateria($nombre, $clave);
						} else {
							ManejadorErrores::manejarError();
						}
					} else {
						ManejadorErrores::manejarError();
					}
				}
				break;
		}
	}

	private function bajas($objeto) {
		switch($objeto) {
			case 'carrera' :
				break;

			case 'departamento' :
				break;

			case 'academia' :
				break;

			case 'materia' :
				break;
		}
	}

	private function consultas($objeto) {
		switch($objeto) {
			case 'carrera' :
				break;

			case 'departamento' :
				break;

			case 'academia' :
				break;

			case 'materia' :
				break;
		}
	}

	private function modificaciones($objeto) {
		switch($objeto) {
			case 'carrera' :
				break;

			case 'departamento' :
				break;

			case 'academia' :
				break;

			case 'materia' :
				break;
		}
	}

	private function checarAltaCarrera() {

	}

}
?>
			