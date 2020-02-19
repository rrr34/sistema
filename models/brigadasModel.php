<?php 
class BrigadasModel extends Model{
	public function __construct(){
		parent::__construct();
	}
	public function getDirectores(){
		try{
			$consulta=$this->db->connect()->prepare("SELECT id, CONCAT(nombre,' ',apellido_paterno,' ' , apellido_materno) as director from colaboradores");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje.=$e->getMessage();
			return false;
		}
	}
	public function getDatosTabla(){
		
		try{$consulta =$this->db->connect()->prepare("SELECT brigadas.id,cargos.puesto as sub, brigadas.nombre,alcaldias.nombre as alcaldia, brigadas.ubicacion, CONCAT(colaboradores.nombre,' ',colaboradores.apellido_paterno,' ' , colaboradores.apellido_materno) as director, brigadas.fecha from brigadas left join cargo_alcaldia on brigadas.alcaldia=cargo_alcaldia.alcaldia left join cargos on cargos.id=cargo_alcaldia.cargo left join alcaldias on brigadas.alcaldia=alcaldias.id left join colaboradores on brigadas.responsable=colaboradores.id");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje.=$e->getMessage();
			return false;
		}
	}
	public function getById($id){
		
		try{$consulta =$this->db->connect()->prepare("SELECT brigadas.id,alcaldias.nombre as alcaldia,brigadas.nombre,brigadas.ubicacion,brigadas.fecha,brigadas.responsable, status.estado from brigadas left join alcaldias on brigadas.alcaldia=alcaldias.id WHERE brigadas.id=:id
			;");
			$consulta->execute(['id' =>$id]);
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}

public function getAlcaldias(){
		
		try{$consulta =$this->db->connect()->prepare("SELECT * from alcaldias ;");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}

	public function getStatus(){
		
		try{$consulta =$this->db->connect()->prepare("SELECT * from status ;");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	
    
    public function insertarBrigada($datos){
    	try{
			$consulta=$this->db->connect()->prepare('INSERT into pilares(nombre,responsable,alcaldia,ubicacion,fecha) values (:nombre,:responsable, :alcaldia, :ubicacion, :fecha)');
			$consulta->execute([
			'nombre'    =>$datos['nombre'],
			'responsable' =>$datos['responsable'],
			'alcaldia'  =>$datos['alcaldia'],
			'ubicacion' =>$datos['ubicacion'],
			'fecha'     =>$datos['fecha']]);
			return true;
    	}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}	
    	
    }
   
	public function update($datos){
		try{
			$consulta =$this->db->connect()->prepare("UPDATE
				pilares SET 
				nombre    =:nombre,
				alcaldia  =:alcaldia,
				ubicacion =:ubicacion,
				fecha     =:fecha,
				responsable =:responsable WHERE id=:id");
			$consulta->execute([
			'nombre'    =>$datos['nombre'],
			'alcaldia'  =>$datos['alcaldia'],
			'ubicacion' =>$datos['ubicacion'],
			'fecha'     =>$datos['fecha'],
			'responsable'     =>$datos['responsable'],
			'id'        =>$datos['id']
		]);
			return true;
		}catch(PDOException $e){
			$controller->mensaje.=$e->getMessage();
			return false;
		}
	}
	public function borrar($id){
		try{
			$consulta=$this->db->connect()->prepare('DELETE FROM brigadas WHERE id=:id');
			$consulta->execute([
				'id'  =>$id]);
			return true;
		}catch(PDOException $e){
			//die();
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	
	public function verificaExiste($brigadas){
		try{
			$consulta=$this->db->connect()->prepare('SELECT colaborador from directores where brigadas=:brigadas');
			$consulta->execute([
				'brigadas'  =>$brigadas]);
			return $consulta->fetchColumn();
		}catch(PDOException $e){
			//die();
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	 public function borrarDirectores($brigadas){
    	try{
    		$consulta=$this->db->connect()->prepare('DELETE from directores WHERE brigadas=:brigadas;');
    		$consulta->execute(['brigadas'=>$brigadas]);
    		return true;
    	}catch(PDOException $e){
			$controller->mensaje.=$e->getMessage();
			return false;
		}
    }
}

?>