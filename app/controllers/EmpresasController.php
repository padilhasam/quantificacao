<?php

class EmpresasController extends AuthController
{
    private $empresaModel;

    public function __construct()
    {
        parent::__construct();
        require_once __DIR__ . '/../models/Empresa.php';
        $this->empresaModel = new Empresa();
    }

    public function index()
    {
        $empresas = $this->empresaModel->listar();
        $this->view('empresas/index', ['empresas' => $empresas]);
    }

    public function criar()
    {
        $this->view('empresas/criar');
    }

    public function armazenar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/empresas');
            exit;
        }

        // Processamento dos dados
        $cidade = null;
        $estado = null;
        if (!empty($_POST['cidade_uf'])) {
            $partes = explode('/', $_POST['cidade_uf']);
            $cidade = trim($partes[0]);
            $estado = isset($partes[1]) ? trim($partes[1]) : null;
        }

        $dados = [
            'razao_social'        => trim($_POST['razao_social'] ?? ''),
            'nome_fantasia'       => !empty($_POST['nome_fantasia']) ? trim($_POST['nome_fantasia']) : null,
            'cnpj'                => !empty($_POST['cnpj']) ? trim($_POST['cnpj']) : null,
            'inscricao_estadual'  => !empty($_POST['inscricao_estadual']) ? trim($_POST['inscricao_estadual']) : null,
            'telefone'            => !empty($_POST['telefone']) ? trim($_POST['telefone']) : null,
            'email'               => !empty($_POST['email']) ? trim($_POST['email']) : null,
            'responsavel'         => !empty($_POST['responsavel']) ? trim($_POST['responsavel']) : null,
            'contato_responsavel' => !empty($_POST['contato_responsavel']) ? trim($_POST['contato_responsavel']) : null,
            'endereco'            => !empty($_POST['endereco']) ? trim($_POST['endereco']) : null,
            'cidade'              => $cidade,
            'estado'              => $estado,
            'cep'                 => !empty($_POST['cep']) ? trim($_POST['cep']) : null,
            'ativo'               => isset($_POST['ativo']) ? (int)$_POST['ativo'] : 1
        ];

        if (empty($dados['razao_social'])) {
            $_SESSION['erro'] = 'A Razão Social é obrigatória.';
            header('Location: ' . BASE_URL . '/empresas/criar');
            exit;
        }

        if ($this->empresaModel->salvar($dados)) {
            $_SESSION['sucesso'] = 'Empresa cadastrada com sucesso!';
        } else {
            $_SESSION['erro'] = 'Erro ao salvar empresa. Verifique os dados.';
        }

        header('Location: ' . BASE_URL . '/empresas');
        exit;
    }

    public function editar($id)
    {
        $empresa = $this->empresaModel->buscarPorId($id);

        if (!$empresa) {
            $_SESSION['erro'] = 'Empresa não encontrada.';
            header('Location: ' . BASE_URL . '/empresas');
            exit;
        }

        if (!empty($empresa['cidade']) && !empty($empresa['estado'])) {
            $empresa['cidade_uf'] = $empresa['cidade'] . ' / ' . $empresa['estado'];
        } else {
            $empresa['cidade_uf'] = $empresa['cidade'] ?? $empresa['estado'] ?? '';
        }

        $this->view('empresas/editar', ['empresa' => $empresa]);
    }

    public function atualizar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/empresas');
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
            'razao_social'        => trim($_POST['razao_social'] ?? ''),
            'nome_fantasia'       => !empty($_POST['nome_fantasia']) ? trim($_POST['nome_fantasia']) : null,
            'cnpj'                => !empty($_POST['cnpj']) ? trim($_POST['cnpj']) : null,
            'inscricao_estadual'  => !empty($_POST['inscricao_estadual']) ? trim($_POST['inscricao_estadual']) : null,
            'telefone'            => !empty($_POST['telefone']) ? trim($_POST['telefone']) : null,
            'email'               => !empty($_POST['email']) ? trim($_POST['email']) : null,
            'responsavel'         => !empty($_POST['responsavel']) ? trim($_POST['responsavel']) : null,
            'contato_responsavel' => !empty($_POST['contato_responsavel']) ? trim($_POST['contato_responsavel']) : null,
            'endereco'            => !empty($_POST['endereco']) ? trim($_POST['endereco']) : null,
            'cidade'              => $cidade,
            'estado'              => $estado,
            'cep'                 => !empty($_POST['cep']) ? trim($_POST['cep']) : null,
            'ativo'               => isset($_POST['ativo']) ? (int)$_POST['ativo'] : 0
        ];

        if ($this->empresaModel->atualizar($id, $dados)) {
            $_SESSION['sucesso'] = 'Empresa atualizada com sucesso!';
        } else {
            $_SESSION['erro'] = 'Erro ao atualizar empresa.';
        }

        header('Location: ' . BASE_URL . '/empresas');
        exit;
    }

    public function excluir($id)
    {
        if ($this->empresaModel->excluir($id)) {
            $_SESSION['sucesso'] = 'Empresa excluída com sucesso!';
        } else {
            $_SESSION['erro'] = 'Não foi possível excluir a empresa.';
        }
        
        header('Location: ' . BASE_URL . '/empresas');
        exit;
    }
}