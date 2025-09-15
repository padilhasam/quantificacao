<?php

class LoginController extends Controller {
    public function index() {
        $this->view('usuarios/login');
    }

    public function autenticar() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $usuarioModel = $this->model('Usuario');
        $email = trim($_POST['email'] ?? '');
        $senha = trim($_POST['senha'] ?? '');

        if (empty($email) || empty($senha)) {
            $this->view('usuarios/login', ['erro' => 'Preencha todos os campos.']);
            return;
        }

        $usuario = $usuarioModel->buscarPorEmail($email);

        if ($usuario && $usuario['ativo'] && password_verify($senha, $usuario['senha'])) {
            $_SESSION['usuario_id'] = $usuario['id'];
            $_SESSION['nome'] = $usuario['nome'];
            $_SESSION['tipo'] = $usuario['tipo'];

            header("Location: " . BASE_URL . "/dashboard");
            exit;
        } else {
            $this->view('usuarios/login', ['erro' => 'Login inválido ou usuário bloqueado.']);
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: " . BASE_URL . "/login");
        exit;
    }
}