<?php 
class PilaresModel extends Model{
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
		
		try{$consulta =$this->db->connect()->prepare("SELECT pilares.id,cargos.puesto as sub, pilares.nombre,alcaldias.nombre as alcaldia, pilares.ubicacion, CONCAT(colaboradores.nombre,' ',colaboradores.apellido_paterno,' ' , colaboradores.apellido_materno) as director, pilares.fecha from pilares left join cargo_alcaldia on pilares.alcaldia=cargo_alcaldia.alcaldia left join cargos on cargos.id=cargo_alcaldia.cargo left join alcaldias on pilares.alcaldia=alcaldias.id left join colaboradores on pilares.responsable=colaboradores.id");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje.=$e->getMessage();
			return false;
		}
	}
	public function getById($id){
		
		try{$consulta =$this->db->connect()->prepare("SELECT pilares.id,alcaldias.nombre as alcaldia,pilares.nombre,pilares.ubicacion,pilares.fecha,pilares.responsable from pilares left join alcaldias on pilares.alcaldia=alcaldias.id WHERE pilares.id=:id
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
	
    
    public function insertarPilares($datos){
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
			$consulta=$this->db->connect()->prepare('DELETE FROM pilares WHERE id=:id');
			$consulta->execute([
				'id'  =>$id]);
			return true;
		}catch(PDOException $e){
			//die();
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	
	public function verificaExiste($pilares){
		try{
			$consulta=$this->db->connect()->prepare('SELECT colaborador from directores where pilares=:pilares');
			$consulta->execute([
				'pilares'  =>$pilares]);
			return $consulta->fetchColumn();
		}catch(PDOException $e){
			//die();
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	 public function borrarDirectores($pilares){
    	try{
    		$consulta=$this->db->connect()->prepare('DELETE from directores WHERE pilares=:pilares;');
    		$consulta->execute(['pilares'=>$pilares]);
    		return true;
    	}catch(PDOException $e){
			$controller->mensaje.=$e->getMessage();
			return false;
		}
    }
}

?>