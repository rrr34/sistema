<?php
class Honorarios extends Controller{
	public function __construct(){
		parent::__construct();
	}
	public function render(){
		$this->compruebaSesion(); 
		if (isset($_SESSION['usuario'])){
			$this->view->datos=$this->model->get();
			$this->obtenerDatos();
			$array=$this->model->getTotalDisponible();
			$this->view->totalDisponible=$array[0];
			$this->view->render('organigramas/honorarios');
		}else{
			header('Location:'.constant('URL'));
		}
	}

	function obtenerDatos(){
		$this->view->datosA=$this->model->getTotalDisponibleA()[0];
		$this->view->datosB=$this->model->getTotalDisponibleB()[0];
		$this->view->datosC=$this->model->getTotalDisponibleC()[0];
		$this->view->datosD=$this->model->getTotalDisponibleD()[0];
		$this->view->datos0=$this->model->getTotalDisponible0()[0];
	}

	function getDistribucion(){	
		$distribucion = $this->model->getDistribucion();
		$data=$distribucion;
		echo json_encode($data);
	}

	function compruebaSesion(){
		if(!isset($_SESSION)) { 
			session_start(); 
		} 
	}

}
?>