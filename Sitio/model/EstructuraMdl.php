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

	function altaMateria($nombre,$clave,$idAcademia=NULL) {
		$cnx = $this -> conexion -> getConexion();
		$sql = "SELECT * FROM materia WHERE nombre LIKE '$nombre' OR clave LIKE '$clave';";
		if ($res = $cnx -> query($sql)) {
			if ($res -> num_rows > 0) {
				//ya existe una materia en la base de datos
				return FALSE;
			} else {
				if($idAcademia==NULL)$sql = "INSERT INTO `materia` (`nombre`, `clave`) VALUES ('$nombre','$clave');";
				else $sql = "INSERT INTO `materia` (`nombre`, `clave`,`idAcademia`) VALUES ('$nombre','$clave','$idAcademia');";
				return $res = $cnx -> query($sql);
			}
		} else {//NO SE PUDO REALIZAR LA CONSULTA
			return FALSE;
		}
	}

	function bajaMateria() {

	}

	function consultaMateria() {

	}

	function modificacionMateria() {

	}

	function altaDepartamento($nombre,$clave,$abreviacion,$codigoMaestro=NULL) {
		$cnx = $this -> conexion -> getConexion();
		
		$sql="SELECt `nombre`, `clave` FROM departamento where nombre LIKE '$nombre' OR clave LIKE '$clave';";
		if ($res = $cnx -> query($sql)) {
			if ($res -> num_rows > 0) {
				//ya existe una materia en la base de datos
				return FALSE;
			} else {
				if($codigoMaestro==NULL){
					echo "CodigoMaestro NULL";
					var_dump($codigoMaestro);
					$sql="INSERT INTO `departamento`( `nombre`, `clave`, `abreviacion`, `idMaestros`) VALUES ('$nombre','$clave','$abreviacion',(SELECT (IdMaestros)FROM maestros WHERE codigo='1111111'));";
				}else{
					 $sql="INSERT INTO `departamento`( `nombre`, `clave`, `abreviacion`, `idMaestros`) VALUES ('$nombre','$clave','$abreviacion',(SELECT (IdMaestros)FROM maestros WHERE codigo='$codigoMaestro'));";
				}
				if($res = $cnx -> query($sql)) return TRUE;
				else{
					if(mysqli_errno($cnx)=='1048'){
						echo "Error corrupcion de datos detectada";
						echo "Errormessage:". $cnx->error.'<br>'.mysqli_errno($cnx).'<br>'.$cnx->errno;
						exit();
					}else{
						return FALSE;
					}
				} 
			}
		} else {//NO SE PUDO REALIZAR LA CONSULTA
			return FALSE;
		}
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