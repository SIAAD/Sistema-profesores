<?php
/** @author:Jesus Alberto Ley Ayon
 * @since: 04/Feb/2015
 * @version 1.5
 */ 
$path=dirname(dirname(dirname(__FILE__))).'\Sitio\Ctrl\CtrlStr.php';
if(file_exists($path))require_once $path;
else exit();

class AdminCtrl extends CtrlStr {
	function __construct() {
		//Cuando se construye se desea crear el modelo
		parent::__construct();
		if (!file_exists('Model/AdminMdl.php')) {
			//exit();
		} else {
			require_once 'Model/AdminMdl.php';
			$this -> modelo = new AdminMdl();
		}
	}

	protected final function altas($objeto) {

		switch($objeto) {
			//////USUARIO
			case 'usuario' :
			if(parent::esAdmin($_SESSION['roles'])){
				if(parent::verificarParametros($_POST)){
					$nombre = $_POST['nombreUsuario'];
					$correo = $_POST['correo'];
					$roles = array();
					if(isset($_POST['maestro']))$roles['maestro'] = 2;
					if(isset($_POST['asistente']))$roles['asistente'] = 3;
					if(isset($_POST['revisor']))$roles['revisor'] = 4;
					if(isset($_POST['jefe']))$roles['jefe'] = 5;
					$resultado = $this->checarCombinaciones($roles);
					if($resultado != FALSE){
						$res = $this -> modelo ->altaUsuario($nombre, $correo,$resultado); 	
						if($res){
							header("refresh:2;index.php?controlador=Admin&accion=consulta&objeto=usuarios");
						}else{
							echo "No se pudo dar de alta";
						}
					}else{
						echo "Combinacion de roles invalida";
					}
					
				}else{
					require_once 'View/formularios/AltaUsuario.php';
				}
			}
			else{
				echo "Permiso denegado";
			}	
			break;	
		}

	}

	protected final function bajas($objeto) {
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

	protected final function consultas($objeto) {
		$res;
		switch($objeto){
			case 'usuarios':
				if(parent::esAdmin($_SESSION['roles'])){
					$res= $this->modelo->consultaUsuarios();					
					if ($res!=FALSE) {
						if($res!=null){
							if(file_exists('View/plantillas/plantillas viejas/consultaUsuarios.php')){
								require_once 'View/plantillas/plantillas viejas/consultaUsuarios.php';
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
				if($_REQUEST['idUsuario']==$_SESSION['idUsuario']){
					if(parent::verificar($_REQUEST['idUsuario'])){
						$id= $_REQUEST['idUsuario'];
						$this -> verificador -> validaNumero($id);
						$res = $this -> modelo -> consultaUsuario($id);
						if($res){
							require_once('view/plantillas/consultaUsuario.php');
							$plantilla = new ConsultaUsuario();
							$pagina=$plantilla->generaPagina($res);
							echo $pagina;
						}else{
							echo "No se puede realizar la consulta";
						}
					}else{
						echo "REGISTRO INEXISTENTE";
					}
				}else{
					echo "NO SE REALIZO LA CONSULTA";
				}
				
			}
		}

	protected final function modificaciones($objetos) {
		switch ($objeto) {
			case 'usuario':
				if(parent::esAdmin($_SESSION['roles'])){
					
				}
				if(isset($_POST['enviar'])){
					
				}
				break;		
		}
		
	}

	protected final function clonar($objeto){
		
	}
	
	private function checarCombinaciones($roles){
		$resultado = array_values($roles);
		$error1 = array(2,3,4,5);
		$error2 = array(3,5);
		$error3 = array(4,5);
		$error4 = array(2,4);
		$error5 = array(5);
		$error6 = array(4);
		if (is_array($resultado) && !empty($resultado)) {
			if($resultado == $error1 || $resultado == $error2 || $resultado == $error3 || $resultado == $error4){
				echo "error";
				return FALSE;
			}else{
				echo "correcto";
				return $resultado;	
			}
		}
		else return FALSE;
	}
}

/*$controlador = new AdminCtrl();
 $controlador -> ejecutar();
 var_dump($controlador);
 */
//$controlador->ejecutar();
?>