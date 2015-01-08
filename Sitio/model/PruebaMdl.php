<?php

	if($var=file_exists('ModeloStr.php')){
		var_dump($var);
		exit();
	}
	else {
		require_once('ModeloStr.php');
	}

    class PruebaMdl extends ModeloStr{
	 	//public $conexion;
		
		function __construct(){
			//Crea la conexion a la base de datos
			parent::__construct();
			
		}
		
		
		
	 }
?>