<?php require_once dirname(__DIR__) . '/../templates/header.php'; ?>

<div class="container mt-4">
    <h2>Editar Empresa</h2>

    <form action="<?= BASE_URL ?>/empresas/atualizar/<?= $empresa['id'] ?>" method="POST">
        <div class="form-group">
            <label for="nome">Nome da Empresa</label>
            <input type="text" class="form-control" id="nome" name="nome" value="<?= htmlspecialchars($empresa['nome']) ?>" required>
        </div>

        <div class="form-group">
            <label for="cnpj">CNPJ</label>
            <input type="text" class="form-control" id="cnpj" name="cnpj" value="<?= htmlspecialchars($empresa['cnpj']) ?>">
        </div>

        <div class="form-group">
            <label for="cnae">CNAE</label>
            <input type="text" class="form-control" id="cnae" name="cnae" value="<?= htmlspecialchars($empresa['cnae']) ?>">
        </div>

        <div class="form-group">
            <label for="responsavel">Responsável</label>
            <input type="text" class="form-control" id="responsavel" name="responsavel" value="<?= htmlspecialchars($empresa['responsavel']) ?>">
        </div>

        <div class="form-group">
            <label for="contato_responsavel">Contato do Responsável</label>
            <input type="text" class="form-control" id="contato_responsavel" name="contato_responsavel" value="<?= htmlspecialchars($empresa['contato_responsavel']) ?>">
        </div>

        <div class="form-group">
            <label for="endereco">Endereço</label>
            <textarea class="form-control" id="endereco" name="endereco" rows="3"><?= htmlspecialchars($empresa['endereco']) ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a href="<?= BASE_URL ?>/empresas" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<?php require_once dirname(__DIR__) . '/../templates/footer.php'; ?>
