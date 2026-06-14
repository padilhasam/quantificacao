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

$requestPath = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// base do sistema (remove /public automaticamente)
$basePath = rtrim(dirname($_SERVER['SCRIPT_NAME']), '/');

$route = $requestPath;

// remove basePath se existir
if ($basePath !== '/' && str_starts_with($route, $basePath)) {
    $route = substr($route, strlen($basePath));
}

// normaliza
$route = '/' . trim($route, '/');

if ($route === '//') {
    $route = '/';
}

// Rotas definidas manualmente
$routes = [
    '/' => ['controller' => 'LoginController', 'method' => 'index'],
    '/login' => ['controller' => 'LoginController', 'method' => 'index'],
    '/login/autenticar' => ['controller' => 'LoginController', 'method' => 'autenticar'],
    '/logout' => ['controller' => 'LoginController', 'method' => 'logout'],
    '/dashboard' => ['controller' => 'DashboardController', 'method' => 'index'],

    // =========================
    // RISCOS
    // =========================
    '/riscos' => ['controller' => 'RiscosController', 'method' => 'index'],

    '/riscos/fisicos' => ['controller' => 'RiscosController', 'method' => 'fisicos'],
    '/riscos/quimicos' => ['controller' => 'RiscosController', 'method' => 'quimicos'],
    '/riscos/biologicos' => ['controller' => 'RiscosController', 'method' => 'biologicos'],
    '/riscos/ergonomicos' => ['controller' => 'RiscosController', 'method' => 'ergonomicos'],
    '/riscos/acidentes' => ['controller' => 'RiscosController', 'method' => 'acidentes'],
    '/riscos/psicossociais' => ['controller' => 'RiscosController', 'method' => 'psicossociais'],

    // =========================
    // EMPRESAS
    // =========================
    '/empresas'                 => ['controller' => 'EmpresasController', 'method' => 'index'],
    '/empresas/criar'            => ['controller' => 'EmpresasController', 'method' => 'criar'],
    '/empresas/armazenar'        => ['controller' => 'EmpresasController', 'method' => 'armazenar'],
    '/empresas/editar/{id}'      => ['controller' => 'EmpresasController', 'method' => 'editar'],
    '/empresas/atualizar/{id}'   => ['controller' => 'EmpresasController', 'method' => 'atualizar'],
    '/empresas/excluir/{id}'     => ['controller' => 'EmpresasController', 'method' => 'excluir'],

    // =========================
    // USUÁRIOS
    // =========================
    '/usuarios' => ['controller' => 'UsuariosController', 'method' => 'index'],
    '/usuarios/criar' => ['controller' => 'UsuariosController', 'method' => 'criar'],
    '/usuarios/salvar' => ['controller' => 'UsuariosController', 'method' => 'salvar'],
    '/usuarios/editar/{id}' => ['controller' => 'UsuariosController', 'method' => 'editar'],
    '/usuarios/atualizar/{id}' => ['controller' => 'UsuariosController', 'method' => 'atualizar'],
    '/usuarios/excluir/{id}' => ['controller' => 'UsuariosController', 'method' => 'excluir'],

    // =========================
    // TECNICOS
    // =========================
    '/tecnicos' => ['controller' => 'TecnicosController', 'method' => 'index'],
    '/tecnicos/criar' => ['controller' => 'TecnicosController', 'method' => 'criar'],
    '/tecnicos/salvar' => ['controller' => 'TecnicosController', 'method' => 'salvar'],
    '/tecnicos/editar/{id}' => ['controller' => 'TecnicosController', 'method' => 'editar'],
    '/tecnicos/atualizar/{id}' => ['controller' => 'TecnicosController', 'method' => 'atualizar'],
    '/tecnicos/excluir/{id}' => ['controller' => 'TecnicosController', 'method' => 'excluir'],
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
        $pattern = preg_replace('#\{[a-zA-Z0-9_]+\}#', '([a-zA-Z0-9_-]+)', $routePattern);
        $pattern = "#^" . $pattern . "$#";

        if (preg_match($pattern, $route, $matches)) {
            $controllerName = $action['controller'];
            $method = $action['method'];
            $params = array_slice($matches, 1);
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