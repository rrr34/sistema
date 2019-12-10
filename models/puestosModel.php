<?php
class PuestosModel extends Model{
	public function __construct(){
		parent::__construct();
	}

	public function borrar($id){
		try{
			$consulta=$this->db->connect()->prepare(
				"DELETE FROM cargos WHERE id=:id");
			$consulta->execute([
				'id'  =>$id]);
			return true;
		}catch(PDOException $e){
			//die();

			$controller->mensaje=$e->getMessage();

			return false;
		}

	}

	public function get(){
		try{
			$result=array();
			$consulta=$this->db->connect()->prepare("SELECT SUPERIOR.PUESTO AS JEFE, CARGO.PUESTO, CARGO.NIVEL, CARGO.TIPO, CARGO.ID, AREA.PUESTO AS AREA FROM CARGOS AS CARGO LEFT JOIN CARGOS AS SUPERIOR ON SUPERIOR.ID=CARGO.SUPERIOR
 LEFT JOIN  CARGOS AS AREA ON AREA.ID=CARGO.AREA;");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}

	}

	public function getById($id){
		try{
			$result=array();
			$consulta=$this->db->connect()->prepare("SELECT SUPERIOR.PUESTO AS JEFE, CARGO.PUESTO, CARGO.NIVEL, CARGO.TIPO, SUPERIOR.ID AS SUPID, CARGO.AREA AS AREA FROM CARGOS AS CARGO LEFT JOIN CARGOS AS SUPERIOR ON SUPERIOR.ID=CARGO.SUPERIOR WHERE CARGO.ID=:ID;");
			$consulta->execute(['ID' => $id]);
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	public function validaPuesto($puesto){
			
		try{
			$consulta=$this->db->connect()->prepare("SELECT id FROM cargos WHERE puesto=:puesto");
			$consulta->execute(['puesto' => $puesto]);
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}

	public function listarSuperior(){
			
		try{
			$result=array();
			$consulta=$this->db->connect()->prepare("SELECT ID,PUESTO FROM CARGOS");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}

	public function listarAreas(){
			
		try{
			$result=array();
			$consulta=$this->db->connect()->prepare("SELECT cargos.id as id,cargos.puesto as puesto FROM cargos INNER JOIN cargos as c on cargos.id=c.area group by cargos.id");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}	
	public function insert($datos){
		try{
			$consulta=$this->db->connect()->prepare('INSERT INTO CARGOS(SUPERIOR,PUESTO,AREA,NIVEL,TIPO) VALUES(:superior, :puesto, :area, :nivel, :tipo)');
			$consulta->execute([
			'superior'=>$datos['superior'],
			'puesto'=>$datos['puesto'],
			'area'=>$datos['area'],
			'nivel' =>$datos['nivel'],
			'tipo'  =>$datos['tipo']]);
			return true;
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}	
	}
	
		public function update($datos){
		try{
			$consulta=$this->db->connect()->prepare(
				"UPDATE cargos SET
				superior =:superior,
				puesto   =:puesto,
				area     =:area,
				nivel    =:nivel,
				tipo     =:tipo 
				WHERE id =:id");
			$consulta->execute([
			'superior' =>$datos['superior'],
			'puesto'   =>$datos['puesto'],
			'area'   =>$datos['area'],
			'nivel'    =>$datos['nivel'],
			'tipo'     =>$datos['tipo'],
			'id'       =>$datos['id']
		]);
			return true;
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}	
	}
}
?>