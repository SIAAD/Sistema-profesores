<?php
	$path=dirname(dirname(dirname(__FILE__))).'\Sitio\model\ModeloStr.php';
	
if(file_exists($path))require_once $path;
else exit();

 	 class AdminMdl extends  ModeloStr{
		
		function __construct(){
			//Crea la conexion a la base de datos
			parent::__construct();
		}
		
		function altaUsuario($nombre,$correo,$roles){
			$cnx=$this->conexion->getConexion();
			$sql = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
			$pass = '1234567';
			if($res=$cnx->query($sql)){
				if($res->num_rows>0){	
					return FALSE;
				}else{
					$sql="INSERT INTO usuarios (nombre,contrasena,correo) VALUES ('$nombre','$pass','$correo')";
					$res = $cnx -> query($sql);
					$sql="SELECT MAX(idUsuarios) AS idUsuarios FROM usuarios";
					$res = $cnx -> query($sql);
					$fila = $res -> fetch_assoc();
					$idUsuarios = $fila['idUsuarios'];
					foreach ($roles as $key => $idPrivilegios) {
					$sql="INSERT INTO roles (idUsuarios,idPrivilegios) VALUES ($idUsuarios,$idPrivilegios)";
					$res = $cnx -> query($sql);
					}
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
			$cnx=$this->conexion->getConexion();
			$sql = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
			$pass = '1234567';
			if($res=$cnx->query($sql)){
				if($res->num_rows>0){	
					return FALSE;
				}else{
					$sql="INSERT INTO usuarios (nombre,contrasena,correo) VALUES ('$nombre','$pass','$correo')";
					$res = $cnx -> query($sql);
					$sql="SELECT MAX(idUsuarios) AS idUsuarios FROM usuarios";
					$res = $cnx -> query($sql);
					$fila = $res -> fetch_assoc();
					$idUsuarios = $fila['idUsuarios'];
					foreach ($roles as $key => $idPrivilegios) {
					$sql="INSERT INTO roles (idUsuarios,idPrivilegios) VALUES ($idUsuarios,$idPrivilegios)";
					$res = $cnx -> query($sql);
					}
					return $res;	
				}
			}else{
				return FALSE;
			}		
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
			$sql = "SELECT * FROM usuarios us,roles rol, privilegios pri WHERE us.idusuarios = $id AND us.idusuarios = rol.idusuarios AND rol.idPrivilegios = pri.idPrivilegios";
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