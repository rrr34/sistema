<?php
            use League\Csv\Writer;
            use League\Csv\CharsetConverter;
            use League\Csv\Reader;

	class Principal extends Controller{

		function __construct(){
			parent::__construct();
		}

		public function render(){
            $this->compruebaSesion(); 
            if (isset($_SESSION['usuario'])){
                if(isset($_SESSION['mensaje'])){
                    $this->mensajeAlerta();
                    unset( $_SESSION["mensaje"] );
                }  
                $this->view->excel=false;
                if (isset($_SESSION['datos'])){
                    $this->view->datos=$_SESSION['datos'];
                }else{
                    $this->view->datos=$this->model->getDatosTabla();
                }
                if (isset($_SESSION['excel'])){
                    $this->view->excel=$_SESSION['excel'];
                }
                unset( $_SESSION["datos"] );
                unset( $_SESSION["excel"] );

                $this->view->render('principal/index');
            }
            else{
                header('Location:'.constant('URL'));
            }
	    }

        function buscar(){
            $conditions = array();
            $parameters = array();
            $datos      = array();
            if (!empty($_POST['area']))
            {
            array_push($conditions,'sup.puesto COLLATE UTF8_GENERAL_CI LIKE ?');
            array_push($parameters,'%'.$_POST['area']."%");
           
            }
            if (!empty($_POST['puesto']))
            {
            
            array_push($conditions,'car.puesto COLLATE UTF8_GENERAL_CI LIKE ?');
            array_push($parameters,'%'.$_POST['puesto']."%");
            }
            if (!empty($_POST['alcaldia']))
            {
            
            array_push($conditions,'alc.nombre COLLATE UTF8_GENERAL_CI LIKE ?');
            array_push($parameters,'%'.$_POST['alcaldia']."%");
            }
            if (!empty($_POST['nombre']))
            {
            
            array_push($conditions,'col.nombre COLLATE UTF8_GENERAL_CI LIKE ?');
            array_push($parameters,'%'.$_POST['nombre']."%");
            }
            if (!empty($_POST['apellido_paterno']))
            {
            
            array_push($conditions,'col.apellido_paterno COLLATE UTF8_GENERAL_CI LIKE ?');
            array_push($parameters,'%'.$_POST['apellido_paterno']."%");
            }
            if (!empty($_POST['apellido_materno']))
            {
            
            array_push($conditions,'col.apellido_materno COLLATE UTF8_GENERAL_CI LIKE ?');
            array_push($parameters,'%'.$_POST['apellido_materno']."%");
            }
            if (!empty($_POST['sexo']))
            {
            
            array_push($conditions,'col.sexo COLLATE UTF8_GENERAL_CI LIKE ?');
            array_push($parameters,'%'.$_POST['sexo']."%");
            }

            $sql = "SELECT col.id,area.puesto as area,sup.puesto as jefe, car.puesto,alc.nombre as alcaldia,col.nombre,col.apellido_paterno,col.apellido_materno,col.sexo 
            FROM colaboradores as col LEFT JOIN cargos as car on col.cargo=car.id LEFT JOIN cargos as sup on car.superior=sup.id LEFT JOIN alcaldias as alc on col.alcaldia=alc.id inner join cargos as area on car.area=area.id";
           
        if ($conditions)
            {
                $sql .= " WHERE ".implode(" AND ", $conditions);
            }
   
            if($this->model->getBusqueda($sql,$parameters)){
                $datos=$this->model->getBusqueda($sql,$parameters);   
            }  
 
            $this->compruebaSesion();
            $_SESSION['datos']       = $datos;
            $_SESSION['excel']       = true;
            header('Location:'.constant('URL').'principal');
        }

function compruebaSesion(){
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
    }
    function crearExcel(){
            $datos_excel=$this->model->getTodo();

            $encoder = (new CharsetConverter())
            ->inputEncoding('utf-8')
            ->outputEncoding('iso-8859-15');
            $csv = Writer::createFromFileObject(new SplTempFileObject());
            $csv->insertOne([utf8_decode('Área'),utf8_decode('Superior'),'Puesto',utf8_decode('Alcaldía'),'PILARES','Nombre','Apellido Paterno', 'Apellido Materno','Sexo','Fecha Alta','CURP',utf8_decode('Teléfono'),utf8_decode('Correo Electrónico'),utf8_decode('Correo Institucional'),'Fecha Nacimiento','Edad','Especialidad','Porcentaje','Documento','Nivel']);
            $csv->addFormatter($encoder);
            $csv->insertAll($datos_excel); 
            $csv->output('reporte.csv');
        }
        function generarExcel(){
             
             $datos=$_POST['datos'];
            
                    
            $datos_excel=$this->model->getTodoBusqueda($datos);

            $encoder = (new CharsetConverter())
            ->inputEncoding('utf-8')
            ->outputEncoding('iso-8859-15');
            $csv = Writer::createFromFileObject(new SplTempFileObject());
            $csv->insertOne([utf8_decode('Área'),utf8_decode('Superior'),'Puesto',utf8_decode('Alcaldía'),'PILARES','Nombre','Apellido Paterno', 'Apellido Materno','Sexo','Fecha Alta','CURP',utf8_decode('Teléfono'),utf8_decode('Correo Electrónico'),utf8_decode('Correo Institucional'),'Fecha Nacimiento','Especialidad','Porcentaje','Documento','Nivel']);
            $csv->addFormatter($encoder);
            $csv->insertAll($datos_excel); 
            $csv->output('reporte.csv');
        }
        function mensajeAlerta(){
        $this->view->alerta = " $(document).ready(function() {
        toastr.success('".$_SESSION['mensaje']."', 'Inicio de Sesión')
        });";
    }
  
    }
?>

