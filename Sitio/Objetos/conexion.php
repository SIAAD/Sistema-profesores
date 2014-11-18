<?php
 
class Conexion {
	private $_connection;
	private static $_instance;
	
	public static function getInstance() {
		if (!self::$_instance) {// If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	// Constructor
	private function __construct() {
		 if(file_exists('Objetos/dbConfig.inc')){
 			require_once('Objetos/dbConfig.inc');
			$this -> _connection = new mysqli($host,$usr,$pass,$db);
 		}else{
 			echo "No se pudo cargar archivo de configuracion DB";
 		}
		
	}

	// Magic method clone is empty to prevent duplication of connection
	private function __clone() {
	}

	// Get mysqli connection
	public function getConexion() {
		return $this -> _connection;
	}
	
	public function closeConexion(){
		$this -> _connection.close();
	}

}
?>
