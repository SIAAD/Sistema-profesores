<?php
/** @author:Jorge Eduardo Garza Martinez
 * @since: 2/Dic/2014
 * @version 1.5 INCLUSION DE COOKIES
 */
 
if(file_exists('Objetos/cookies.php')){
	require_once('Objetos/cookies.php');
}else{
	exit();
}
 
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
					//checar si desea mantener la sesion abierta
					
					if(isset($_POST['sesion'])&&!empty($_POST['sesion'])&&$_POST['sesion']=='mantener'){
						//crear cokie
						$cookies = new Cookies();
						
						$value='';
						foreach ($roles as $rol) {
							$value=$value.$rol.'|';
						}
						$cookies->set($usuario, $value);
					}
					header("Location:index.php");
				} else {
					$cnx -> close();
					header("Location:view/formularios/login.html");
				}
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