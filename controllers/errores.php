<?php
	class Errores extends Controller{
		function __construct(){
			parent::__construct();
			
		}
		function render(){
			$this->compruebaSesion(); 
			if (isset($_SESSION['usuario'])){
			$this->view->mensaje="Hubo un error en la solicitud";
			$this->view->render('errores/index');
			}else{
			header('Location:'.constant('URL'));
				}
		}

		function compruebaSesion(){
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 
	}
	}
?>