<?php
/** @author:Jorge Eduardo Garza Martinez
 * @since: 25/03/2015
 * @version 1
 */ 
class outPutFormarter{

	/**
	 * Prototipo de funcion para conversion de informacion a cadena con formato JSON
	 * @param $datos que debe de ser de tipo mysqli_result
	 * @return cadena con formato JSON
	 */
	public function datosJson($datos){
		$res=array();
		$res = $this->datosArray($datos);
		$res= json_encode($res);
		return $res;
	}
	/**
	 * Prototipo de funcion para conversion de informacion a formato xml
	 * @param $datos que debe de ser de tipo mysqli_result
	 * @return cadena con formato xml
	 */
	public function datosXml($datos){
		
		var_dump($datos);
		$test=array_flip($this->datosArray($datos));
		var_dump($test);		
		$xml = new SimpleXMLElement('<datos/>');
		array_walk_recursive($test, array ($xml, 'addChild'));
		var_dump($xml->asXML());
	}
	/**
	 * Prototipo de funcion para conversion de informacion a un array asociativo
	 * @param $datos que debe de ser de tipo mysqli_result
	 * @return array asociativo
	 */
	public function datosArray($datos){
		$res=array();
		$arreglo=array();
		foreach ($datos as $fila) {
			$keys=array_keys($fila);
			foreach ($keys as $key) {
				$arreglo[$key]=$fila[$key];
			}
			
			$res[]=$arreglo;
		}
		return $res;
	}
}

?>