<?php
/** @author:Jorge Eduardo Garza Martinez
 * @author:Jesus Alberto Ley Ayon
 * @since: 3/Marzo/2015
 * @version 0.5
 */
class ProcesadorPlantillas {
	protected $archivo;
	protected $valores = array();

	/**
	 * This function allows the object to work with different Templates
	 * @param $file must be a string with the path of the template we are going to work
	 * @return NULL if $file is not a string and FALSE if the path is wrong
	 */
	public function setFile($file) {
		if (!is_string($file)) {
			return NULL;
		} else {
			if (file_exists($file))
				$this -> archivo = $file;
			else
				return FALSE;
		}
	}

	/**
	 * This function allows the object to store several values that will be used to replace in the template
	 * @param $key
	 * @param $value
	 */
	public function setValue($key, $value) {
		$this -> valores[$key] =array('tag'=>"[@$key]",'value'=>$value);
	}

	public function generateFile() {
		if (!file_exists($this -> file))return "Error loading template file ($this->file).";
		
		$output = file_get_contents($this -> file);
		foreach ($this->valores as $key => $valor) {
			$output = str_replace($valor['tag'], $valor['value'], $output);
		}
		return $output;
	}
}
?>