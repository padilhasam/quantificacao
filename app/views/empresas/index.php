<?php
$css = 'empresas.css';
require_once dirname(__DIR__) . '/templates/header.php';
?>

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

        <header class="page-header-empresas mb-4 px-4 py-3 bg-white border rounded-3 shadow-sm d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h3 class="m-0 fw-bold text-dark d-flex align-items-center gap-3" style="font-size: 1.5rem;">
                    <span class="icon-container d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: linear-gradient(135deg, #0d6efd, #084298); border-radius: 8px; box-shadow: 0 2px 6px rgba(13, 110, 253, 0.25);">
                        <i class="fas fa-building text-white" style="font-size: 1.10rem;"></i>
                    </span>

                    Empresas Clientes

                    <span class="badge bg-primary-subtle text-primary rounded-pill px-3 py-1 fw-bold fs-6 border border-primary-subtle">
                        <?= count($empresas ?? []) ?>
                    </span>
                </h3>

                <small class="text-muted d-block mt-1">
                    Gestão centralizada de clientes, responsáveis legais e contatos principais.
                </small>
            </div>

            <div class="page-header-actions d-flex gap-2 flex-wrap">
                <a href="<?= BASE_URL ?>/dashboard" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-medium">
                    <i class="fas fa-arrow-left me-1"></i> Dashboard
                </a>

                <a href="<?= BASE_URL ?>/empresas/criar" class="btn btn-primary btn-sm rounded-pill px-3 fw-medium shadow-sm">
                    <i class="fas fa-plus-circle me-1"></i> Nova Empresa
                </a>
            </div>
        </header>

        <?php if (!empty($empresas)): ?>

            <!-- DESKTOP -->
            <div class="card border-0 shadow-sm rounded-3 empresas-desktop-view">
                <div class="card-body p-4">
                    <div class="table-responsive">
                        <table id="tabelaEmpresas" class="table table-hover align-middle nowrap w-100">
                            <thead class="table-light">
                                <tr>
                                    <th style="width:60px;" class="text-secondary small fw-bold">#</th>
                                    <th class="text-secondary small fw-bold">Empresa / Razão Social</th>
                                    <th class="text-secondary small fw-bold">CNPJ</th>
                                    <th class="text-secondary small fw-bold">Responsável</th>
                                    <th class="text-center text-secondary small fw-bold" style="width:120px;">Ações</th>
                                </tr>
                            </thead>

                            <tbody>
                                <?php foreach ($empresas as $emp): ?>
                                    <tr>
                                        <td class="text-muted fw-semibold">#<?= $emp['id'] ?></td>

                                        <td>
                                            <div class="fw-semibold text-dark">
                                                <?= htmlspecialchars($emp['nome_fantasia'] ?? $emp['nome'] ?? $emp['razao_social'] ?? 'Sem nome') ?>
                                            </div>

                                            <?php if (!empty($emp['razao_social']) && ($emp['nome_fantasia'] ?? '') !== $emp['razao_social']): ?>
                                                <small class="text-muted">
                                                    <?= htmlspecialchars($emp['razao_social']) ?>
                                                </small>
                                            <?php endif; ?>
                                        </td>

                                        <td class="font-monospace text-muted fw-bold">
                                            <?= !empty($emp['cnpj']) ? htmlspecialchars($emp['cnpj']) : '-' ?>
                                        </td>

                                        <td class="text-muted">
                                            <?= !empty($emp['responsavel']) ? htmlspecialchars($emp['responsavel']) : '-' ?>
                                        </td>

                                        <td class="text-center">
                                            <div class="dropdown">
                                                <button
                                                    class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                                    data-bs-toggle="dropdown"
                                                    title="Abrir ações">
                                                    <i class="fas fa-folder-open"></i>
                                                </button>

                                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-3">
                                                    <li>
                                                        <button class="dropdown-item"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#modalEmpresa<?= $emp['id'] ?>">
                                                            <i class="fas fa-circle-info me-2 text-secondary"></i>
                                                            Visualizar
                                                        </button>
                                                    </li>

                                                    <li>
                                                        <a class="dropdown-item" href="<?= BASE_URL ?>/empresas/editar/<?= $emp['id'] ?>">
                                                            <i class="fas fa-edit me-2 text-primary"></i>
                                                            Editar
                                                        </a>
                                                    </li>

                                                    <li><hr class="dropdown-divider"></li>

                                                    <li>
                                                        <a class="dropdown-item text-danger"
                                                            href="<?= BASE_URL ?>/empresas/excluir/<?= $emp['id'] ?>"
                                                            onclick="return confirm('Deseja realmente excluir esta empresa?')">
                                                            <i class="fas fa-trash me-2"></i>
                                                            Excluir
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- MOBILE / TABLET / WEBVIEW -->
            <section class="empresas-app-view">

                <div class="empresas-app-toolbar bg-white border rounded-4 shadow-sm p-3 mb-3">
                    <div class="input-group empresas-app-search">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-muted"></i>
                        </span>

                        <input
                            type="text"
                            id="buscarEmpresaMobile"
                            class="form-control border-start-0"
                            placeholder="Buscar empresa, CNPJ, cidade ou responsável...">
                    </div>

                    <div class="d-flex align-items-center justify-content-between mt-3 gap-2">
                        <small class="text-muted">
                            <span id="contadorEmpresasMobile"><?= count($empresas ?? []) ?></span>
                            empresa(s) exibida(s)
                        </small>
                    </div>
                </div>

                <div class="empresas-app-list">
                    <?php foreach ($empresas as $emp): ?>
                        <?php
                        $nomeEmpresa = $emp['nome_fantasia'] ?? $emp['nome'] ?? $emp['razao_social'] ?? 'Sem nome';
                        $textoBusca = strtolower(
                            ($emp['nome_fantasia'] ?? '') . ' ' .
                            ($emp['razao_social'] ?? '') . ' ' .
                            ($emp['cnpj'] ?? '') . ' ' .
                            ($emp['responsavel'] ?? '') . ' ' .
                            ($emp['cidade'] ?? '') . ' ' .
                            ($emp['estado'] ?? '')
                        );
                        ?>

                        <article
                            class="empresa-app-card"
                            data-search="<?= htmlspecialchars($textoBusca) ?>">

                            <div class="empresa-app-card-main">
                                <div class="empresa-app-icon">
                                    <i class="fas fa-building"></i>
                                </div>

                                <div class="empresa-app-content">
                                    <h5><?= htmlspecialchars($nomeEmpresa) ?></h5>

                                    <?php if (!empty($emp['razao_social']) && $emp['razao_social'] !== $nomeEmpresa): ?>
                                        <p class="empresa-app-razao">
                                            <?= htmlspecialchars($emp['razao_social']) ?>
                                        </p>
                                    <?php endif; ?>

                                    <div class="empresa-app-meta">
                                        <span>
                                            <i class="fas fa-id-card"></i>
                                            <?= !empty($emp['cnpj']) ? htmlspecialchars($emp['cnpj']) : 'CNPJ não informado' ?>
                                        </span>

                                        <span>
                                            <i class="fas fa-location-dot"></i>
                                            <?= !empty($emp['cidade']) ? htmlspecialchars($emp['cidade']) : 'Cidade não informada' ?>
                                            <?= !empty($emp['estado']) ? ' / ' . htmlspecialchars($emp['estado']) : '' ?>
                                        </span>

                                        <span>
                                            <i class="fas fa-user"></i>
                                            <?= !empty($emp['responsavel']) ? htmlspecialchars($emp['responsavel']) : 'Responsável não informado' ?>
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <div class="empresa-app-actions">
                                <button
                                    class="btn btn-outline-secondary rounded-pill px-3"
                                    data-bs-toggle="modal"
                                    data-bs-target="#modalEmpresa<?= $emp['id'] ?>">
                                    <i class="fas fa-circle-info me-1"></i>
                                    Ficha
                                </button>

                                <a href="<?= BASE_URL ?>/empresas/editar/<?= $emp['id'] ?>" class="btn btn-outline-primary rounded-pill px-3">
                                    <i class="fas fa-edit me-1"></i>
                                    Editar
                                </a>

                                <a href="<?= BASE_URL ?>/empresas/excluir/<?= $emp['id'] ?>"
                                class="btn btn-outline-danger rounded-pill px-3"
                                onclick="return confirm('Deseja realmente excluir esta empresa?')">
                                    <i class="fas fa-trash me-1"></i>
                                    Excluir
                                </a>
                            </div>
                        </article>
                    <?php endforeach; ?>
                </div>

                <div id="semResultadoEmpresasMobile" class="text-center py-5 text-muted d-none">
                    <i class="fas fa-magnifying-glass fa-2x mb-3 opacity-50"></i>
                    <h6 class="fw-bold text-dark">Nenhuma empresa encontrada</h6>
                    <p class="small mb-0">Tente buscar por nome, CNPJ, cidade ou responsável.</p>
                </div>
            </section>

        <?php else: ?>

            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <div class="text-center py-5 text-muted">
                        <div class="icon-container d-flex align-items-center justify-content-center rounded-circle mx-auto mb-3 bg-light text-muted opacity-70" style="width: 70px; height: 70px;">
                            <i class="fas fa-building fa-2x"></i>
                        </div>

                        <h5 class="fw-bold text-dark mb-1">Nenhuma empresa cadastrada</h5>

                        <p class="small text-muted mb-3">
                            Clique no botão abaixo para adicionar a primeira empresa.
                        </p>

                        <a href="<?= BASE_URL ?>/empresas/criar" class="btn btn-primary btn-sm rounded-pill px-4 fw-medium shadow-sm">
                            <i class="fas fa-plus-circle me-1"></i>
                            Cadastrar Empresa
                        </a>
                    </div>
                </div>
            </div>

        <?php endif; ?>
    </div>

    <?php foreach ($empresas as $emp): ?>
        <div class="modal fade" id="modalEmpresa<?= $emp['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
                <div class="modal-content border-0 shadow-lg rounded-3">
                    <div class="modal-header bg-light border-bottom py-3">
                        <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                            <i class="fas fa-building border p-2 bg-light rounded-3 text-secondary"></i>
                            Ficha da Empresa #<?= $emp['id'] ?>
                        </h5>

                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4">
                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label class="text-secondary small fw-semibold d-block">Código Interno</label>
                                <span class="font-monospace text-primary fw-bold">
                                    <?= htmlspecialchars($emp['codigo'] ?? '-') ?>
                                </span>
                            </div>
                        </div>

                        <div class="mb-3 border-bottom pb-2">
                            <label class="text-secondary small fw-semibold d-block">Razão Social</label>
                            <span class="text-dark fw-bold fs-5">
                                <?= htmlspecialchars($emp['razao_social'] ?? $emp['nome'] ?? '-') ?>
                            </span>
                        </div>

                        <div class="mb-3">
                            <label class="text-secondary small fw-semibold d-block">Nome Fantasia</label>
                            <span class="font-monospace text-dark fw-bold bg-light px-2 py-1 rounded border d-inline-block">
                                <?= htmlspecialchars($emp['nome_fantasia'] ?? '-') ?>
                            </span>
                        </div>

                        <div class="row g-3 mb-3">
                            <div class="col-12 col-md-6">
                                <label class="text-secondary small fw-semibold d-block">CNPJ</label>
                                <span class="text-dark fw-medium">
                                    <?= htmlspecialchars($emp['cnpj'] ?? '-') ?>
                                </span>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="text-secondary small fw-semibold d-block">Insc. Estadual</label>
                                <span class="text-dark fw-medium">
                                    <?= htmlspecialchars($emp['inscricao_estadual'] ?? '-') ?>
                                </span>
                            </div>
                        </div>

                        <div class="row g-3 mb-3 border-top pt-3">
                            <div class="col-12 col-md-6">
                                <label class="text-secondary small fw-semibold d-block">Responsável</label>
                                <span class="text-dark fw-medium">
                                    <?= htmlspecialchars($emp['responsavel'] ?? '-') ?>
                                </span>
                            </div>

                            <div class="col-12 col-md-6">
                                <label class="text-secondary small fw-semibold d-block">Contato</label>
                                <span class="text-dark fw-medium">
                                    <?= htmlspecialchars($emp['contato_responsavel'] ?? '-') ?>
                                </span>
                            </div>
                        </div>

                        <div class="border-top pt-3">
                            <label class="text-secondary small fw-semibold d-block">Endereço</label>

                            <span class="text-dark">
                                <?= htmlspecialchars($emp['endereco'] ?? '-') ?>
                            </span>

                            <?php if (!empty($emp['cidade']) || !empty($emp['estado'])): ?>
                                <div class="text-muted small mt-1">
                                    <?= htmlspecialchars($emp['cidade'] ?? '') ?>
                                    <?= (!empty($emp['cidade']) && !empty($emp['estado'])) ? ' / ' : '' ?>
                                    <?= htmlspecialchars($emp['estado'] ?? '') ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($emp['cep'])): ?>
                                <div class="text-muted small">
                                    CEP: <?= htmlspecialchars($emp['cep']) ?>
                                </div>
                            <?php endif; ?>
                        </div>

                        <div class="border-top mt-3 pt-3">
                            <label class="text-secondary small fw-semibold d-block">Data de Cadastro</label>

                            <span class="text-muted small">
                                <i class="fas fa-calendar-alt me-1"></i>
                                <?= !empty($emp['criado_em']) ? date('d/m/Y H:i', strtotime($emp['criado_em'])) : 'Data não informada' ?>
                            </span>
                        </div>
                    </div>

                    <div class="modal-footer bg-light border-top">
                        <a href="<?= BASE_URL ?>/empresas/editar/<?= $emp['id'] ?>" class="btn btn-primary rounded-pill px-4">
                            <i class="fas fa-edit me-1"></i>
                            Editar
                        </a>

                        <button type="button" class="btn btn-outline-secondary rounded-pill px-4" data-bs-dismiss="modal">
                            Fechar
                        </button>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {
    ['toastSucesso', 'toastErro'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            new bootstrap.Toast(el, {
                delay: id === 'toastSucesso' ? 4000 : 5000
            }).show();
        }
    });

    const inputMobile = document.getElementById('buscarEmpresaMobile');
    const cardsMobile = document.querySelectorAll('.empresa-app-card');
    const contadorMobile = document.getElementById('contadorEmpresasMobile');
    const semResultado = document.getElementById('semResultadoEmpresasMobile');

    if (inputMobile && cardsMobile.length) {
        inputMobile.addEventListener('input', function () {
            const termo = this.value.toLowerCase().trim();
            let totalVisiveis = 0;

            cardsMobile.forEach(card => {
                const texto = card.dataset.search || '';
                const visivel = texto.includes(termo);

                card.classList.toggle('d-none', !visivel);

                if (visivel) {
                    totalVisiveis++;
                }
            });

            if (contadorMobile) {
                contadorMobile.textContent = totalVisiveis;
            }

            if (semResultado) {
                semResultado.classList.toggle('d-none', totalVisiveis > 0);
            }
        });
    }
});

$(document).ready(function () {
    if ($('#tabelaEmpresas').length) {
        $('#tabelaEmpresas').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
            },
            columnDefs: [
                { orderable: false, targets: 4 }
            ],
            drawCallback: function () {
                $('.dataTables_paginate .paginate_button').addClass('shadow-sm');
            }
        });
    }
});
</script>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>