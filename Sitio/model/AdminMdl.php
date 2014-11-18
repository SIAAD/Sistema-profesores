<?php
	if(!file_exists('ModeloStr.php')){
		//exit();
		require_once('ModeloStr.php');
	}
	else {
		require_once('ModeloStr.php');
	}
	

 	 class AdminMdl extends  ModeloStr{
		
		function __construct(){
			//Crea la conexion a la base de datos
			parent::__construct();
		}
		
		function altaAdmin($datosAdmin){
			$miQuery = "INSERT INTO usuarios VALUES('{$datosAdmin['nombre']}', '{{$datosAdmin['contrasena']}', '{$datosAdmin['roles']['tipos']}'";
		}
		
		
	 }
?>