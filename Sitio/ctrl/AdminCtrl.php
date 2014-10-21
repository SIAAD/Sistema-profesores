<?php
	if(!file_exists('ctrlStr.php')){
		exit();
	}
	else {
		require_once('ctrlStr.php');
	}
	
    class adminCtrl implements ctrlStr{
	 	public $modelo;
	 	
		function __construct(){
			//Cuando se construye se desea crear el modelo
			require ('model/adminMdl.php');
			$this->modelo=new adminMdl();
		}
		
		function ejecutar(){
			if(checarAcciones()){
				
			}
			else {
				echo "Error no se especificaron acciones u objetos";
			}
		}
	}
?>