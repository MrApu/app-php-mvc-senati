<?php
//include "./config/Database.php";
//$db = new Database();
//$valida = $db->connect();
//
//if($valida){
//    echo "Conexion establecida correctamente";
//}else{
//    echo "Conexión no establecida";
//}
//




//Manejo de errores
error_reporting(E_ALL);
ini_set('display_errors', 1);

//carar el archvio confuguracion

require_once 'config/config.php';

//Autoload de clases

spl_autoload_register(function ($class_name) {
    $directories = [
        'controllers/',
        'models/',
        'config/',
        'utils/',
        ''
    ];
    
    foreach ($directories as $directory) {
        $file = $directory . $class_name . '.php';
        if (file_exists($file)) {
            // var_dump($file);
            require_once $file;
            return;
        }
    }
});



//Crear una instancia del router
$router = new Router();

$public_routes = [
    '/web',
    '/login',
    '/Register',
];

//Obtener la ruta actual 
$current_route = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$current_route = str_replace(dirname($_SERVER['SCRIPT_NAME']),'',$current_route);
//echo $current_route;
//var_dump($current_route);
//var_dump((dirname($_SERVER['SCRIPT_NAME']);

$router->add('GET','/web','WebController','index');

//login y Register

$router->add('GET','/login','AuthController','showLogin');
$router->add('GET','/register','AuthController','showRegister');


$router->add('POST','/auth/login','AuthController','login');
$router->add('POST','/auth/register','AuthController','register');

//HomeController

$router->add('GET','Home', 'HomeController','index');



//Home

$router->add('GET','productos/', 'ProductoController','index');
$router->add('GET','productos/obtener-todo', 'ProductoController','obtenerProducto');




//Despachar la ruta
try {
    //var_dump($current_route);
    
    $router->dispatch($current_route, $_SERVER['REQUEST_METHOD']);
} catch (Exception $e) {
    // Manejar el error
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        include 'views/errors/404.php';
    } else {
        header('Content-Type: application/json');
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
}   


