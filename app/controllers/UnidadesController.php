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
        // Agora o método será chamado corretamente a partir do Model Empresa
        $empresas = $this->empresaModel->listar(); 
        $this->view('unidades/criar', ['empresas' => $empresas]);
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $cidade = null;
            $estado = null;
            if (!empty($_POST['cidade_uf'])) {
                $partes = explode('/', $_POST['cidade_uf']);
                $cidade = trim($partes[0]);
                $estado = isset($partes[1]) ? trim($partes[1]) : null;
            }

            $dados = [
                'empresa_id' => $_POST['empresa_id'],
                'nome'       => $_POST['nome'],
                'cnpj'       => $_POST['cnpj'] ?? null,
                'endereco'   => $_POST['endereco'] ?? null,
                'cidade'     => $cidade,
                'estado'     => $estado,
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

        if (!empty($unidade['cidade']) && !empty($unidade['estado'])) {
            $unidade['cidade_uf'] = $unidade['cidade'] . ' / ' . $unidade['estado'];
        } else {
            $unidade['cidade_uf'] = $unidade['cidade'] ?? $unidade['estado'] ?? '';
        }

        $this->view('unidades/editar', [
            'unidade' => $unidade,
            'empresas' => $empresas
        ]);
    }

    public function atualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
            $cidade = null;
            $estado = null;
            if (!empty($_POST['cidade_uf'])) {
                $partes = explode('/', $_POST['cidade_uf']);
                $cidade = trim($partes[0]);
                $estado = isset($partes[1]) ? trim($partes[1]) : null;
            }

            $dados = [
                'empresa_id' => $_POST['empresa_id'],
                'nome'       => $_POST['nome'],
                'cnpj'       => $_POST['cnpj'] ?? null,
                'endereco'   => $_POST['endereco'] ?? null,
                'cidade'     => $cidade,
                'estado'     => $estado,
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