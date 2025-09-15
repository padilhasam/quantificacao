<?php

class DashboardController extends AuthController {
    public function index() {
        $this->view('dashboard/index', [
            'usuario' => $_SESSION['nome'] ?? 'Usuário'
        ]);
    }
}