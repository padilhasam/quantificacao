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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Quebra com precisão o campo "Cidade / UF" vindo unificado da View
            $cidade = null;
            $estado = null;
            if (!empty($_POST['cidade_uf'])) {
                $partes = explode('/', $_POST['cidade_uf']);
                $cidade = trim($partes[0]);
                $estado = isset($partes[1]) ? trim($partes[1]) : null;
            }

            $dados = [
                'razao_social'        => trim($_POST['razao_social']),
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

            if ($this->empresaModel->salvar($dados)) {
                header('Location: ' . BASE_URL . '/empresas');
                exit;
            }
            echo "Erro ao salvar empresa.";
        }
    }

    public function editar($id)
    {
        $empresa = $this->empresaModel->buscarPorId($id);

        if (!$empresa) {
            header('Location: ' . BASE_URL . '/empresas');
            exit;
        }

        // Reconstrói Cidade / UF para popular o input text correspondente
        if (!empty($empresa['cidade']) && !empty($empresa['estado'])) {
            $empresa['cidade_uf'] = $empresa['cidade'] . ' / ' . $empresa['estado'];
        } else {
            $empresa['cidade_uf'] = $empresa['cidade'] ?? $empresa['estado'] ?? '';
        }

        $this->view('empresas/editar', ['empresa' => $empresa]);
    }

    public function atualizar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $cidade = null;
            $estado = null;
            if (!empty($_POST['cidade_uf'])) {
                $partes = explode('/', $_POST['cidade_uf']);
                $cidade = trim($partes[0]);
                $estado = isset($partes[1]) ? trim($partes[1]) : null;
            }

            $dados = [
                'razao_social'        => trim($_POST['razao_social']),
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
                header('Location: ' . BASE_URL . '/empresas');
                exit;
            }
            echo "Erro ao atualizar empresa.";
        }
    }

    public function excluir($id)
    {
        $this->empresaModel->excluir($id);
        header('Location: ' . BASE_URL . '/empresas');
        exit;
    }
}