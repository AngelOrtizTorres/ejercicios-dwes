<?php
/**
 * @author Angel Ortiz Torres
 * Fichero que recibe una ruta y muestra un hola mundo si es correcta
 */

require_once ("../vendor/autoload.php");

use App\Core\Router;
use App\Controllers\NumeroController;

// Creamos el enrutador
$router = new Router();

// Ruta para mostrar los 10 primeros números pares
$router->add([
    'name' => 'numeros',
    'path' => '/^\/pares\/?$/',
    'action' => [NumeroController::class, 'ParAction']
]);

$router->add([
    'name' => 'numeros',
    'path' => '/^\/impares\/?$/',
    'action' => [NumeroController::class, 'ImparAction']
]);

$router->add(array(
    'name' => 'pares_param',
    'path' => '/^\/pares\/([0-9]+)$/',
    'action' => [NumeroController::class, 'NumParAction']
));

$router->add(array(
    'name' => 'impares_param',
    'path' => '/^\/impares\/([0-9]+)$/',
    'action' => [NumeroController::class, 'NumImparAction']
));


// Obtenemos la ruta de la petición
$request = $_SERVER['REQUEST_URI'];

// Buscamos coincidencia
$route = $router->match($request);

if ($route) {
    $controllerName = $route['action'][0];
    $actionName = $route['action'][1];
    $controller = new $controllerName;

    $controller->$actionName($request);
} else {
    echo "No route";
}