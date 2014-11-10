<?php
	if(!file_exists('../Objetos/Verificador.php')){
		exit();
	}else{
		require_once('../Objetos/Verificador.php');
	}
	
	
    class ctrlStr{
    	protected $modelo; // las interfases no tienen atributos
		protected $verificador;
		
		public function getVerificador(){
			return  $this->verificador;
		}
		
		
		public function __construct(){
			$this->verificador= new Verificador();
		}
		//las funciones de las interfases no tienen body
		public function checarAcciones(){
			
		}/*{
			if(isset($_POST['accion'])&&!empty($_POST['accion'])){
				if(isset($_POST['objeto'])&&!empty($_POST['objeto'])){
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}*/
		
		public function ejecutar(){
			
		} //les quite el tipo protected, no funciona para interfaces
		public function altas(){
			
		}
		public function bajas(){
			
		}
		public function consultas(){
			
		}
		public function modificaciones(){
			
		}		
    }
?>