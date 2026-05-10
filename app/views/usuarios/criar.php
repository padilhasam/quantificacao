<?php require_once dirname(__DIR__) . '../templates/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>/css/usuarios.css">

<div class="container mt-4">
    <h2>Cadastrar Novo Usuário</h2>

    <form action="<?= BASE_URL ?>/usuarios/salvar" method="POST">

        <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
        </div>

        <div class="form-group">
            <label for="tipo">Tipo</label>
            <select class="form-control" id="tipo" name="tipo">
                <option value="ADMIN">Administrador</option>
                <option value="TECNICO" selected>Técnico</option>
                <option value="CLIENTE">Cliente</option>
                <option value="VISUALIZADOR">Visualizador</option>
            </select>
        </div>

        <div class="form-group mt-2">
            <label for="telefone">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone">
        </div>

        <div class="form-group mt-2">
            <label for="ativo">Status</label>
            <select class="form-control" id="ativo" name="ativo">
                <option value="1" selected>Ativo</option>
                <option value="0">Inativo</option>
            </select>
        </div>

        <div class="form-group text-end mt-4">
            <button type="submit" class="btn btn-success me-2">
                <i class="fas fa-check-circle"></i> Salvar
            </button>

            <a href="<?= BASE_URL ?>/usuarios" class="btn btn-outline-secondary">
                <i class="fas fa-times-circle"></i> Cancelar
            </a>
        </div>

    </form>
</div>

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>