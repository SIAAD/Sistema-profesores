<?php
    if(!file_exists("CtrlStr")){
    	exit();
    }else{
    	require_once("CtrlStr");
    }
	
	class EstructuraCtrl implements CtrlStr {
		
		function __construct(){
			if(!file_exists('../model/EstructuraMdl')){
				exit();
			}else{
				require_once('../model/EstructuraMdl');
				$modelo= new EstructuraMdl();
				if(!file_exists('../Objetos/Verificador')){
					exit();
				}else{
					require_once('../Objetos/Verificador');
					$verificador= new Verificador();
				}
			}
			
		}
		
		function ejecutar(){
			if(checarAcciones()){
				$accion=$_SESSION['accion'];
				$objeto=$_SESSION['objeto'];
				switch ($accion) {
					case 'alta':
						switch ($objeto) {
							case 'carrera':								
								if(isset($_POST['']))
								if()
								$modelo->altaCarrera();
								break;
								
							case 'academia':
								
								break;
								
							case 'materia':
								
								break;
								
							case 'departamento':
								
								break;
							
							default:
								
								break;
						}
						break;
						
					case 'baja':
						switch ($objeto) {
							case 'carrera':
								
								break;
								
							case 'academia':
								
								break;
								
							case 'materia':
								
								break;
								
							case 'departamento':
								
								break;
							
							default:
								
								break;
						}
						break;
						
					case 'consulta':
						switch ($objeto) {
							case 'carrera':
								
								break;
								
							case 'academia':
								
								break;
								
							case 'materia':
								
								break;
								
							case 'departamento':
								
								break;
							
							default:
								
								break;
						}
						break;
					
					case 'modificacion':
						switch ($objeto) {
							case 'carrera':
								
								break;
								
							case 'academia':
								
								break;
								
							case 'materia':
								
								break;
								
							case 'departamento':
								
								break;
							
							default:
								
								break;
						}
						break;
					
					default:
						
						break;
				}
			}else{
				echo "Error no se especificaron acciones ni objetos";
			}
		}
	}
			