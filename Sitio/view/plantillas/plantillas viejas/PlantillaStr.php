<?php
/** @author:Jorge Eduardo Garza Martinez
 * @since: 26/Ene/2015
 * @version BETA
 */ 
$path=dirname(dirname(dirname(dirname(__FILE__)))).'\Ctrl\CtrlStr.php';
if(file_exists($path))require_once $path;
else exit();

abstract class PlantillaStr {
	public abstract function generaPagina($datos);
	
	protected static function generarHead(){
		return '<!DOCTYPE html>
		<html lang="en">
			<head>
				<meta charset="utf-8">
				<meta http-equiv="X-UA-Compatible" content="IE=edge">
				<meta name="viewport" content="width=device-width, initial-scale=1">
				<title>SIIAD</title>
				<link rel="stylesheet" type="text/css" href="View/bootstrap/css/bootstrap.css"/>
			</head>';	
	}
	protected static function generaHeader($codigo=NULL){
		
		
		if($codigo==NULL){
			echo "no se ingreso codigo";
			//exit();
		}
		return "<body>
		<div class='container'>
			<header class='page-header'>
				<div class='row''>
					<div class='col-md-8 col-sm-10 col-xs-12'>
						<h1 class='text-center'>SIAAD
						<br />
						<small>Sistema Integral de Apoyo Administrativo y Docente</small></h1>
					</div>
					<div class='col-md-4 col-sm-2 col-xs-12'>
						<div class='row text-center'>
							<div class=' col-xs-12'>
								<h3><a href='index.php?controlador=Admin&accion=consulta&objeto=usuario&idUsuario=$codigo'>$codigo</a></h3>
							</div>
							<div class='col-xs-12'>
								<h3><a href='logout.php'>Cerrar Sesion</a></h3>
							</div>
						</div>
					</div>
				</div>
			</header>";
	}
	public static function generarNav(){
		$idUsuario=$_SESSION['idUsuario'];
		
		$nav='<nav><ul><li><h3>';
		
		//MENU USUARIOS
		if(CtrlStr::esAdmin($_SESSION['roles']))$nav.='<a href="index.php?controlador=Admin&accion=consulta&objeto=usuarios">';
		else $nav.="<a href='index.php?controlador=Admin&accion=consulta&objeto=usuario&idUsuario=$idUsuario'>";
		$nav.='Usuarios</a></h3><ul><li>';
		if(CtrlStr::esAdmin($_SESSION['roles']))$nav.='<a href="index.php?controlador=Admin&accion=alta&objeto=usuario">Alta Usuario</a></li><li>';
		$nav.="<a href='index.php?controlador=Admin&accion=modificar&objeto=usuario&idUsuario=$idUsuario'>Modificar Usuario</a></li>";
		$nav.="<li><a href='index.php?controlador=Admin&accion=consulta&objeto=usuario&idUsuario=$idUsuario'>Consultar Usuario</a></li></ul>";
		
		//MENU ESTRUCTURA
		//departamento
		$nav.="<li><h3>Estructura</h3>";
		$nav.="<ul><li><h4><a href='index.php?controlador=Estructura&accion=consulta&objeto=departamentos'>Departamentos</a></h4></li><ul>";
		if(CtrlStr::esAdmin($_SESSION['roles'])){
			$nav.="<li><a href='index.php?controlador=Estructura&accion=alta&objeto=departamento'>Altas</a></li>";
		}
		if(CtrlStr::esJefDep($_SESSION['roles'])){
			$nav.="<li><a href='index.php?controlador=Estructura&accion=modificaciones&objeto=departamento&idDepartamento=$idDepartamento'>Modificaciones</a></li>";			
		}
		$nav.='</ul>';
		
		//academias
		$nav.="<li><h4><a href='index.php?controlador=Estructura&accion=consulta&objeto=academias'>Academias</a></h4></li><ul>";
		if(CtrlStr::esAdmin($_SESSION['roles'])||CtrlStr::esJefDep($_SESSION['roles'])||CtrlStr::esAsis($_SESSION['roles'])){
			$nav.="<li><a href='index.php?controlador=Estructura&accion=alta&objeto=academia'>Altas</a></li>";
		}
		if(CtrlStr::esRevis($_SESSION['roles'])){
			$idAcademia=$_SESSION['idAcademia'];
			$nav.="<li><a href='index.php?controlador=Estructura&accion=modificaciones&objeto=academia&idAcademia=$idAcademia'>Modificaciones</a></li>";			
		}
		$nav.='</ul>';
		
		//carreras
		$nav.="<li><h4><a href='index.php?controlador=Estructura&accion=consulta&objeto=carreras'>Carreras</a></h4></li><ul>";
		if(CtrlStr::esAdmin($_SESSION['roles'])||CtrlStr::esJefDep($_SESSION['roles'])||CtrlStr::esAsis($_SESSION['roles'])){
			$nav.="<li><a href='index.php?controlador=Estructura&accion=alta&objeto=carrera'>Altas</a></li>";
		}
		$nav.='</ul>';
		
		return $nav;
	}
	protected function generarNav2(){
		$nav='
			<div class="row ">
				<nav class="navbar navbar-default">
					<div class="container-fluid">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavbar-content">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
							<a class="navbar-brand" href="index.php">SIAAD</a>
						</div>
						<div class="collapse navbar-collapse" id="mynavbar-content">
							<ul class="nav navbar-nav">
								<li>';
		
		if (!session_id() == ''){
			if(CtrlStr::esAdmin($_SESSION['roles'])) //$nav.='<a href="index.php?controlador=Admin&accion=consulta&objeto=usuarios">Usuarios</a></li>';
			$nav.='<li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Usuarios <b class="caret"> </b> </a>
									<ul class="dropdown-menu">
										<li>
											<a href="index.php?controlador=Admin&accion=alta&objeto=usuario">Alta Usuario</a>
										</li>
										<li>
											<a href="index.php?controlador=Admin&accion=consulta&objeto=usuarios">Consulta Usuarios</a>
										</li>
										<li>
											<a href="index.php?controlador=Admin&accion=modificacion&objeto=usuario">Modificar Usuario</a>
										</li>
									</ul>
								</li>
								';
			/////////////////
			else{
				$idUsuario=$_SESSION['idUsuario'];
				$nav.="<a href='index.php?controlador=Admin&accion=consulta&objeto=usuario&idUsuario=$idUsuario'>Usuario</a></li>";
				
			}
		}								
		$nav.='<li>
								<li class="dropdown">
									<a href="#" class="dropdown-toggle" data-toggle="dropdown"> Estructura <b class="caret"> </b> </a>
									<ul class="dropdown-menu">
										<li>
											<a href="index.php?controlador=Estructura&accion=consulta&objeto=departamentos">Departamentos</a>
										</li>
										<li>
											<a href="index.php?controlador=Estructura&accion=consulta&objeto=academias">Academias</a>
										</li>
										<li class="divider">

										</li>
										<li>
											<a href="index.php?controlador=Estructura&accion=consulta&objeto=carreras">Carreras</a>
										</li>
									</ul>
								</li>
								<li>
									<a href="#">Feedback</a>
								</li>
							</ul>
						</div>

					</div>
				</nav>
			</div>';			
		
		return $nav;
	}

	protected function generaFooter(){
		return '</div>
		<script src="View/bootstrap/js/jquery.js"></script>
		<script src="View/bootstrap/js/bootstrap.js"></script>
	</body>
</html>';
	}
	
	protected function generaSider(){
		
	}
}
?>