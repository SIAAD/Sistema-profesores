<?php
/**
 * @author:Jorge Eduardo Garza
 * @since: 02/Dic/2014
 * @version BETA SOPORTE DE COOKIES
 */
class Cookies {
	
	const DefaultLife=3600;
	
	public function set($name,$value,$expiry=self::DefaultLife,$path='/',$domain=FALSE){
		$val=FALSE;
		if(!headers_sent()){
			if($domain===-1){
				$domain= $_SERVER['HTTP_HOST'];
			}
			
			if($expiry===FALSE){
				$expiry=1893456000;
			}elseif(is_numeric($expiry)){
				$expiry+=time();
			}else{
				$expiry=strtotime($expiry);
			}
			
			$val=@setcookie($name,$value,$expiry,$path,$domain);
		}
		
		return $val;
	}
	
	public function getAll() {
		if (!empty($_COOKIE)) {
			$c = array_keys($_COOKIE);
		} else {
			return FALSE;
		}
	}

	public function delete($name, $path = '/', $domain = FALSE) {
		setcookie($name,'',time()-9000000);
		unset($_COOKIE[$name]);
	}

	public function deleteAll() {
		$c = self::getAll();
		if (!empty($c)) {
			for ($i = 0; $i < count($c); $i++) {
				self::delete($c[$i]);
			}
		}
	}

}

$cookies=new Cookies();
$cookies->deleteAll();
setcookie('2093663','',time()-9000000);
unset($_COOKIE['2093663']);
var_dump($_COOKIE);
?>