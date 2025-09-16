<?php require_once dirname(__DIR__, 2) . '/templates/header.php'; ?>

<div class="container mt-4">
    <h3><i class="fas fa-bolt"></i> Riscos Físicos</h3>
    <hr>

    <a href="<?= BASE_URL ?>/riscos/novo/fisico" class="btn btn-success mb-3">
        <i class="fas fa-plus"></i> Novo Risco Físico
    </a>

    <?php if (!empty($riscos)): ?>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($riscos as $risco): ?>
                        <tr>
                            <td><?= $risco['id'] ?></td>
                            <td><?= htmlspecialchars($risco['nome']) ?></td>
                            <td><?= htmlspecialchars($risco['descricao']) ?></td>
                            <td>
                                <a href="<?= BASE_URL ?>/riscos/editar/<?= $risco['id'] ?>" class="btn btn-sm btn-warning">Editar</a>
                                <a href="<?= BASE_URL ?>/riscos/excluir/<?= $risco['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Deseja excluir este risco?')">Excluir</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <p class="text-muted">Nenhum risco físico cadastrado.</p>
    <?php endif; ?>
</div>

<?php require_once dirname(__DIR__, 2) . '/templates/footer.php'; ?>
