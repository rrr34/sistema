<?php
class HonorariosModel extends Model{
	public function __construct(){
		parent::__construct();
	}
	public function get(){
			try{
			$consulta=$this->db->connect()->prepare("SELECT cargos.id, cargos.puesto , count(colaboradores.cargo) as cantidad from cargos left join colaboradores on colaboradores.cargo = cargos.id  
			WHERE cargos.puesto like '%Honorario%' group by cargos.puesto order by cargos.superior");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
			}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
			}
	}
	public function getTotal(){
		try{
			$constulta=$this->db->connect()->prepare("SELECT count(colaboradores.cargo) as total from cargos left join colaboradores on colaboradores.cargo = cargos.id WHERE cargos.puesto like 'Honorario%'");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
			}
	}
	public function getTotalDisponible(){
			try{
			$consulta =$this->db->connect()->prepare("SELECT count(*) as total from cargos left join colaboradores on colaboradores.cargo = cargos.id WHERE cargos.puesto like 'Honorario%'");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
			}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
			}
	}
 public function getTotalDisponibleA(){
 	try{
 		$consulta =$this->db->connect()->prepare("SELECT 37- count(*) as total from cargos left join colaboradores on colaboradores.cargo = cargos.id WHERE cargos.puesto like 'Honorario (A)%'");
 		$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
			}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
			}
 }
 public function getTotalDisponibleB(){
 	try{
 		$consulta =$this->db->connect()->prepare("SELECT 14- count(*) as total from cargos left join colaboradores on colaboradores.cargo = cargos.id WHERE cargos.puesto like 'Honorario (B)%'");
 		$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
			}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
			}
 }

public function getTotalDisponibleC(){
 	try{
 		$consulta =$this->db->connect()->prepare("SELECT 10- count(*) as total from cargos left join colaboradores on colaboradores.cargo = cargos.id WHERE cargos.puesto like 'Honorario (C)%'");
 		$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
			}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
			}
 }
 public function getTotalDisponible0(){
 	try{
 		$consulta =$this->db->connect()->prepare("SELECT 1- count(*) as total from cargos left join colaboradores on colaboradores.cargo = cargos.id WHERE cargos.puesto like 'Honorario (0)%'");
 		$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
			}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
			}
 }

public function getTotalDisponibleD(){
 	try{
 		$consulta =$this->db->connect()->prepare("SELECT 4- count(*) as total from cargos left join colaboradores on colaboradores.cargo = cargos.id WHERE cargos.puesto like 'Honorario (D)%'");
 		$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
			}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
			}
 }

	public function getDistribucion(){
		try{
			$consulta=$this->db->connect()->prepare("SELECT count(*)as cantidad from colaboradores inner join cargos on cargos.id=colaboradores.cargo where cargos.puesto like 'Honorario (A)%' UNION SELECT count(*)as cantidad from colaboradores inner join cargos on cargos.id=colaboradores.cargo where cargos.puesto like 'Honorario (B)%' UNION SELECT count(*)as cantidad from colaboradores inner join cargos on cargos.id=colaboradores.cargo where cargos.puesto like 'Honorario (C)%' UNION SELECT count(*)as cantidad from colaboradores inner join cargos on cargos.id=colaboradores.cargo where cargos.puesto like 'Honorario (D)%' union SELECT count(*)as cantidad from colaboradores inner join cargos on cargos.id=colaboradores.cargo where cargos.puesto like 'Honorario (0)%' union SELECT count(*)as cantidad from colaboradores inner join cargos on cargos.id=colaboradores.cargo where cargos.puesto like 'Honorario%'");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$e->getMessage();
			return false;}
	}
}