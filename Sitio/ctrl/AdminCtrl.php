<?php
if (!file_exists('ctrl/CtrlStr.php'))exit();
else require_once ('CtrlStr.php');

class AdminCtrl extends CtrlStr {
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
					$res= $this->modelo->consultaUsuarios();					
					if ($res!=FALSE) {
						if($res!=null){
							if(file_exists('View/plantillas/consultaUsuarios.php')){
								require_once 'View/plantillas/consultaUsuarios.php';
								$plantilla = new ConsultaUsuarios();
								$pagina=$plantilla->generaPagina($res);	
								echo $pagina;
							}else{
								echo "Error no se pudo incluir la plantilla consultaUsuarios";
							}												
						}else{
							echo "NO HAY NADA EN LA TABLA";
						}
					}else{
						echo "ERROR NO SE REALIZO LA CONSULTA";
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
					if(parent::esAdmin($_SESSION['roles'])){
						$longitud = '';
						// Cambiado por la funcion de verificar datos
						if(parent::verificar($_POST['nombre'])){
							$nombre = $_POST['nombre'];
							$this -> verificador -> validaCodigo($nombre);
							if(parent::verificar($_POST['pass'])){
								$pass = $_POST['pass'];
								$this-> verificador -> validaPass($pass);	
								$pass = md5($_POST['pass']);
								if(parent::verificar($_POST['correo'])){
									$correo = $_POST['correo'];
									$this ->verificador -> validaCorreo($correo);
									if(parent::verificar($_POST['estatus'])){
										$estatus = $POST['estatus'];
										$this -> verificador -> validaEstatus($estatus);
									}else{
										
									}
								}else{
									
								}
							}else{
								
							}
						}else{
							
						}
					}else{
						if(parent::verificar($_POST['pass'])){
							$pass = md5($_POST['pass']);
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