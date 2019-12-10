
<?php
/*Se controlan todos los controladores, se hace el mapeo*/
require_once 'controllers/errores.php';
class App{

function __construct(){
	
	$url=isset($_GET['url']) ? $_GET['url'] : null;
	$url=rtrim($url,'/');
	$url=explode('/',$url);
	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
	header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE');
	header ("Expires: Fri, 14 Mar 1980 20:53:00 GMT"); //la pagina expira en fecha pasada 
	header ("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); //ultima actualizacion ahora cuando la cargamos 
	header ("Cache-Control: no-cache, must-revalidate"); //no guardar en CACHE 
	header ("Pragma: no-cache"); //PARANOIA, NO GUARDAR EN CACHE 
		
	/*cuando se ingresa sin definir controlador*/

	if(empty($url[0])){

	 	$archivoController='controllers/login.php';
	 	require_once $archivoController;
	 	$controller= new Login();
	 	$controller->loadModel('login');
	 	$controller->render();
	 	return false;
	 	/*
	 	$archivoController='controllers/principal.php';
	 	require_once $archivoController;
	 	$controller= new Principal();
	 	$controller->loadModel('principal');
	 	$controller->render();
	 	return false;
	*/
	}
		/*crear instancia del controlador que se le proporione*/

	$archivoController='controllers/'.$url[0].'.php';	
	if(file_exists($archivoController)){
		require_once $archivoController;
		$controller= new $url[0];
		$controller->loadModel($url[0]);
		//número de elementos del arreglo
		$parametros = sizeof($url);
		/*verificar que existe el método*/
		if ($parametros>1) {
			if ($parametros>2) {
				$parametro_array = [];
				for ($i=2; $i <$parametros ; $i++) { 
					array_push($parametro_array,$url[$i]);
				}
				$controller->{$url[1]}($parametro_array);
			}else{
				$controller->{$url[1]}();
			}
		}
		else{
			$controller->render();
		}
	}else{
		$controller= new Errores();
		$controller->render();
	}
}	
}
?>