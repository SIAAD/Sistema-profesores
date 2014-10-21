<?php
    if(!file_exists("CtrlStr")){
    	exit();
    }else{
    	require_once("CtrlStr");
    }
	
	class EstructuraCtrl implements CtrlStr {
		
		function ejecutar(){
			if(checarAcciones()){
				$accion=$_SESSION
				switch (variable) {
					case 'value':
						
						break;
					
					default:
						
						break;
				}
			}else{
				echo "Error no se especificaron acciones ni objetos";
			}
		}
	}
			