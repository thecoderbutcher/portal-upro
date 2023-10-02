<?php
    #define('URL_ROUTE', 'http://localhost/portal-upro');
    define('URL_ROUTE', 'http://portal.uprosanluis.edu.ar/');
    
    spl_autoload_register(function($className){require_once 'backend/' . $className . '.php';}); 

    $auth     = new AuthController; 
    $rrhh     = new RRHHController;
    $security = new SecurityController;

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $_POST = json_decode(file_get_contents("php://input") , true);
            
        if (isset($_POST['action'])){
            if($_POST['action'] === 'search-esecurity'){
                $security->search($_POST['value']); 
            }
            elseif($_POST['action'] === 'search-empleados'){
                $rrhh->search($_POST['value']); 
            }
            elseif($_POST['action'] === 'search-register'){
                $rrhh->searchRegister($_POST['value']); 
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
            elseif($_POST['action'] === 'filtrarFechaUbicacion'){
                $rrhh->registros($_POST['fecha_entrada']);
            }
            elseif($_POST['action'] === 'deshabilitar'){
                $rrhh->disableUser($_POST['documento']);
            }
            elseif($_POST['action'] === 'salir'){
                $auth->logout(); 
            }

        }
    } 
?>