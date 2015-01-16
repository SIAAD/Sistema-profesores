<?php

	if(!file_exists('../Sitio/Objetos/Verificador.php')){
		exit();
	}else{
		require_once('../Sitio/Objetos/Verificador.php');
	}

    class CtrlStr{
    	protected $modelo;
		protected $verificador;
		const ADMIN = 0;
		const MTRS = 1;
		const ASIS = 2;
		const REVIS = 3;
		const JEFDEP = 4;
		
		public function __construct(){
			$this->verificador= new Verificador();
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
		
		protected function esAdmin($var){
			if(in_array(CtrlStr::ADMIN,$var)) return TRUE;
			else return FALSE;
		}
		
		protected function esMstr($var){
			if(in_array(CtrlStr::MSTR,$var)) return TRUE;
			else return FALSE;
		}
		
		protected function esAsis($var){
			if(in_array(CtrlStr::ASIS,$var)) return TRUE;
			else return FALSE;
		}
		
		protected function esRevis($var){
			if(in_array(CtrlStr::REVIS,$var)) return TRUE;
			else return FALSE;
		}
		
		protected function esJefDep($var){
			if(in_array(CtrlStr::JEFDEP,$var)) return TRUE;
			else return FALSE;
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
    }
?>