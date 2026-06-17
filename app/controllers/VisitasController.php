<?php

class VisitasController extends Controller {

    public function __construct() {
        if (!isset($_SESSION['usuario_id'])) {
            header('Location: ' . BASE_URL . '/login');
            exit;
        }
    }

    /**
     * Rota: /visitas
     */
    public function index() {
        $visitaModel = new Visita();
        $visitas = $visitaModel->listarTodos();

        $this->view('visitas/index', [
            'visitas' => $visitas
        ]);
    }

    /**
     * Rota: /visitas/criar
     */
    public function criar() {
        $empresaModel = new Empresa();
        
        // Abre a conexão nativa com o banco de dados do seu projeto
        $database = new Database();
        $db = $database->getConnection();

        // Utiliza o método .listar() existente na sua model Empresa
        $empresas = $empresaModel->listar();
        
        // Busca os usuários do sistema diretamente pela tabela correta do banco
        $usuarios = $db->query("SELECT id, nome FROM usuarios ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC); 

        // Busca os veículos cadastrados na frota e as unidades operacionais
        $veiculos = $db->query("SELECT id, modelo, placa FROM veiculos ORDER BY modelo ASC")->fetchAll(PDO::FETCH_ASSOC);
        $unidades = $db->query("SELECT id, nome FROM unidades ORDER BY nome ASC")->fetchAll(PDO::FETCH_ASSOC);

        // Renderiza a view enviando os dados mapeados sem conflito de classes
        $this->view('visitas/criar', [
            'usuarios' => $usuarios,
            'empresas' => $empresas,
            'veiculos' => $veiculos,
            'unidades' => $unidades
        ]);
    }

    /**
     * Rota: /visitas/salvar
     */
    public function salvar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            
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

            // Validação estrita dos campos NOT NULL do banco
            if (!$dados['usuario_id'] || !$dados['empresa_id'] || !$dados['data_visita']) {
                $_SESSION['erro'] = "Por favor, preencha todos os campos obrigatórios marcados com (*).";
                header('Location: ' . BASE_URL . '/visitas/criar');
                exit;
            }

            $visitaModel = new Visita();
            
            if ($visitaModel->salvar($dados)) {
                $_SESSION['sucesso'] = "Agendamento de visita e veículo realizados com sucesso!";
                header('Location: ' . BASE_URL . '/visitas');
                exit;
            } else {
                $_SESSION['erro'] = "Erro interno ao salvar o agendamento.";
                header('Location: ' . BASE_URL . '/visitas/criar');
                exit;
            }
        }
    }
}