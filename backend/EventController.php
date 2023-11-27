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
                    $text .= "<td class='text-center btn-out line-danger'><button class='eio-actions btn btn-primary' id='registrar-salida' data-empleado='$egresado->dni'  data-action='ingresoEgresado' data-status='1' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Registrar salida'>Se Retiró</button></td></tr>";
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
                        <td class='text-center'>$egresado->asiento</td> 
					";

                if($egresado->status == 0){
                    $text .= "<td class='text-center btn-in'><button class='eio-actions btn btn-primary entrada' id='registrar-entrada' data-empleado='$egresado->dni' data-action='ingresoEgresado' data-status='0' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Registrar entrada'>Ingresó</button></td></tr>";  
                }
                else{
                    $text .= "<td class='text-center btn-out line-danger'><button class='eio-actions btn btn-primary' id='registrar-salida' data-empleado='$egresado->dni'  data-action='ingresoEgresado' data-status='1' data-bs-toggle='tooltip' data-bs-placement='bottom' title='Registrar salida'>Se Retiró</button></td></tr>";
                } 
                $text .= "</tr>";
            }
            echo $text;
        }

        public function entradaRetirada(){
            $param = [
                'status'    => $_POST['dataStatus'] == 0 ? 1 : 0 ,
                'documento' => $_POST['egresado']
            ];
            echo $this->userModel->registrarER($param);
        }

        public function egresadosConsulta(){
            $text = "";
            $param = [
                'evento' => $_POST['eventoID'],
                'fila'   => $_POST['fila']
            ];

            foreach($this->userModel->consultarEgresados($param) as $egresado){  
                $text .= "
					<tr class='egresado-posicion'>
						<th scope='row' class='text-center'>$egresado->documento</th>
						<td>$egresado->apellido, $egresado->nombres</td>
                        <td>$egresado->carrera</td>
                        <td class='text-center'>$egresado->fila</td>
                        <td class='text-center'>$egresado->asiento</td> 
					";

                if($egresado->estado == 0){
                    $text .= "<td class='text-center'>No</td>";
                }
                else{
                    $text .= "<td class='text-center'>Si</td>";
                } 
                $text .= "</tr>";
            }
            echo $text;
        }

        public function estadisticas(){ 
            $total = count($this->userModel->nroTotalEstadisticos(intval($_POST['eventoID'])));
            $acreditados = count($this->userModel->nroPresenteEstatisticos(intval($_POST['eventoID'])));
            $noAcreditados = $total - $acreditados;
            
            $text = "
            <div class='col-2 mt-4'>
                <h3 class='text-center'>$total</h3>
                <p class='text-center'><small>Cantidad de Egresados</small></p>
            </div>
            <div class='col-2 mt-4'>
                <h3 class='text-center'>$acreditados</h3>
                <p class='text-center'><small>Cantidad de Acreditados</small></p>
            </div>
            <div class='col-2 mt-4'>
                <h3 class='text-center'>$noAcreditados</h3>
                <p class='text-center'><small>No Acreditados</small></p>
            </div>
            "; 

            echo $text;
        }
    } 
?>