<?php
    $path=stream_resolve_include_path('Verificador.php');
	var_dump($path);
	var_dump(file_exists($path));
	
	$path=stream_resolve_include_path('EstructuraCtrl.php');
	var_dump($path);
	var_dump(file_exists($path));
	
	$path=stream_resolve_include_path('index.php');
	var_dump($path);
	var_dump(file_exists($path));
	
	$path=realpath('Verificador.php');
	var_dump($path);
	var_dump(file_exists($path));
	
	$path=realpath('../index.php');
	var_dump($path);
	var_dump(file_exists($path));
	
	$path=realpath('..Ctrl/EstructuraCtrl.php');
	var_dump($path);
	var_dump(file_exists($path));
	
	var_dump(realpath('Verificador.php'));
	var_dump(realpath('../Model/modeloStr.php'));
	var_dump(realpath('../index.php'));
	var_dump(realpath('../Ctrl/ctrlStr.php'));
	var_dump(realpath('../index.php'));
	
?>