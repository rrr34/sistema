<?php
class EstadisticasModel extends Model{
	public function __construct(){
		parent::__construct();
	}
	public function getSubdirecciones(){
		try{
			$result=array();
			$consulta=$this->db->connect()->prepare("SELECT carg.id,carg.puesto from cargos as carg inner join cargo_alcaldia ON cargo_alcaldia.cargo=carg.id group by carg.id;");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$controller->mensaje=$e->getMessage();
			return false;
		}
	}
	public function getAlcaldiasPorCargo($id){
			try{
			$result=array();
			$consulta=$this->db->connect()->prepare("SELECT alc.nombre as alcaldia, alc.id from cargo_alcaldia inner join alcaldias as alc on cargo_alcaldia.alcaldia=alc.id where cargo_alcaldia.cargo=:id");
			$consulta->execute([
				'id'  =>$id]);
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			die($e->getMessage());
			return false;
		}
	}
	public function getAlcaldias(){
		try{
			$consulta=$this->db->connect()->prepare("SELECT nombre from alcaldias order by id");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$e->getMessage();
			return false;}
	}
	public function getDistribucion($zona,$alcaldia){
		try{
			$consulta=$this->db->connect()->prepare("SELECT colaboradores.sexo as name, count(*) as y, alcaldias.autorizado as autorizado from colaboradores left join cargos on cargos.id=colaboradores.cargo left join alcaldias on alcaldias.id=colaboradores.alcaldia where cargos.superior=:zona and alcaldias.id=:alcaldia group by colaboradores.sexo");
			$consulta->execute([
				'zona' => $zona,
				'alcaldia' => $alcaldia]);
			return $consulta->fetchAll(PDO::FETCH_ASSOC);
		}catch(PDOException $e){
			$e->getMessage();
			return false;
		}
	}

	public function getDistribucionGlobal(){
		try{
			$consulta=$this->db->connect()->prepare("SELECT  tabla.nombre as alcaldia,tabla1.cantidad as Hombres,tabla2.cantidad as Mujeres FROM (SELECT id,nombre from alcaldias) as tabla LEFT JOIN (SELECT alcaldias.id, alcaldias.nombre as alcaldia, colaboradores.sexo, count(*) as cantidad from colaboradores inner join cargos on cargos.id=colaboradores.cargo inner join alcaldias on alcaldias.id=colaboradores.alcaldia where colaboradores.sexo=:hombre group by alcaldias.nombre,colaboradores.sexo) as tabla1 ON tabla1.id=tabla.id LEFT JOIN (SELECT alcaldias.id, alcaldias.nombre as alcaldia, colaboradores.sexo, count(*) as cantidad from colaboradores inner join cargos on cargos.id=colaboradores.cargo inner join alcaldias on alcaldias.id=colaboradores.alcaldia where colaboradores.sexo=:mujer group by alcaldias.nombre,colaboradores.sexo) as tabla2 ON tabla2.id=tabla.id");
			$consulta->execute(
			[
				'hombre' => 'H',
				'mujer' => 'M']);
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$e->getMessage();
			return false;
		}
	}
	public function getDistribucionZona($id){
		try{
			$consulta=$this->db->connect()->prepare("SELECT  tabla.alcaldia,tabla1.cantidad as Hombres,tabla2.cantidad as Mujeres FROM 
			(SELECT alcaldias.nombre as alcaldia,alcaldias.id as id,cargo_alcaldia.cargo as cargo  from cargo_alcaldia inner join alcaldias on cargo_alcaldia.alcaldia=alcaldias.id) as tabla 
			LEFT JOIN 
			(SELECT alcaldias.id, alcaldias.nombre as alcaldia, colaboradores.sexo, count(*) as cantidad from colaboradores inner join cargos on cargos.id=colaboradores.cargo inner join alcaldias on alcaldias.id=colaboradores.alcaldia where colaboradores.sexo=:hombre group by alcaldias.nombre,colaboradores.sexo) as tabla1 ON tabla1.id=tabla.id 
			LEFT JOIN 
			(SELECT alcaldias.id, alcaldias.nombre as alcaldia, colaboradores.sexo, count(*) as cantidad from colaboradores inner join cargos on cargos.id=colaboradores.cargo inner join alcaldias on alcaldias.id=colaboradores.alcaldia where colaboradores.sexo=:mujer group by alcaldias.nombre,colaboradores.sexo) as tabla2 ON tabla2.id=tabla.id
			where tabla.cargo=:id ");
			$consulta->execute(
			[
				'hombre' => 'H',
				'mujer' => 'M',
				'id' => $id
			]);
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$e->getMessage();
			return false;
		}
	}

	public function getRango1(){
		try{
			$consulta=$this->db->connect()->prepare("SELECT 'Mujeres' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores where sexo='M' HAVING EDAD2 BETWEEN 20 AND 30) as Mujeres union SELECT 'Hombres' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores where sexo='H' HAVING EDAD2 BETWEEN 20 AND 30) as Mujeres");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$e->getMessage();
			return false;}
	}
	public function getRango2(){
		try{
			$consulta=$this->db->connect()->prepare("SELECT 'Mujeres' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores where sexo='M' HAVING EDAD2 BETWEEN 31 AND 40) as Mujeres union SELECT 'Hombres' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores where sexo='H' HAVING EDAD2 BETWEEN 31 AND 40) as Mujeres");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$e->getMessage();
			return false;}
	}
	public function getRango3(){
		try{
			$consulta=$this->db->connect()->prepare("SELECT 'Mujeres' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores where sexo='M' HAVING EDAD2 BETWEEN 41 AND 50) as Mujeres union SELECT 'Hombres' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores where sexo='H' HAVING EDAD2 BETWEEN 41 AND 50) as Mujeres");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$e->getMessage();
			return false;}
	}
	public function getRango4(){
		try{
			$consulta=$this->db->connect()->prepare("SELECT 'Mujeres' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores where sexo='M' HAVING EDAD2 BETWEEN 51 AND 60) as Mujeres union SELECT 'Hombres' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores where sexo='H' HAVING EDAD2 BETWEEN 51 AND 60) as Mujeres");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$e->getMessage();
			return false;}
	}
	public function getRango5(){
		try{
			$consulta=$this->db->connect()->prepare("SELECT 'Mujeres' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores where sexo='M' HAVING EDAD2 BETWEEN 61 AND 80) as Mujeres union SELECT 'Hombres' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores where sexo='H' HAVING EDAD2 BETWEEN 61 AND 80) as Mujeres");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$e->getMessage();
			return false;}
	}

	public function getNivelesEducativos(){
		try{
			$consulta=$this->db->connect()->prepare("SELECT tabla.nivel as niveles, tabla1.cantidad as Certificado, tabla2.cantidad as Título, tabla3.cantidad as Constancia, tabla4.cantidad as Kárdex, tabla5.cantidad as Cédula, tabla6.cantidad as Otro FROM (Select id, nivel from niveles_educativos) as tabla LEFT JOIN
(SELECT niveles_educativos.id,niveles_educativos.nivel, documentos.documento,COUNT(*) as cantidad from colaboradores LEFT JOIN colaborador_formacion on colaborador_formacion.colaborador=colaboradores.id LEFT join niveles_educativos on niveles_educativos.id=colaborador_formacion.nivel LEFT JOIN documentos on documentos.id=colaborador_formacion.documento where documentos.id= 1 GROUP BY niveles_educativos.nivel,documentos.documento order by niveles_educativos.id) as tabla1 on tabla1.id=tabla.id
LEFT JOIN
(SELECT niveles_educativos.id,niveles_educativos.nivel, documentos.documento,COUNT(*) as cantidad from colaboradores LEFT JOIN colaborador_formacion on colaborador_formacion.colaborador=colaboradores.id LEFT join niveles_educativos on niveles_educativos.id=colaborador_formacion.nivel LEFT JOIN documentos on documentos.id=colaborador_formacion.documento where documentos.id= 2 GROUP BY niveles_educativos.nivel,documentos.documento order by niveles_educativos.id) as tabla2 on tabla2.id=tabla.id
LEFT JOIN
(SELECT niveles_educativos.id,niveles_educativos.nivel, documentos.documento,COUNT(*) as cantidad from colaboradores LEFT JOIN colaborador_formacion on colaborador_formacion.colaborador=colaboradores.id LEFT join niveles_educativos on niveles_educativos.id=colaborador_formacion.nivel LEFT JOIN documentos on documentos.id=colaborador_formacion.documento where documentos.id= 3 GROUP BY niveles_educativos.nivel,documentos.documento order by niveles_educativos.id) as tabla3 on tabla3.id=tabla.id
LEFT JOIN
(SELECT niveles_educativos.id,niveles_educativos.nivel, documentos.documento,COUNT(*) as cantidad from colaboradores LEFT JOIN colaborador_formacion on colaborador_formacion.colaborador=colaboradores.id LEFT join niveles_educativos on niveles_educativos.id=colaborador_formacion.nivel LEFT JOIN documentos on documentos.id=colaborador_formacion.documento where documentos.id= 4 GROUP BY niveles_educativos.nivel,documentos.documento order by niveles_educativos.id) as tabla4 on tabla4.id=tabla.id
LEFT JOIN
(SELECT niveles_educativos.id,niveles_educativos.nivel, documentos.documento,COUNT(*) as cantidad from colaboradores LEFT JOIN colaborador_formacion on colaborador_formacion.colaborador=colaboradores.id LEFT join niveles_educativos on niveles_educativos.id=colaborador_formacion.nivel LEFT JOIN documentos on documentos.id=colaborador_formacion.documento where documentos.id= 5 GROUP BY niveles_educativos.nivel,documentos.documento order by niveles_educativos.id) as tabla5 on tabla5.id=tabla.id
LEFT JOIN
(SELECT niveles_educativos.id,niveles_educativos.nivel, documentos.documento,COUNT(*) as cantidad from colaboradores LEFT JOIN colaborador_formacion on colaborador_formacion.colaborador=colaboradores.id LEFT join niveles_educativos on niveles_educativos.id=colaborador_formacion.nivel LEFT JOIN documentos on documentos.id=colaborador_formacion.documento where documentos.id= 6 GROUP BY niveles_educativos.nivel,documentos.documento order by niveles_educativos.id) as tabla6 on tabla6.id=tabla.id");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$e->getMessage();
			return false;
		}
	}

	public function getEdadesGeneral(){
		try{
			$consulta=$this->db->connect()->prepare("SELECT 'De 20 a 30' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores HAVING EDAD2 BETWEEN 20 AND 30) as personas union SELECT 'De 31 a 40' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores HAVING EDAD2 BETWEEN 31 AND 40) as personas1 union SELECT 'De 41 a 50' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores HAVING EDAD2 BETWEEN 41 AND 50) as personas2 union SELECT 'De 51 a 60' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores HAVING EDAD2 BETWEEN 51 AND 60) as personas3 union SELECT 'De 61+' AS name,count(*) AS y from (SELECT sexo, FLOOR(TIMESTAMPDIFF(DAY , nacimiento, CURDATE() ) /365 ) AS EDAD2 from colaboradores HAVING EDAD2 BETWEEN 61 AND 80) as personas4");
			$consulta->execute();
			return $consulta->fetchAll(PDO::FETCH_OBJ);
		}catch(PDOException $e){
			$e->getMessage();
			return false;}
	}

}
?>