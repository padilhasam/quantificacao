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
                            <i class="fas fa-exclamation-circle me-2"></i>
                            <?= htmlspecialchars($erro) ?>
                        </div>
                        <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <header class="mb-4 px-4 py-3 bg-white border rounded-3 shadow-sm d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h3 class="m-0 fw-bold text-dark d-flex align-items-center gap-3" style="font-size: 1.5rem;">
                    <span class="icon-container d-flex align-items-center justify-content-center"
                        style="width: 38px; height: 38px; background: linear-gradient(135deg, #6c757d, #343a40); border-radius: 8px; box-shadow: 0 2px 6px rgba(108, 117, 125, 0.25);">
                        <i class="fas fa-users text-white" style="font-size: 1.10rem;"></i>
                    </span>
                    Usuários
                    <span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill" style="font-size: 0.85rem; font-weight: 600;">
                        <?= count($usuarios ?? []) ?>
                    </span>
                </h3>
                <small class="text-muted d-block mt-1">Gerenciamento de credenciais, perfis corporativos e controle de acessos ativos do sistema</small>
            </div>

            <div class="d-flex gap-2 flex-wrap">
                <a href="<?= BASE_URL ?>/dashboard" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-medium">
                    <i class="fas fa-arrow-left me-1"></i> Dashboard
                </a>
                <a href="<?= BASE_URL ?>/usuarios/criar" class="btn btn-primary btn-sm rounded-pill px-3 fw-medium shadow-sm">
                    <i class="fas fa-plus-circle me-1"></i> Novo Usuário
                </a>
            </div>
        </header>

        <div class="card border-0 shadow-sm rounded-3 mb-4">
            <div class="card-body p-3 bg-white rounded-3 border">
                <div class="row g-3 align-items-end">
                    <div class="col-12 col-md-4">
                        <label for="filtroNivel" class="form-label small fw-semibold text-secondary mb-1">
                            <i class="fas fa-user-shield me-1"></i> Filtrar por Nível de Acesso
                        </label>
                        <select id="filtroNivel" class="form-select form-select-sm rounded-pill">
                            <option value="">Todos os Níveis</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Técnico">Técnico</option>
                            <option value="Cliente">Cliente</option>
                            <option value="Visualizador">Visualizador</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label for="filtroStatus" class="form-label small fw-semibold text-secondary mb-1">
                            <i class="fas fa-toggle-on me-1"></i> Filtrar por Status
                        </label>
                        <select id="filtroStatus" class="form-select form-select-sm rounded-pill">
                            <option value="">Todos os Status</option>
                            <option value="Ativo">Ativo</option>
                            <option value="Inativo">Inativo</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4 text-md-end">
                        <button id="btnLimparFiltros" class="btn btn-sm btn-light border rounded-pill px-3 text-secondary w-100 w-md-auto">
                            <i class="fas fa-eraser me-1"></i> Limpar Filtros
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">

                <?php if (!empty($usuarios)): ?>
                    <div class="table-responsive">
                        <table id="tabelaUsuarios" class="table table-hover align-middle nowrap w-100">
                            <thead class="table-light text-secondary small">
                                <tr>
                                    <th style="width: 60px;">#</th>
                                    <th>Nome do Colaborador</th>
                                    <th>E-mail (Login)</th>
                                    <th>Nível de Acesso</th>
                                    <th>Status</th>
                                    <th>Último Acesso</th>
                                    <th class="text-center" style="width: 140px;">Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($usuarios as $usuario): ?>
                                    <tr>
                                        <td class="text-muted fw-semibold">#<?= $usuario['id'] ?></td>
                                        
                                        <td class="fw-semibold text-dark">
                                            <?= htmlspecialchars($usuario['nome']) ?>
                                        </td>
                                        
                                        <td class="text-secondary small">
                                            <?= htmlspecialchars($usuario['email']) ?>
                                        </td>
                                        
                                        <td>
                                            <?php 
                                                $tipoUpper = strtoupper($usuario['tipo'] ?? '');
                                                switch($tipoUpper) {
                                                    case 'ADMIN':
                                                    case 'ADMINISTRADOR':
                                                        echo '<span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2.5 py-1">Administrador</span>';
                                                        break;
                                                    case 'TECNICO':
                                                        echo '<span class="badge bg-primary-subtle text-primary border border-primary-subtle rounded-pill px-2.5 py-1">Técnico</span>';
                                                        break;
                                                    case 'CLIENTE':
                                                        echo '<span class="badge bg-info-subtle text-info border border-info-subtle rounded-pill px-2.5 py-1">Cliente</span>';
                                                        break;
                                                    default:
                                                        echo '<span class="badge bg-secondary-subtle text-secondary border border-secondary-subtle rounded-pill px-2.5 py-1">Visualizador</span>';
                                                }
                                            ?>
                                        </td>
                                        
                                        <td>
                                            <?php if ($usuario['ativo']): ?>
                                                <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill px-2 py-1 small">
                                                    <i class="fas fa-circle fs-xs me-1"></i> Ativo
                                                </span>
                                            <?php else: ?>
                                                <span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill px-2 py-1 small">
                                                    <i class="fas fa-circle fs-xs me-1"></i> Inativo
                                                </span>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td class="text-secondary small">
                                            <?php if (!empty($usuario['ultimo_acesso'])): ?>
                                                <i class="far fa-clock me-1 text-muted"></i> <?= date('d/m/Y H:i', strtotime($usuario['ultimo_acesso'])) ?>
                                            <?php else: ?>
                                                <span class="text-muted italic small">Nunca acessou</span>
                                            <?php endif; ?>
                                        </td>
                                        
                                        <td class="text-center">
                                            <div class="d-flex justify-content-center gap-2">
                                                <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#modalUsuario<?= $usuario['id'] ?>" 
                                                        title="Visualizar Detalhes">
                                                    <i class="fas fa-info-circle"></i>
                                                </button>
                                                
                                                <a href="<?= BASE_URL ?>/usuarios/editar/<?= $usuario['id'] ?>" 
                                                   class="btn btn-sm btn-outline-primary rounded-pill px-3" 
                                                   title="Editar Usuário">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                
                                                <a href="<?= BASE_URL ?>/usuarios/excluir/<?= $usuario['id'] ?>" 
                                                   class="btn btn-sm btn-outline-danger rounded-pill px-3" 
                                                   onclick="return confirm('Deseja realmente excluir este usuário permanentemente?')" 
                                                   title="Excluir Usuário">
                                                    <i class="fas fa-trash-alt"></i>
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
                        <div class="icon-container d-inline-flex align-items-center justify-content-center bg-light rounded-circle mb-3" style="width: 70px; height: 70px;">
                            <i class="fas fa-users-slash text-secondary fa-2x opacity-50"></i>
                        </div>
                        <h5 class="fw-bold text-dark">Nenhum usuário cadastrado</h5>
                        <p class="small text-muted mb-4 mx-auto" style="max-width: 380px;">
                            Não encontramos registros de colaboradores integrados. Clique abaixo para registrar o primeiro acesso.
                        </p>
                        <a href="<?= BASE_URL ?>/usuarios/criar" class="btn btn-primary btn-sm rounded-pill px-4 fw-medium shadow-sm">
                            <i class="fas fa-plus-circle me-1"></i> Cadastrar Primeiro
                        </a>
                    </div>
                <?php endif; ?>

            </div>
        </div>
    </div>
</main>

<?php if (!empty($usuarios)): ?>
    <?php foreach ($usuarios as $usuario): ?>
        <div class="modal fade" id="modalUsuario<?= $usuario['id'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0 shadow-lg rounded-3">
                    <div class="modal-header border-bottom-0 pt-4 px-4 pb-2">
                        <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                            <i class="fas fa-user border p-2 bg-light rounded-3 text-secondary"></i>
                            Ficha do Usuário #<?= $usuario['id'] ?>
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body px-4 pb-4 pt-2">
                        <div class="bg-light p-3 border rounded-3 mb-3">
                            <div class="mb-2.5">
                                <small class="text-muted d-block fw-semibold text-uppercase fs-xs">Nome Completo</small>
                                <span class="text-dark fw-bold"><?= htmlspecialchars($usuario['nome']) ?></span>
                            </div>
                            <div class="mb-2.5">
                                <small class="text-muted d-block fw-semibold text-uppercase fs-xs">E-mail Corporativo</small>
                                <span class="text-dark-emphasis font-monospace"><?= htmlspecialchars($usuario['email']) ?></span>
                            </div>
                        </div>

                        <div class="row g-3">
                            <div class="col-6">
                                <div class="border rounded-3 p-2.5 bg-light-subtle">
                                    <small class="text-muted d-block fw-semibold text-uppercase fs-xs mb-1">Nível de Acesso</small>
                                    <span class="fw-semibold text-primary small"><?= htmlspecialchars($usuario['tipo']) ?></span>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="border rounded-3 p-2.5 bg-light-subtle">
                                    <small class="text-muted d-block fw-semibold text-uppercase fs-xs mb-1">Status Atual</small>
                                    <?= $usuario['ativo'] 
                                        ? '<span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill">Ativo</span>' 
                                        : '<span class="badge bg-danger-subtle text-danger border border-danger-subtle rounded-pill">Inativo</span>' ?>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="border rounded-3 p-2.5 bg-light-subtle">
                                    <small class="text-muted d-block fw-semibold text-uppercase fs-xs mb-1">Rastreamento de Último Acesso</small>
                                    <span class="text-dark small">
                                        <?php if (!empty($usuario['ultimo_acesso'])): ?>
                                            <i class="far fa-calendar-alt text-muted me-1"></i> <?= date('d/m/Y \à\s H:i', strtotime($usuario['ultimo_acesso'])) ?>
                                        <?php else: ?>
                                            <span class="text-muted italic">Nenhuma autenticação registrada</span>
                                        <?php endif; ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {
    // Inicializador Automático de Toasts
    ['toastSucesso', 'toastErro'].forEach(id => {
        const el = document.getElementById(id);
        if (el) {
            new bootstrap.Toast(el, {
                delay: id === 'toastSucesso' ? 4000 : 5000
            }).show();
        }
    });

    // Inicialização do DataTables
    const tabela = $('#tabelaUsuarios').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        order: [[0, 'desc']], 
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json"
        },
        columnDefs: [
            {
                orderable: false,
                targets: 6 
            }
        ]
    });

    // Lógica dos Filtros Customizados (Filtra por correspondência exata nas colunas 3 e 4)
    $('#filtroNivel').on('change', function () {
        tabela.column(3).search(this.value).draw();
    });

    $('#filtroStatus').on('change', function () {
        tabela.column(4).search(this.value).draw();
    });

    // Limpar filtros executando o reset nos inputs e na tabela
    $('#btnLimparFiltros').on('click', function () {
        $('#filtroNivel').val('');
        $('#filtroStatus').val('');
        tabela.columns([3, 4]).search('').draw();
    });
});
</script>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>