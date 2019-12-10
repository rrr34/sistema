<?php
class Puestos extends Controller{
	function __construct(){

		parent::__construct();
		$this->view->datos="";
		$this->view->valores=null;
		$this->view->alerta=null;
		$this->view->id=0;
	}

	function render(){
		$this->compruebaSesion();
		if (isset($_SESSION['usuario'])){
			$this->view->lista = $this->model->get();
			if (isset($_SESSION['mensaje'])){
			$this->mensajeAlerta();
			unset( $_SESSION["mensaje"] );
			}
			$this->view->render('puestos/index');
		}else{
			header('Location:'.constant('URL'));
		}
		
	}

	function editar($param = null){
		$id = $param[0];
		$valores = $this->model->getById($id);
		$this->view->valores =$valores[0];

		$this->view->id=$id;
		$this->view->datos=$this->listarSuperior();
		$this->view->areas=$this->listarAreas();
		
		$this->view->render('puestos/detalle');
	}
	
	function listarSuperior(){
		$cargos=$this->model->listarSuperior();
		return $cargos;
	}
	function listarAreas(){
		$cargos=$this->model->listarAreas();
		return $cargos;
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
		header('Location:'.constant('URL').'puestos');
	}
	

	function ver(){
		$id = $_GET['id'];
		$puesto = $this->model->getById($id);
		$data=$puesto[0];
		echo json_encode($data);

	}

	function nuevo(){
		$this->compruebaSesion();
		if (isset($_SESSION['mensaje'])){
		$this->view->datos=$this->listarSuperior();
		$this->view->areas=$this->listarAreas();
		$this->mensajeAlerta();
		$this->view->render('puestos/crear');
		unset( $_SESSION["mensaje"] );
		}else{
			$this->view->datos=$this->listarSuperior();
			$this->view->areas=$this->listarAreas();
			$this->view->render('puestos/crear');
		}
		
	}

	function registrarPuesto(){
		$this->compruebaSesion();
		$superior =$_POST['superior'];
		$puesto   =$_POST['puesto'];
		$area   =$_POST['area'];
		$nivel    =$_POST['nivel'];
		$tipo     =$_POST['tipo'];
		$mensaje = "";
		if($this->model->insert(['superior'=>$superior,'puesto'=>$puesto,'area'=>$area,'nivel' =>$nivel,'tipo'  =>$tipo])){
			$mensaje ="Dato Insertado Correctamente";
		}else{
			$mensaje ="Fue imposible insertar el registro";
		}
		
		$_SESSION['mensaje'] = $mensaje;
		header('Location:'.constant('URL').'puestos/nuevo');
	}

	

	function editarPuesto(){
		
		$this->compruebaSesion();
		/*
		$superior =$_POST['superior'];
		$puesto   ='"'.$_POST['puesto'].'"';
		$nivel    =$_POST['nivel'];
		$tipo     =$_POST['tipo'];
		$id 	  =$_POST['id'];
		*/
		$id_puesto=$_POST['id'];		
		if($id_puesto==$_POST['superior']){
				$_POST['superior']=NULL;}
		$mensaje = "";

		if($this->model->update($_POST)){
			$mensaje ="Dato Actualizado Correctamente";
		}else{
			$mensaje .="Fue imposible actualizar el registro";
		}
		
		$_SESSION['mensaje'] = $mensaje;
		$this->mensajeAlerta();
		header('Location:'.constant('URL').'puestos');
		
	}
	function mensajeAlerta(){
		$this->view->alerta = " $(document).ready(function() {
    	toastr.info('".$_SESSION['mensaje']."', 'Alerta') });";
	}
	
		function compruebaSesion(){
		if(!isset($_SESSION)) 
		{ 
			session_start(); 
		} 
	}
}
?>