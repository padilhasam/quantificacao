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

        // Validação básica
        if (empty($email) || empty($senha)) {
            $this->view('usuarios/login', [
                'erro' => 'Preencha todos os campos.'
            ]);
            return;
        }

        // Busca usuário
        $usuario = $usuarioModel->buscarPorEmail($email);

        // Verificação de existência
        if (!$usuario) {
            $this->view('usuarios/login', [
                'erro' => 'E-mail ou senha inválidos.'
            ]);
            return;
        }

        // Verifica se está ativo
        if ((int)$usuario['ativo'] !== 1) {
            $this->view('usuarios/login', [
                'erro' => 'Usuário bloqueado ou inativo.'
            ]);
            return;
        }

        // Verifica senha
        if (!password_verify($senha, $usuario['senha'])) {
            $this->view('usuarios/login', [
                'erro' => 'E-mail ou senha inválidos.'
            ]);
            return;
        }

        // Segurança: evita session fixation
        session_regenerate_id(true);

        // Atualiza último login
        $usuarioModel->atualizarUltimoAcesso($usuario['id']);

        // Sessão
        $_SESSION['usuario_id'] = $usuario['id'];
        $_SESSION['nome'] = $usuario['nome'];
        $_SESSION['email'] = $usuario['email'];
        $_SESSION['tipo'] = $usuario['tipo'];
        

        header("Location: " . BASE_URL . "/dashboard");
        exit;
    }

    public function logout()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $_SESSION = [];

        session_unset();
        session_destroy();

        // Remove cookie da sessão (importante)
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        header("Location: " . BASE_URL . "/login");
        exit;
    }
}