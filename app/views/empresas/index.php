<?php require_once dirname(__DIR__) . '../templates/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>/css/empresas.css">

<!-- DataTables CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<main class="content flex-grow-1 p-4">

    <!-- TÍTULO -->
    <div class="mb-4 d-flex justify-content-between align-items-center flex-wrap gap-2">
        <div>
            <h3 class="fw-bold mb-1">
                <i class="fas fa-building me-2"></i> Empresas
            </h3>
            <p class="text-muted mb-0">
                Gestão de empresas, responsáveis e contatos
            </p>
        </div>

        <a href="<?= BASE_URL ?>/empresas/criar" class="btn btn-primary">
            <i class="fas fa-plus-circle me-1"></i> Nova Empresa
        </a>
    </div>

    <!-- VOLTAR -->
    <div class="mb-3">
        <a href="<?= BASE_URL ?>/dashboard" class="btn btn-outline-secondary btn-sm">
            <i class="fas fa-arrow-left me-1"></i> Voltar ao dashboard
        </a>
    </div>

    <!-- LISTAGEM -->
    <?php if (!empty($empresas)) : ?>
        <div class="card shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="tabelaEmpresas" class="table table-hover align-middle small">
                        <thead class="table-light">
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
                                    <td class="fw-semibold">
                                        <?= htmlspecialchars($empresa['nome']) ?>
                                    </td>
                                    <td><?= htmlspecialchars($empresa['cnpj']) ?></td>
                                    <td><?= htmlspecialchars($empresa['responsavel']) ?></td>
                                    <td><?= htmlspecialchars($empresa['contato_responsavel']) ?></td>
                                    <td class="text-center">

                                        <a href="<?= BASE_URL ?>/empresas/editar/<?= $empresa['id'] ?>"
                                           class="btn btn-sm btn-outline-primary me-1"
                                           title="Editar">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="<?= BASE_URL ?>/empresas/excluir/<?= $empresa['id'] ?>"
                                           class="btn btn-sm btn-outline-danger"
                                           title="Excluir"
                                           onclick="return confirmarExclusao('<?= addslashes($empresa['nome']) ?>')">
                                            <i class="fas fa-trash-alt"></i>
                                        </a>

                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    <?php else : ?>
        <div class="alert alert-info">
            Nenhuma empresa cadastrada ainda.
        </div>
    <?php endif; ?>

</main>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('#tabelaEmpresas').DataTable({
        responsive: true,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
        },
        columnDefs: [
            { orderable: false, targets: 4 }
        ]
    });
});

function confirmarExclusao(nome) {
    return confirm(`Tem certeza que deseja excluir a empresa "${nome}"?\nEsta ação não poderá ser desfeita.`);
}
</script>

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>