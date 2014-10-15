<?php
	/**
	 * @author:Jesus Alberto Ley Ayón & Jorge Eduardo Garza
	 * @since: 09/Oct/2014
	 * @version ALFA
	 * @param usuario This describes to where the controller is passed to, there are 3 users 'alumno' 'maestro' 'admin'
	 * @param accion This describes what action is taking depends on each user
	 */
	 
	 function verificarLogIn($user,$psw,$bd){
		$sql="SELECT * FROM usuarios WHERE nombre='$user'AND contrasena='$psw'";
		echo $sql;
		$res=$bd->query($sql);
		var_dump($res);
		return -1;
	}
	
	function regresaRol($idUsuario){
		return 1;
	}
	
	$conexion;
	$bd;
	session_start();
	//conexion
	if(file_exists('Objetos/Conexion.php')){
		require_once('Objetos/Conexion.php');
		$conexion=Conexion::getInstance();
		$bd=$conexion->getConexion();
	}	
	if(!isset($_SESSION['idUsuario'])){
		if(isset($_POST['enviar'])){
			if(isset($_POST['codigo'])&&isset($_POST['pass'])){
				$usr=$_POST['codigo'];
				$psw=$_POST['pass'];
				//depurar variables objeto depurador
				//verificar
				
				$idUsuario=verificarLogIn($usr,$psw,$bd);
				if($idUsuario>0){
					//Si existe iniciar sesion
					//variable de tiempo de sesion
					//permisos del usuario en tabla roles
					$roles=regresaRol($idUsuario);
					$_SESSION['idUsuario']=$idUsuario;
					$_SESSION['codigo']=$usr;
					$_SESSION['roles']=$roles;
					header("Location:index.php");
				}else{
					echo "Usuario o contrasena Invalida";
				}
			}
			header("Location:view/login.html");
		}
		
	}else{
		echo "Su usuario es correcto";
		//realizar tareas de index normales
	}
?>	

