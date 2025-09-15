<?php
require_once '../config/config.php';

session_start();

// Autoload
spl_autoload_register(function($class) {
    $paths = ['../core/', '../app/controllers/', '../app/models/'];
    foreach ($paths as $path) {
        $file = $path . $class . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});

// Pega URI atual sem query string
$requestUri = $_SERVER['REQUEST_URI'];
$requestPath = parse_url($requestUri, PHP_URL_PATH);

// Remove o BASE_URL da URI para trabalhar só com a rota
$route = substr($requestPath, strlen(BASE_URL));
$route = $route ?: '/';

// Rotas definidas manualmente
$routes = [
    '/' => ['controller' => 'LoginController', 'method' => 'index'],
    '/login' => ['controller' => 'LoginController', 'method' => 'index'],
    '/login/autenticar' => ['controller' => 'LoginController', 'method' => 'autenticar'],
    '/login/logout' => ['controller' => 'LoginController', 'method' => 'logout'],
    '/dashboard' => ['controller' => 'DashboardController', 'method' => 'index'],
];

// Verifica rota
if (!array_key_exists($route, $routes)) {
    http_response_code(404);
    echo "Rota $route não encontrada.";
    exit;
}

$controllerName = $routes[$route]['controller'];
$method = $routes[$route]['method'];

$controllerFile = "../app/controllers/$controllerName.php";
if (!file_exists($controllerFile)) {
    http_response_code(404);
    die("Controller $controllerName não encontrado.");
}

require_once $controllerFile;

if (!class_exists($controllerName)) {
    http_response_code(500);
    die("Classe $controllerName não definida.");
}

$controller = new $controllerName();

if (!method_exists($controller, $method)) {
    http_response_code(404);
    die("Método $method não encontrado no controller $controllerName.");
}

$controller->$method();