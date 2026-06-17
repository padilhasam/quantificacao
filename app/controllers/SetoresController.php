<?php

class SetoresController extends Controller {

    private $setorModel;
    private $unidadeModel;

    public function __construct() {
        // Garantindo inicialização da sessão e proteção
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $this->setorModel = $this->model('Setor');
        $this->unidadeModel = $this->model('Unidade');
    }

    public function index() {
        $setores = $this->setorModel->listarTudo();
        $this->view('setores/index', ['setores' => $setores]);
    }

    public function criar() {
        $unidades = $this->unidadeModel->listarTudo();
        $this->view('setores/criar', ['unidades' => $unidades]);
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/setores');
            exit;
        }

        $dados = [
            'unidade_id' => (int)$_POST['unidade_id'],
            'nome'       => trim($_POST['nome'] ?? ''),
            'descricao'  => !empty($_POST['descricao']) ? trim($_POST['descricao']) : null
        ];

        if (empty($dados['nome']) || empty($dados['unidade_id'])) {
            $_SESSION['erro'] = 'Nome do setor e unidade são obrigatórios.';
            header('Location: ' . BASE_URL . '/setores/criar');
            exit;
        }

        if ($this->setorModel->salvar($dados)) {
            $_SESSION['sucesso'] = 'Setor cadastrado com sucesso!';
        } else {
            $_SESSION['erro'] = 'Erro ao cadastrar setor.';
        }

        header('Location: ' . BASE_URL . '/setores');
        exit;
    }

    public function editar($id) {
        $setor = $this->setorModel->buscarPorId((int)$id);
        $unidades = $this->unidadeModel->listarTudo();

        if (!$setor) {
            $_SESSION['erro'] = 'Setor não encontrado.';
            header('Location: ' . BASE_URL . '/setores');
            exit;
        }

        $this->view('setores/editar', [
            'setor'    => $setor,
            'unidades' => $unidades
        ]);
    }

    public function atualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/setores');
            exit;
        }

        $dados = [
            'unidade_id' => (int)$_POST['unidade_id'],
            'nome'       => trim($_POST['nome'] ?? ''),
            'descricao'  => !empty($_POST['descricao']) ? trim($_POST['descricao']) : null
        ];

        if (empty($dados['nome']) || empty($dados['unidade_id'])) {
            $_SESSION['erro'] = 'Preencha os campos obrigatórios.';
            header('Location: ' . BASE_URL . '/setores/editar/' . $id);
            exit;
        }

        if ($this->setorModel->atualizar((int)$id, $dados)) {
            $_SESSION['sucesso'] = 'Setor atualizado com sucesso!';
        } else {
            $_SESSION['erro'] = 'Erro ao atualizar setor.';
        }

        header('Location: ' . BASE_URL . '/setores');
        exit;
    }

    public function excluir($id) {
        $setor = $this->setorModel->buscarPorId((int)$id);

        if (!$setor) {
            $_SESSION['erro'] = 'Setor não encontrado.';
        } elseif ($this->setorModel->deletar((int)$id)) {
            $_SESSION['sucesso'] = 'Setor excluído com sucesso!';
        } else {
            $_SESSION['erro'] = 'Erro ao excluir. O setor pode possuir vínculos ativos.';
        }

        header('Location: ' . BASE_URL . '/setores');
        exit;
    }
}