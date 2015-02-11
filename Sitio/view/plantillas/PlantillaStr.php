<?php
/** @author:Jorge Eduardo Garza Martinez
 * @since: 26/Ene/2015
 * @version BETA
 */ 
 $path=dirname(dirname(dirname(__FILE__))).'\Ctrl\CtrlStr.php';
var_dump($path);
require_once $path;

abstract class PlantillaStr {
	public abstract function generaPagina($datos);
	
	protected function generaHeader(){
	
	}
	public static function generarNav(){
		$idUsuario=$_SESSION['idUsuario'];
		$nav='<nav><ul><li><h3>';
		
		//MENU USUARIOS
		if(CtrlStr::esAdmin($_SESSION['roles']))$nav.='<a href="../../index.php?controlador=Admin&accion=consulta&objeto=usuarios">';
		else $nav.="<a href='../../index.php?controlador=Admin&accion=consulta&objeto=usuario&idUsuario=$idUsuario'>";
		$nav.='Usuarios</a></h3><ul><li>';
		if(CtrlStr::esAdmin($_SESSION['roles']))$nav.='<a href="../../index.php?controlador=Admin&accion=alta&objeto=usuario">Alta Usuario</a></li><li>';
		$nav.="<a href='../../index.php?controlador=Admin&accion=modificar&objeto=usuario&idUsuario=$idUsuario'>Modificar Usuario</a></li></ul></li>";
		
		//MENU ESTRUCTURA
		//departamento
		$nav.="<li><h3>Estructura</h3>";
		$nav.="<ul><li><h4><a href='../../index.php?controlador=Estructura&accion=consulta&objeto=departamentos'>Departamentos</a></h4></li><ul>";
		if(CtrlStr::esAdmin($_SESSION['roles'])){
			$nav.="<li><a href='../../index.php?controlador=Estructura&accion=altas&objeto=departamento'>Altas</a></li>";
		}
		if(CtrlStr::esJefDep($_SESSION['roles'])){
			$nav.="<li><a href='../../index.php?controlador=Estructura&accion=modificaciones&objeto=departamento&idDepartamento=$idDepartamento'>Modificaciones</a></li>";			
		}
		$nav.='</ul>';
		
		
		$nav.="<li><h4><a href='../../index.php?controlador=Estructura&accion=consulta&objeto=academias'>Academias</a></h4></li><ul>";
		if(CtrlStr::esAdmin($_SESSION['roles'])||CtrlStr::esJefDep($_SESSION['roles'])||CtrlStr::esAsis($_SESSION['roles'])){
			$nav.="<li><a href='../../index.php?controlador=Estructura&accion=altas&objeto=academia'>Altas</a></li>";
		}
		if(CtrlStr::esRevis($_SESSION['roles'])){
			$idAcademia=$_SESSION['idAcademia'];
			$nav.="<li><a href='../../index.php?controlador=Estructura&accion=modificaciones&objeto=academia&idAcademia=$idAcademia'>Modificaciones</a></li>";			
		}
		$nav.='</ul>';
		
		$nav.="<li><h4><a href='../../index.php?controlador=Estructura&accion=consulta&objeto=carreras'>Carreras</a></h4></li><ul>";
		if(CtrlStr::esAdmin($_SESSION['roles'])||CtrlStr::esJefDep($_SESSION['roles'])||CtrlStr::esAsis($_SESSION['roles'])){
			$nav.="<li><a href='../../index.php?controlador=Estructura&accion=alta&objeto=carrera'>Altas</a></li>";
		}
		$nav.='</ul>';
		
		return $nav;
		//'</ul></nav>'
	}
	protected function generaFooter(){
		
	}
	
	protected function generaSider(){
		
	}
}
?>