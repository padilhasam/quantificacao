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
        require_once "../app/views/{$view}.php";
    }
}