<?php
	if(!file_exists('ModeloStr.php')){
		//exit();
		require_once('ModeloStr.php');
	}
	else {
		require_once('ModeloStr.php');
	}
	

 	 class AdminMdl extends  ModeloStr{
	 	public $conexion;
		
		function __construct(){
			//Crea la conexion a la base de datos
			parent::__construct();
			echo "<br>Se hiso conexion a la bd";
		}
		
		function altaAdmin($datosAdmin){
			$miQuery = "INSERT INTO usuarios VALUES('{$datosAdmin['nombre']}', '{{$datosAdmin['contrasena']}', '{$datosAdmin['roles']['tipos']}'";
		}
		
		
	 }
?>