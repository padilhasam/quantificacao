<?php

class Controller {
    public function model($model) {
        $modelFile = "../app/models/{$model}.php";
        if (file_exists($modelFile)) {
            require_once $modelFile;
            return new $model();
        }
        throw new Exception("Model $model não encontrado.");
    }

    public function view($view, $data = []) {
        extract($data);
        $viewPath = __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . $view . '.php';

        if (file_exists($viewPath)) {
            require_once $viewPath;
        } else {
            die("View '{$view}' não encontrada em {$viewPath}");
        }
    }

}