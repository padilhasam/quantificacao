<?php

class SetoresController extends Controller {

    private $setorModel;
    private $unidadeModel;

    public function __construct() {
        $this->setorModel = $this->model('Setor');
        $this->unidadeModel = $this->model('Unidade');
    }

    public function index() {
        $setores = $this->setorModel->listarTudo();
        $this->view('setores/index', ['setores' => $setores]);
    }

    public function criar() {
        $unidades = $this->unidadeModel->listarTudo(); // Carrega as unidades disponíveis para o vínculo
        $this->view('setores/criar', ['unidades' => $unidades]);
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'unidade_id' => $_POST['unidade_id'],
                'nome'       => $_POST['nome'],
                'descricao'  => $_POST['descricao'] ?? null
            ];

            if ($this->setorModel->salvar($dados)) {
                header('Location: ' . BASE_URL . '/setores');
                exit;
            }
        }
    }

    public function editar($id) {
        $setor = $this->setorModel->buscarPorId($id);
        $unidades = $this->unidadeModel->listarTudo();

        if (!$setor) {
            header('Location: ' . BASE_URL . '/setores');
            exit;
        }

        $this->view('setores/editar', [
            'setor' => $setor,
            'unidades' => $unidades
        ]);
    }

    public function atualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'unidade_id' => $_POST['unidade_id'],
                'nome'       => $_POST['nome'],
                'descricao'  => $_POST['descricao'] ?? null
            ];

            if ($this->setorModel->atualizar($id, $dados)) {
                header('Location: ' . BASE_URL . '/setores');
                exit;
            }
        }
    }

    public function excluir($id) {
        $this->setorModel->deletar($id);
        header('Location: ' . BASE_URL . '/setores');
        exit;
    }
}