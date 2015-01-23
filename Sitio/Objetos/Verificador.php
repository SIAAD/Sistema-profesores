<?php
/** @author:Jorge Eduardo Garza Martinez, Jesus Alberto Ley Ayon
 * @since: 21/Enero/2015
 * @version 2.0
 */
class Verificador {
	
	public function validaNombreMateria($nombrecurso) {//here we validate the syntaxis of the name of the course
		if(preg_match("/[a-zA-Z ñÑáéíóúâêîôûàèìòùäëïöü]{1,90}$/", $nombrecurso)) return TRUE;
		else return FALSE;
	}
	
	public function validaNombreCarrera($nombre) {
		if(preg_match('/[a-zA-Z]{10,70}$/', $nombre)) return TRUE;
 		else return FALSE; 
	}
	
	public function validaNombreDepartamento($nombre) {
		if(preg_match('/[a-zA-Z]{10,45}$/', $nombre))return TRUE;
		else return FALSE;
	}

	public function validaSeccion($seccion) {//function to validate the name of the section
		if (preg_match("/[A-Za-z]+[0-9]+\-D[0-9]+/", $seccion))return TRUE;
		else return FALSE;
	}

	public function validaNrc($nrc) {//function to validate the nrc of the especific group
		if (preg_match("/0[0-9]{4}/", $nrc))return TRUE;
		else return FALSE;
	}

	public function validaSeccion($seccion) {//function to validate the name of the section
		if (preg_match("/^[A-Za-z]+[0-9]+\-D[0-9]+$/", $seccion))
			return TRUE;
		else
			return FALSE;
	}

	/*function validaCodigo($codigo) {//Function to validate the code with a lenght of 9 numbers
	 $codigo = ltrim($codigo);
	 $codigo = rtrim($codigo);
	 //We clean the code first
	 if (preg_match("/^[0-9]{7}/", $codigo))
	 return TRUE;
	 else
	 return FALSE;
	 }*/

	function validaCadena($cadena) {//Function to validate the syntax of name

		$cadena = ltrim($cadena);
		$cadena = rtrim($cadena);
		//We clean the name first
		if (preg_match("/^[A-Za-z\sñÑáéíóúâêîôûàèìòùäëïöü]+/", $cadena)) return TRUE;
		else return FALSE;
	}

	function validaCorreo($correo) {//Function to validate the syntax of email
		$correo = ltrim($correo);
		$correo = rtrim($correo);
		//We clean the email first
		if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/", $correo))return TRUE;
		else return FALSE;
	}

	public function validaFecha($fecha) {//Function to validate the date
		if (strtotime($fecha) == 0)return FALSE;
		else return TRUE;

		//CREAR FECHA DATE(FORMATO,RESULTADO DE FUNCION STRTOTIME)
	}

	public function validaPass($p) {//Function to validate the pass with a lenght of 6-20 characters
		if (preg_match("/^[A-Za-z0-9_\-]{6,20}$/", $p))return true;
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

	public function validaCodigo($codigo) {
		if (preg_match("/^[0-9]{7}$/", $codigo))return true;
		else return false;
	}

	public function validaRol($rol) {
		foreach ($rol as  $value) {
			if (preg_match("/^[1-5]{1}$/", $value)) return true;
			else return false;
		}
	}

	public function validaAbreviacion($abreviacion){
		if (preg_match("^[A-ZÑ]*$/", $nrc)) return TRUE;
		else return FALSE;
	}
	
	public function validaNum($numero){
		if(preg_match("/^[1-9]{1}/",$numero))return TRUE;
		else return FALSE;
	}
	
	public function validaEstatus($estatus){
		if(preg_match("/^[1-3]{1}/",$estatus))
			return TRUE;
		else
			return FALSE;
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