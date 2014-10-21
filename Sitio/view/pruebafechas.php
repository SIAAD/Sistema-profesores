<?php
    var_dump ($_POST);
	
	$fecha =$_POST['fecha'];
	$fecha2=strtotime($fecha);
	if($fecha2 == 0){
		echo "esta mal";
	}else{
		$fecha3= date("d/m/Y",$fecha2);
		echo "$fecha3";
	}
	
?>