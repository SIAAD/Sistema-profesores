<?php
	if(!file_exists('ctrlStr.php')){
		exit();
	}
	else {
		require_once('ctrlStr.php');
		require_once('../model/PruebaMdl.php');
	}
	session_start();
	
	
    class AdminCtrl extends ctrlStr{
	 	//public $modelo;
	 	//public $verificador;
		function __construct(){
			//Cuando se construye se desea crear el modelo
			parent::__construct();
			$this->modelo=new PruebaMdl();
		}
		
		public function ejecutar(){
			if($this->checarAcciones()){
				$accion = $_REQUEST['accion'];
				//$objeto = $_REQUEST['objeto'];
				var_dump($accion);
				switch ($accion) {
					case 'alta':
						
						include("../view/AltaUsuario.html");
						$this->altas($objeto);
							
						break;
					case 'baja':
						
						break;
					case 'consulta':
						
						break;
					case 'modificacion':
						
						break;
					default:
						
						break;
				}
			}
			else {
				echo "Error no se especificaron acciones u objetos";
			}
		}
		
		public function altas(){
			if(isset($_SESSION[''])){
				if(isset($_POST['nombre']))
					$nombre = $verificador->validaNombreCurso($_POST['nombre']);
				else
					$nombre = false;
				if(isset($_POST['contrasena']))
					$contrasena = $verificador->validaCodigo($_POST['contrasena']);
				else
					$contrasena = false;
				if(isset($_POST['roles']))
					$rol = $verificador->validaRol($_POST['rol']);
				else 
					$rol = false;
				
				
				
				if ($nombre && $contrasena && $rol) {
					$datosAdmin = array('nombre' => $_POST['nombre'],'contrasena' => $_POST['contrasena'],'roles' => $_POST['roles']['tipos']);
					$status = $this->model->insertaUsuario($datosAdmin);
				
				}
			}
		}
		
		public function bajas(){
			
		}
		
		public function consultas(){
			
		}
		
		public function modificaciones(){
			
		}
		
		public function checarAcciones(){
			return true;
		}
	}
	
	$controlador = new AdminCtrl();
	$controlador -> ejecutar();
	var_dump($controlador);
	
	//$controlador->ejecutar();
	



?>