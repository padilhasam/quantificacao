<?php

class EmpresasController extends AuthController
{
    private $empresaModel;

    public function __construct()
    {
        parent::__construct();

        // Corrigido para usar a model Empresa corretamente
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = [
                'nome' => trim($_POST['nome']),
                'cnpj' => trim($_POST['cnpj']),
                'cnae' => trim($_POST['cnae']),
                'responsavel' => trim($_POST['responsavel']),
                'contato_responsavel' => trim($_POST['contato_responsavel']),
                'endereco' => trim($_POST['endereco']),
            ];

            $salvo = $this->empresaModel->salvar($dados);

            if ($salvo) {
                header('Location: ' . BASE_URL . '/empresas');
                exit;
            } else {
                echo "Erro ao salvar empresa.";
            }
        }
    }

    public function editar($id)
    {
        $empresa = $this->empresaModel->buscarPorId($id);
        if (!$empresa) {
            header('Location: ' . BASE_URL . '/empresas');
            exit;
        }

        $this->view('empresas/editar', ['empresa' => $empresa]);
    }

    public function atualizar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $dados = [
                'nome' => trim($_POST['nome']),
                'cnpj' => trim($_POST['cnpj']),
                'cnae' => trim($_POST['cnae']),
                'responsavel' => trim($_POST['responsavel']),
                'contato_responsavel' => trim($_POST['contato_responsavel']),
                'endereco' => trim($_POST['endereco']),
            ];

            $atualizado = $this->empresaModel->atualizar($id, $dados);

            if ($atualizado) {
                header('Location: ' . BASE_URL . '/empresas');
                exit;
            } else {
                echo "Erro ao atualizar empresa.";
            }
        }
    }

    public function excluir($id)
    {
        $this->empresaModel->excluir($id);
        header('Location: ' . BASE_URL . '/empresas');
        exit;
    }
}
