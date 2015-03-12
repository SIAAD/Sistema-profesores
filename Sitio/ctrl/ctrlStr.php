<?php
/** @author:Jorge Eduardo Garza Martinez
 * @author:Jesus Alberto Ley Ayón
 * @since: 04/Feb/2015
 * @version 2.0
 */

$path = dirname(dirname(__FILE__)) . '\Objetos\Verificador.php';
if (!file_exists($path))exit();
else require_once $path;

abstract class CtrlStr {
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

	/**
	 *
	 */
	public static function esAdmin($var) {
		if (in_array(self::ADMIN, $var))return TRUE;
		else return FALSE;
	}

	/**
	 *
	 */
	static function esMstr($var) {
		if (in_array(self::MTRS, $var)) return TRUE;
		else return FALSE;
	}

	/**
	 *
	 */
	static function esAsis($var) {
		if (in_array(self::ASIS, $var)) return TRUE;
		else return FALSE;
	}

	/**
	 *
	 */
	static function esRevis($var) {
		if (in_array(self::REVIS, $var))return TRUE;
		else return FALSE;
	}

	/**
	 *
	 */
	static function esJefDep($var) {
		if (in_array(self::JEFDEP, $var))return TRUE;
		else return FALSE;
	}
	/**
	 *Function that all the controllers used to choose with accion must be excecuted
	 * @param none
	 * @return NULL
	 */
	public function ejecutar() {
		if (isset($_GET)) {
			if ($this -> checarAcciones()) {
				$accion = $_GET['accion'];
				$objeto = $_GET['objeto'];
				switch ($accion) {
					case 'alta' :
						$this -> altas($objeto);
						break;

					case 'baja' :
						$this -> bajas($objeto);
						break;

					case 'consulta' :
						$this -> consultas($objeto);
						break;

					case 'modificacion' :
						$this -> modificaciones($objeto);
						break;

					case 'clonar' :
						$this -> clonaciones($objeto);
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

	protected abstract function altas($objeto);
	protected abstract function bajas($objeto);
	protected abstract function consultas($objeto);
	protected abstract function modificaciones($objeto);
	protected abstract function clonar($objeto);
	/**
	 * Function that verify if a variable exist, contain a value and is a string
	 * @param the reference of a variable ($variable)
	 * @return return TRUE if it is correct or FALSE
	 */
	protected function verificar($variable) {
		if (isset($variable) && !empty($variable) && is_string($variable))return TRUE;
		else return FALSE;
	}

	/**
	 *
	 */
	protected function checarAcciones() {
		if (isset($_GET['accion']) && !empty($_GET['accion'])) {
			if (isset($_GET['objeto']) && !empty($_GET['objeto']))return TRUE;
			else return FALSE;
		}
	}

	/**
	 *Check if a groups of roles are aceptable
	 * @param an Array conteining two or more roles or only one
	 * @return TRUE if all the roles are accepted, FALSE othewise
	 */
	protected function verificarPrivilegios($privilegios) {
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

	/**
	 *This function check if a role is correct
	 * @param receive one element to verify
	 * @return TRUE if the role us correct, FALSE otherwise
	 */
	private function verificarPrivilegio($privilegio) {
		if ($this -> esAdmin($privilegio) || $this -> esAMstr($privilegio) || $this -> esAsis($privilegio) || $this -> esRevis($privilegio) || $this -> esJefDep($privilegio))
			return TRUE;
		else
			return FALSE;
	}

	/**
	 *This function check the integrity of data before is used in the program
	 * @param the function can receive an array with keys
	 * @return TRUE if all the variables inside the array are ok, FALSE if at least one of them doesn't pass the verification process
	 */
	protected function verificarParametros($variables) {
		if (is_array($variables) && !empty($variables)) {
			$keys = array_keys($variables);
			foreach ($keys as $key) {
				if (!$this -> verificar($variables[$key])) {
					//return FALSE;
					switch ($key) {
						case 'maestro':
						case 'revisor':
						case 'asistente':
						case 'jefe':
							if(!isset($variables[$key]) && !is_string($variables[$key])){
								return FALSE;
							}		
							break;
						
						default:
							return FALSE;
							break;
					}
				} else {
					switch ($key) {
						case 'enviar' :
						case 'modificar' :
						case 'valor1' :
						case 'valor2' :
							//va ser para enteros utilizados para llaves secundarias
							break;

						case 'idCarrera' :
						case 'idDepartamento' :
						case 'idMateria' :
						case 'idMaestro' :
							if (!$this -> verificador -> validaIds($variables[$key]))
								return FALSE;
							break;

						case 'nombreUsuario' :
							if (!$this -> verificador -> validaCodigo($variables[$key]))
								return FALSE;
							break;

						case 'nombreDepartamento' :
							if (!$this -> verificador -> validaNombreDepartamento($variables[$key]))
								return FALSE;
							break;

						case 'nombreCarrera' :
							if (!$this -> verificador -> validaNombreCarrera($variables[$key]))
								return FALSE;
							break;

						case 'nombreMateria' :
							if (!$this -> verificador -> validaNombreMateria($variables[$key]))
								return FALSE;
							break;

						case 'nombreAcademia' :
							if (!$this -> verificador -> validaNombreAcademia($variables[$key]))
								return FALSE;
							break;

						case 'correo' :
							if (!$this -> verificador -> validaCorreo($variables[$key]))
								return FALSE;
							break;

						case 'pass' :
							if (!$this -> verificador -> validaPass($variables[$key]))
								return FALSE;
							break;

						case 'tipoPrivilegio' :
							if (!$this -> verificarPrivilegios($variables[$key]))
								return FALSE;
							break;

						case 'descripcionPrivilegio' :
							break;

						case 'codigoNombramiento' :
							break;

						case 'nombreNombramiento' :
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
							if (!$this -> verificador -> validaCodigo($variables[$key]))
								return FALSE;
							break;

						case 'apellidosMaestros' :
							break;

						case 'nrc' :
							if (!$this -> verificador -> validaNrc($variables[$key]))
								return FALSE;
							break;

						case 'seccion' :
							if (!$this -> verificador -> validaSeccion($variables[$key]))
								return FALSE;
							break;

						case 'ciclo' :
							if (!$this -> verificador -> validaCiclo($variables[$key]))
								return FALSE;
							break;

						case 'inicioCiclo' :
						case 'finCiclo' :
							if (!$this -> verificador -> validaFecha($variables[$key]))
								return FALSE;
							break;

						case 'claveMateria' :
							if (!$this -> verificador -> validaClaveMateria($variables[$key]))
								return FALSE;
							break;

						case 'abreviacionAcademia' :
						case 'abreviacionDepartamento' :
							if (!$this -> verificador -> validaAbreviacion($variables[$key]))
								return FALSE;
							break;

						case 'claveDepartamento' :
							if (!$this -> verificador -> validaClaveDepartamento($variables[$key]))
								return FALSE;
							break;

						case 'claveCarrera' :
							if (!$this -> verificador -> validaClaveCarrera($variables[$key]))
								return FALSE;
							break;

						case 'aula' :
							break;

						case 'nombreEdificio' :
							break;

						case 'diaHorario' :
							break;

						case 'inicioHorario' :
						case 'finHorario' :
							if (!$this -> verificador -> validaHora($variables[$key]))
								return FALSE;
							break;

						case 'horasHorario' :
							break;

						case 'teoriaPractica' :
							break;
						
						case 'maestro':
						case 'asistente':
						case 'revisor':
						case 'jefe':
							if(!$this -> verificador -> validaCheckbox($variables[$key]))
								return FALSE;
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