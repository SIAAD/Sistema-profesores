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
						$_SESSION['roles'] = $roles;	
					}else{
						$_SESSION['roles'] = -1;
					}
					
					$navegador=obtenerNavegadorWeb();
					$_SESSION['navegador']=$navegador;
					$cnx -> close();
					header("Location:index.php");
				} else {
					$cnx -> close();
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

function obtenerNavegadorWeb()
{
$agente = $_SERVER['HTTP_USER_AGENT'];
$navegador = 'Unknown';
$platforma = 'Unknown';
$version= "";

//Obtenemos la Plataforma
if (preg_match('/linux/i', $agente)) {
$platforma = 'linux';
}
elseif (preg_match('/macintosh|mac os x/i', $agente)) {
$platforma = 'mac';
}
elseif (preg_match('/windows|win32/i', $agente)) {
$platforma = 'windows';
}

//Obtener el UserAgente
if(preg_match('/MSIE/i',$agente) && !preg_match('/Opera/i',$agente))
{
$navegador = 'Internet Explorer';
$navegador_corto = "MSIE";
}
elseif(preg_match('/Firefox/i',$agente))
{
$navegador = 'Mozilla Firefox';
$navegador_corto = "Firefox";
}
elseif(preg_match('/Chrome/i',$agente))
{
$navegador = 'Google Chrome';
$navegador_corto = "Chrome";
}
elseif(preg_match('/Safari/i',$agente))
{
$navegador = 'Apple Safari';
$navegador_corto = "Safari";
}
elseif(preg_match('/Opera/i',$agente))
{
$navegador = 'Opera';
$navegador_corto = "Opera";
}
elseif(preg_match('/Netscape/i',$agente))
{
$navegador = 'Netscape';
$navegador_corto = "Netscape";
}

$res= array(
'agente' => $agente,
'nombre'      => $navegador,
'platforma'  => $platforma
);

return $res;

}
?>