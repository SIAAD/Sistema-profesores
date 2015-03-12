<?php
/** @author:Jorge Eduardo Garza Martinez
 * @author:Jesus Alberto Ley Ayon
 * @since: 21/Enero/2015
 * @version 2.0
 */
class Verificador {

	public function validaNombreMateria($nombrecurso) {//here we validate the syntaxis of the name of the course
		if (preg_match("/^[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü\s]{1,90}$/", $nombrecurso))return TRUE;
		else return FALSE;
	}//BIEN
	public function validaNombreCarrera($nombre) {
		if (preg_match('/^[a-zA-Z\s]{10,70}$/', $nombre))return TRUE;
		else return FALSE;
	}//BIEN
	public function validaNombreDepartamento($nombre) {
		if (preg_match('/^[a-zA-Z\s]{10,45}$/', $nombre))return TRUE;
		else return FALSE;
	}//BIEN
	public function validaNombreAcademia($nombre){
		if (preg_match('/^[a-zA-Z\s]{10,70}$/', $nombre))return TRUE;
		else return FALSE;
	}
	public function validaSeccion($seccion) {//function to validate the name of the section
		if (preg_match("/^D[0-9]{2}$/", $seccion))return TRUE;
		else return FALSE;
	}//BIEN
	public function validaNrc($nrc) {//function to validate the nrc of the especific group
		if (preg_match("/^[0-9]{5}$/", $nrc))return TRUE;
		else return FALSE;
	}//BIEN
	public function validaClaveDepartamento($clave){
		if (preg_match("/^[0-9]{4}$/", $clave))return TRUE;
		else return FALSE;
	}//BIEN
	public function validaClaveMateria($clave){
		if (preg_match("/^([A-Z]{1}[0-9]{4})|([A-Z]{2}[0-9]{3})|([A-Z]{3}[0-9]{2})$/", $clave))return TRUE;//et201
		else return FALSE;
	}//BIEN
	public function validaClaveCarrera($clave){
		if (preg_match("/^([A-Z]){3,4}$/", $clave))return TRUE;//et201
		else return FALSE;
	}
	public function validaHora($hora){
		if (preg_match("/^[0-9]{4}$/", $hora)){
			if($hora>=700 && $hora<=2155)return TRUE;
			else return FALSE;			
		}
		else return FALSE;
	}//BIEN
	public function validaCodigo($codigo) {
		if (preg_match("/^[0-9]{7}$/", $codigo))return TRUE;
		else return FALSE;
	}//BIEN
	public function validaFecha($fecha) {//Function to validate the date
		if (strtotime($fecha) == 0)return FALSE;
		else return TRUE;
	}//BIEN
	public function validaPass($p) {//Function to validate the pass with a lenght of 8-20 characters
		if (preg_match("/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/", $p))return TRUE;
		else return FALSE;
	}//BIEN	
	public function validaAbreviacion($abreviacion) {
		if (preg_match("/^[A-ZÑa-z]{3,10}$/", $abreviacion))return TRUE;
		else return FALSE;
	}//BIEN
	public function validaCiclo($ciclo) {
		if (preg_match("/^((20[0-9]{2}[ABV])|(20[0-9]{2}(10|20|80)))$/", $ciclo))return TRUE;
		else return FALSE;
	}//BIEN
	function validaCorreo($correo) {//Function to validate the syntax of email
		$correo = ltrim($correo);
		$correo = rtrim($correo);
		if (preg_match("/^[a-zA-Z]+[a-zA-Z0-9\._-]{2,}[a-zA-Z0-9]@[a-zA-Z0-9]+[.][a-zA-Z]+([.][a-zA-Z]+)*$/", $correo))return TRUE;
		else return FALSE;
	}//BIEN
	function validaCadena($cadena) {//Function to validate the syntax of name

		$cadena = ltrim($cadena);
		$cadena = rtrim($cadena);
		if (preg_match("/^[A-Za-z\sñÑáéíóú]+$/", $cadena))return TRUE;
		else return FALSE;
	}
	function validaNumero($numero){
		if (preg_match("/^[-]?([0-9]+([.][0-9]+)?|[0][.][0-9]+)$/", $numero))return TRUE;
		else return FALSE;
	}
	function validaIds($id){
		if (preg_match("/^([1-9][0-9]*|0)$/", $cadena))return TRUE;
		else return FALSE;
	}
	
	public function limpiaSQL($variables) {//Posibility to use with the other controllers because is more standard this function
		foreach ($variables as $llave => $valor) {
			if (is_string($valor)) {
				$valor = ltrim($valor);
				$valor = rtrim($valor);
				$variables[$llave] = $valor;
			}
		}//Look this wonderful code :D we are gonna to use to another controllers to clean the values.
		return $variables;
	}
	
	public function validaCheckbox($variable){
		if(preg_match("/^on$/",$variable)) return TRUE;
		else return FALSE;
	}
}

/*$ver = new Verificador();
var_dump($ver -> validaNombreCarrera('Licenciatura en Ingenieria en Comunicaciones y Electronica'));
var_dump($ver -> validaNombreCarrera('aaaaaaaaaa'));
var_dump($ver -> validaNombreCarrera('Lice'));
var_dump($ver -> validaNombreCarrera('aaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa'));
var_dump($ver -> validaCodigo('2093663'));
*/
?>