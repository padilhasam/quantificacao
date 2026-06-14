<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<main class="content flex-grow-1 p-4">

<?php
    $sucesso = $_SESSION['sucesso'] ?? null;
    $erro = $_SESSION['erro'] ?? null;
    unset($_SESSION['sucesso'], $_SESSION['erro']);
?>

<!-- TOASTS -->
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">

    <?php if ($sucesso): ?>
        <div id="toastSucesso" class="toast text-bg-success border-0 shadow-lg">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas fa-check-circle me-2"></i>
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

<!-- HEADER -->
<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

    <div>
        <h3 class="fw-bold mb-1">
            <i class="fas fa-user-gear me-2 text-primary"></i>
            Técnicos
        </h3>
        <p class="text-muted mb-0">
            Gestão de profissionais técnicos cadastrados no sistema
        </p>
    </div>

    <a href="<?= BASE_URL ?>/tecnicos/criar" class="btn btn-primary shadow-sm">
        <i class="fas fa-plus-circle me-2"></i>
        Novo Técnico
    </a>

</div>

<!-- FILTRO -->
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">

        <div class="row g-3">

            <div class="col-lg-6">
                <label class="form-label fw-semibold">Buscar</label>
                <input type="text" class="form-control" placeholder="Nome, CPF ou registro profissional">
            </div>

            <div class="col-lg-3">
                <label class="form-label fw-semibold">Conselho</label>
                <select class="form-select">
                    <option value="">Todos</option>
                    <option>CREA</option>
                    <option>CRM</option>
                    <option>MTE</option>
                    <option>OUTRO</option>
                </select>
            </div>

            <div class="col-lg-3 d-flex align-items-end">
                <button class="btn btn-outline-primary w-100">
                    <i class="fas fa-search me-2"></i>
                    Filtrar
                </button>
            </div>

        </div>

    </div>
</div>

<!-- TABELA -->
<div class="card border-0 shadow-sm">
    <div class="card-body p-0">

        <div class="table-responsive">

            <table class="table table-hover align-middle mb-0">

                <thead class="table-light">
                    <tr>
                        <th style="width:60px;">#</th>
                        <th>Nome</th>
                        <th>Conselho</th>
                        <th>Status</th>
                        <th class="text-center" style="width:140px;">Ações</th>
                    </tr>
                </thead>

                <tbody>

                <?php if (!empty($tecnicos)): ?>

                    <?php foreach ($tecnicos as $tec): ?>

                        <tr>

                            <td class="text-muted fw-semibold">
                                #<?= $tec['id'] ?>
                            </td>

                            <td class="fw-semibold">
                                <?= htmlspecialchars($tec['nome']) ?>
                            </td>

                            <td>
                                <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                    <?= htmlspecialchars($tec['conselho'] ?? '-') ?>
                                </span>
                            </td>

                            <td>
                                <?php if (!empty($tec['ativo'])): ?>
                                    <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                        Ativo
                                    </span>
                                <?php else: ?>
                                    <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                        Inativo
                                    </span>
                                <?php endif; ?>
                            </td>

                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    <!-- INFO -->
                                    <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                            data-bs-toggle="modal"
                                            data-bs-target="#modalTecnico<?= $tec['id'] ?>">
                                        <i class="fas fa-circle-info""></i>
                                    </button>

                                    <!-- EDITAR -->
                                    <a href="<?= BASE_URL ?>/tecnicos/editar/<?= $tec['id'] ?>"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <!-- EXCLUIR -->
                                    <a href="<?= BASE_URL ?>/tecnicos/excluir/<?= $tec['id'] ?>"
                                       class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                       onclick="return confirm('Deseja excluir este técnico?')">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                <?php else: ?>

                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="fas fa-user-gear fa-3x mb-3 opacity-50"></i>
                            <div>Nenhum técnico cadastrado</div>
                        </td>
                    </tr>

                <?php endif; ?>

                </tbody>

            </table>

        </div>

    </div>
</div>

<!-- MODAIS -->
<?php foreach ($tecnicos as $tec): ?>

<div class="modal fade" id="modalTecnico<?= $tec['id'] ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">
                    Técnico #<?= $tec['id'] ?>
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <p><strong>Nome:</strong> <?= htmlspecialchars($tec['nome']) ?></p>
                <p><strong>Registro:</strong> <?= htmlspecialchars($tec['registro_profissional'] ?? '-') ?></p>
                <p><strong>Conselho:</strong> <?= htmlspecialchars($tec['conselho'] ?? '-') ?></p>
                <p><strong>UF:</strong> <?= htmlspecialchars($tec['uf'] ?? '-') ?></p>
                <hr>
                <p><strong>Email:</strong> <?= htmlspecialchars($tec['email'] ?? '-') ?></p>
                <p><strong>Telefone:</strong> <?= htmlspecialchars($tec['telefone'] ?? '-') ?></p>
                <p><strong>Status:</strong> <?= !empty($tec['ativo']) ? 'Ativo' : 'Inativo' ?></p>

            </div>

        </div>
    </div>
</div>

<?php endforeach; ?>

</main>

<script>
document.addEventListener('DOMContentLoaded', function () {

    ['toastSucesso', 'toastErro'].forEach(id => {
        const el = document.getElementById(id);
        if (!el) return;

        new bootstrap.Toast(el, {
            delay: id === 'toastSucesso' ? 4000 : 5000
        }).show();
    });

});
</script>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>