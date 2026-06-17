<?php

class CargosController extends Controller {

    private $cargoModel;
    private $setorModel;

    public function __construct() {
        $this->cargoModel = $this->model('Cargo');
        $this->setorModel = $this->model('Setor');
    }

    public function index() {
        $cargos = $this->cargoModel->listarTudo();
        $this->view('cargos/index', ['cargos' => $cargos]);
    }

    public function criar() {
        $setores = $this->setorModel->listarTudo(); // Alimenta o select dinâmico de setores
        $this->view('cargos/criar', ['setores' => $setores]);
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'setor_id'  => $_POST['setor_id'],
                'nome'      => $_POST['nome'],
                'cbo'       => $_POST['cbo'] ?? null,
                'descricao' => $_POST['descricao'] ?? null
            ];

            if ($this->cargoModel->salvar($dados)) {
                header('Location: ' . BASE_URL . '/cargos');
                exit;
            }
        }
    }

    public function editar($id) {
        $cargo = $this->cargoModel->buscarPorId($id);
        $setores = $this->setorModel->listarTudo();

        if (!$cargo) {
            header('Location: ' . BASE_URL . '/cargos');
            exit;
        }

        $this->view('cargos/editar', [
            'cargo' => $cargo,
            'setores' => $setores
        ]);
    }

    public function atualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'setor_id'  => $_POST['setor_id'],
                'nome'      => $_POST['nome'],
                'cbo'       => $_POST['cbo'] ?? null,
                'descricao' => $_POST['descricao'] ?? null
            ];

            if ($this->cargoModel->atualizar($id, $dados)) {
                header('Location: ' . BASE_URL . '/cargos');
                exit;
            }
        }
    }

    public function excluir($id) {
        $this->cargoModel->deletar($id);
        header('Location: ' . BASE_URL . '/cargos');
        exit;
    }
}