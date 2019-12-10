<?php
class OrganigramasModel extends Model{
	public function __construct(){
		parent::__construct();
	}

	public function getPilaresAutorizados(){
 	try{
 		$consulta =$this->db->connect()->prepare("SELECT * from alcaldias");
 		$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
			}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
			}
 }
	public function getChild($id){
		try{
			if($id===null){
				$consulta=$this->db->connect()->prepare("SELECT cargos.id, cargos.puesto, count(colaboradores.cargo) as cantidad from cargos left join colaboradores on colaboradores.cargo = cargos.id  WHERE cargos.superior is null group by cargos.puesto;");	
				$consulta->execute();
			
			}else {$consulta=$this->db->connect()->prepare("SELECT cargos.id, cargos.puesto , count(colaboradores.cargo) as cantidad from cargos left join colaboradores on colaboradores.cargo = cargos.id  WHERE cargos.superior = :ID group by cargos.puesto order by cargos.id;");
			$consulta->execute(['ID' => $id]);
		}
			
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return true;
		}
	}
}
?>
