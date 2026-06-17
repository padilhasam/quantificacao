<?php

class UnidadesController extends Controller {

    private $unidadeModel;
    private $empresaModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $this->unidadeModel = $this->model('Unidade');
        $this->empresaModel = $this->model('Empresa');
    }

    public function index() {
        $unidades = $this->unidadeModel->listarTudo();
        $this->view('unidades/index', ['unidades' => $unidades]);
    }

    public function criar() {
        $empresas = $this->empresaModel->listar(); 
        $this->view('unidades/criar', ['empresas' => $empresas]);
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/unidades');
            exit;
        }

        $cidade = null;
        $estado = null;
        if (!empty($_POST['cidade_uf'])) {
            $partes = explode('/', $_POST['cidade_uf']);
            $cidade = trim($partes[0]);
            $estado = isset($partes[1]) ? trim($partes[1]) : null;
        }

        $dados = [
            'empresa_id' => (int)$_POST['empresa_id'],
            'nome'       => trim($_POST['nome'] ?? ''),
            'cnpj'       => !empty($_POST['cnpj']) ? trim($_POST['cnpj']) : null,
            'endereco'   => !empty($_POST['endereco']) ? trim($_POST['endereco']) : null,
            'cidade'     => $cidade,
            'estado'     => $estado,
            'telefone'   => !empty($_POST['telefone']) ? trim($_POST['telefone']) : null,
            'ativo'      => isset($_POST['ativo']) ? (int)$_POST['ativo'] : 1
        ];

        if (empty($dados['nome']) || empty($dados['empresa_id'])) {
            $_SESSION['erro'] = 'Nome da unidade e empresa são obrigatórios.';
            header('Location: ' . BASE_URL . '/unidades/criar');
            exit;
        }

        if ($this->unidadeModel->salvar($dados)) {
            $_SESSION['sucesso'] = 'Unidade cadastrada com sucesso!';
        } else {
            $_SESSION['erro'] = 'Erro ao cadastrar unidade.';
        }

        header('Location: ' . BASE_URL . '/unidades');
        exit;
    }

    public function editar($id) {
        $unidade = $this->unidadeModel->buscarPorId((int)$id);
        $empresas = $this->empresaModel->listar();

        if (!$unidade) {
            $_SESSION['erro'] = 'Unidade não encontrada.';
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
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/unidades');
            exit;
        }

        $cidade = null;
        $estado = null;
        if (!empty($_POST['cidade_uf'])) {
            $partes = explode('/', $_POST['cidade_uf']);
            $cidade = trim($partes[0]);
            $estado = isset($partes[1]) ? trim($partes[1]) : null;
        }

        $dados = [
            'empresa_id' => (int)$_POST['empresa_id'],
            'nome'       => trim($_POST['nome'] ?? ''),
            'cnpj'       => !empty($_POST['cnpj']) ? trim($_POST['cnpj']) : null,
            'endereco'   => !empty($_POST['endereco']) ? trim($_POST['endereco']) : null,
            'cidade'     => $cidade,
            'estado'     => $estado,
            'telefone'   => !empty($_POST['telefone']) ? trim($_POST['telefone']) : null,
            'ativo'      => isset($_POST['ativo']) ? (int)$_POST['ativo'] : 1
        ];

        if (empty($dados['nome']) || empty($dados['empresa_id'])) {
            $_SESSION['erro'] = 'Preencha os campos obrigatórios.';
            header('Location: ' . BASE_URL . '/unidades/editar/' . $id);
            exit;
        }

        if ($this->unidadeModel->atualizar((int)$id, $dados)) {
            $_SESSION['sucesso'] = 'Unidade atualizada com sucesso!';
        } else {
            $_SESSION['erro'] = 'Erro ao atualizar unidade.';
        }

        header('Location: ' . BASE_URL . '/unidades');
        exit;
    }

    public function excluir($id) {
        $unidade = $this->unidadeModel->buscarPorId((int)$id);

        if (!$unidade) {
            $_SESSION['erro'] = 'Unidade não encontrada.';
        } elseif ($this->unidadeModel->deletar((int)$id)) {
            $_SESSION['sucesso'] = 'Unidade excluída com sucesso!';
        } else {
            $_SESSION['erro'] = 'Erro ao excluir. Verifique os vínculos.';
        }
        
        header('Location: ' . BASE_URL . '/unidades');
        exit;
    }
}