<?php 
class Colaboradores extends Controller{
	function __construct(){
		parent::__construct();
		$this->id=0;
	}
	function render(){
		$this->compruebaSesion();  
		if (isset($_SESSION['usuario'])){
			$this->view->lista = $this->model->getDatosTabla();
			if (isset($_SESSION['mensaje'])){
				$this->alerta();
				unset( $_SESSION["mensaje"] );
				$this->view->render('colaboradores/index');
			} else {
			$this->view->render('colaboradores/index');
		}}else{
			header('Location:'.constant('URL'));}
		
	}
	function nuevo(){
		$this->compruebaSesion(); 
		$this->obtenerDatos();
		if(isset($_SESSION['mensaje'])){
			$this->alerta();
			unset( $_SESSION["mensaje"] );
			//$this->view->render('colaboradores/nuevo');
		}
			$this->view->render('colaboradores/nuevo');
		
	}
	function editar($param = null){
		$id = $param[0];
		$valores = $this->model->getById($id);
		$this->obtenerDatos();
		$valores = $this->model->getById($id);
		$this->view->valores =$valores[0];
		$this->view->id=$id;
		$this->view->render('colaboradores/editar');

	}


	function editarColaborador(){
		$arrayColaboradores=$_POST;

		$mensaje = "";
			if($this->model->update($arrayColaboradores)){
			$mensaje ="Dato Actualizado Correctamente";
			}else{
			$mensaje .="Fue imposible actualizar el registro";
			}
		$this->compruebaSesion(); 
		$_SESSION['mensaje'] = $mensaje;
		header('Location:'.constant('URL').'colaboradores');
	}


	function registrarColaborador(){
		$this->compruebaSesion(); 
		$arrayColaboradores=$_POST;
		$mensaje = "";
		if($this->model->insertarColaborador($arrayColaboradores)){
			$mensaje ="Dato Insertado Correctamente";
		} else{
			$mensaje ="Fue imposible insertar el registro";
		}
		$_SESSION['mensaje'] = $mensaje;
		header('Location:'.constant('URL').'colaboradores/nuevo');
		
	}
	function obtenerDatos(){
		$this->view->puestos =$this->model->getPuestos();
		$this->view->niveles =$this->model->getNiveles();
		$this->view->documentos =$this->model->getDocumentos();
		$this->view->alcaldias =$this->model->getAlcaldias();
	}
	function alerta(){
		$this->view->alerta = " $(document).ready(function() {
    	toastr.info('".$_SESSION['mensaje']."', 'Alerta') });";
	}
	function ver(){
		$id = $_GET['id'];
		$colaborador = $this->model->getTodo($id);
		$data=$colaborador[0];
		echo json_encode($data);
	}
	function eliminar($param = null){
		$this->compruebaSesion(); 
		$id = $param[0];
		$mensaje = "";
		if($this->model->borrar($id)){
			$mensaje ="Dato Eliminado Correctamente";
		}else{
			$mensaje .="Fue imposible eliminar el registro";
		}
		$_SESSION['mensaje'] = $mensaje;
		header('Location:'.constant('URL').'colaboradores');
	}
	function compruebaSesion(){
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 
	}
}
?>