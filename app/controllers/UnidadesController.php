<?php

class UnidadesController extends Controller
{
    private $unidadeModel;

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }

        $this->unidadeModel = $this->model('Unidade');
    }

    public function index()
    {
        $unidades = $this->unidadeModel->listarTudo();

        $this->view('unidades/index', [
            'unidades' => $unidades
        ]);
    }

    public function criar()
    {
        $this->view('unidades/criar');
    }

    public function salvar()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/unidades');
            exit;
        }

        $cidade = null;
        $estado = null;

        if (!empty($_POST['cidade_uf'])) {

            $partes = explode('/', $_POST['cidade_uf']);

            $cidade = trim($partes[0]);
            $estado = isset($partes[1])
                ? trim($partes[1])
                : null;
        }

        $dados = [

            'codigo' => !empty($_POST['codigo'])
                ? trim($_POST['codigo'])
                : null,

            'codigo_externo' => !empty($_POST['codigo_externo'])
                ? trim($_POST['codigo_externo'])
                : null,

            'nome' => trim($_POST['nome'] ?? ''),

            'cnpj' => !empty($_POST['cnpj'])
                ? trim($_POST['cnpj'])
                : null,

            'endereco' => !empty($_POST['endereco'])
                ? trim($_POST['endereco'])
                : null,

            'numero' => !empty($_POST['numero'])
                ? trim($_POST['numero'])
                : null,

            'bairro' => !empty($_POST['bairro'])
                ? trim($_POST['bairro'])
                : null,

            'cidade' => $cidade,

            'estado' => $estado,

            'cep' => !empty($_POST['cep'])
                ? trim($_POST['cep'])
                : null,

            'telefone' => !empty($_POST['telefone'])
                ? trim($_POST['telefone'])
                : null,

            'email' => !empty($_POST['email'])
                ? trim($_POST['email'])
                : null,

            'responsavel' => !empty($_POST['responsavel'])
                ? trim($_POST['responsavel'])
                : null,

            'ativo' => isset($_POST['ativo'])
                ? (int)$_POST['ativo']
                : 1
        ];

        if (empty($dados['nome'])) {

            $_SESSION['erro'] =
                'O nome da unidade é obrigatório.';

            header('Location: ' . BASE_URL . '/unidades/criar');
            exit;
        }

        $unidadeExistente = null;

        if (!empty($dados['cnpj'])) {
            $unidadeExistente =
                $this->unidadeModel->buscarPorCnpj($dados['cnpj']);
        }

        if ($unidadeExistente) {

            $_SESSION['erro'] =
                'Já existe uma unidade cadastrada com este CNPJ.';

            header('Location: ' . BASE_URL . '/unidades/criar');
            exit;
        }

        $unidadeId = $this->unidadeModel->salvar($dados);

        if ($unidadeId) {

            $_SESSION['sucesso'] =
                'Unidade cadastrada com sucesso!';

        } else {

            $_SESSION['erro'] =
                'Erro ao cadastrar unidade.';
        }

        header('Location: ' . BASE_URL . '/unidades');
        exit;
    }

    public function editar($id)
    {
        $unidade = $this->unidadeModel->buscarPorId((int)$id);

        if (!$unidade) {

            $_SESSION['erro'] =
                'Unidade não encontrada.';

            header('Location: ' . BASE_URL . '/unidades');
            exit;
        }

        if (
            !empty($unidade['cidade']) &&
            !empty($unidade['estado'])
        ) {

            $unidade['cidade_uf'] =
                $unidade['cidade'] .
                ' / ' .
                $unidade['estado'];

        } else {

            $unidade['cidade_uf'] =
                $unidade['cidade']
                ?? $unidade['estado']
                ?? '';
        }

        $this->view('unidades/editar', [
            'unidade' => $unidade
        ]);
    }

    public function atualizar($id)
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {

            header('Location: ' . BASE_URL . '/unidades');
            exit;
        }

        $cidade = null;
        $estado = null;

        if (!empty($_POST['cidade_uf'])) {

            $partes = explode('/', $_POST['cidade_uf']);

            $cidade = trim($partes[0]);

            $estado = isset($partes[1])
                ? trim($partes[1])
                : null;
        }

        $dados = [

            'codigo' => !empty($_POST['codigo'])
                ? trim($_POST['codigo'])
                : null,

            'codigo_externo' => !empty($_POST['codigo_externo'])
                ? trim($_POST['codigo_externo'])
                : null,

            'nome' => trim($_POST['nome'] ?? ''),

            'cnpj' => !empty($_POST['cnpj'])
                ? trim($_POST['cnpj'])
                : null,

            'endereco' => !empty($_POST['endereco'])
                ? trim($_POST['endereco'])
                : null,

            'numero' => !empty($_POST['numero'])
                ? trim($_POST['numero'])
                : null,

            'bairro' => !empty($_POST['bairro'])
                ? trim($_POST['bairro'])
                : null,

            'cidade' => $cidade,

            'estado' => $estado,

            'cep' => !empty($_POST['cep'])
                ? trim($_POST['cep'])
                : null,

            'telefone' => !empty($_POST['telefone'])
                ? trim($_POST['telefone'])
                : null,

            'email' => !empty($_POST['email'])
                ? trim($_POST['email'])
                : null,

            'responsavel' => !empty($_POST['responsavel'])
                ? trim($_POST['responsavel'])
                : null,

            'ativo' => isset($_POST['ativo'])
                ? (int)$_POST['ativo']
                : 1
        ];

        if (empty($dados['nome'])) {

            $_SESSION['erro'] =
                'O nome da unidade é obrigatório.';

            header('Location: ' . BASE_URL . '/unidades/editar/' . $id);
            exit;
        }

        if ($this->unidadeModel->atualizar((int)$id, $dados)) {

            $_SESSION['sucesso'] =
                'Unidade atualizada com sucesso!';

        } else {

            $_SESSION['erro'] =
                'Erro ao atualizar unidade.';
        }

        header('Location: ' . BASE_URL . '/unidades');
        exit;
    }

    public function excluir($id)
    {
        if ($this->unidadeModel->desativar((int)$id)) {

            $_SESSION['sucesso'] =
                'Unidade desativada com sucesso!';

        } else {

            $_SESSION['erro'] =
                'Erro ao desativar unidade.';
        }

        header('Location: ' . BASE_URL . '/unidades');
        exit;
    }
}