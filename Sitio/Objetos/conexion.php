<?php

/*
 * Mysql database class - only one connection alowed
 */ 
 
class Conexion {
	private $_connection;
	private static $_instance;

	/*
	 Get an instance of the Database
	 @return Instance
	 */
	public static function getInstance() {
		if (!self::$_instance) {// If no instance then make one
			self::$_instance = new self();
		}
		return self::$_instance;
	}

	// Constructor
	public function __construct() {
		 if(file_exists('Objetos/dbConfig.inc')){
 			require_once('Objetos/dbConfig.inc');
 		}else{
 			echo "No se pudo cargar archivo de configuracion DB";
 		}
		//$this -> _connection = new mysqli(HOST, USR, PASS, DB);
		$this -> _connection = new mysqli($host, $usr, $pass, $db);
		// Error handling
		if (mysqli_connect_error()) {
			trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(), E_USER_ERROR);
		}
	}

	// Magic method clone is empty to prevent duplication of connection
	private function __clone() {
	}

	// Get mysqli connection
	public function getConnection() {
		return $this -> _connection;
	}
	
	public function closeConnection(){
		$this -> _connection.close();
	}

}
?>
