<?php

if (!file_exists("ctrl/ctrlStr.php")) {
	exit();
} else {
	require_once ("ctrlStr.php");
}

class EstructuraCtrl extends CtrlStr {

	public function __construct() {
		parent::__construct();
		if (!file_exists('Model/EstructuraMdl.php')) {
			exit();
		} else {
			require_once 'Model/EstructuraMdl.php';
			$this->modelo = new EstructuraMdl();
		}

	}

	public function ejecutar() {
		if (isset($_GET)) {
			if (parent::checarAcciones()) {
				$accion = $_GET['accion'];
				$objeto = $_GET['objeto'];
				switch ($accion) {
					case 'alta' :
						$this->altas($objeto);
						break;

					case 'baja' :
						$this->bajas($objeto);
						break;

					case 'consulta' :
						$this->consultas($objeto);
						break;

					case 'modificacion' :
						$this->modificaciones($objeto);
						break;

					default :
						break;
				}
			} else {
				header("Location: view/paginaInicio.php");
				//ManejadorErrores::manejarError();
			}
		} else {
			header("Location: view/paginaInicio.php");
			//error sesion terminada por inactividad
			//ManejadorErrores::manejarError();
		}

	}

	protected final function altas($objeto) {
		switch($objeto) {
			case 'carrera' :
				if (isset($_POST['enviar'])) {
					if (isset($_POST['nombre']) && !empty($_POST['nombre']) && is_string($_POST['nombre'])) {
						$nombre = $_POST['nombre'];
						//$this->verificador->
						$this->verificador->validaNombreCurso($_POST['nombre']);
						if (isset($_POST['clave']) && !empty($_POST['clave']) && is_string($_POST['clave'])) {
							$clave = $_POST['clave'];
							$res=$this->modelo -> altaCarrera($nombre, $clave);
							if($res){
								//header("Location: view/paginaInicio.php");
								header('Location: View/formularios/altaCarrera.html');
							}else{
								echo "Error no se pudo dar de alta";
							}
						} else {
							require_once 'View/formularios/altaCarrera.html';
						}
					} else {
						require_once 'View/formularios/altaCarrera.html';
					}	
				}else{
					require_once 'View/formularios/altaCarrera.html';
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
					if (isset($_POST['codigoMateria']) && !empty($_POST['codigoMateria']) && is_string($_POST['codigoMateria'])) {
						$materia = $_POST['codigoMateria'];
						if (isset($_POST['codigoCarrera']) && !empty($_POST['codigoCarrera']) && is_string($_POST['codigoCarrera'])) {
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
					if (isset($_POST['nombre']) && !empty($_POST['nombre']) && is_string($_POST['nombre'])) {
						$nombre = $_POST['nombre'];
						if (isset($_POST['clave']) && !empty($_POST['clave']) && is_string($_POST['clave'])) {
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

	protected final function bajas($objeto) {
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

	protected final function consultas($objeto) {
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

	protected final function modificaciones($objeto) {
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

	protected final function checarAltaCarrera() {

	}

}
?>
			