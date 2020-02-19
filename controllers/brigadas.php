<?php 
class brigadas extends Controller {
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
				$this->view->render('brigadas/index');
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
		$this->view->render('brigadas/editar');
	}
	function editarbrigada(){
		$this->compruebaSesion(); 
		$arrayBrigadas = $_POST;
		$mensaje="";
		if($this->model->update($arrayBrigadas)){
			$mensaje .="Dato Actualizado Correctamente";
				}else{
			$mensaje .="Fue imposible actualizar el registro";
			}
			$_SESSION['mensaje'] = $mensaje;
		header('Location:'.constant('URL').'brigadas');
	}

	function nuevo(){
		$this->compruebaSesion(); 
		$this->obtenerDatos();
		if(isset($_SESSION['mensaje'])){
			$this->mensajeAlerta();
			unset( $_SESSION["mensaje"] );
		}
		$this->view->render('brigadas/nuevo');
	}

	function registrar(){

		$this->compruebaSesion(); 
		$arrayP=$_POST;
		$mensaje="";

			if($this->model->insertarBrigada($arrayP)){
			$mensaje ="Dato Insertado Correctamente";
			}else{
			$mensaje ="Fue imposible insertar el registro";
			}
		
		
		$_SESSION['mensaje'] = $mensaje;
		header('Location:'.constant('URL').'brigadas/nuevo');
		
	}


	function obtenerDatos(){
		$this->view->alcaldias=$this->model->getAlcaldias();
		$this->view->directores=$this->model->getDirectores();
		$this->view->status=$this->model->getStatus();
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
		header('Location:'.constant('URL').'brigadas');
	}

	function compruebaSesion(){
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 
	}
	
}
?>