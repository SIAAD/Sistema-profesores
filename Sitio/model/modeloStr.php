<?php
	if(!file_exists('Objetos/conexion.php')){
		exit();
	}else{
		require_once 'Objetos/conexion.php';
	}

    class ModeloStr {
        protected $conexion;
		
		
		public function __construct(){
			$this->conexion= Conexion::getInstance();
		}	

    }

?>