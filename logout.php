<?php
    define('URL_ROUTE', 'http://localhost/vigilancia2');
    #define('URL_ROUTE', 'http://192.168.1.153/vigilancia2');
    #define('URL_ROUTE', 'http://172.0.4.19/vigilancia2');

    spl_autoload_register(function($className){require_once 'backend/' . $className . '.php';}); 

    $auth = new AuthController;  
    $auth->logout();
?>