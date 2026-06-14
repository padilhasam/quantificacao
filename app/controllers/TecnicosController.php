<?php

class TecnicosController extends Controller
{
    public function index()
    {
        $model = $this->model('Tecnico');

        $this->view('tecnicos/index', [
            'tecnicos' => $model->listarTodos()
        ]);
    }

    public function criar()
    {
        $this->view('tecnicos/criar');
    }

    public function salvar()
    {
        $model = $this->model('Tecnico');

        $dados = [
            'nome' => trim($_POST['nome'] ?? ''),
            'registro_profissional' => trim($_POST['registro_profissional'] ?? null),
            'conselho' => trim($_POST['conselho'] ?? null),
            'uf' => strtoupper(trim($_POST['uf'] ?? null)), // 🔥 ADICIONADO
            'cpf' => trim($_POST['cpf'] ?? null),
            'telefone' => trim($_POST['telefone'] ?? null),
            'email' => trim($_POST['email'] ?? null),
            'assinatura' => $_POST['assinatura'] ?? null,
            'ativo' => isset($_POST['ativo']) ? (int)$_POST['ativo'] : 1
        ];

        // VALIDAÇÃO
        if (empty($dados['nome'])) {
            $this->view('tecnicos/criar', [
                'erro' => 'Nome é obrigatório'
            ]);
            return;
        }

        if (!empty($dados['email']) && !filter_var($dados['email'], FILTER_VALIDATE_EMAIL)) {
            $this->view('tecnicos/criar', [
                'erro' => 'E-mail inválido'
            ]);
            return;
        }

        if (!empty($dados['cpf']) && strlen($dados['cpf']) < 11) {
            $this->view('tecnicos/criar', [
                'erro' => 'CPF inválido'
            ]);
            return;
        }

        $ok = $model->cadastrar($dados);

        if (!$ok) {
            $this->view('tecnicos/criar', [
                'erro' => 'Erro ao salvar técnico'
            ]);
            return;
        }

        header("Location: " . BASE_URL . "/tecnicos");
        exit;
    }

    public function editar($id)
    {
        $model = $this->model('Tecnico');

        $tecnico = $model->buscarPorId($id);

        if (!$tecnico) {
            header("Location: " . BASE_URL . "/tecnicos");
            exit;
        }

        $this->view('tecnicos/editar', [
            'tecnico' => $tecnico
        ]);
    }

    public function atualizar($id)
    {
        $model = $this->model('Tecnico');

        $dados = [
            'nome' => trim($_POST['nome'] ?? ''),
            'registro_profissional' => trim($_POST['registro_profissional'] ?? null),
            'conselho' => trim($_POST['conselho'] ?? null),
            'uf' => strtoupper(trim($_POST['uf'] ?? null)), // 🔥 ADICIONADO
            'cpf' => trim($_POST['cpf'] ?? null),
            'telefone' => trim($_POST['telefone'] ?? null),
            'email' => trim($_POST['email'] ?? null),
            'assinatura' => $_POST['assinatura'] ?? null,
            'ativo' => isset($_POST['ativo']) ? (int)$_POST['ativo'] : 1
        ];

        if (empty($dados['nome'])) {
            $this->view('tecnicos/editar', [
                'erro' => 'Nome é obrigatório',
                'tecnico' => array_merge($dados, ['id' => $id])
            ]);
            return;
        }

        $ok = $model->atualizar($id, $dados);

        if (!$ok) {
            $this->view('tecnicos/editar', [
                'erro' => 'Erro ao atualizar técnico',
                'tecnico' => array_merge($dados, ['id' => $id])
            ]);
            return;
        }

        header("Location: " . BASE_URL . "/tecnicos");
        exit;
    }

    public function excluir($id)
    {
        $model = $this->model('Tecnico');

        $model->excluir($id);

        header("Location: " . BASE_URL . "/tecnicos");
        exit;
    }
}