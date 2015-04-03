<?php
/** @author:Jorge Eduardo Garza Martinez
 * @since: 04/Feb/2015
 * @version 1.5
 * @see CtrlStr.php
 */ 
if(!file_exists("ctrl/CtrlStr.php"))exit();
else require_once ("CtrlStr.php");

class EstructuraCtrl extends CtrlStr{

	public function __construct(){
		parent::__construct();
		if(!file_exists('Model/EstructuraMdl.php')){
			exit();
		}else{
			require_once 'Model/EstructuraMdl.php';
			$this -> modelo = new EstructuraMdl();
		}
	}

	protected final function altas($objeto){
		switch($objeto) {
			case 'carrera' :
				//BIEN
				if (parent::esAdmin($_SESSION['roles']) || parent::esAsis($_SESSION['roles']) || parent::esJefDep($_SESSION['roles'])) {
					if (parent::verificarParametros($_POST)) {
						$nombre = $_POST['nombreCarrera'];
						$clave = $_POST['claveCarrera'];
						$res = $this -> modelo -> altaCarrera($nombre, $clave);
						if ($res) {
							header("refresh:2;index.php?controlador=Estructura&accion=consulta&objeto=carreras");
						} else {
							echo "Error no se pudo dar de alta";
						}
					} else {
						require_once 'View/formularios/altaCarrera.html';
					}
				} else {
					echo "Permiso denegado";
				}
				break;

			case 'departamento' :
				//BIEN
				if (parent::esAdmin($_SESSION['roles'])) {
					if (parent::verificarParametros($_POST)) {
						$nombre = $_POST['nombreDepartamento'];
						$clave = $_POST['claveDepartamento'];
						$abreviacion = $_POST['abreviacionDepartamento'];
						
						//separar codigo y nombre
						$datosMaestro=$_POST['datosMaestro'];
						$corte = preg_split("/(([A-Za-z]+\s){2,}\s*)|((\([\s]*)|([\s]*\)))/",$datosMaestro,-1,PREG_SPLIT_NO_EMPTY);
						$codigoMaestro=$corte[0];
						if ($this -> modelo -> altaDepartamento($nombre, $clave, $abreviacion,$codigoMaestro)) {
							header("refresh:2;index.php?controlador=Estructura&accion=consulta&objeto=departamentos");
						} else {
							echo "Error no se pudo dar de alta";
						}
					} else {
						//pedir listado de maestros para utilizar en alta departamento						
						require_once 'View/formularios/AltaDepartamento.php';
						//var_dump($_POST);
					}
				} else {
					echo "Permiso denegado";
				}
				break;

			case 'academia' :
				if (parent::esAdmin($_SESSION['roles']) || parent::esAsis($_SESSION['roles']) || parent::esJefDep($_SESSION['roles'])) {
					if (parent::verificarParametros($_POST)) {
						$nombre = $_POST['nombreAcademia'];
						$abreviacion = $_POST['abreviacionAcademia'];
						$idMaestro = $_POST['idMaestro'];
						$res = $this -> modelo -> altaAcademia($nombre, $abreviacion, $idMaestro);
						if ($res) {
							header("refresh:2;index.php?controlador=Estructura&accion=consulta&objeto=academia");
						} else {
							echo "Error no se pudo dar de alta";
						}
					} else {
						require_once 'View/formularios/altaAcademia.html';
					}
				} else {
					echo "Permiso denegado";
				}
				break;

			case 'materiaCarrera' :
				if (parent::esAdmin($_SESSION['roles']) || parent::esAsis($_SESSION['roles']) || parent::esJefDep($_SESSION['roles'])) {
					if (parent::verificarParametros($_POST)) {
						$idMateria = $_POST['idMateria'];
						$idCarrera = $_POST['idCarrera'];
						$res = $this -> modelo -> altaMateriaCarrera($idMateria,$idCarrera);
						if ($res) {
							header("refresh:2;index.php?controlador=Estructura&accion=consulta&objeto=carrera&idcarrera='$carrera'");
						} else {
							echo "Error no se pudo dar de alta";
						}
					} else {
						require_once 'View/formularios/altaAcademia.html';
					}
				} else {
					echo "Permiso denegado";
				}
				break;

			case 'materia' :
				if (parent::esAdmin($_SESSION['roles']) || parent::esAsis($_SESSION['roles']) || parent::esJefDep($_SESSION['roles'])) {
					if(parent::verificarParametros($_POST)) {
						$nombre = $_POST['nombreMateria'];
						$clave = $_POST['claveMateria'];
						$idAcademia = $_POST['idAcademia'];
						$res = $this -> modelo -> altaMateria($nombre, $clave, $idMateria);
						if ($res) {
							header("refresh:2;index.php?controlador=Estructura&accion=consulta&objeto=materia");
						}else{
							echo "Error no se pudo dar de alta";
						}
					} else {
						require_once 'View/formularios/altaMateria.html';
					}
				} else {
					echo "Permiso denegado";
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
			case 'carreras' :
				//BIEN
				$res = $this -> modelo -> consultaCarreras();
				/*if ($res != FALSE) {
					if ($res != null) {
						if (file_exists('View/plantillas/plantillas viejas/consultaCarreras.php')) {
							require_once 'View/plantillas/plantillas viejas/consultaCarreras.php';
							$plantilla = new ConsultaCarreras();
							$pagina = $plantilla -> generaPagina($res);
							echo $pagina;
						} else {
							echo "Error no se pudo incluir la plantilla consultaCarreras";
						}
					} else {
						echo "NO HAY NADA EN LA TABLA";
					}
				} else {
					echo "ERROR NO SE REALIZO LA CONSULTA";
				}*/
				if($res != FALSE){
					if($res != NULL){
				 		$this->diccionario['nombreConsulta']='Carreras';
						$this->diccionario['encabezado']=array('Nombre','Clave');
						$this->diccionario['datos']=$this->formato->datosObjetos($res);
						$this->diccionario['totalFilas']=4;
					}else{
						$this->diccionario['datos']=FALSE;
					}
				}else{
				 	//DEJA EN BLANCO LA SECCION DATOS PORQUE OCURRIO UN ERROR
					//$this->diccionario['datos']=FALSE;
				}
				
				/*$datos=array(
					array('id'=>'1',
						  'nombre'=>'Ingenieria en Computacion',
						  'clave'=>'INCO'),
					array('id'=>'2',
						  'nombre'=>'Ingenieria en Informatica',
						  'clave'=>'INFO'),
					array('id'=>'3',
						  'nombre'=>'Ingenieria en Biomedica',
						  'clave'=>'INBI'),
					array('id'=>'4',
						  'nombre'=>'Ingenieria en Comunicaciones y Electronica',
						  'clave'=>'INCE'),
				);*/
				//$this->diccionario['totalFilas']=4;
				echo $this->twig->render('consultaCarreras.html',$this->diccionario);
				break;
				
			case 'carrera' :
				$var= array();
				$var['idCarrera']=$_GET['idCarrera'];
				$var['nombreCarrera']=$_GET['nombreCarrera'];
				if(parent::verificarParametros($var)){
					echo 'variables correctas iniciando consulta';
					$res=$this->modelo->consultaCarrera($var['idCarrera'],$var['nombreCarrera']);
				}else{
					echo 'error en las variables necesarias para la consulta';
				}
				
				//problema>> ocupamos verificar el idCarrera y el nombre para prevenir inyeccion de SQL
				
				
				break;

			case 'departamentos' :
				$res = $this -> modelo -> consultaDepartamentos();
				if ($res != FALSE) {
					if ($res != null) {				 
						if (file_exists('View/plantillas/consultaDepartamentos.php')) {
							require_once 'View/plantillas/consultaDepartamentos.php';
							$plantilla = new ConsultaDepartamento();
							$pagina = $plantilla -> generaPagina($res);
							echo $pagina;
						} else {
							echo "Error no se pudo incluir la plantilla consultaCarreras";
						}
					} else {
						echo "NO HAY NADA EN LA TABLA";
					}
				} else {
					echo "ERROR NO SE REALIZO LA CONSULTA";
				}
				break;

			case 'departamento' :
				break;

			case 'academias' :
				$res = $this -> modelo -> consultaAcademias();
				if ($res != FALSE) {
					if ($res != null) {
						if (file_exists('View/plantillas/consultaAcademias.php')) {
							require_once 'View/plantillas/consultaAcademias.php';
							$plantilla = new ConsultaAcademias();
							$pagina = $plantilla -> generaPagina($res);
							echo $pagina;
						} else {
							echo "Error no se pudo incluir la plantilla consultaCarreras";
						}
					} else {
						echo "NO HAY NADA EN LA TABLA";
					}
				} else {
					echo "ERROR NO SE REALIZO LA CONSULTA";
				}
				break;

			case 'academia' :
				break;

			case 'materias' :
				$res = $this -> modelo -> consultaMaterias();
				if ($res != FALSE) {
					if ($res != null) {
						if (file_exists('View/plantillas/consultaMaterias.php')) {
							require_once 'View/plantillas/consultaMaterias.php';
							$plantilla = new ConsultaMaterias();
							$pagina = $plantilla -> generaPagina($res);
							echo $pagina;
						} else {
							echo "Error no se pudo incluir la plantilla consultaCarreras";
						}
					} else {
						echo "NO HAY NADA EN LA TABLA";
					}
				} else {
					echo "ERROR NO SE REALIZO LA CONSULTA";
				}
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
	
	protected final function clonar($objeto){
		switch ($objeto) {
			case 'horario':
				
				break;
			
			default:
				
				break;
		}
	}

}
?>
