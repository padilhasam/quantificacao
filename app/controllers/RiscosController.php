<?php

class RiscosController extends AuthController {
    public function index() {
        $tipoAgenteModel = $this->model('TipoRisco');
        $tipos = $tipoAgenteModel->listarTodos();

        $this->view('riscos/index', ['tipos' => $tipos]);
    }


    public function fisicos() {

        $riscosModel = $this->model('Risco');
        $riscos = $riscosModel->listarPorCategoria('fisico');

        $this->view('riscos/fisicos/index', ['riscos' => $riscos]);
    }

    public function quimicos() {
        $this->view('riscos/quimicos/index');
    }

    public function biologicos() {
        $this->view('riscos/biologicos/index');
    }

    public function ergonomicos() {
        $this->view('riscos/ergonomicos/index');
    }

    public function acidente() {
        $this->view('riscos/acidente/index');
    }
    
}
