<?php
class Organigramas extends Controller{
	var $objetos = [];
    var $identacion = "";
    var $identacion_select = "";
	public function __construct(){
		parent::__construct();
	}
	public function render(){
        $this->compruebaSesion();
		if (isset($_SESSION['usuario'])){
			$this->view->datos=$this->get();
            $this->view->pilares=$this->model->getPilaresAutorizados();
			$this->view->render('organigramas/index'); }else{
            header('Location:'.constant('URL'));
        }
	}
	

	public function get($superior = null){

        foreach($this->model->getChild($superior) as $objeto)
        {

            $this->identacion.= "&nbsp&nbsp&nbsp&nbsp";
            $this->identacion_select .= ' -  - ';
            $objeto->text = $this->identacion_select.$objeto->puesto;
            $objeto->nombre = $this->identacion.$objeto->puesto;
            $this->objetos[] = $objeto;
            $this->get($objeto->id);
        }
        $this->identacion = substr($this->identacion,0,-20);
        $this->identacion_select = substr($this->identacion_select,0,-6);
        return $this->objetos;
    }
    function compruebaSesion(){
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
    }

}
?>
