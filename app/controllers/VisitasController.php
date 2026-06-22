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
            'usuario_id'               => filter_input(INPUT_POST, 'usuario_id', FILTER_VALIDATE_INT),
            'veiculo_id'               => filter_input(INPUT_POST, 'veiculo_id', FILTER_VALIDATE_INT),
            'empresa_id'               => filter_input(INPUT_POST, 'empresa_id', FILTER_VALIDATE_INT),
            'unidade_id'               => filter_input(INPUT_POST, 'unidade_id', FILTER_VALIDATE_INT),
            'data_visita'              => trim($_POST['data_visita'] ?? ''),
            'hora_visita'              => trim($_POST['hora_visita'] ?? ''),
            'responsavel_acompanhamento' => trim($_POST['responsavel_acompanhamento'] ?? ''),
            'objetivo'                 => trim($_POST['objetivo'] ?? ''),
            'observacoes'              => trim($_POST['observacoes'] ?? '')
        ];

        // Validação idêntica ao padrão adotado em UsuariosController
        if (empty($dados['usuario_id']) || empty($dados['empresa_id']) || empty($dados['data_visita'])) {
            $_SESSION['erro'] = "Preencha todos os campos obrigatórios.";
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

    public function editar($id = null) {
        // Se o ID não foi passado como argumento, tenta obter via GET da URL
        if ($id === null) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        }
        
        // Validação de segurança: se não houver ID, interrompe a execução
        if (!$id) {
            $_SESSION['erro'] = "ID do agendamento não informado.";
            header('Location: ' . BASE_URL . '/visitas');
            exit;
        }

        $visita = $this->visitaModel->buscarPorId((int)$id);
        
        if (!$visita) {
            $_SESSION['erro'] = "Agendamento não encontrado.";
            header('Location: ' . BASE_URL . '/visitas');
            exit;
        }
        
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

    public function atualizar($id = null) {
        // 1. Captura o ID caso não tenha sido passado pelo roteador
        if ($id === null) {
            $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        }

        // 2. Garante que é uma requisição POST
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: ' . BASE_URL . '/visitas');
            exit;
        }

        // 3. Valida se o ID existe
        if (!$id || !$this->visitaModel->buscarPorId((int)$id)) {
            $_SESSION['erro'] = "Agendamento não encontrado.";
            header('Location: ' . BASE_URL . '/visitas');
            exit;
        }

        // 4. Captura e filtra os dados do formulário
        $dados = [
            'usuario_id'               => filter_input(INPUT_POST, 'usuario_id', FILTER_VALIDATE_INT),
            'veiculo_id'               => filter_input(INPUT_POST, 'veiculo_id', FILTER_VALIDATE_INT),
            'empresa_id'               => filter_input(INPUT_POST, 'empresa_id', FILTER_VALIDATE_INT),
            'unidade_id'               => filter_input(INPUT_POST, 'unidade_id', FILTER_VALIDATE_INT),
            'data_visita'              => trim($_POST['data_visita'] ?? ''),
            'hora_visita'              => trim($_POST['hora_visita'] ?? ''),
            'responsavel_acompanhamento' => trim($_POST['responsavel_acompanhamento'] ?? ''),
            'objetivo'                 => trim($_POST['objetivo'] ?? ''),
            'observacoes'              => trim($_POST['observacoes'] ?? '')
        ];

        // 5. Executa a atualização
        if ($this->visitaModel->atualizar((int)$id, $dados)) {
            $_SESSION['sucesso'] = "Agendamento atualizado com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao atualizar agendamento.";
        }

        header('Location: ' . BASE_URL . '/visitas');
        exit;
    }

    public function atualizarData() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $novaData = trim($_POST['nova_data'] ?? '');

            if (!$id || empty($novaData)) {
                http_response_code(400);
                echo json_encode(['status' => 'error', 'message' => 'Dados inválidos']);
                return;
            }

            // CORREÇÃO: Usar $this->visitaModel em vez de $this->model
            $resultado = $this->visitaModel->updateData($id, $novaData);

            if ($resultado) {
                echo json_encode(['status' => 'success']);
            } else {
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => 'Erro ao atualizar no banco']);
            }
        }
    }

    public function excluir($id) {
        if (!$this->visitaModel->buscarPorId((int)$id)) {
            $_SESSION['erro'] = "Agendamento não encontrado.";
            header('Location: ' . BASE_URL . '/visitas');
            exit;
        }

        if ($this->visitaModel->deletar((int)$id)) {
            $_SESSION['sucesso'] = "Visita excluída com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao excluir agendamento.";
        }
        header('Location: ' . BASE_URL . '/visitas');
        exit;
    }

    public function cancelar() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        
        // Verifica se a visita existe
        $visita = $this->visitaModel->buscarPorId((int)$id);
        
        if (!$id || !$visita) {
            $_SESSION['erro'] = "Agendamento não encontrado.";
            header('Location: ' . BASE_URL . '/visitas');
            exit;
        }

        // Chama um método no seu model que faz: UPDATE visitas SET status = 'CANCELADA' WHERE id = ...
        if ($this->visitaModel->atualizarStatus((int)$id, 'CANCELADA')) {
            $_SESSION['sucesso'] = "Visita cancelada com sucesso!";
        } else {
            $_SESSION['erro'] = "Erro ao cancelar agendamento.";
        }
        
        header('Location: ' . BASE_URL . '/visitas');
        exit;
    }

    public function visualizar() {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
        if (!$id) {
            header('Location: ' . BASE_URL . '/visitas');
            exit;
        }
        
        $visita = $this->visitaModel->buscarPorId($id);
        if (!$visita) {
            $_SESSION['erro'] = "Agendamento não encontrado.";
            header('Location: ' . BASE_URL . '/visitas');
            exit;
        }
        
        $this->view('visitas/visualizar', ['visita' => $visita]);
    }

    public function atualizarStatus()
    {
        $id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

        if (!$id) {
            $_SESSION['erro'] = 'ID da visita não informado.';
            header('Location: ' . BASE_URL . '/visitas');
            exit;
        }

        $status = trim($_POST['status'] ?? '');

        if (empty($status)) {
            $_SESSION['erro'] = 'Status não informado.';
            header('Location: ' . BASE_URL . '/visitas');
            exit;
        }

        if ($this->visitaModel->atualizarStatus($id, $status)) {
            $_SESSION['sucesso'] = 'Status atualizado com sucesso!';
        } else {
            $_SESSION['erro'] = 'Erro ao atualizar status.';
        }

        header('Location: ' . BASE_URL . '/visitas');
        exit;
    }
}