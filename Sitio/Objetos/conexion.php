<?php

/*
 * Mysql database class - only one connection alowed
 */
 require_once('dbConfig.inc');
 
class Database {
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
	private function __construct() {
		$this -> _connection = new mysqli(SERVIDOR, USR, PASS, DB);
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
