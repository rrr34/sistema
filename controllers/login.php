<?php
	class Login extends Controller{
		private $nombre;
		private $username;
		function __construct(){
			parent::__construct();
			
		}
		function render(){
			$this->compruebaSesion();
			if(isset($_SESSION['mensaje'])){
				$this->mensajeAlerta();
				unset( $_SESSION["mensaje"] );
			}
			$this->view->render('login/index');
		}
		

		 function userExists(){
        	//$md5pass = md5($pass);
        	$this->compruebaSesion();
        	if($this->model->validar($_POST)){
        		$mensaje .="Bienvenido al sistema";
        		$_SESSION['mensaje'] = $mensaje;
        		$_SESSION['usuario'] = true;
				header('Location:'.constant('URL').'principal');
        	}else{
        		$mensaje .="Los datos Ingresados son incorrectos";
        		$_SESSION['mensaje'] = $mensaje;
				header('Location:'.constant('URL'));
        	}
        }

        function cerrarSesion(){
        	$this->compruebaSesion();
			$_SESSION = array();
			if (ini_get("session.use_cookies")) {
			$params = session_get_cookie_params();
			setcookie(session_name(), '', time() - 42000,
			$params["path"], $params["domain"],
			$params["secure"], $params["httponly"]
			);
			}
        	session_destroy();
        	header('Location:'.constant('URL'));
        }


    	function mensajeAlerta(){
		$this->view->alerta = " $(document).ready(function() {
		toastr.warning('".$_SESSION['mensaje']."', 'ERROR')
    	});";
	}

	function compruebaSesion(){
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 
	}
	}
?>