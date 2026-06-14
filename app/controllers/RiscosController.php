<?php

class RiscosController extends AuthController {

    public function index() {
        $tipoModel = $this->model('TipoRisco');
        $tipos = $tipoModel->listarTodos();

        $this->view('riscos/index', ['tipos' => $tipos]);
    }

    public function fisicos() {
        $model = $this->model('Risco');
        $this->view('riscos/fisicos/index', [
            'riscos' => $model->listarPorCategoria(1)
        ]);
    }

    public function quimicos() {
        $model = $this->model('Risco');
        $this->view('riscos/quimicos/index', [
            'riscos' => $model->listarPorCategoria(2)
        ]);
    }

    public function biologicos() {
        $model = $this->model('Risco');
        $this->view('riscos/biologicos/index', [
            'riscos' => $model->listarPorCategoria(3)
        ]);
    }

    public function ergonomicos() {
        $model = $this->model('Risco');
        $this->view('riscos/ergonomicos/index', [
            'riscos' => $model->listarPorCategoria(4)
        ]);
    }

    public function acidentes() {
        $model = $this->model('Risco');
        $this->view('riscos/acidentes/index', [
            'riscos' => $model->listarPorCategoria(5)
        ]);
    }

    public function psicossociais() {
        $model = $this->model('Risco');
        $this->view('riscos/psicossociais/index', [
            'riscos' => $model->listarPorCategoria(6)
        ]);
    }
}
