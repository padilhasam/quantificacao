<?php

class VisitasController extends Controller {

    private $visitaModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) session_start();
        
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
        
        $this->visitaModel = $this->model('Visita');
    }

    public function index() {
        $visitas = $this->visitaModel->listarTodos();
        $this->view('visitas/index', ['visitas' => $visitas]);
    }

    public function criar() {
        $empresaModel = $this->model('Empresa');
        $database = new Database();
        $db = $database->getConnection();

        $this->view('visitas/criar', [
            'usuarios' => $db->query("SELECT id, nome FROM usuarios ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC),
            'empresas' => $empresaModel->listar(),
            'veiculos' => $db->query("SELECT id, modelo, placa FROM veiculos ORDER BY modelo ASC")->fetchAll(PDO::FETCH_ASSOC),
            'unidades' => $db->query("SELECT id, nome FROM unidades ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC)
        ]);
    }

    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/visitas');
            exit;
        }
            
        $dados = [
            'usuario_id'                 => filter_input(INPUT_POST, 'usuario_id', FILTER_VALIDATE_INT),
            'veiculo_id'                 => filter_input(INPUT_POST, 'veiculo_id', FILTER_VALIDATE_INT),
            'empresa_id'                 => filter_input(INPUT_POST, 'empresa_id', FILTER_VALIDATE_INT),
            'unidade_id'                 => filter_input(INPUT_POST, 'unidade_id', FILTER_VALIDATE_INT),
            'data_visita'                => filter_input(INPUT_POST, 'data_visita', FILTER_DEFAULT),
            'hora_visita'                => filter_input(INPUT_POST, 'hora_visita', FILTER_DEFAULT),
            'responsavel_acompanhamento' => filter_input(INPUT_POST, 'responsavel_acompanhamento', FILTER_DEFAULT),
            'objetivo'                   => filter_input(INPUT_POST, 'objetivo', FILTER_DEFAULT),
            'observacoes'                => filter_input(INPUT_POST, 'observacoes', FILTER_DEFAULT)
        ];

        if (!$dados['usuario_id'] || !$dados['empresa_id'] || !$dados['data_visita']) {
            $_SESSION['erro'] = "Por favor, preencha todos os campos obrigatórios.";
            header('Location: ' . BASE_URL . '/visitas/criar');
            exit;
        }

        if ($this->visitaModel->salvar($dados)) {
            $_SESSION['sucesso'] = "Visita agendada com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao salvar o agendamento.";
        }
        
        header('Location: ' . BASE_URL . '/visitas');
        exit;
    }

    public function editar($id) {
        $visita = $this->visitaModel->buscarPorId((int)$id);
        if (!$visita) {
            $_SESSION['erro'] = "Agendamento não encontrado.";
            header('Location: ' . BASE_URL . '/visitas');
            exit;
        }
        
        // Carrega dependências para o formulário
        $empresaModel = $this->model('Empresa');
        $db = (new Database())->getConnection();
        
        $this->view('visitas/editar', [
            'visita'   => $visita,
            'usuarios' => $db->query("SELECT id, nome FROM usuarios ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC),
            'empresas' => $empresaModel->listar(),
            'veiculos' => $db->query("SELECT id, modelo, placa FROM veiculos ORDER BY modelo ASC")->fetchAll(PDO::FETCH_ASSOC),
            'unidades' => $db->query("SELECT id, nome FROM unidades ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC)
        ]);
    }

    public function atualizar($id) {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/visitas');
            exit;
        }

        $dados = [
            'usuario_id'                 => filter_input(INPUT_POST, 'usuario_id', FILTER_VALIDATE_INT),
            'veiculo_id'                 => filter_input(INPUT_POST, 'veiculo_id', FILTER_VALIDATE_INT),
            'empresa_id'                 => filter_input(INPUT_POST, 'empresa_id', FILTER_VALIDATE_INT),
            'unidade_id'                 => filter_input(INPUT_POST, 'unidade_id', FILTER_VALIDATE_INT),
            'data_visita'                => filter_input(INPUT_POST, 'data_visita', FILTER_DEFAULT),
            'hora_visita'                => filter_input(INPUT_POST, 'hora_visita', FILTER_DEFAULT),
            'responsavel_acompanhamento' => filter_input(INPUT_POST, 'responsavel_acompanhamento', FILTER_DEFAULT),
            'objetivo'                   => filter_input(INPUT_POST, 'objetivo', FILTER_DEFAULT),
            'observacoes'                => filter_input(INPUT_POST, 'observacoes', FILTER_DEFAULT)
        ];

        if ($this->visitaModel->atualizar((int)$id, $dados)) {
            $_SESSION['sucesso'] = "Agendamento atualizado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao atualizar agendamento.";
        }

        header('Location: ' . BASE_URL . '/visitas');
        exit;
    }

    public function excluir($id) {
        if ($this->visitaModel->deletar((int)$id)) {
            $_SESSION['sucesso'] = "Visita excluída com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao excluir agendamento.";
        }
        header('Location: ' . BASE_URL . '/visitas');
        exit;
    }
}