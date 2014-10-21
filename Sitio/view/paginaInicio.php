<?php
	session_start();
    var_dump($_SESSION);
    $roles = $_SESSION['roles'];
	$nombre = $_SESSION['codigo'];
?>