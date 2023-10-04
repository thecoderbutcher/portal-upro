<?php
    class RRHHController{
        private $userModel;
		private $inoutModel;

		public function __construct(){  
            $this->inoutModel = new InoutModel;
			$this->userModel  = new UserModel;
		}

		public function index(){ 
			$param = [
				'users' 	  => $this->userModel->getUsers(),
				'areas' 	  => $this->userModel->getAreas(),
				'secretarias' => $this->userModel->getSecretarias(),
				'ubicacion'   => $this->userModel->getUbicaciones(),
				'registros'   => $this->inoutModel->getRegistros("Villa Mercedes",date("Y-m-d")),
			];
			return $param;
        }
		
		public function registros(){
			$ubicacion = ($_POST['location'] != "") ? $_POST['location'] : "Villa Mercedes"; 
            $fecha     = ($_POST['date'] != "") ? $_POST['date'] : date("Y-m-d");
			$text = "";
			foreach($this->inoutModel->getRegistros($ubicacion, $fecha) as $result){
				$entrada = (explode(" ",$result->r_entrada))[1];
				$salida = (explode(" ",$result->r_salida))[1];
				$text .= "
					<tr>
						<th scope='row'>$result->e_documento</th>
						<td>$result->e_apellido, $result->e_nombres</td>
						<td class='text-center'>$entrada</td>
						<td class='text-center'>$salida</td>
					</tr>
				";
			}
			echo $text;
		}

		public function search($value){  
			foreach ($this->userModel->searchUser($value) as $result){
				$apellidos = explode(" ",$result->apellido); 
                $nombres   = explode(" ",$result->nombres);
				$text = "<tr>
							<th scope='row' class='text-center'>$result->documento</th>
							<td>$apellidos[0] <span class='hidden'>$apellidos[1]</span>, $nombres[0] <span class='hidden'>$nombres[1]</span></td>
							<td>$result->email</td>	
							<td>$result->telefono</td>
							<td>$result->area</td>
							<td>
								<button style='width:34px; height:34px; padding: 0' class='btn btn-secondary' data-user='$result->documento' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar a $apellidos[0]'><span class='material-icons'>edit</span></button>
								<button style='width:34px; height:34px; padding: 0' class='material-icons btn btn-warning' data-bs-toggle='tooltip' data-bs-placement='top' title='Suspender a $apellidos[0]'><span class='material-icons'>warning</span></button>
							</td>
						</tr>
						";
				echo $text;
			}  
		}
		public function disableUser($documento){ 
			$this->userModel->disableUser(intval($documento)); 
		}

		public function enableUser($documento){
			$this->userModel->enableUser(intval($documento));
		}

		public function cargaMasiva($csv){
			# Quito la cabecera
			array_shift($csv);
						
			# Recorro el csv
			foreach($csv as $element){
				$empleado = explode(",", $element);
				$param = [
					'documento' => $empleado[0],
					'apellido' => $empleado[1],
					'nombre' => $empleado[2],
					#'fecha_nacimiento' => $empleado[3],
					'email' => $empleado[4],
					'telefono' => $empleado[5],
					'ubicacion' => $empleado[6],
					'area' => $empleado[7],
					'rol' => 3,
				];
				if($this->userModel->create($param)){
					$text = "
						<div class='toast align-items-center text-bg-success border-0 fade mb-1' role='alert' aria-live='assertive' aria-atomic='true'>
							<div class='d-flex'>
								<div class='toast-body'>
									<span class='material-icons'>check</span> <strong>$empleado[1], $empleado[2]</strong> agregado con éxito 
								</div>
								<button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
							</div>
						</div>
					";
				}
				else{
					$text = "
						<div class='toast align-items-center text-bg-danger border-0 fade mb-1' role='alert' aria-live='assertive' aria-atomic='true'>
							<div class='d-flex'>
								<div class='toast-body'>
									<span class='material-icons'>close</span> <strong>$empleado[1], $empleado[2]</strong> no se puedo agregar
								</div>
							<button type='button' class='btn-close btn-close-white me-2 m-auto' data-bs-dismiss='toast' aria-label='Close'></button>
							</div>
						</div>
					";
				}
				echo $text;
			}


		}

		public function searchRegister($value){#
			
		}

    }
?>