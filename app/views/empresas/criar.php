<?php require_once dirname(__DIR__) . '../templates/header.php'; ?>
<link rel="stylesheet" href="<?= BASE_URL ?>/css/empresas.css">

<div class="container mt-4">
    <h2>Cadastrar Nova Empresa</h2>

    <form action="<?= BASE_URL ?>/empresas/armazenar" method="POST">
        <div class="form-group">
            <label for="nome">Nome da Empresa</label>
            <input type="text" class="form-control" id="nome" name="nome" required>
        </div>

        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj">
        </div>

        <div class="form-group">
            <label for="cnae">CNAE</label>
            <input type="text" class="form-control" id="cnae" name="cnae">
        </div>

        <div class="form-group">
            <label for="responsavel">Responsável</label>
            <input type="text" class="form-control" id="responsavel" name="responsavel">
        </div>

        <div class="form-group">
            <label for="contato_responsavel">Contato do Responsável</label>
            <input type="text" class="form-control" id="contato_responsavel" name="contato_responsavel">
        </div>

        <div class="form-group text-end mt-4">
            <button type="submit" class="btn btn-success me-2">
                <i class="fas fa-check-circle"></i> Salvar
            </button>
            <a href="<?= BASE_URL ?>/empresas" class="btn btn-outline-secondary">
                <i class="fas fa-times-circle"></i> Cancelar
            </a>
        </div>
    </form>
</div>

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>
