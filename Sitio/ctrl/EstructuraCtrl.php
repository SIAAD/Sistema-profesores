<?php
    if(!file_exists("CtrlStr")){
    	exit();
    }else{
    	require_once("CtrlStr");
    }
	
	class EstructuraCtrl implements CtrlStr {
		
		function ejecutar(){
			if(checarAcciones()){
				$accion=$_SESSION['accion'];
				switch ($accion) {
					case 'alta':
						
						break;
						
					case 'baja':
						
						break;
						
					case 'consulta':
						
						break;
					
					default:
						
						break;
				}
			}else{
				echo "Error no se especificaron acciones ni objetos";
			}
		}
	}
			