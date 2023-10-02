<?php
    #define('URL_ROUTE', 'http://localhost/portal-upro');
    define('URL_ROUTE', 'http://portal.uprosanluis.edu.ar/');
    spl_autoload_register(function($className){require_once 'backend/' . $className . '.php';}); 
    
    require_once 'frontend/Main.php';
?>