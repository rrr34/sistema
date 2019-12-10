<?php 
class ColaboradoresModel extends Model{
	public function __construct(){
		parent::__construct();

	}
	public function borrar($id){
		try{
			$consulta=$this->db->connect()->prepare(
				"DELETE FROM colaboradores WHERE id=:id");
			$consulta->execute([
				'id'  =>$id]);
			return true;
		}catch(PDOException $e){
			//die();

			$controller->mensaje=$e->getMessage();

			return false;
		}

	}
	public function getPuestos(){
		$result=array();
		try{
			$consulta=$this->db->connect()->prepare("SELECT id,puesto FROM CARGOS");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	public function getAlcaldias(){
		$result=array();
		try{
			$consulta=$this->db->connect()->prepare("SELECT id,nombre FROM alcaldias");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}

	public function getNiveles(){
		$result=array();
		try{
			$consulta=$this->db->connect()->prepare("SELECT id,nivel FROM NIVELES_EDUCATIVOS");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	public function getDocumentos(){
		$result=array();
		try{
			$consulta=$this->db->connect()->prepare("SELECT id,documento FROM documentos");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	public function getTodo($id){
		$result=array();
		try{
				$consulta=$this->db->connect()->prepare("SELECT sup.puesto as jefe, car.puesto,alc.nombre as alcaldia,col.nombre,col.apellido_paterno,col.apellido_materno,col.sexo,col.telefono,col.correo,col.alta, col.curp,col.nacimiento,col.correo_institucional,cf.especialidad,cf.porcentaje,doc.documento,niv.nivel FROM colaboradores as col 
					LEFT JOIN colaborador_formacion as cf on cf.colaborador=col.id
					left JOIN cargos as car on col.cargo=car.id
					LEFT JOIN cargos as sup on car.superior=sup.id
					LEFT JOIN alcaldias as alc on col.alcaldia=alc.id
					LEFT JOIN documentos as doc on doc.id=cf.documento
					LEFT JOIN niveles_educativos as niv on niv.id=cf.nivel
					WHERE col.id=:id;");
			$consulta->execute(['id' => $id]);
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	public function getDatosTabla(){
		$result=array();
		try{$consulta =$this->db->connect()->prepare("SELECT area.puesto as area, sup.puesto as jefe, car.puesto,alc.nombre as alcaldia,col.nombre,col.apellido_paterno,col.apellido_materno,col.sexo, col.id FROM colaboradores as col LEFT JOIN cargos as car on col.cargo       =car.id LEFT JOIN cargos as sup on car.superior    =sup.id LEFT JOIN alcaldias as alc on col.alcaldia =alc.id
		inner join cargos as area on car.area =area.id
		order by area.id,sup.id,car.id;");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	public function insertarColaborador($datos){
		try{
			$consulta=$this->db->connect();
			$quer=$consulta->prepare('INSERT INTO colaboradores(
				cargo,nombre,apellido_paterno,apellido_materno,sexo,alta,curp,alcaldia,telefono,correo,nacimiento,correo_institucional) VALUES(:cargo,:nombre,:apellido_paterno,:apellido_materno,:sexo,:alta,:curp,:alcaldia,:telefono,:correo,:nacimiento,:correo_institucional)');
			$quer->bindParam(":cargo",$datos['cargo'],PDO::PARAM_INT);
			$quer->bindParam(":nombre",$datos['nombre'],PDO::PARAM_STR);
			$quer->bindParam(":apellido_paterno",$datos['apellido_paterno'],PDO::PARAM_STR);
			$quer->bindParam(":apellido_materno",$datos['apellido_materno'],PDO::PARAM_STR);
			$quer->bindParam(":sexo",$datos['sexo'],PDO::PARAM_STR);
			$quer->bindParam(":alta",$datos['alta'],PDO::PARAM_STR);
			$quer->bindParam(":curp",$datos['curp'],PDO::PARAM_STR);
			$quer->bindParam(":alcaldia",$datos['alcaldias'],PDO::PARAM_INT);
			$quer->bindParam(":telefono",$datos['telefono'],PDO::PARAM_STR);
			$quer->bindParam(":correo",$datos['correo'],PDO::PARAM_STR);
			$quer->bindParam(":nacimiento",$datos['nacimiento'],PDO::PARAM_STR);
			$quer->bindParam(":correo_institucional",$datos['correo_institucional'],PDO::PARAM_STR);
			$quer->execute();
			$id= $consulta->lastInsertId();
			$consulta2=$this->db->connect();
			$quer=$consulta2->prepare('INSERT INTO colaborador_formacion(
				nivel,colaborador,documento,especialidad,porcentaje) VALUES(:nivel,:colaborador,:documento,:especialidad,:porcentaje)');
			$quer->bindParam(":nivel",$datos['nivel'],PDO::PARAM_INT);
			$quer->bindParam(":colaborador",$id,PDO::PARAM_INT);
			$quer->bindParam(":documento",$datos['documento'],PDO::PARAM_INT);
			$quer->bindParam(":especialidad",$datos['especialidad'],PDO::PARAM_STR);
			$quer->bindParam(":porcentaje",$datos['porcentaje'],PDO::PARAM_INT);
			$quer->execute();
			return true;
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	public function getById($id){
		try{
			$result=array();
			$consulta =$this->db->connect()->prepare("SELECT car.id as cargo,car.puesto,alc.id as aid, alc.nombre AS alcaldia, col.nombre, col.apellido_paterno, col.apellido_materno, col.curp,col.correo,col.telefono,col.sexo,col.alta,col.nacimiento,col.correo_institucional,niv.nivel,niv.id as idn,doc.id as idd,doc.documento,cf.especialidad,cf.porcentaje FROM
			colaboradores AS col LEFT JOIN cargos AS car on col.cargo =car.id
			LEFT JOIN alcaldias AS alc on alc.id                      =col.alcaldia
			LEFT JOIN colaborador_formacion AS cf on cf.colaborador   =col.id
			LEFT JOIN documentos AS doc on doc.id                     =cf.documento
			LEFT JOIN niveles_educativos AS niv on niv.id             =cf.nivel WHERE col.id=:id;");
			$consulta->execute(['id' => $id]);
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}

	public function update($datos){
		try{
			$consulta=$this->db->connect()->prepare(
				"UPDATE colaboradores SET
				cargo            =:cargo,
				nombre           =:nombre,
				apellido_paterno =:apellido_paterno,
				apellido_materno =:apellido_materno, 
				sexo             =:sexo,
				alta             =:alta,
				curp             =:curp,
				alcaldia         =:alcaldia,
				telefono         =:telefono,
				correo           =:correo,
				nacimiento           =:nacimiento,
				correo_institucional           =:correo_institucional
				WHERE id=:id");
			$consulta->execute([
			'cargo'                =>$datos['cargo'],
			'nombre'               =>$datos['nombre'],
			'apellido_paterno'     =>$datos['apellido_paterno'],
			'apellido_materno'     =>$datos['apellido_materno'],
			'sexo'                 =>$datos['sexo'],
			'alta'                 =>$datos['alta'],
			'curp'                 =>$datos['curp'],
			'alcaldia'             =>$datos['alcaldia'],
			'telefono'             =>$datos['telefono'],
			'correo'               =>$datos['correo'],
			'nacimiento'           =>$datos['nacimiento'],
			'correo_institucional' =>$datos['correo_institucional'],
			'id'               =>$datos['id']
		]);

			$consulta2=$this->db->connect()->prepare(
				"UPDATE colaborador_formacion SET
				nivel             =:nivel,
				documento         =:documento,
				especialidad      =:especialidad,
				porcentaje        =:porcentaje
				WHERE colaborador =:colaborador");
			$consulta2->execute([
			'nivel'        =>$datos['nivel'],
			'documento'    =>$datos['documento'],
			'especialidad' =>$datos['especialidad'],
			'porcentaje' =>$datos['porcentaje'],
			'colaborador'         =>$datos['id']
		]);
			return true;
		}catch(PDOException $e){
			//$controller->mensaje=
			$e->getMessage();
			return false;
		}	
	}


}

?>