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
            <i class="fas fa-building text-primary"></i>
            Empresas
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                <?= count($empresas ?? []) ?>
            </span>
        </h3>
        <p class="text-muted mb-0">
            Gestão de empresas clientes, responsáveis legais e contatos principais
        </p>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="<?= BASE_URL ?>/dashboard" class="btn btn-light border shadow-sm">
            <i class="fas fa-arrow-left me-1"></i> Dashboard
        </a>
        <a href="<?= BASE_URL ?>/empresas/criar" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-1"></i> Nova Empresa
        </a>
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-body p-4">
        <?php if (!empty($empresas)): ?>
            <div class="table-responsive">
                <table id="tabelaEmpresas" class="table table-hover align-middle nowrap w-100">
                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>Empresa / Razão Social</th>
                            <th>CNPJ</th>
                            <th>Responsável</th>
                            <th class="text-center" style="width:140px;">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($empresas as $empresa): ?>
                            <tr>
                                <td class="text-muted fw-semibold">#<?= $empresa['id'] ?></td>
                                <td class="fw-semibold">
                                    <?= htmlspecialchars($empresa['nome_fantasia'] ?? $empresa['nome'] ?? $empresa['razao_social']) ?>
                                    <?php if (!empty($empresa['razao_social']) && ($empresa['nome_fantasia'] ?? '') !== $empresa['razao_social']): ?>
                                        <small class="text-muted fw-normal d-block"><?= htmlspecialchars($empresa['razao_social']) ?></small>
                                    <?php endif; ?>
                                </td>
                                <td class="font-monospace text-muted"><?= !empty($empresa['cnpj']) ? htmlspecialchars($empresa['cnpj']) : '-' ?></td>
                                <td><?= !empty($empresa['responsavel']) ? htmlspecialchars($empresa['responsavel']) : '-' ?></td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalEmpresa<?= $empresa['id'] ?>">
                                            <i class="fas fa-circle-info"></i>
                                        </button>

                                        <a href="<?= BASE_URL ?>/empresas/editar/<?= $empresa['id'] ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <a href="<?= BASE_URL ?>/empresas/excluir/<?= $empresa['id'] ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Deseja excluir esta empresa? Todas as unidades e setores vinculados também poderão ser afetados.')">
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
                <i class="fas fa-building fa-3x mb-3 opacity-50"></i>
                <h5>Nenhuma empresa cadastrada</h5>
                <p class="small text-muted mb-3">Clique no botão acima para adicionar a primeira.</p>
                <a href="<?= BASE_URL ?>/empresas/criar" class="btn btn-primary btn-sm"><i class="fas fa-plus-circle me-1"></i> Cadastrar</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if (!empty($empresas)): ?>
    <?php foreach ($empresas as $empresa): ?>
    <div class="modal fade" id="modalEmpresa<?= $empresa['id'] ?>" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold">Empresa #<?= $empresa['id'] ?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p><strong>Nome/Fantasia:</strong> <?= htmlspecialchars($empresa['nome_fantasia'] ?? $empresa['nome'] ?? '-') ?></p>
                    <p><strong>Razão Social:</strong> <?= htmlspecialchars($empresa['razao_social'] ?? '-') ?></p>
                    <p><strong>CNPJ:</strong> <?= htmlspecialchars($empresa['cnpj'] ?? '-') ?></p>
                    <hr>
                    <p><strong>Responsável:</strong> <?= htmlspecialchars($empresa['responsavel'] ?? '-') ?></p>
                    <p><strong>Contato:</strong> <?= htmlspecialchars($empresa['contato_responsavel'] ?? '-') ?></p>
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
    // Inicialização do Toast
    ['toastSucesso', 'toastErro'].forEach(id => {
        const el = document.getElementById(id);
        if (el) new bootstrap.Toast(el, { delay: id === 'toastSucesso' ? 4000 : 5000 }).show();
    });

    // Inicialização do DataTables
    $('#tabelaEmpresas').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
        },
        columnDefs: [
            { orderable: false, targets: 4 }
        ]
    });
});
</script>

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>