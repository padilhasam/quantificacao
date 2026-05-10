<?php require_once dirname(__DIR__) . '../templates/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>/css/empresas.css">

<!-- DataTables -->
<link rel="stylesheet"
href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

<link rel="stylesheet"
href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<main class="content flex-grow-1 p-4">

    <!-- HEADER DA PÁGINA -->
    <div class="page-header mb-4">

        <div>
            <h3 class="fw-bold mb-1 d-flex align-items-center gap-2">
                <i class="fas fa-building text-primary"></i>
                Empresas

                <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                    <?= count($empresas) ?>
                </span>
            </h3>

            <p class="text-muted mb-0">
                Gestão de empresas, responsáveis e contatos
            </p>
        </div>

        <div class="d-flex gap-2 flex-wrap">

            <a href="<?= BASE_URL ?>/dashboard"
               class="btn btn-light border">
                <i class="fas fa-arrow-left me-1"></i>
                Dashboard
            </a>

            <a href="<?= BASE_URL ?>/empresas/importar"
               class="btn btn-outline-success">
                <i class="fas fa-file-import me-1"></i>
                Importar CSV
            </a>

            <a href="<?= BASE_URL ?>/empresas/criar"
               class="btn btn-primary">
                <i class="fas fa-plus-circle me-1"></i>
                Nova Empresa
            </a>

        </div>

    </div>

    <!-- CARD -->
    <div class="card border-0 shadow-sm">

        <div class="card-body">

            <?php if (!empty($empresas)) : ?>

                <div class="table-responsive">

                    <table id="tabelaEmpresas"
                           class="table table-hover align-middle nowrap w-100">

                        <thead>
                            <tr>
                                <th>Empresa</th>
                                <th>CNPJ</th>
                                <th>Responsável</th>
                                <th>Contato</th>
                                <th width="120" class="text-center">Ações</th>
                            </tr>
                        </thead>

                        <tbody>

                            <?php foreach ($empresas as $empresa) : ?>

                                <tr>

                                    <td>
                                        <div class="fw-semibold text-dark">
                                            <?= htmlspecialchars($empresa['nome']) ?>
                                        </div>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($empresa['cnpj']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($empresa['responsavel']) ?>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($empresa['contato_responsavel']) ?>
                                    </td>

                                    <td class="text-center">

                                        <div class="d-flex justify-content-center gap-1">

                                            <a href="<?= BASE_URL ?>/empresas/editar/<?= $empresa['id'] ?>"
                                               class="btn btn-sm btn-light border btn-action"
                                               title="Editar">

                                                <i class="fas fa-edit text-primary"></i>
                                            </a>

                                            <a href="<?= BASE_URL ?>/empresas/excluir/<?= $empresa['id'] ?>"
                                               class="btn btn-sm btn-light border btn-action"
                                               title="Excluir"
                                               onclick="return confirmarExclusao('<?= addslashes($empresa['nome']) ?>')">

                                                <i class="fas fa-trash text-danger"></i>
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        </tbody>

                    </table>

                </div>

            <?php else : ?>

                <div class="empty-state">

                    <i class="fas fa-building empty-icon"></i>

                    <h5>Nenhuma empresa cadastrada</h5>

                    <p class="text-muted">
                        Clique em "Nova Empresa" para começar.
                    </p>

                    <a href="<?= BASE_URL ?>/empresas/criar"
                       class="btn btn-primary">
                        <i class="fas fa-plus-circle me-1"></i>
                        Cadastrar Empresa
                    </a>

                </div>

            <?php endif; ?>

        </div>

    </div>

</main>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>

<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    $('#tabelaEmpresas').DataTable({

        responsive: true,

        autoWidth: false,

        pageLength: 10,

        lengthMenu: [5, 10, 25, 50, 100],

        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
        },

        columnDefs: [
            {
                orderable: false,
                targets: 4
            }
        ]
    });

});

function confirmarExclusao(nome) {

    return confirm(
        `Tem certeza que deseja excluir a empresa "${nome}"?\n\nEsta ação não poderá ser desfeita.`
    );
}
</script>

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>