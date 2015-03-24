<?php
/** @author:Jorge Eduardo Garza Martinez
 * @author: Jesus Alberto Ley Ayón
 * @since: 26/Ene/2014
 * @version BETA
 */ 
 
require_once 'PlantillaStr.php';

class PaginaInicio extends PlantillaStr{
	
	public final function generaPagina($datos){
		if (session_id() == '')session_start();
		$codigo = $_SESSION['codigo'];
		$roles = $_SESSION['roles'];

		$pagina=parent::generarHead();
		$pagina.=parent::generaHeader($codigo);
		$pagina.=parent::generarNav2();
		$pagina.=parent::generaFooter();
		
		echo $pagina;		
	}
}
?>
