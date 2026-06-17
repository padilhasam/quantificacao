<?php

class UnidadesController extends Controller {

    private $unidadeModel;
    private $empresaModel;

    public function __construct() {
        $this->unidadeModel = $this->model('Unidade');
        $this->empresaModel = $this->model('Empresa');
    }

    public function index() {
        $unidades = $this->unidadeModel->listarTudo();
        $this->view('unidades/index', ['unidades' => $unidades]);
    }

    public function criar() {
        $empresas = $this->empresaModel->listarTudo(); // Para preencher o select de empresas
        $this->view('unidades/criar', ['empresas' => $empresas]);
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'empresa_id' => $_POST['empresa_id'],
                'nome'       => $_POST['nome'],
                'cnpj'       => $_POST['cnpj'] ?? null,
                'endereco'   => $_POST['endereco'] ?? null,
                'cidade'     => $_POST['cidade'] ?? null, // Mapeado do banco
                'estado'     => $_POST['estado'] ?? null, // Mapeado do banco (ex: PR)
                'telefone'   => $_POST['telefone'] ?? null,
                'ativo'      => isset($_POST['ativo']) ? $_POST['ativo'] : 1
            ];

            if ($this->unidadeModel->salvar($dados)) {
                header('Location: ' . BASE_URL . '/unidades');
                exit;
            }
        }
    }

    public function editar($id) {
        $unidade = $this->unidadeModel->buscarPorId($id);
        $empresas = $this->empresaModel->listarTudo();

        if (!$unidade) {
            header('Location: ' . BASE_URL . '/unidades');
            exit;
        }

        $this->view('unidades/editar', [
            'unidade' => $unidade,
            'empresas' => $empresas
        ]);
    }

    public function atualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dados = [
                'empresa_id' => $_POST['empresa_id'],
                'nome'       => $_POST['nome'],
                'cnpj'       => $_POST['cnpj'] ?? null,
                'endereco'   => $_POST['endereco'] ?? null,
                'cidade'     => $_POST['cidade'] ?? null,
                'estado'     => $_POST['estado'] ?? null,
                'telefone'   => $_POST['telefone'] ?? null,
                'ativo'      => isset($_POST['ativo']) ? $_POST['ativo'] : 1
            ];

            if ($this->unidadeModel->atualizar($id, $dados)) {
                header('Location: ' . BASE_URL . '/unidades');
                exit;
            }
        }
    }

    public function excluir($id) {
        $this->unidadeModel->deletar($id);
        header('Location: ' . BASE_URL . '/unidades');
        exit;
    }
}