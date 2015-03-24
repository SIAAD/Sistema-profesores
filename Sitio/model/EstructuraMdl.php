<?php
/** @author:Jorge Eduardo Garza Martinez
 * @since: 26/Ene/2015
 * @version 1.0
 * @see  ModeloStr.php
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
	/**
	 * This function insert a new career in carreras table
	 * @param nombre the name of the signature
	 * @param clave numbre of signatura
	 * @return FALSE if the name or code already exsist or couldn't realized the input, TRUE if the querry is done
	 */
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
	/**
	 * This function return the deteails of one career
	 * @param idCarrera
	 * @param nombreCarrera
	 * @return return FALSE if the querry was not made, NULL if the querry return an empty result, a vector if the querry was succesfully done
	 */
	function consultaCarrera($idCarrera=NULL,$nombreCarrera=NULL) {
		if($idCarrera==NULL || $nombreCarrera==NULL){
			$cnx = $this-> conexion ->getConexion();
			$sql="SELECT * FROM carreras where idCarreras=$idCarrera;";
			
			echo "error alguno de los parametros esta vacio";
		}else{
			echo "iniciando consulta";
		}
	}
	/**
	 * This function return all the Carreers in a list
	 * @param None
	 * @return return FALSE if the querry was not made, NULL if the querry return an empty result and a mysqi_result object if the querry was succesfully done
	 */
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
	/**
	 * This function insert a new signature in materia table
	 * @param nombre the name of the signature
	 * @param clave numbre of signatura
	 * @param nombreDepartamento name of the department it belongs to
	 * @param nombreAcademia name of the academy it belong to
	 * @return FALSE if the name or code already exsist or couldn't realized the input, TRUE if the querry is done
	 */
	function altaMateria($nombre,$clave,$nombreDepartamento=NULL,$nombreAcademia=NULL) {
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
	/**
	 * This function insert a new department in departamento table
	 * @param nombre the name of the department
	 * @param clave numbre of department
	 * @param abreviacion a string of letter use as a shortname
	 * @param codigoMaestro code of the ruler XD
	 * @return FALSE if the name or code already exsist or couldn't realized the input, TRUE if the querry is done
	 */
	
	function altaDepartamento($nombre,$clave,$abreviacion,$codigoMaestro=NULL) {
		$cnx = $this -> conexion -> getConexion();
		
		$sql="SELECt `nombre`, `clave` FROM departamento where nombre LIKE '$nombre' OR clave LIKE '$clave';";
		if ($res = $cnx -> query($sql)) {
			if ($res -> num_rows > 0) {
				//ya existe una materia en la base de datos
				return FALSE;
			} else {
				if($codigoMaestro==NULL){
					$sql="INSERT INTO `departamento`( `nombre`, `clave`, `abreviacion`, `idMaestros`) VALUES ('$nombre','$clave','$abreviacion',(SELECT (IdMaestros)FROM maestros WHERE codigo='1111111'));";
				}else{
					 $sql="INSERT INTO `departamento`( `nombre`, `clave`, `abreviacion`, `idMaestros`) VALUES ('$nombre','$clave','$abreviacion',(SELECT (IdMaestros)FROM maestros WHERE codigo='$codigoMaestro'));";
				}
				$sql.="INSERT INTO `academia`( `nombre`, `abreviacion`, `idMaestros`, `idDepartamento`) VALUES ('Sin Academia ".$nombre."','N/A ".$abreviacion."',(SELECT (IdMaestros)FROM maestros WHERE codigo='$codigoMaestro')";
				$sql.=",(SELECT (IdDepartamento)FROM departamento WHERE nombre='$nombre' AND clave = '$clave'))";
				//ASEGURARME QUE EL MAESTRO SEA USUARIO Y SI
				
				if($res=$cnx->multi_query($sql)) return TRUE;
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
	function consultaDepartamento(){
		
	}
	
	/**
	 * This function return all the Departments in a list
	 * @param None
	 * @return return FALSE if the querry was not made, NULL if the querry return an empty result and a mysqi_result object if the querry was succesfully done
	 */
	function consultaDepartamentos() {
		$cnx = $this -> conexion -> getConexion();
		$sql = "SELECT * FROM jefesdpto";
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