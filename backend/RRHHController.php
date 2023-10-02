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
								<button style='width:34px; height:34px; padding: 0' class='material-icons btn btn-secondary' data-user='$result->documento' data-bs-toggle='tooltip' data-bs-placement='top' title='Editar a $apellidos[0]'>edit</button>
								<button style='width:34px; height:34px; padding: 0' class='material-icons btn btn-warning' data-bs-toggle='tooltip' data-bs-placement='top' title='Suspender a $apellidos[0]'>warning</button>
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
		public function searchRegister($value){
			
		}

    }
?>