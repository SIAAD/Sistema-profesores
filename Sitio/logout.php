<?php
/** @author:Jesus Alberto Ley Ayón & Jorge Eduardo Garza Martinez
 * @since: 20/Oct/2014
 * @version 1.0
 */
 if(file_exists('Objetos/cookies.php')){
 	require_once('Objetos/cookies.php');
	$cookies= new Cookies();	 
 }else{
 	exit();
 } 
 
//Crear sesión
session_start();

var_dump($_SESSION);
$nombre=$_SESSION['codigo'];
echo "$nombre";
$cookies->delete($nombre);
var_dump($_COOKIE);

//Vaciar sesión
$_SESSION = array();
//Destruir Sesión
session_destroy();
//Redireccionar a login.php
header("location: view/formularios/login.html");
//header('location: index.php');
?>