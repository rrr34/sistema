<?php 
	class Estadisticas extends Controller{
		public function __construct(){
			parent::__construct();
		}
		public function render(){
			$this->compruebaSesion(); 
			if (isset($_SESSION['usuario'])){
			$this->view->subdirecciones=$this->model->getSubdirecciones();
			$this->view->render('estadisticas/alcaldias');
			}else{
			header('Location:'.constant('URL'));
		}
		}
		function getAlcaldias(){
		$id = $_GET['id'];
		$alcaldia = $this->model->getAlcaldiasPorCargo($id);
		$data=$alcaldia;
		echo json_encode($data);
	}
	function getDistribucion(){
		$zona = $_GET['zona'];
		$alcaldia = $_GET['alcaldia'];
		$distribucion = $this->model->getDistribucion($zona,$alcaldia);
		$data=$distribucion;
		echo json_encode($data);
	}
	
	function getDistribucionGlobal(){	
		$distribucion = $this->model->getDistribucionGlobal();
		$data=$distribucion;
		echo json_encode($data);
	}
	function distribucionGlobal(){	
		$this->view->datos=$this->model->getDistribucionGlobal();
		$this->view->name=$this->model->getAlcaldias();	
		$this->view->render('estadisticas/general');
	}

	function getZonas(){
		$id = $_GET['id'];
		$zona = $this->model->getDistribucionZona($id);
		$data=$zona;
		echo json_encode($data);
	}
	function distribucionZona(){
		$this->view->subdirecciones=$this->model->getSubdirecciones();

			$this->view->render('estadisticas/zonas');
	}

	function edades(){
		//$this->view->subdirecciones=$this->model->getEdades();

			$this->view->render('estadisticas/edades');
	}
	function edadesGeneral(){
			$this->view->edades=$this->model->getEdadesGeneral();	
			$this->view->render('estadisticas/edadesgeneral');
	}
	function getedadesGeneral(){
			$distribucion=$this->model->getEdadesGeneral();
			$data=$distribucion;
			echo json_encode($data);
	}
	function getEdades(){
		$id = $_GET['id'];
		
		$distribucion;
		switch ($id) {
			
			case 20:
				
				$distribucion = $this->model->getRango1();
				//var_dump($distribucion);
				break;
			
			case 31:
				$distribucion = $this->model->getRango2();
				break;
			
			case 41:
				$distribucion = $this->model->getRango3();
				break;
			
			case 51:
				$distribucion = $this->model->getRango4();
				break;
			
			case 61:
				$distribucion = $this->model->getRango5();
				break;

		}
		
		$data=$distribucion;
		echo json_encode($data);
	}

	function compruebaSesion(){
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 
	}


	function getNivelesEducativos(){	
		$distribucion = $this->model->getNivelesEducativos();
		$data=$distribucion;
		echo json_encode($data);
	}
	function nivelesEducativos(){	
		$this->view->datos=$this->model->getNivelesEducativos();	
		$this->view->render('estadisticas/documentos');
	}

	}
?>