<?php
/** @author:Jesus Alberto Ley Ayón & Jorge Eduardo Garza Martinez
 * @since: 20/Oct/2014
 * @version 1.0
 */
 
if (isset($_POST['enviar'])) {
	if (isset($_POST['codigo'])&&!empty($_POST['codigo'])) {
		$usuario = $_POST['codigo'];
		if (isset($_POST['pass'])&&!empty($_POST['pass'])) {
			$password = $_POST['pass'];
			if (file_exists("Objetos/dbConfig.inc")) {
				require_once ("Objetos/dbConfig.inc");
				$cnx = new mysqli($host, $usr, $pass, $db);
				$sql = "SELECT * FROM usuarios WHERE nombre='$usuario' AND contrasena='$password'";
				$res = $cnx -> query($sql);
				if ($res -> num_rows > 0) {
					$row=mysqli_fetch_row($res);
					
					session_start();
					$_SESSION['idUsuario'] = $row[0];
					$_SESSION['codigo'] = $usuario;
					
					$sql="SELECT * FROM privilegiosUsuarios WHERE nombre='$usuario'";
					$res = $cnx -> query($sql);
					print"resultado de querry roles";
					var_dump($res);
					$roles=array();
					if(mysqli_num_rows($res)>0){
						while ($row = $res->fetch_row()) {
        					$roles[]=$row[1];
    					}
						var_dump($roles);
						$_SESSION['roles'] = $roles;
							
					}else{
						$_SESSION['roles'] = -1;
					}
					
					var_dump($_SESSION);
					header("Location:index.php");
				} else {
					//	 header("Location:view/login.html");
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