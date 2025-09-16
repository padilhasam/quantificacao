<?php require_once dirname(__DIR__) . '../templates/header.php'; ?>
<link rel="stylesheet" href="<?= BASE_URL ?>/css/empresas.css">

<div class="container mt-4">
    <h2><i class="fas fa-building"></i> Empresas</h2>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <a href="<?= BASE_URL ?>/dashboard" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left"></i> Voltar
        </a>

        <a href="<?= BASE_URL ?>/empresas/criar" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Nova Empresa
        </a>
    </div>

    <?php if (!empty($empresas)) : ?>
        <table class="table table-bordered table-striped small">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Responsável</th>
                    <th>Contato</th>
                    <th class="text-center">Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($empresas as $empresa) : ?>
                    <tr>
                        <td><?= htmlspecialchars($empresa['nome']) ?></td>
                        <td><?= htmlspecialchars($empresa['cnpj']) ?></td>
                        <td><?= htmlspecialchars($empresa['responsavel']) ?></td>
                        <td><?= htmlspecialchars($empresa['contato_responsavel']) ?></td>
                        <td class="text-center">
                            <a href="<?= BASE_URL ?>/empresas/editar/<?= $empresa['id'] ?>"
                               class="btn btn-sm btn-primary me-1"
                               title="Editar">
                                <i class="fas fa-edit"></i>
                            </a>
                            <a href="<?= BASE_URL ?>/empresas/excluir/<?= $empresa['id'] ?>"
                               class="btn btn-sm btn-danger"
                               title="Excluir"
                               onclick="return confirmarExclusao('<?= addslashes($empresa['nome']) ?>')">
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else : ?>
        <div class="alert alert-info">Nenhuma empresa cadastrada ainda.</div>
    <?php endif; ?>
</div>

<script>
    function confirmarExclusao(nome) {
        return confirm(`Tem certeza que deseja excluir a empresa "${nome}"? Esta ação não poderá ser desfeita.`);
    }
</script>

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>
