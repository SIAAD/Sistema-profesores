<?php
var_dump($_POST);
if (isset($_POST['enviar'])) {
	if (isset($_POST['codigo'])) {
		$usuario = $_POST['codigo'];
		if (isset($_POST['pass'])) {
			$password = $_POST['pass'];
			if (file_exists("Objetos/dbConfig.inc")) {
				require_once ("Objetos/dbConfig.inc");
				$cnx = new mysqli($host, $usr, $pass, $db);
				$sql = "SELECT * FROM usuarios WHERE nombre='$usuario' AND contrasena='$password'";
				$res = $cnx -> query($sql);
				var_dump($res -> num_rows);
				var_dump($res);
				if ($res -> num_rows > 0) {
					echo "usuario y contrasena aceptados";	
					$row=mysqli_fetch_row($res);
					//$row=$res->fech_array();
					var_dump($row);
					session_start();
					$roles = 'roles';
					//$_SESSION['idUsuario'] = $idUsuario;
					$_SESSION['codigo'] = $usuario;
					$_SESSION['roles'] = $roles;
					var_dump($_SESSION);
					header("Location:index.php");
				} else {
					 echo 'usuario incorrecto';
					 header("Location:view/login.html");
				}
				$cnx -> close();
			} else {
				echo "No se pudo incluir el archivo de configuracion de la base de datos";
			}
		} else {
			//no se encontro la variable password
		}

	} else {
		//no se encontro la variable codigo
	}
}
?>