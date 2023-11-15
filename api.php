<?php
    define('URL_ROUTE', 'http://localhost/portal-upro');
    #define('URL_ROUTE', 'http://portal.uprosanluis.edu.ar/');
    
    spl_autoload_register(function($className){require_once 'backend/' . $className . '.php';}); 
# note: just call method from controller and the controllers make all control and verification. Make correction
    $auth     = new AuthController; 
    $rrhh     = new RRHHController;
    $security = new SecurityController;
    $event    = new EventController;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_POST = json_decode(file_get_contents("php://input") , true);
        
        # Para formularios sin archivos
        if (isset($_POST['action'])){
            
            if($_POST['action'] === 'search-esecurity'){
                $security->search($_POST['value']); 
            }
            elseif($_POST['action'] === 'create'){
                $param = [
                    'nombre'    => $_POST['nombre'],
                    'apellido'  => $_POST['apellido'],
                    'documento' => $_POST['documento'],
                    'email'     => $_POST['email'],
                    'telefono'  => $_POST['telefono'],
                    'ubicacion' => $_POST['ubicacion'],
                    'area'      => $_POST['area']
                ];
                $rrhh->agregarEmpleado($param);
            }
            elseif($_POST['action'] === 'cargaMasiva'){  
                $rrhh->cargaMasiva($_POST['csv_file']);
            }
            elseif($_POST['action'] === 'search-empleados'){
                $rrhh->search($_POST['value']); 
            } 
            elseif($_POST['action'] === 'registrarEntrada'){
                $param = [
                    "empleado"    => intval($_POST['empleado']),
                    "registrador" => intval($_POST['registrador'])
                ];
                $security->registrarEntrada($param);
            }
            elseif($_POST['action'] === 'registrarSalida'){
                $param = [
                    "empleado"    => intval($_POST['empleado']),
                    "registrador" => intval($_POST['registrador']),
                    "dataStatus"  => intval($_POST['dataStatus'])
                ];
                $security->registrarSalida($param);
            } 
            elseif($_POST['action'] === 'cargaMasivaEgresados'){
                $rrhh->cargaMasivaEgresados($_POST['csv_file']);
            }
            elseif($_POST['action'] === 'filtrarFechaUbicacion'){
                $rrhh->registros($_POST['fecha_entrada']);
            }
            elseif($_POST['action'] === 'deshabilitar'){
                $rrhh->disableUser($_POST['documento']);
            }
            elseif($_POST['action'] === 'habilitar'){
                $rrhh->enableUser($_POST['documento']);
            }
            elseif($_POST['action'] === 'distribuir'){
                $rrhh->distribuirEgresados();
            }
            elseif($_POST['action'] === 'egresadosUbicacion'){
                $event->getEgresadosUbicacion();
            }
            elseif($_POST['action'] === 'seRetiroEgresado'){
                $event->registrarRetirada();
            }
            elseif($_POST['action'] === 'ingresoEgresado'){
                $event->entradaRetirada();
            }
            elseif($_POST['action'] === 'salir'){
                $auth->logout(); 
            }
            elseif($_POST['action'] === 'buscarEgresado'){
                $event->buscarEgresados();
            }
        }
    } 
?>