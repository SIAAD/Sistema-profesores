<?php

	if(!file_exists('../Objetos/Conexion.php')){
		exit();
	}else{
		require_once('../Objetos/Conexion.php');
	}

    class ModeloStr {
        protected $conexion;
		protected $varprueba;
		
		function __construct(){
			$this->conexion = Conexion::getInstance();
		}
		
		
		
    }

?>