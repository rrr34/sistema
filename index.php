
<?php
	require_once 'libs/controller.php';
	require_once 'libs/view.php';
	require_once 'libs/model.php';
	require_once 'libs/database.php';
 	require_once 'libs/app.php';

 	require_once 'config/config.php';
 	require_once 'vendor/autoload.php';
 	
 	header('Access-Control-Allow-Origin: *');
	header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
	header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
	header("Allow: GET, POST, OPTIONS, PUT, DELETE");
	$method = $_SERVER['REQUEST_METHOD'];
	if($method == "OPTIONS") {
	die();
	}

 	$app = new App();
?>