<?php  
	class UserModel{
		private $db;
		
		public function __construct(){
			$this->db = new DataBase;
		}

		public function getByEmail($email){
			$email =  $this->db->deleteSpecialChars($email,'email'); 
			$this->db->query('SELECT * FROM  plataforma_upro.empleados WHERE email = :email');
			$this->db->bind(':email', $email);

			$response = $this->db->getRecord();
			return $response;
		}

		public function getUsers(){
			$this->db->query('
				SELECT empleado.documento as "documento", empleado.apellido as "apellido", empleado.nombres as "nombres", empleado.telefono as "telefono", empleado.email as "email", empleado.status as "status", areas.nombre as "area_nombre"
				FROM plataforma_upro.empleados empleado
				JOIN plataforma_upro.areas areas on areas.id = empleado.area_id 
				ORDER BY apellido ASC
			'); 
			return $this->db->getRecords();
		}

		public function getUserId($documento){
			$this->db->query('SELECT empleado.id, empleado.documento FROM plataforma_upro.empleados empleado WHERE empleado.documento = :documento');
			$this->db->bind(':documento', $documento);
			
			return ($this->db->getRecord())->id;
		}

		public function getDisabledUsers(){
			$this->db->query('
				SELECT empleado.documento as "documento", empleado.apellido as "apellido", empleado.nombres as "nombres", empleado.telefono as "telefono", empleado.email as "email", empleado.status as "status", areas.nombre as "area_nombre"
				FROM plataforma_upro.empleados empleado
				JOIN plataforma_upro.areas areas on areas.id = empleado.area_id
				WHERE empleado.status = -1
				ORDER BY apellido ASC
			'); 
			return $this->db->getRecords();
		}

		public function disableUser($documento){
			$this->db->query('
				UPDATE plataforma_upro.empleados
				SET status = -1
				WHERE documento = :documento;		
			');
			$this->db->bind(':documento', $documento);
			return $this->db->execute();
		}
		
		public function enableUser($documento){
			$this->db->query('
				UPDATE plataforma_upro.empleados
				SET status = 0
				WHERE documento = :documento;		
			');
			$this->db->bind(':documento', $documento);
			return $this->db->execute();
		}

		public function create($param){
			$this->db->query('
				INSERT INTO plataforma_upro.empleados (nombres, apellido, documento, email, telefono, contrasena, ubicacion_id, area_id, rol_id) 
				VALUES (:nombres, :apellido, :documento, :email, :telefono, :contrasena, :ubicacion, :area, :rol)
			');
			$this->db->bind(':nombres',$param['nombre']);
			$this->db->bind(':apellido',$param['apellido']);
			$this->db->bind(':documento',$param['documento']);
			$this->db->bind(':email',$param['email']);
			$this->db->bind(':telefono',$param['telefono']);
			$this->db->bind(':contrasena', password_hash($param['documento'], PASSWORD_BCRYPT, ['cost' => 12]));
			$this->db->bind('ubicacion', intval($param['ubicacion']));
			$this->db->bind(':area',intval($param['area']));
			$this->db->bind(':rol',intval($param['rol']));

			return $this->db->execute();
		}

		public function searchUser($param){
			$this->db->query("
				SELECT empleado.documento, empleado.apellido, empleado.nombres, empleado.email, empleado.telefono, empleado.status, areas.nombre as area
				FROM plataforma_upro.empleados empleado
				JOIN plataforma_upro.areas areas on areas.id = empleado.area_id
				WHERE empleado.documento ILIKE '%' || :value || '%' 
				OR empleado.apellido ILIKE '%' || :value || '%' 
				OR empleado.nombres ILIKE '%' || :value || '%'
				AND empleado.status <> -1
				ORDER BY empleado.apellido ASC
			");
			$this->db->bind(':value', $param);
			return $this->db->getRecords();
		}

		public function getAreas(){
			$this->db->query('SELECT * FROM plataforma_upro.areas');
            return $this->db->getRecords();
		}

		public function getUbicaciones(){
			$this->db->query('SELECT * FROM plataforma_upro.ubicaciones');
            return $this->db->getRecords();
		}

		public function getSecretarias(){
			$this->db->query('SELECT * FROM plataforma_upro.secretaria');
            return $this->db->getRecords();
		}
	}
?>