<?php


 	 class AdminMdl implements modeloStr{
	 	public $conexion;
		
		function __construct(){
			//Crea la conexion a la base de datos
		}
		
		function altaAdmin($datosAdmin){
			$miQuery = "INSERT INTO usuarios VALUES('{$datosAdmin['nombre']}', '{{$datosAdmin['contrasena']}', '{$datosAdmin['roles']['tipos']}'";
		}
		
		
	 }
?>