<?php
    class SecurityController{
        private $userModel;
		private $inoutModel;

		public function __construct(){  
            $this->inoutModel = new InoutModel;
			$this->userModel  = new UserModel;
		}

        public function index(){ 
			return ['users' => $this->userModel->getUsers()];
        }

        public function registrarEntrada($values){
			$param = [
				'empleado'    => $this->userModel->getUserId($values['empleado']),
				'registrador' => $this->userModel->getUserId($values['registrador'])
			];

			$param['fecha']      = $this->inoutModel->registroEntrada($param);
			$param['id_entrada'] = $this->inoutModel->getRegistroEntradaId($param);
			
			$this->inoutModel->changeStatus($param);
			
			echo $param['id_entrada'];
		}
	
		public function registrarSalida($values){
			$param = [
				'empleado'    => $this->userModel->getUserId($values['empleado']),
				'registrador' => $this->userModel->getUserId($values['registrador']),
				'id_entrada'  => $values['dataStatus']
			];			
			$this->inoutModel->registroSalida($param);

			$param['id_entrada'] =  0;
			$this->inoutModel->changeStatus($param);
			
			echo 0;
		}
        public function search($value){  
			foreach ($this->userModel->searchUser($value) as $result){
				$apellidos = explode(" ",$result->apellido); 
                $nombres   = explode(" ",$result->nombres);
				$text = "<tr>
							<th scope='row' class='text-center'>$result->documento</th>
							<td>$apellidos[0] <span class='hidden'>$apellidos[1]</span>, $nombres[0] <span class='hidden'>$nombres[1]</span></td></td>
						";
				
				if($result->status == 0){
					$text .= "<td class='text-center'><button class='io-actions btn btn-primary entrada' id='registrar-entrada' data-empleado='$result->documento' data-registrador='$_SESSION[userdoc]' data-url='".URL_ROUTE."Inouts/' data-action='registrarEntrada' data-status='0' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Registrar entrada'>Entrada</button></td></tr>"; 
				}
				else{
					$text .= "<td class='text-center'><button class='io-actions btn btn-primary' id='registrar-salida' data-empleado='$result->documento' data-registrador='$_SESSION[userdoc]' data-url='".URL_ROUTE."Inouts/' data-action='registrarSalida' data-status='$result->status' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Registrar salida'>Salida</button></td></tr>";
				} 
				echo $text;
			}  
		}
    }
?>