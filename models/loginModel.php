<?php
class LoginModel extends Model{
	public function __construct(){
		parent::__construct();
	}
	public function validar($datos){
		try{
			$consulta=$this->db->connect()->prepare('SELECT * FROM usuarios WHERE username = :user AND password = :pass');
			$consulta->execute(['user' =>$datos['user'], 'pass' => $datos['pass']]);
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	public function setUser($user){
		try{
			$consulta=$this->db->connect()->prepare('SELECT * FROM usuarios WHERE username = :user');
        	$consulta->execute(['user' => $user]);
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
}
?>