<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<main class="content flex-grow-1 pt-3 px-4 pb-4 bg-light-subtle">
    <div class="container-fluid px-2 px-lg-4 mb-4">

        <?php
        $sucesso = $_SESSION['sucesso'] ?? null;
        $erro = $_SESSION['erro'] ?? null;
        unset($_SESSION['sucesso'], $_SESSION['erro']);
        ?>

        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:9999;">
            <?php if ($sucesso): ?>
                <div id="toastSucesso" class="toast text-bg-success border-0 shadow-lg">
                    <div class="d-flex">
                        <div class="toast-body"><i class="fas fa-circle-check me-2"></i> <?= htmlspecialchars($sucesso) ?></div>
                        <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            <?php endif; ?>
            <?php if ($erro): ?>
                <div id="toastErro" class="toast text-bg-danger border-0 shadow-lg">
                    <div class="d-flex">
                        <div class="toast-body"><i class="fas fa-circle-exclamation me-2"></i> <?= htmlspecialchars($erro) ?></div>
                        <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <header class="mb-4 px-4 py-3 bg-white border rounded-3 shadow-sm d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h3 class="m-0 fw-bold text-dark d-flex align-items-center gap-3" style="font-size: 1.5rem;">
                    <span class="icon-container d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: linear-gradient(135deg, #0d6efd, #084298); border-radius: 8px; box-shadow: 0 2px 6px rgba(13, 110, 253, 0.25);">
                        <i class="fas fa-briefcase text-white" style="font-size: 1.10rem;"></i>
                    </span>
                    Cargos e Funções
                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 fw-bold fs-6 border border-primary-subtle">
                        <?= count($cargos ?? []) ?>
                    </span>
                </h3>
                <small class="text-muted d-block mt-1">Gestão dos cargos e funções organizacionais para análise de riscos.</small>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="<?= BASE_URL ?>/dashboard" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-medium">
                    <i class="fas fa-arrow-left me-1"></i> Dashboard
                </a>
                <a href="<?= BASE_URL ?>/cargos/criar" class="btn btn-primary btn-sm rounded-pill px-3 fw-medium shadow-sm">
                    <i class="fas fa-plus-circle me-1"></i> Novo Cargo
                </a>
            </div>
        </header>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <?php if (!empty($cargos)): ?>
                    <div class="table-responsive">
                        <table id="tabelaCargos" class="table table-hover align-middle nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:60px;" class="text-secondary small fw-bold">#</th>
                                    <th class="text-secondary small fw-bold">Cargo / Função</th>
                                    <th class="text-secondary small fw-bold">Setor</th>
                                    <th class="text-secondary small fw-bold">CBO</th>
                                    <th class="text-center text-secondary small fw-bold" style="width:140px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cargos as $c): ?>
                                    <tr>
                                        <td class="text-muted fw-semibold">#<?= $c['id'] ?></td>
                                        <td class="fw-semibold text-dark"><?= htmlspecialchars($c['nome']) ?></td>
                                        <td class="text-secondary"><?= htmlspecialchars($c['setor_nome'] ?? '-') ?></td>
                                        <td class="font-monospace text-muted"><?= !empty($c['cbo']) ? htmlspecialchars($c['cbo']) : '-' ?></td>
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalCargo<?= $c['id'] ?>"><i class="fas fa-circle-info"></i></button>
                                                <a href="<?= BASE_URL ?>/cargos/editar/<?= $c['id'] ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3"><i class="fas fa-edit"></i></a>
                                                <a href="<?= BASE_URL ?>/cargos/excluir/<?= $c['id'] ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Deseja excluir este cargo?')"><i class="fas fa-trash"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <div class="text-center py-5 text-muted">
                        <div class="icon-container d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3 bg-light text-muted opacity-70" style="width: 70px; height: 70px;">
                            <i class="fas fa-briefcase fa-2x"></i>
                        </div>
                        <h5 class="fw-bold text-dark mb-1">Nenhum cargo cadastrado</h5>
                        <a href="<?= BASE_URL ?>/cargos/criar" class="btn btn-primary btn-sm rounded-pill px-4 fw-medium shadow-sm">Cadastrar Cargo</a>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <?php if (!empty($cargos)): foreach ($cargos as $c): ?>
        <div class="modal fade" id="modalCargo<?= $c['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-3">
                    <div class="modal-header bg-light border-bottom py-3">
                        <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                            <i class="fas fa-briefcase border p-2 bg-light rounded-3 text-secondary"></i> Ficha do Cargo #<?= $c['id'] ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="mb-3 border-bottom pb-2">
                            <label class="text-secondary small fw-semibold d-block">Nome do Cargo</label>
                            <span class="text-dark fw-bold fs-5"><?= htmlspecialchars($c['nome']) ?></span>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="text-secondary small fw-semibold d-block">Setor</label>
                                <span class="text-dark fw-medium"><?= htmlspecialchars($c['setor_nome'] ?? '-') ?></span>
                            </div>
                            <div class="col-6">
                                <label class="text-secondary small fw-semibold d-block">CBO</label>
                                <span class="font-monospace text-dark fw-bold"><?= !empty($c['cbo']) ? htmlspecialchars($c['cbo']) : '-' ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; endif; ?>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    $('.toast').each(function() { new bootstrap.Toast(this, { delay: 4000 }).show(); });

    $('#tabelaCargos').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json' },
        columnDefs: [{ orderable: false, targets: 4 }],
        drawCallback: function() {
            $('.dataTables_paginate .paginate_button').addClass('shadow-sm');
        }
    });
});
</script>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>