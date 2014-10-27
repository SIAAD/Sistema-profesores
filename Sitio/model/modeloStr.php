<?php

	if(!file_exists('../Objetos/Conexion.php')){
		exit();
	}else{
		require_once('../Objetos/Conexion.php');
	}

    interface ModeloStr{
        protected $conexion;
		
		function __construct(){
			$conexion= Conexion::getInstance();
		}
		
		
		
    }

?>