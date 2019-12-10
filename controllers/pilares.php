<?php 
class Pilares extends Controller {
	function __construct(){

			parent::__construct();
			$this->view->alerta="";
		}
	public function render(){
		$this->compruebaSesion(); 
		if (isset($_SESSION['usuario'])){
			$this->view->valores = $this->model->getDatosTabla();
			if(isset($_SESSION['mensaje'])){
				$this->mensajeAlerta();
				unset( $_SESSION["mensaje"] );
			}
				$this->view->render('pilares/index');
			}else{
			header('Location:'.constant('URL'));
		}
	}
	function editar($param = null){
		$id = $param[0];
		$valores = $this->model->getById($id);
		$this->view->valores =$valores[0];
		$this->obtenerDatos();
		//$colaboradores=$this->model->getColaboradores($id);	
		
		$this->view->id=$id;
		$this->view->render('pilares/editar');
	}
	function editarPilar(){
		$this->compruebaSesion(); 
		$arrayPilares = $_POST;
		$mensaje="";
		if($this->model->update($arrayPilares)){
			$mensaje .="Dato Actualizado Correctamente";
				}else{
			$mensaje .="Fue imposible actualizar el registro";
			}
			$_SESSION['mensaje'] = $mensaje;
		header('Location:'.constant('URL').'pilares');
	}

	function nuevo(){
		$this->compruebaSesion(); 
		$this->obtenerDatos();
		if(isset($_SESSION['mensaje'])){
			$this->mensajeAlerta();
			unset( $_SESSION["mensaje"] );
		}
		$this->view->render('pilares/nuevo');
	}

	function registrar(){

		$this->compruebaSesion(); 
		$arrayP=$_POST;
		$mensaje="";

			if($this->model->insertarPilares($arrayP)){
			$mensaje ="Dato Insertado Correctamente";
			}else{
			$mensaje ="Fue imposible insertar el registro";
			}
		
		
		$_SESSION['mensaje'] = $mensaje;
		header('Location:'.constant('URL').'pilares/nuevo');
		
	}


	function obtenerDatos(){
		$this->view->alcaldias=$this->model->getAlcaldias();
		$this->view->directores=$this->model->getDirectores();
	}

	function mensajeAlerta(){
		$this->view->alerta = " $(document).ready(function() {
    	toastr.info('".$_SESSION['mensaje']."', 'Alerta') });";
	}

	function eliminar($param = null){
		$this->compruebaSesion(); 
		$id = $param[0];
		$mensaje="";
		if($this->model->borrar($id)){
			$mensaje ="Dato Eliminado Correctamente";
		}else{
			$mensaje .="Fue imposible eliminar el registro";
		}
		$_SESSION['mensaje'] = $mensaje;
		header('Location:'.constant('URL').'pilares');
	}

	function compruebaSesion(){
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 
	}
	
}
?>