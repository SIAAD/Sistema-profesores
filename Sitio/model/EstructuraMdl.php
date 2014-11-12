<?php
if(file_exists('Model/modeloStr.php')){
	require_once 'Model/modeloStr.php';
}else{
	exit();
}

	class EstructuraMdl extends ModeloStr {
		
		function __construct() {
			parent::__construct();
		}
		
		function altaMateriaCarrera($materia,$carrera){
			
		}
		
		function bajaMateriaCarrera($materia,$carrera){
			
		}
		
		function consultaMateriaCarrera(){
			
		}
		
		function modificacionMateriaCarrera($materia,$carrera){
			
		}
		
		function altaCarrera($nombre,$clave){
			
		}	
		
		function bajaCarrera(){
			
		}
		
		function consultaCarrera(){
			
		}
		
		function modificacionCarrera(){
			
		}
		
		function altaMateria(){
			
		}
		
		function bajaMateria(){
			
		}
		
		function consultaMateria(){
			
		}
		
		function modificacionMateria(){
			
		}
		
		function altaDepartamento(){
			
		}
		
		function bajaDepartamento(){
			
		}
		
		function consultaDepartamentos(){
			
		}
		
		function modificacionDepartamentos(){
			
		}
		
		function altaAcademia(){
			
		}
		
		function bajaAcademia(){
			
		}
		
		function consultaAcademia(){
			
		}
		
		function modificacionAcademia(){
			
		}
	}
	
?>