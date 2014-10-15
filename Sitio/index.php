<?php

	/**
	 * @author:Jesus Alberto Ley Ayón & Jorge Eduardo Garza
	 * @since: 09/Oct/2014
	 * @version ALFA
	 * @param usuario This describes to where the controller is passed to, there are 3 users 'alumno' 'maestro' 'admin'
	 * @param accion This describes what action is taking depends on each user
	 */
	session_start();
	//conexion
	require_once('Objetos/conexion.php');
	$conexion=$_connection.getConnection();
	
	function verificarLogIn($user,$psw){
		$sql="SELECT * FROM usuarios WHERE nombre='$user'AND contrasena='$psw'";
		$res=conexion.querry($sql);
		var_dump($res);
		return 1;
	}
	
	function regresaRol($idUsuaio){
		return 1;
	}
	
	if(!isset($_SESSION['idUsuario'])){
		if(isset($_POST['enviar'])){
			if(isset($_POST['codigo'])&&isset($_POST['pass'])){
				$usr=$_POST['codigo'];
				$psw=$_POST['pass'];
				//depurar variables objeto depurador
				//verificar
				
				$idUsuario=verificarLogIn($usr,$psw);
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

