<?php
abstract class PlantillaStr {
	public abstract function generaPagina($datos);
	
	public function generaHeader(){
		$roles=$_SESSION['roles'];
	}
	
	public function generaFooter(){
		
	}
	
	public function generaSider(){
		
	}
}
?>