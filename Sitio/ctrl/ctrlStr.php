<?php
	
	if(!file_exists('Objetos/Verificador.php')){
		echo "<br>Archivo verificador no existe";	
		//exit();
		require_once('Objetos/Verificador.php');
	}else{
		
		require_once('Objetos/Verificador.php');
	}

    class CtrlStr{
    	protected $modelo;
		protected $verificador;
		
		public function __construct(){
			echo "<br>objeto verificador";
			$this->verificador= new Verificador();
			
		}
		
		protected function checarAcciones(){
			if(isset($_POST['accion'])&&!empty($_POST['accion'])){
				if(isset($_POST['objeto'])&&!empty($_POST['objeto'])){
					return TRUE;
				}else{
					return FALSE;
				}
			}else{
				return FALSE;
			}
		}
		
		public function ejecutar(){
			
		}
		protected function altas(){
			
		}
		protected function bajas(){
			
		}
		protected function consultas(){
			
		}
		protected function modificaciones(){
			
		}		
    }
?>