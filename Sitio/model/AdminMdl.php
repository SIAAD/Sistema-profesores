<?php
	if(!file_exists('ModeloStr.php'))exit();
	else require_once('ModeloStr.php');	

 	 class AdminMdl extends  ModeloStr{
		
		function __construct(){
			//Crea la conexion a la base de datos
			parent::__construct();
		}
		
		function altaUsuario($nombre,$pass){
			$cnx=$this->conexion->getConexion();
			$sql = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
			$pass = md5($pass);
			if($res=$cnx->query($sql)){
				if($res->num_rows>0){	
					return FALSE;
				}else{
					$sql="INSERT INTO usuarios (nombre,contrasena) VALUES ('$nombre','$pass')";
					$res = $cnx -> query($sql);
					return $res;
				}
			}else{
				return FALSE;
			}			
		}
		
		function bajaUsuario($id){
			$cnx = $this -> conexion -> getConexion();
			$sql = "UPDATE administradores SET estatus = 1 WHERE id = $id";
			$res = $cnx -> query($sql);
			if($res){
				return $res;
			}else {
				return FALSE;
			}
		}
		
		function modificaUsuario($id){
			
		}
		
		function consultaUsuarios(){
			$cnx=$this->conexion->getConexion();
			$sql = "SELECT * FROM usuarios";
			if($res=$cnx->query($sql)){
				if($res->num_rows>0){
					return $res;
				}else{
					return null;
				}
			}else{
				return FALSE;
			}
		}
		
		function consultaUsuario($id){
			$cnx=$this->conexion->getConexion();
			$sql = "SELECT * FROM usuarios WHERE id = $id";
			if($res=$cnx->query($sql)){
				if($res->num_rows>0){
					return $res;
				}else{	
					return null;	
				}
			}else{
				return FALSE;
			}
		}
		
	 }
?>