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
					//Asignar los valores de los roles
					if(isset($_POST['maestro']))$roles['maestro'] = 2;
					if(isset($_POST['asistente']))$roles['asistente'] = 3;
					if(isset($_POST['revisor']))$roles['revisor'] = 4;
					if(isset($_POST['jefe']))$roles['jefe'] = 5;
					//verificar combinacion de roles
					$resultado = $this->checarCombinaciones($roles);
					if($resultado != FALSE){
						$res = $this -> modelo ->altaUsuario($nombre, $correo,$resultado); 	
						if($res){
							echo "Listo";
							exit();
							header("refresh:2;index.php?controlador=Admin&accion=consulta&objeto=usuarios");
						}else{
							echo "No se pudo dar de alta";
							exit();
						}
					}else{
						echo "Combinacion de roles invalida";
						exit();
					}
				}else{
					if(file_exists('View/formularios/AltaUsuario.php')){
						$datos = '1';
						require_once 'View/formularios/AltaUsuario.php';
						$plantilla = new AltaUsuario();
						$pagina=$plantilla->generaPagina($datos);
						echo($pagina) ;
						
					}
					
				}
			}
			else{
				echo "Permiso denegado";
			}	
			break;	
		}

	}

	protected final function bajas($objeto) {
		//var_dump($_POST['idUsuarios']);
		switch($objeto){
			case 'usuarios':
				if(parent::esAdmin($_SESSION['roles'])){
					if(parent::verificar($_POST['idUsuarios'])) {
						$idUsuarios = $_POST['idUsuarios'];
						$idUsuarios = explode(',', $idUsuarios);
						if($var=is_array($idUsuarios)){
							$idUsuarios=array_unique($idUsuarios);
							//var_dump($idUsuarios);
							foreach ($idUsuarios as $key => $id) {
								$this -> verificador -> validaIds($id);
								$res = $this -> modelo -> bajaUsuario($id);
								//var_dump($id);
							}
							
						}
						else {if(is_string($idUsuarios)){
							$this -> verificador -> validaIds($idUsuarios);
						}
						$res = $this -> modelo -> bajaUsuario($idUsuarios);
						}
						//var_dump($res);
						if ($res) {
							echo "Baja Exitosa";
						} else {
							echo "Error no se pudo dar de baja";
						}	
					} else {
						echo "No tienes permisos suficientes";
					}
				}
			break; 
		}
	}

	protected final function consultas($objeto) {
		$res;
		switch($objeto){
			case 'usuarios':
				$res = $this -> modelo -> consultaUsuarios();
				if($res != FALSE){
					if($res != NULL){
				 		$this->diccionario['nombreConsulta']='Usuarios';
						$this->diccionario['encabezado']=array('Codigo','Correo');
						$this->diccionario['datos']=$this->formato->datosArray($res);
						$this->diccionario['totalFilas']=$res->num_rows;
						
					}else{
						$this->diccionario['datos']=FALSE;
					}
				}else{
				 	//DEJA EN BLANCO LA SECCION DATOS PORQUE OCURRIO UN ERROR
					unset($this->diccionario['datos']);
				}				
				echo $this->twig->render('consultaUsuarios.html',$this->diccionario);
				/*
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
				}*/
				
			break;
			case 'usuario':
				if(parent::verificar($_REQUEST['idUsuario'])){
					$id= $_REQUEST['idUsuario'];
					$res = $this -> modelo -> consultaUsuario($id);
					if($res != FALSE){
						if($res != NULL){
					 		$this->diccionario['nombreConsulta']='Usuarios';
							$this->diccionario['encabezado']=array('Codigo','Correo','Roles');
							$this->diccionario['datos']=$this->formato->datosArray($res);
							//$this->diccionario['totalFilas']=$res->num_rows;						
						}else{
							$this->diccionario['datos']=FALSE;
						}
					}else{
					 	//DEJA EN BLANCO LA SECCION DATOS PORQUE OCURRIO UN ERROR
						unset($this->diccionario['datos']);
					}				
					echo $this->twig->render('consultaUsuario.html',$this->diccionario);
				
				}
				
				/*
				if($_REQUEST['idUsuario']==$_SESSION['idUsuario'] || in_array('0',$_SESSION['roles'])){
					if(parent::verificar($_REQUEST['idUsuario'])){
						$id= $_REQUEST['idUsuario'];
						$this -> verificador -> validaIds($id);
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
					echo "NO SE TIENEN LOS PERMISOS";
				}*/
				
			}
			
		}

	protected final function modificaciones($objeto) {
		switch ($objeto) {
			case 'usuario':
				if(parent::esAdmin($_SESSION['roles']) || $_SESSION['codigo'] == $POST['nombreUsuario']) {
					if(parent::verificarParametros($_POST)){
						$dato = $_POST['valor'];
						$campo = $_POST['campo'];
						$id = $_POST['idUsuario'];
						$res = $this -> modelo -> modificaUsuario($dato,$campo,$id); 
						if($res){
							echo "Modificacion realizada";
						}else{
							echo "No se pudo modificar";
						}
					}else{
						echo "Error en la edicion";
					}
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
				
				return FALSE;
			}else{
				
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