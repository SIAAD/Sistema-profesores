<?php
	if(!file_exists('ctrlStr.php')){
		exit();
	}
	else {
		require_once('ctrlStr.php');
	}
	
    class AdminCtrl implements ctrlStr{
	 	public $modelo;
	 	
		function __construct(){
			//Cuando se construye se desea crear el modelo
			require ('model/adminMdl.php');
			$this->modelo=new adminMdl();
		}
		
		public function ejecutar(){
			if(checarAcciones()){
				$accion = $_SESSION['accion'];
				$objeto = $_SESSION['objeto'];
				switch ($accion) {
					case 'alta':
						if(empty($_POST)){
								require_once("view/AltaUsuario.html");
							}
							else
								$this->alta();
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
		
		public function alta(){
			if($this->isLogged()){
			if(isset($_POST['nombre']))
				$nombre = $verificador->validaNombreCurso($_POST['nombre']);
			else
				$nombre = false;
			if(isset($_POST['contrasena']))
				$contrasena = $verificador->validaCodigo($_POST['nombre']);
			else
				$contrasena = false;
			}
			
			if ($nombre && $contrasena) {
				$datosAdmin = array('nombre' => $_POST['nombre'],'contrasena' => $_POST['contrasena'],'roles' => $_POST['roles']['tipos']);
				$status = $this->model->insertaUsuario($datosAdmin);
				
			}
			
			
		}
	}
?>