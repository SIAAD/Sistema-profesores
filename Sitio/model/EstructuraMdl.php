<?php
/** @author:Jorge Eduardo Garza Martinez
 * @since: 26/Ene/2015
 * @version 1.0
 */ 
if (file_exists('Model/ModeloStr.php'))require_once 'Model/ModeloStr.php';
else exit();

class EstructuraMdl extends ModeloStr {

	function __construct() {
		parent::__construct();
	}

	function altaMateriaCarrera($materia, $carrera) {

	}

	function bajaMateriaCarrera($materia, $carrera) {

	}

	function consultaMateriaCarrera() {

	}

	function modificacionMateriaCarrera($materia, $carrera) {

	}

	function altaCarrera($nombre, $clave) {
		$cnx = $this -> conexion -> getConexion();
		$sql = "SELECT * FROM carreras WHERE nombre LIKE '$nombre' OR clave LIKE '$clave';";
		if ($res = $cnx -> query($sql)) {
			if ($res -> num_rows > 0) {
				return FALSE;
			} else {
				$sql = "INSERT INTO `carreras` (`nombre`, `clave`) VALUES ('$nombre','$clave');";
				return $res = $cnx -> query($sql);
			}
		} else {
			return FALSE;
		}
	}

	function bajaCarrera() {

	}

	function consultaCarrera() {

	}

	function consultaCarreras() {
		$cnx = $this -> conexion -> getConexion();
		$sql = "SELECT * FROM carreras";
		if ($res = $cnx -> query($sql)) {
			if ($res -> num_rows > 0) {
				return $res;
			} else {
				return null;
			}
		} else {
			return FALSE;
		}
	}

	function modificacionCarrera() {

	}

	function altaMateria() {

	}

	function bajaMateria() {

	}

	function consultaMateria() {

	}

	function modificacionMateria() {

	}

	function altaDepartamento() {

	}

	function bajaDepartamento() {

	}

	function consultaDepartamentos() {

	}

	function modificacionDepartamentos() {

	}

	function altaAcademia() {

	}

	function bajaAcademia() {

	}

	function consultaAcademia() {

	}

	function modificacionAcademia() {

	}

}
?>