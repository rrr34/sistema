<?php 
class PrincipalModel extends Model{
	public function __construct(){
		parent::__construct();

	}
	
	public function getDatosTabla(){
		
		try{$consulta =$this->db->connect()->prepare("SELECT col.id,area.puesto as area,sup.puesto as jefe, car.puesto,alc.nombre as alcaldia,col.nombre,col.apellido_paterno,col.apellido_materno,col.sexo, col.id FROM colaboradores as col LEFT JOIN cargos as car on col.cargo=car.id LEFT JOIN cargos as sup on car.superior=sup.id LEFT JOIN alcaldias as alc on col.alcaldia=alc.id inner join cargos as area on car.area=area.id order by area.id,sup.id,car.id
			;");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	public function getBusqueda($datos,$parametros){
		try{$consulta =$this->db->connect()->prepare($datos);
			$consulta->execute($parametros);
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$e->getMessage();
			return false;
		}
	}
	public function getTodo(){
		$result=array();
		try{
				$consulta=$this->db->connect()->prepare("SELECT area.puesto COLLATE UTF8_GENERAL_CI as area,sup.puesto COLLATE UTF8_GENERAL_CI as jefe, car.puesto COLLATE UTF8_GENERAL_CI as puesto,alc.nombre as alcaldia,pil.nombre as pilares,col.nombre,col.apellido_paterno,col.apellido_materno,col.sexo,col.alta, col.curp,col.telefono,col.correo,col.correo_institucional,col.nacimiento,YEAR(CURDATE())-YEAR(col.nacimiento) + IF(DATE_FORMAT(CURDATE(),'%m-%d') > DATE_FORMAT(col.nacimiento,'%m-%d'), 0 , -1 ) AS edad,cf.especialidad,cf.porcentaje,doc.documento,niv.nivel FROM colaboradores as col LEFT JOIN colaborador_formacion as cf on cf.colaborador=col.id LEFT JOIN cargos as car on col.cargo=car.id LEFT JOIN cargos as sup on car.superior=sup.id LEFT JOIN alcaldias as alc on col.alcaldia=alc.id LEFT JOIN documentos as doc on doc.id=cf.documento LEFT JOIN niveles_educativos as niv on niv.id=cf.nivel LEFT JOIN pilares as pil on pil.responsable=col.id inner join cargos as area on car.area=area.id order by area.id,sup.id,car.id
					");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
		}

		public function getTodoBusqueda($datos){
		$arr = $datos;
		$in  = str_repeat('?,', count($arr) - 1) . '?';

		try{
				$consulta=$this->db->connect()->prepare("SELECT area.puesto COLLATE UTF8_GENERAL_CI as area,sup.puesto COLLATE UTF8_GENERAL_CI as jefe, car.puesto COLLATE UTF8_GENERAL_CI,alc.nombre as alcaldia,pil.nombre as pilares,col.nombre,col.apellido_paterno,col.apellido_materno,col.sexo,col.alta, col.curp,col.telefono,col.correo,col.correo_institucional,col.nacimiento,cf.especialidad,cf.porcentaje,doc.documento,niv.nivel FROM colaboradores as col 
					LEFT JOIN colaborador_formacion as cf on cf.colaborador=col.id
					LEFT JOIN cargos as car on col.cargo=car.id
					LEFT JOIN cargos as sup on car.superior=sup.id
					LEFT JOIN alcaldias as alc on col.alcaldia=alc.id
					LEFT JOIN documentos as doc on doc.id=cf.documento
					LEFT JOIN niveles_educativos as niv on niv.id=cf.nivel 
					LEFT JOIN pilares as pil on pil.responsable=col.id 
					inner join cargos as area on car.area=area.id
					WHERE col.id IN ($in)
					");
			$consulta->execute($datos);
			return $consulta->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}

	
}
?>