<?php require_once dirname(__DIR__) . '../templates/header.php'; ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<main class="content flex-grow-1 p-4">

<?php
    $sucesso = $_SESSION['sucesso'] ?? null;
    $erro = $_SESSION['erro'] ?? null;
    unset($_SESSION['sucesso'], $_SESSION['erro']);
?>

<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <?php if ($sucesso): ?>
        <div id="toastSucesso" class="toast text-bg-success border-0 shadow-lg">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-circle-check me-2"></i>
                    <?= htmlspecialchars($sucesso) ?>
                </div>
                <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($erro): ?>
        <div id="toastErro" class="toast text-bg-danger border-0 shadow-lg">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-circle-exclamation me-2"></i>
                    <?= htmlspecialchars($erro) ?>
                </div>
                <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    <?php endif; ?>
</div>

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
    <div>
        <h3 class="fw-bold mb-1 d-flex align-items-center gap-2">
            <i class="fas fa-briefcase text-primary"></i>
            Cargos
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                <?= count($cargos ?? []) ?>
            </span>
        </h3>

        <p class="text-muted mb-0">
            Gestão dos cargos e funções organizacionais para análise de riscos ocupacionais.
        </p>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="<?= BASE_URL ?>/dashboard" class="btn btn-light border shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Dashboard
        </a>

        <a href="<?= BASE_URL ?>/cargos/criar" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-1"></i> Novo Cargo
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <?php if (!empty($cargos)): ?>

            <div class="table-responsive">
                <table id="tabelaCargos" class="table table-hover align-middle nowrap w-100">

                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>Cargo / Função</th>
                            <th>Setor</th>
                            <th>CBO</th>
                            <th class="text-center" style="width:140px;">Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($cargos as $cargo): ?>
                            <tr>

                                <td class="text-muted fw-semibold">
                                    #<?= $cargo['id'] ?>
                                </td>

                                <td class="fw-semibold">
                                    <?= htmlspecialchars($cargo['nome']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($cargo['setor_nome'] ?? '-') ?>
                                </td>

                                <td class="font-monospace text-muted">
                                    <?= !empty($cargo['cbo']) ? htmlspecialchars($cargo['cbo']) : '-' ?>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">

                                        <button
                                            class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalCargo<?= $cargo['id'] ?>">
                                            <i class="fas fa-circle-info"></i>
                                        </button>

                                        <a href="<?= BASE_URL ?>/cargos/editar/<?= $cargo['id'] ?>"
                                           class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="<?= BASE_URL ?>/cargos/excluir/<?= $cargo['id'] ?>"
                                           class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                           onclick="return confirm('Deseja excluir este cargo?');">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                    </div>
                                </td>

                            </tr>
                        <?php endforeach; ?>

                    </tbody>

                </table>
            </div>

        <?php else: ?>

            <div class="text-center py-5 text-muted">
                <i class="fas fa-briefcase fa-3x mb-3 opacity-50"></i>

                <h5>Nenhum cargo cadastrado</h5>

                <p class="small text-muted mb-3">
                    Clique no botão acima para adicionar o primeiro cargo.
                </p>

                <a href="<?= BASE_URL ?>/cargos/criar" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus-circle me-1"></i>
                    Cadastrar
                </a>
            </div>

        <?php endif; ?>

    </div>
</div>

<?php if (!empty($cargos)): ?>
    <?php foreach ($cargos as $cargo): ?>

        <div class="modal fade" id="modalCargo<?= $cargo['id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">
                            Cargo #<?= $cargo['id'] ?>
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body">

                        <p>
                            <strong>Cargo:</strong>
                            <?= htmlspecialchars($cargo['nome']) ?>
                        </p>

                        <p>
                            <strong>Setor:</strong>
                            <?= htmlspecialchars($cargo['setor_nome'] ?? '-') ?>
                        </p>

                        <p>
                            <strong>CBO:</strong>
                            <?= !empty($cargo['cbo']) ? htmlspecialchars($cargo['cbo']) : 'Não informado' ?>
                        </p>

                    </div>

                </div>

            </div>
        </div>

    <?php endforeach; ?>
<?php endif; ?>

</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    ['toastSucesso', 'toastErro'].forEach(id => {
        const el = document.getElementById(id);

        if (el) {
            new bootstrap.Toast(el, {
                delay: id === 'toastSucesso' ? 4000 : 5000
            }).show();
        }
    });

    $('#tabelaCargos').DataTable({
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
</script>

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>