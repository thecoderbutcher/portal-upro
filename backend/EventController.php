<?php
    class EventController{
        private $userModel;

        public function __construct(){
            $this->userModel  = new UserModel;
        }

        public function index(){
            return ['egresados' => $this->userModel->getPosiciones(10)]; 
        }

        public function getEgresadosUbicacion(){
            $text = "";
            foreach($this->userModel->getPosiciones(intval($_POST['eventoID'])) as $egresado){ 
                $text .= "
					<tr class='egresado-posicion'>
						<th scope='row' class='text-center'>$egresado->dni</th>
						<td>$egresado->apellido, $egresado->nombres</td>
                        <td>$egresado->carrera</td>
                        <td class='text-center'>$egresado->fila</td>
                        <td class='text-center'>$egresado->asiento</td> 
					";
                if($egresado->status == 0){
                    $text .= "<td class='text-center btn-in'><button class='eio-actions btn btn-primary entrada' id='registrar-entrada' data-empleado='$egresado->dni' data-action='ingresoEgresado' data-status='0' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Registrar entrada'>Ingresó</button></td></tr>"; 
                }
                else{
                    $text .= "<td class='text-center btn-out line-danger'><button class='eio-actions btn btn-primary' id='registrar-salida' data-empleado='$egresado->dni'  data-action='seRetiroEgresado' data-status='$egresado->status' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Registrar salida'>Se Retiró</button></td></tr>";
                } 
                $text .= "</tr>";
            }
            echo $text;
        }

        public function buscarEgresados(){
            $text = "";
            $param = [
                'value' => $_POST['value'],
                'evento_id' => $_POST['evento_id']
            ];
            foreach($this->userModel->buscarEgresados($param) as $egresado){ 
                $text .= "
					<tr class='egresado-posicion'>
						<th scope='row' class='text-center'>$egresado->dni</th>
						<td>$egresado->apellido, $egresado->nombres</td>
                        <td>$egresado->carrera</td>
                        <td class='text-center'>$egresado->fila</td>
                        <td class='text-center'>$egresado->asiento $egresado->status</td> 
					";

                if($egresado->status == 0){
                    $text .= "<td class='text-center btn-in'><button class='eio-actions btn btn-primary entrada' id='registrar-entrada' data-empleado='$egresado->dni' data-action='registrarEntrada' data-status='0' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Registrar entrada'>Ingresó</button></td></tr>"; 
                }
                else{
                    $text .= "<td class='text-center btn-out'><button class='eio-actions btn btn-primary' id='registrar-salida' data-empleado='$egresado->dni'  data-action='registrarSalida' data-status='$egresado->status' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Registrar salida'>Se Retiró</button></td></tr>";
                } 
                $text .= "</tr>";
            }
            echo $text;
        }

        public function entradaRetirada(){
            $param = [
                'status' => $_POST['status'],
                'documento' => $_POST['dataStat']
            ];
            return $this->userModel->registrarER($_POST['egresado']);
            
        }

        public function registrarRetirada(){
            
        }
    }


?>