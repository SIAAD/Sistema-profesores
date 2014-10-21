<?php
	if(!file_exists('../Objetos/Verificador.php')){
		exit();
	}else{
		require_once('../Objetos/Verificador.php');
	}

    interface CtrlStr{
    	protected $modelo;
		protected $verificador;
		
		public function __construct(){
			$verificador= new Verificador();
		}
		
		public function checarAcciones(){
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
		
    }
?>