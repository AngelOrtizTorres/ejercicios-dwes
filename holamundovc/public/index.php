<?php
/**
 * @author Angel Ortiz Torres
 * Fichero que recibe una ruta y muestra un hola mundo si es correcta
 */

require_once ("../vendor/autoload.php");
require_once ("../app/config/config.php");

use App\Core\Router;
use App\Controllers\IndexController;

// Creamos un único enrutador
$router = new Router();

// Ruta principal ("/")
$router->add(array(
    'name' => 'home',
    'path' => '/^\/$/',
    'action' => [IndexController::class, 'IndexAction']
));

// Ruta dinámica "/saludo/{nombre}"
$router->add(array(
    'name' => 'saludo',
    'path' => '/^\/saludo\/([a-zA-Z0-9_-]+)$/',
    'action' => [IndexController::class, 'SaludoAction']
));

// Obtenemos la ruta de la petición
$request = str_replace(DIRBASEURL, '', $_SERVER['REQUEST_URI']);

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
