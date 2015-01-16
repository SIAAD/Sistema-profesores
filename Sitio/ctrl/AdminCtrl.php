<?php
if (!file_exists('ctrl/CtrlStr.php')) {
	//exit();
	require_once ('CtrlStr.php');
	//require_once('model/PruebaMdl.php');
} else {
	require_once ('CtrlStr.php');
	//require_once('model/PruebaMdl.php');
}
//session_start();

class AdminCtrl extends CtrlStr {
	//public $modelo;
	//public $verificador;
	function __construct() {
		//Cuando se construye se desea crear el modelo
		parent::__construct();
		if (!file_exists('Model/AdminMdl.php')) {
			exit();
		} else {
			require_once 'Model/AdminMdl.php';
			$this -> modelo = new AdminMdl();
		}
	}

	public function ejecutar() {
		if (isset($_GET)) {
			if (parent::checarAcciones()) {
				$accion = $_REQUEST['accion'];
				$objeto = $_REQUEST['objeto'];
				var_dump($accion);
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
					default :
						echo "no se encontro accion valida";
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

	protected function altas($objeto) {

		switch($objeto) {
			//////USUARIO
			case 'usuario' :
			if(parent::esAdmin($_SESSION['roles'])){
				if (isset($_POST['enviar'])) {
					if(parent::verificar($_POST['nombre'])) {
						$nombre = $_POST['nombre'];
						$this -> verificador -> validaCodigo($nombre);
						if (parent::verificar($_POST['pass'])) {
							$pass = $_POST['pass'];
							$this -> verificador -> validaPass($pass);
							if(parent::verificar($_POST['correo'])){
								$correo = $_POST['correo'];
								$this -> verificador -> validaCorreo($correo);
								$res = $this -> modelo -> altaUsuario($nombre, $pass);
								if ($res) {
									//header("Location: view/paginaInicio.php");
									require_once('View/formularios/AltaUsuario.php');
								} else {
									echo "Error no se pudo dar de alta";
								}
							}else{
								require_once 'View/formularios/AltaUsuario.php';
							}				
						} else {
							require_once 'View/formularios/AltaUsuario.php';
						}
					} else {
						require_once 'View/formularios/AltaUsuario.php';
					}
				}else {
					require_once 'View/formularios/AltaUsuario.php';
				}
			}
				
				break;
				////////DEPARTAMENTO
				/*
			case 'departamento' :
					if (isset($_POST['enviar'])) {
					if ($this->verificar($_POST['nombre'])) {
						$nombre = $_POST['nombre'];
						$this -> verificador -> validaCadena($_POST['nombre']);
						if ($this->verificar($_POST['clave'])) {
							$clave = $_POST['clave'];
							$this -> verificador -> validaCodigo($_POST['clave']);
							if($this->verificar($_POST['abreviacion'])){
								$abreviacion = $_POST['abreviacion'];
								$this -> verificador -> validaAbreviacion($_POST['abreviacion']);
								$res = $this -> modelo -> altaDepartamento($nombre, $clave,$abreviacion);
								if ($res) {
									//header("Location: view/paginaInicio.php");
									require_once('View/formularios/AltaUsuario.php');
								} else {
									echo "Error no se pudo dar de alta";
								}	
							}else {
							require_once 'View/formularios/altaDepartamento.php';
						}
						} else {
							require_once 'View/formularios/altaDepartamento.php';
						}
					} else {
						require_once 'View/formularios/altaDepartamento.php';
					}
				}else {
					require_once 'View/formularios/altaDepartamento.php';
				}
				break;
				////////////ACADEMIA
			case 'academia' :
					if (isset($_POST['enviar'])) {
					if ($this -> verificar($_POST['nombre'])) {
						$nombre = $_POST['nombre'];
						$this -> verificador -> validaNombreCurso($_POST['nombre']);
						if ($this -> verificar($_POST['clave'])) {
							$clave = $_POST['clave'];
							$this -> verificador -> validaAbreviacion($clave);
							if($this -> verificar($_POST['departamento'])){
								$departamento = $_POST['departamento'];
								$this -> verificador -> validaNum($departamento);
								if($this -> verificar($_POST['maestro'])){
									$maestro = $_POST['maestro'];
									$this -> verificador -> validaNum($_POST['maestro']);
									$res = $this -> modelo -> altaAcademia($nombre,$clave,$departamento,$maestro);
									if ($res) {
										//header("Location: view/paginaInicio.php");
										require_once('View/formularios/altaAcademia.php');
									} else {
										echo "Error no se pudo dar de alta";
									}
								}else{
									require_once 'View/formularios/altaAcademia.php';
								}
							}else{
									require_once 'View/formularios/altaAcademia.php';
							}	
						} else {
							require_once 'View/formularios/altaAcademia.php';
						}
					} else {
						require_once 'View/formularios/altaAcademia.php';
					}
				}else {
					require_once 'View/formularios/altaAcademia.php';
				}
				break;
			//////////MATERIA CARRERA
			case 'materiaCarrera' :
				if (isset($_POST['enviar'])) {
					//require_once '../view/formularios/altaMateriaCarrera.html';
					if ($this->verificar($_POST['codigoMateria'])) {
						$materia = $_POST['codigoMateria'];
						//$this -> verificador -> 
						if ($this->verificar($_POST['codigoCarrera'])) {
							$carrera = $_POST['codigoCarrera'];
							if($this->verificar($_POST['academia'])){
								$academia = $_POST['academia'];
								$res = $this -> $modelo -> altaMateriaCarrera($codigoCarrera,$codigoMateria,$academia);
							}	
						} else {
							return 1;
						}
					} else {
						ManejadorErrores::manejarError(1236);
					}
				} else {
					
				}
				break;
			///////////MATERIA
			case 'materia' :
				if (empty($_POST)) {
					require_once '../view/formularios/altaMateria.html';
				} else {
					if ($this -> verificar($_POST['nombre'])) {
						$nombre = $_POST['nombre'];
						if ($this-> verificar($_POST['clave'])) {
							$clave = $_POST['clave'];
							$modelo -> altaMateria($nombre, $clave);
						} else {
							ManejadorErrores::manejarError();
						}
					} else {
						ManejadorErrores::manejarError();
					}
				}
				break;*/
		}

	}

	public function bajas($objeto) {
		switch($objeto){
			case 'usuario':
				if(parent::esAdmin($_SESSION['roles'])){
					if (isset($_POST['enviar'])) {
						if(parent::verificar($_POST['id'])) {
							$id = $_POST['id'];
							$this -> verificador -> validaNumero($_POST['id']);
							$res = $this -> modelo -> bajaUsuario($id);
							if ($res) {
								//header("Location: view/paginaInicio.php");
								require_once('view/formularios/bajaUsuario.php');
							} else {
								echo "Error no se pudo dar de baja";
							}	
						} else {
							require_once ('view/formularios/bajaUsuario.php');
						}
					}else {
						require_once ('view/formularios/bajaUsuario.php');
					}
				}
			break; 
		}
	}

	public function consultas($objetos) {
		$res;
		switch($objeto){
			case 'usuarios':
				if(parent::esAdmin($_SESSION['roles'])){
					$res = $this -> modelo -> consultaUsuarios();
					if($res){
						require_once('view/plantillas/consultaUsuarios.php');
					}
					else{
						echo"No se pudo realizar la consulta";
					}
				}	
			break;
			case 'usuario':
				if(isset($_POST['enviar'])){
					if(parent::verificar($_POST['id'])){
						$id= $_POST['id'];
						$this -> verificador -> validaNumero($id);
						$res = $this -> modelo -> consultaUsuario($id);
						if($res){
							require_once('view/plantillas/consultaUsuario.php');
						}else{
							echo "No se puede realizar la consulta";
						}
					}else{
						require_once ('view/formularios/modificarUsuario.php');
					}
				}else{
					require_once ('view/formularios/modificarUsuario.php');
				}
				
		}
	}

	public function modificaciones($objetos) {
		switch ($objeto) {
			case 'usuario':
				if(isset($_POST['enviar'])){
					if(isset($_POST['enviarmodificar'])){
						if(parent::verificar($_POST['correo'])){
							
						}
					}else{
						if(parent::verificar($_POST['contrasena'])){
							$contrasena = md5($_POST['contrasena']);
						}
					}
					
				}
				break;		
		}
		
	}
	
	function verificar($var){
		if (isset($var) && !empty($var) && is_string($var)){
			return true;
		}else{
			return false;
		}
	}
	
}

/*$controlador = new AdminCtrl();
 $controlador -> ejecutar();
 var_dump($controlador);
 */
//$controlador->ejecutar();
?>