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

		public function getUsersUbicacion($ubicacion){
			$this->db->query('
				SELECT empleado.documento as "documento", empleado.apellido as "apellido", empleado.nombres as "nombres", empleado.telefono as "telefono", empleado.email as "email", empleado.status as "status", areas.nombre as "area_nombre"
				FROM plataforma_upro.empleados empleado
				JOIN plataforma_upro.areas areas on areas.id = empleado.area_id 
				WHERE empleado.ubicacion_id = :ubicacion
				ORDER BY apellido ASC
			'); 
			$this->db->bind(':ubicacion', $ubicacion);
			return $this->db->getRecords();
		}

		public function getUser($documento){
			$this->db->query('
				SELECT empleado.documento as "documento", empleado.apellido as "apellido", empleado.nombres as "nombres", empleado.telefono as "telefono", empleado.email as "email", empleado.status as "status", areas.nombre as "area_nombre"
				FROM plataforma_upro.empleados empleado
				JOIN plataforma_upro.areas areas on areas.id = empleado.area_id 
				WHERE empleado.documento = :documento
			'); 
			$this->db->bind(':documento', $documento);
			return $this->db->getRecord();
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
			$this->db->bind(':ubicacion', intval($param['ubicacion']));
			$this->db->bind(':area',intval($param['area']));
			$this->db->bind(':rol',intval(3));

			return $this->db->execute();
		}
		public function agregarEgresado($param){ 
			$this->db->query('
				INSERT INTO plataforma_upro.egresados (nombres, apellido, documento,  ubicacion_id, carrera_id) 
				VALUES (:nombres, :apellido, :documento, :ubicacion, :carrera)
			');
			$this->db->bind(':nombres',$param['nombre']);
			$this->db->bind(':apellido',$param['apellido']);
			$this->db->bind(':documento',$param['documento']);
			#$this->db->bind(':telefono',$param['telefono']);
			$this->db->bind(':ubicacion', $param['ubicacion']);
			$this->db->bind(':carrera',$param['carrera']);
			
			return $this->db->execute(); 
		}

		public function getUbicacionId($ubicacion){
			$this->db->query('SELECT id FROM plataforma_upro.ubicaciones WHERE nombre = :nombre');
			$this->db->bind(':nombre', $ubicacion);
			return ($this->db->getRecord())->id;
		}
		public function getCarreraId($carrera){
			$this->db->query('SELECT id FROM plataforma_upro.carreras WHERE nombre = :nombre');
			$this->db->bind(':nombre', $carrera);
			return ($this->db->getRecord())->id;
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

		# EVENTS CODE
		public function getEventoId($ubicacion){
			$this->db->query('SELECT id FROM plataforma_upro.eventos WHERE ubicacion_id = :ubicacion');
			$this->db->bind(':ubicacion', intval($ubicacion));
			return ($this->db->getRecord())->id;
		}

		public function getFilaId($evento_id){
			$this->db->query('SELECT id FROM plataforma_upro.eventos_fila WHERE evento_id = :evento_id ORDER BY id DESC LIMIT 1');
			$this->db->bind(':evento_id', intval($evento_id));
			return ($this->db->getRecord())->id;
		}

		public function getEgresadosId($ubicacion){
			$this->db->query('SELECT id FROM plataforma_upro.egresados WHERE ubicacion_id = :ubicacion_id ORDER BY carrera_id, apellido, nombres ASC');
			$this->db->bind(':ubicacion_id', $ubicacion);
			return $this->db->getRecords();
		}

		public function getFilasId($evento_id){
			$this->db->query('SELECT id FROM plataforma_upro.eventos_fila WHERE evento_id = :evento_id');
			$this->db->bind(':evento_id', $evento_id);
			return $this->db->getRecords();
		}

		public function getAsientosId($fila_id){
			$this->db->query('SELECT id FROM plataforma_upro.eventos_asientos WHERE fila_id = :fila_id');
			$this->db->bind(':fila_id', $fila_id);
			return $this->db->getRecords();
		}

		public function setEventoCantidadFila($param){
			$evento_id = $this->getEventoId($param['ubicacion_id']);
			for($i = 1; $i <= intval($param['cantidad_fila']); $i++){
				$this->db->query('
					INSERT INTO plataforma_upro.eventos_fila (nombre, evento_id)
					VALUES (:nombre, :id)
				'); 
				$this->db->bind(':nombre', $i);
				$this->db->bind(':id', $evento_id);
				$this->db->execute();

				$fila_id = $this->getFilaId($evento_id); 
				
				$aux = 0;
				for($j = 1; $j < intval($param['cantidad_asientos']); $j++){
					if($aux === 0 && $j === 13 && (intval($param['ubicacion_id']) === 1 || intval($param['ubicacion_id']) === 14)){
						$nombre = "LL";
						$j = $j - 1;
						$aux = $aux + 1; 
					}
					elseif($j >= 27){
						$nombre = "Z$aux";
						$aux++;
					}
					else{
						if(($aux === 1 || $aux === 0) && $j === 15){
							$nombre = 'Ñ';
							$j = $j - 1  ;
							$aux = 2;
						}
						else{
							$nombre = chr($j + 64);
						}
					}

					$this->db->query('
						INSERT INTO plataforma_upro.eventos_asientos (nombre, fila_id)
						VALUES (:nombre, :id)
					'); 
					$this->db->bind(':nombre', $nombre);
					$this->db->bind(':id', $fila_id);
					$this->db->execute();
				}
			}

			$egresados = $this->getEgresadosId($param['ubicacion_id']);
			$filas = $this->getFilasId($evento_id);
			
			foreach($filas as $fila){
				$asientos = $this->getAsientosId($fila->id);
				foreach($asientos as $asiento){
					if(count($egresados) > 0){
						$egresado = array_shift($egresados);

						$this->db->query('INSERT INTO plataforma_upro.eventos_posicion (asiento_id, fila_id, egresado_id, evento_id) VALUES (:asiento, :fila, :egresado, :evento)');
						$this->db->bind(':asiento', $asiento->id);
						$this->db->bind(':fila', $fila->id);
						$this->db->bind(':egresado', $egresado->id);
						$this->db->bind(':evento', $evento_id);
						$this->db->execute();
					}
					else{
						return;
					}
				}
			}
		}

		public function getPosiciones($evento){
			$this->db->query('
				SELECT egresado.documento as "dni",
				egresado.apellido as "apellido",
				egresado.nombres as "nombres",
				carrera.nombre as "carrera",
				fila.nombre as "fila",
				asiento.nombre as "asiento",
				posicion.status as "status"
				FROM plataforma_upro.eventos_posicion posicion
				LEFT JOIN plataforma_upro.eventos_fila fila ON fila.id = posicion.fila_id 
				LEFT JOIN plataforma_upro.eventos_asientos asiento ON asiento.id = posicion.asiento_id 
				LEFT JOIN plataforma_upro.egresados egresado ON egresado.id = posicion.egresado_id
				LEFT JOIN plataforma_upro.carreras carrera ON carrera.id = egresado.carrera_id 
				LEFT JOIN plataforma_upro.ubicaciones ubicacion ON ubicacion.id = egresado.ubicacion_id 
				WHERE posicion.evento_id = :evento_id
				ORDER BY fila.nombre::numeric, asiento.nombre ASC'
			);
			$this->db->bind(':evento_id', $evento);
			return $this->db->getRecords();
		}

		public function buscarEgresados($param){
			$this->db->query("
				SELECT egresado.documento as dni,
				egresado.apellido as apellido,
				egresado.nombres as nombres,
				carrera.nombre as carrera,
				fila.nombre as fila,
				asiento.nombre as  asiento,
				posicion.status as status
				FROM plataforma_upro.eventos_posicion posicion
				LEFT JOIN plataforma_upro.eventos_fila fila ON fila.id = posicion.fila_id 
				LEFT JOIN plataforma_upro.eventos_asientos asiento ON asiento.id = posicion.asiento_id 
				LEFT JOIN plataforma_upro.egresados egresado ON egresado.id = posicion.egresado_id
				LEFT JOIN plataforma_upro.carreras carrera ON carrera.id = egresado.carrera_id 
				LEFT JOIN plataforma_upro.ubicaciones ubicacion ON ubicacion.id = egresado.ubicacion_id 
				WHERE posicion.evento_id = :evento_id
				AND (egresado.documento ILIKE '%' || :value || '%' 
				OR egresado.apellido ILIKE '%' || :value || '%' 
				OR egresado.nombres ILIKE '%' || :value || '%') 
				ORDER BY fila.nombre::numeric, asiento.nombre ASC
			");
			$this->db->bind(':value', $param['value']);
			$this->db->bind(':evento_id', intval($param['evento_id']));
			return $this->db->getRecords();
		}

		public function registrarER($param){
			$this->db->query('
				UPDATE plataforma_upro.eventos_posicion posicion
				SET status = :status
				FROM plataforma_upro.egresados egresados
				WHERE egresados.id = posicion.egresado_id 
				AND egresados.documento = :dni'
			);

			$this->db->bind(':status', $param['status']);
			$this->db->bind(':dni', $param['documento']);
			$this->db->execute();
			return $param['status'];
		}

		public function consultarEgresados($param){
			$this->db->query('
				SELECT egresados.documento as documento, egresados.apellido as apellido, egresados.nombres as nombres, carrera.nombre as carrera, fila.nombre as fila, asiento.nombre as asiento, posicion.status as estado   
				FROM plataforma_upro.eventos_posicion posicion
				LEFT JOIN plataforma_upro.eventos_fila fila on fila.id = posicion.fila_id 
				LEFT JOIN plataforma_upro.eventos_asientos asiento on asiento.id  = posicion.asiento_id 
				LEFT JOIN plataforma_upro.egresados egresados on egresados.id = posicion.egresado_id 
				LEFT JOIN plataforma_upro.carreras carrera on carrera.id = egresados.carrera_id 
				WHERE posicion.evento_id = :evento AND fila.nombre = :fila
				ORDER BY fila.nombre::numeric, asiento.nombre ASC
			');
			$this->db->bind(':evento', $param['evento']);
			$this->db->bind(':fila', $param['fila']);

			return $this->db->getRecords();
		}

		public function nroTotalEstadisticos($param){
			$this->db->query('
				SELECT *
				FROM plataforma_upro.eventos_posicion posicion
				WHERE posicion.evento_id = :evento
			');
			$this->db->bind(':evento', $param);
			return $this->db->getRecords();
		}

		public function nroPresenteEstatisticos($param){
			$this->db->query('
				SELECT *
				FROM plataforma_upro.eventos_posicion posicion
				WHERE posicion.status = 1 and posicion.evento_id = :evento
			');
			$this->db->bind(':evento', $param);
			return $this->db->getRecords(); 
		}

	}
