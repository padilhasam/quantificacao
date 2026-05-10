<?php

class UsuariosController extends Controller
{
    private $usuarioModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Verifica login
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $this->usuarioModel = $this->model('Usuario');
    }

    /**
     * LISTAGEM
     */
    public function index()
    {
        $usuarios = $this->usuarioModel->listarTodos();

        $dados = [
            'titulo' => 'Usuários',
            'usuarios' => $usuarios,
            'css' => 'usuarios.css'
        ];

        $this->view('usuarios/index', $dados);
    }

    /**
     * FORMULÁRIO DE CRIAÇÃO
     */
    public function criar()
    {
                $this->view('usuarios/criar');
    }

    /**
     * SALVAR NOVO USUÁRIO
     */
    public function salvar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/usuarios');
            exit;
        }

        $nome  = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $senha = trim($_POST['senha'] ?? '');
        $tipo  = trim($_POST['tipo'] ?? 'USUARIO');
        $ativo = isset($_POST['ativo']) ? 1 : 0;

        // Validação
        if (empty($nome) || empty($email) || empty($senha)) {

            $_SESSION['erro'] = 'Preencha todos os campos obrigatórios.';

            header('Location: ' . BASE_URL . '/usuarios/criar');
            exit;
        }

        // Verifica e-mail
        if ($this->usuarioModel->buscarPorEmail($email)) {

            $_SESSION['erro'] = 'Já existe um usuário com este e-mail.';

            header('Location: ' . BASE_URL . '/usuarios/criar');
            exit;
        }

        $dados = [
            'nome'  => $nome,
            'email' => $email,
            'senha' => password_hash($senha, PASSWORD_DEFAULT),
            'tipo'  => $tipo,
            'ativo' => $ativo
        ];

        $salvou = $this->usuarioModel->criar($dados);

        if ($salvou) {

            $_SESSION['sucesso'] = 'Usuário cadastrado com sucesso.';

        } else {

            $_SESSION['erro'] = 'Erro ao cadastrar usuário.';
        }

        header('Location: ' . BASE_URL . '/usuarios');
        exit;
    }

    /**
     * FORMULÁRIO DE EDIÇÃO
     */
    public function editar($id)
    {
        $usuario = $this->usuarioModel->buscarPorId($id);

        if (!$usuario) {

            $_SESSION['erro'] = 'Usuário não encontrado.';

            header('Location: ' . BASE_URL . '/usuarios');
            exit;
        }

        $dados = [
            'titulo' => 'Editar Usuário',
            'usuario' => $usuario,
            'css' => 'usuarios.css'
        ];

        $this->view('usuarios/editar', $dados);
    }

    /**
     * ATUALIZAR
     */
    public function atualizar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/usuarios');
            exit;
        }

        $usuarioAtual = $this->usuarioModel->buscarPorId($id);

        if (!$usuarioAtual) {

            $_SESSION['erro'] = 'Usuário não encontrado.';

            header('Location: ' . BASE_URL . '/usuarios');
            exit;
        }

        $nome  = trim($_POST['nome'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $tipo  = trim($_POST['tipo'] ?? 'USUARIO');
        $ativo = isset($_POST['ativo']) ? 1 : 0;

        $dados = [
            'nome'  => $nome,
            'email' => $email,
            'tipo'  => $tipo,
            'ativo' => $ativo
        ];

        // Atualizar senha somente se preenchida
        if (!empty($_POST['senha'])) {
            $dados['senha'] = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        }

        $atualizou = $this->usuarioModel->atualizar($id, $dados);

        if ($atualizou) {

            $_SESSION['sucesso'] = 'Usuário atualizado com sucesso.';

        } else {

            $_SESSION['erro'] = 'Erro ao atualizar usuário.';
        }

        header('Location: ' . BASE_URL . '/usuarios');
        exit;
    }

    /**
     * EXCLUIR
     */
    public function excluir($id)
    {
        $usuario = $this->usuarioModel->buscarPorId($id);

        if (!$usuario) {

            $_SESSION['erro'] = 'Usuário não encontrado.';

            header('Location: ' . BASE_URL . '/usuarios');
            exit;
        }

        // Impede excluir a si mesmo
        if ($usuario['id'] == $_SESSION['usuario_id']) {

            $_SESSION['erro'] = 'Você não pode excluir seu próprio usuário.';

            header('Location: ' . BASE_URL . '/usuarios');
            exit;
        }

        $excluiu = $this->usuarioModel->excluir($id);

        if ($excluiu) {

            $_SESSION['sucesso'] = 'Usuário excluído com sucesso.';

        } else {

            $_SESSION['erro'] = 'Erro ao excluir usuário.';
        }

        header('Location: ' . BASE_URL . '/usuarios');
        exit;
    }
}