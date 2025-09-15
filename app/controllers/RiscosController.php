<?php

class RiscosController extends AuthController {
    public function index() {
        $this->view('riscos/index');
    }

    public function fisicos() {
        $this->view('riscos/fisicos');
    }

    public function quimicos() {
        $this->view('riscos/quimicos');
    }

    public function biologicos() {
        $this->view('riscos/biologicos');
    }

    public function ergonomicos() {
        $this->view('riscos/ergonomicos');
    }

    public function acidente() {
        $this->view('riscos/acidente');
    }
}
