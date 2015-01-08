<?php

	if(!file_exists('../Sitio/Objetos/Verificador.php')){
		exit();
	}else{
		require_once('../Sitio/Objetos/Verificador.php');
	}

    class CtrlStr{
    	protected $modelo;
		protected $verificador;
		
		public function __construct(){
			$this->verificador= new Verificador();
		}
		
		protected function checarAcciones(){
			if(isset($_GET['accion'])&&!empty($_GET['accion'])){
				if(isset($_GET['objeto'])&&!empty($_GET['objeto'])){
					return TRUE;
				}else{
				return FALSE;
				}
			}
		}
		
		public function ejecutar(){
			
		}
		protected function altas($objeto){
			
		}
		protected function bajas($objeto){
			
		}
		protected function consultas($objeto){
			
		}
		protected function modificaciones($objeto){
			
		}
		
		protected function verificar($variable){
			if(isset($variable) && !empty($variable) && is_string($variable)) return TRUE;
			else return FALSE;
		}	
    }
?>