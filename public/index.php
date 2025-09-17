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

    // Rotas de riscos
    '/riscos' => ['controller' => 'RiscosController', 'method' => 'index'],
    '/riscos/fisicos' => ['controller' => 'RiscosController', 'method' => 'fisicos'],
    '/riscos/quimicos' => ['controller' => 'RiscosController', 'method' => 'quimicos'],
    '/riscos/biologicos' => ['controller' => 'RiscosController', 'method' => 'biologicos'],
    '/riscos/ergonomicos' => ['controller' => 'RiscosController', 'method' => 'ergonomicos'],
    '/riscos/acidente' => ['controller' => 'RiscosController', 'method' => 'acidente'],

    // Rotas para Empresas
    '/empresas'                 => ['controller' => 'EmpresasController', 'method' => 'index'],
    '/empresas/criar'            => ['controller' => 'EmpresasController', 'method' => 'criar'],
    '/empresas/armazenar'        => ['controller' => 'EmpresasController', 'method' => 'armazenar'],
    '/empresas/editar/{id}'      => ['controller' => 'EmpresasController', 'method' => 'editar'],
    '/empresas/atualizar/{id}'   => ['controller' => 'EmpresasController', 'method' => 'atualizar'],
    '/empresas/excluir/{id}'     => ['controller' => 'EmpresasController', 'method' => 'excluir'],
];

// Verifica rota exata
if (array_key_exists($route, $routes)) {
    $controllerName = $routes[$route]['controller'];
    $method = $routes[$route]['method'];
    $params = [];
} else {
    // Se não achou, tenta bater com rotas dinâmicas
    $found = false;
    foreach ($routes as $routePattern => $action) {
        // Transforma {qualquerCoisa} em regex que aceita número ou texto
        $pattern = preg_replace('#\{[a-zA-Z0-9_]+\}#', '([a-zA-Z0-9_-]+)', $routePattern);
        $pattern = "#^" . $pattern . "$#";

        if (preg_match($pattern, $route, $matches)) {
            $controllerName = $action['controller'];
            $method = $action['method'];
            $params = array_slice($matches, 1); // captura parâmetros
            $found = true;
            break;
        }
    }

    if (!$found) {
        http_response_code(404);
        echo "Rota $route não encontrada.";
        exit;
    }
}

// Verifica controller
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

// Executa passando os parâmetros (se houver)
$controller->$method(...$params);