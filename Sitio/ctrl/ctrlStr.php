<?php

if (!file_exists('../Sitio/Objetos/Verificador.php')) {
	exit();
} else {
	require_once ('../Sitio/Objetos/Verificador.php');
}

class CtrlStr {
	protected $modelo;
	protected $verificador;
	const ADMIN = 0;
	const MTRS = 1;
	const ASIS = 2;
	const REVIS = 3;
	const JEFDEP = 4;

	public function __construct() {
		$this -> verificador = new Verificador();
	}

	public function ejecutar(){}
	protected function altas($objeto){}
	protected function bajas($objeto){}
	protected function consultas($objeto){}
	protected function modificaciones($objeto){}

	protected function verificar($variable) {
		if (isset($variable) && !empty($variable) && is_string($variable))return TRUE;
		else return FALSE;
	}

	protected function esAdmin($var) {
		if (in_array(CtrlStr::ADMIN, $var))return TRUE;
		else return FALSE;
	}

	protected function esMstr($var) {
		if (in_array(CtrlStr::MSTR, $var))return TRUE;
		else return FALSE;
	}

	protected function esAsis($var) {
		if (in_array(CtrlStr::ASIS, $var))return TRUE;
		else return FALSE;
	}

	protected function esRevis($var) {
		if (in_array(CtrlStr::REVIS, $var))return TRUE;
		else return FALSE;
	}

	protected function esJefDep($var) {
		if (in_array(CtrlStr::JEFDEP, $var)) return TRUE;
		else return FALSE;
	}

	protected function checarAcciones() {
		if (isset($_GET['accion']) && !empty($_GET['accion'])) {
			if (isset($_GET['objeto']) && !empty($_GET['objeto']))return TRUE;
			else return FALSE;
		}
	}

	private function verificarPrivilegios($privilegios) {
		if (is_array($privilegios)) {
			$bandera = TRUE;
			foreach ($privilegios as $privilegio) {
				$bandera = $bandera and verificarPrivilegio($privilegio);
			}
			return $bandera;
		} else {
			return $this -> verificarPrivilegio($privilegios);
		}
	}

	private function verificarPrivilegio($privilegio) {
		if ($this -> esAdmin($privilegio) || $this -> esAMstr($privilegio) || $this -> esAsis($privilegio) || $this -> esRevis($privilegio) || $this -> esJefDep($privilegio))return TRUE;
		else return FALSE;
	}

	protected function verificarParametros($variables) {
		if (is_array($variables)&&!empty($variables)) {
			$keys = array_keys($variables);
			foreach ($keys as $key) {
				if (!$this->verificar($variables[$key])) {
					return FALSE;
				}else{
					switch ($key) {
						case 'enviar' :case 'modificar' :case 'valor1' :case 'valor2' :
							//va ser para enteros utilizados para llaves secundarias
							break;

						case 'nombreUsuario' :
							if (!$this->verificador -> validaCodigo($variables[$key]))return FALSE;
							break;

						case 'nombreDepartamento' :
							if (!$this->verificador -> validaNombreDepartamento($variables[$key]))return FALSE;
							break;

						case 'nombreCarrera' :
							if (!$this->verificador -> validaNombreCarrera($variables[$key]))return FALSE;
							break;

						case 'nombreMateria' :
							if (!$this->verificador -> validaNombreMateria($variables[$key]))return FALSE;
							break;

						case 'nombreAcademia' :
							if (!$this->verificador -> validaNombreAcademia($variables[$key]))return FALSE;
							break;

						case 'correo' :
							if (!$this->verificador -> validaCorreo($variables[$key]))return FALSE;
							break;

						case 'pass' :
							if (!$this->verificador -> validaPass($variables[$key]))return FALSE;
							break;

						case 'tipoPrivilegio' :
							if(!$this->verificarPrivilegios($variables[$key]))return FALSE;
							break;

						case 'descripcionPrivilegio':
							break;

						case 'codigoNombramiento':
							break;

						case 'nombreNombramiento':
							break;

						case 'horasNombramiento' :
							break;

						case 'estatus' :
							break;

						case 'descripcionEstatus' :
							break;

						case 'nombresMaestros' :
							break;

						case 'codigoMaestros' :
							if (!$this->verificador -> validaCodigo($variables[$key]))return FALSE;
							break;

						case 'apellidosMaestros' :
							break;

						case 'nrc' :
							if (!$this->verificador -> validaNrc($variables[$key]))return FALSE;
							break;

						case 'seccion' :
							if (!$this->verificador -> validaSeccion($variables[$key]))return FALSE;
							break;

						case 'ciclo' :
							if (!$this->verificador -> validaCiclo($variables[$key]))return FALSE;
							break;

						case 'inicioCiclo' :
						case 'finCiclo' :
							if (!$this->verificador -> validaFecha($variables[$key]))return FALSE;
							break;

						case 'claveMateria' :
							if (!$this->verificador -> validaClaveMateria($variables[$key]))return FALSE;
							break;

						case 'abreviacionAcademia' :
						case 'abreviacionDepartamento' :
							if (!$this->verificador -> validaAbreviacion($variables[$key]))return FALSE;
							break;

						case 'claveDepartamento' :
							if (!$this->verificador -> validaClaveDepartamento($variables[$key]))return FALSE;
							break;

						case 'claveCarrera' :
							if (!$this->verificador -> validaClaveCarrera($variables[$key]))return FALSE;
							break;

						case 'aula' :
							break;

						case 'nombreEdificio' :
							break;

						case 'diaHorario' :
							break;

						case 'inicioHorario' :
						case 'finHorario' :
							if (!$this->verificador -> validaHora($variables[$key]))return FALSE;
							break;

						case 'horasHorario' :
							break;

						case 'teoriaPractica' :
							break;

						default :
							echo "No se encontro >>>> " . $key . ">>>>>>" . $variables[$key];
							exit();
							break;
					}
				}
			}
		} else {
			return FALSE;
		}
		return TRUE;

	}

}
?>