<?php
    class Main{  
        /*
         * 1 admin
         * 2 seguridad
         * 3 rrhh
         * 4 g alumnos
         */
        public static function home(){
            require_once 'components/header.php';
            require_once 'components/nav.php';

            if($_SESSION['rol'] == 2){  # Seguridad
                require_once 'components/seguridad/dashboard.php';
            }
            elseif ($_SESSION['rol'] == 3){  # RRHH
                require_once 'components/rrhh/dashboard.php';
                require_once 'components/rrhh/modal-components.php';
            }
            elseif ($_SESSION['rol'] == 4){
                require_once 'components/alumnos/dashboard.php';
            }
            elseif ($_SESSION['rol'] == 6){
                require_once 'components/eventos/acreditacion/dashboard.php';
            }
            elseif ($_SESSION['rol'] == 7){
                require_once 'components/eventos/administracion/dashboard.php';
            }
            require_once 'components/footer.php'; 
        }

        public static function login(){
            $auth = new AuthController; 
            require_once 'components/header.php';
            require_once 'components/login.php';
            require_once 'components/footer.php';
        }

        public static function init(){
            $auth = new AuthController; 
            AuthController::authenticated() ? Main::home() : Main::login();
        }
    }
?>