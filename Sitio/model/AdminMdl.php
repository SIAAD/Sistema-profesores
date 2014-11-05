<?php
	if(!file_exists('mdlStr.php')){
		exit();
	}
	else {
		require_once('mdlStr.php');
	}
	

 	 class AdminMdl extends  modeloStr{
	 	public $conexion;
		
		function __construct(){
			//Crea la conexion a la base de datos
			$conexion = Conexion::getInstance();
		}
		
		function altaAdmin($datosAdmin){
			$miQuery = "INSERT INTO usuarios VALUES('{$datosAdmin['nombre']}', '{{$datosAdmin['contrasena']}', '{$datosAdmin['roles']['tipos']}'";
		}
		
		
	 }
?>