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
            <i class="fas fa-sitemap text-primary"></i>
            Unidades
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                <?= count($unidades ?? []) ?>
            </span>
        </h3>

        <p class="text-muted mb-0">
            Gestão das unidades, filiais e plantas operacionais vinculadas às empresas.
        </p>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="<?= BASE_URL ?>/dashboard" class="btn btn-light border shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Dashboard
        </a>

        <a href="<?= BASE_URL ?>/unidades/criar" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-1"></i> Nova Unidade
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">

        <?php if (!empty($unidades)): ?>

            <div class="table-responsive">
                <table id="tabelaUnidades" class="table table-hover align-middle nowrap w-100">

                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>Unidade</th>
                            <th>Empresa</th>
                            <th>Cidade / UF</th>
                            <th>Status</th>
                            <th class="text-center" style="width:140px;">Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($unidades as $unidade): ?>
                            <tr>

                                <td class="text-muted fw-semibold">
                                    #<?= $unidade['id'] ?>
                                </td>

                                <td class="fw-semibold">
                                    <?= htmlspecialchars($unidade['nome']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($unidade['nome_fantasia'] ?? $unidade['razao_social'] ?? '-') ?>
                                </td>

                                <td>
                                    <?= !empty($unidade['cidade']) ? htmlspecialchars($unidade['cidade']) : '-' ?>
                                    <?= !empty($unidade['estado']) ? ' / ' . htmlspecialchars($unidade['estado']) : '' ?>
                                </td>

                                <td>
                                    <?php if ((int)($unidade['ativo'] ?? 0) === 1): ?>
                                        <span class="badge bg-success-subtle text-success border border-success-subtle">
                                            Ativo
                                        </span>
                                    <?php else: ?>
                                        <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                            Inativo
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">

                                        <button
                                            class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalUnidade<?= $unidade['id'] ?>">
                                            <i class="fas fa-circle-info"></i>
                                        </button>

                                        <a href="<?= BASE_URL ?>/unidades/editar/<?= $unidade['id'] ?>"
                                           class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="<?= BASE_URL ?>/unidades/excluir/<?= $unidade['id'] ?>"
                                           class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                           onclick="return confirm('Deseja excluir esta unidade?');">
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
                <i class="fas fa-sitemap fa-3x mb-3 opacity-50"></i>

                <h5>Nenhuma unidade cadastrada</h5>

                <p class="small text-muted mb-3">
                    Clique no botão acima para adicionar a primeira unidade.
                </p>

                <a href="<?= BASE_URL ?>/unidades/criar" class="btn btn-primary btn-sm">
                    <i class="fas fa-plus-circle me-1"></i>
                    Cadastrar
                </a>
            </div>

        <?php endif; ?>

    </div>
</div>

<?php if (!empty($unidades)): ?>
    <?php foreach ($unidades as $unidade): ?>

        <div class="modal fade" id="modalUnidade<?= $unidade['id'] ?>" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title fw-bold">
                            Unidade #<?= $unidade['id'] ?>
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                        </button>
                    </div>

                    <div class="modal-body">

                        <p>
                            <strong>Nome:</strong>
                            <?= htmlspecialchars($unidade['nome']) ?>
                        </p>

                        <p>
                            <strong>Empresa:</strong>
                            <?= htmlspecialchars($unidade['nome_fantasia'] ?? $unidade['razao_social'] ?? '-') ?>
                        </p>

                        <p>
                            <strong>Cidade:</strong>
                            <?= htmlspecialchars($unidade['cidade'] ?? '-') ?>
                        </p>

                        <p>
                            <strong>Estado:</strong>
                            <?= htmlspecialchars($unidade['estado'] ?? '-') ?>
                        </p>

                        <hr>

                        <p>
                            <strong>Status:</strong>
                            <?= ((int)($unidade['ativo'] ?? 0) === 1) ? 'Ativo' : 'Inativo' ?>
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

    $('#tabelaUnidades').DataTable({
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
                targets: 5
            }
        ]
    });

});
</script>

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>