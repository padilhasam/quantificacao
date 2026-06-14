<?php require_once dirname(__DIR__) . '../templates/header.php'; ?>

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

    <!-- HEADER -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                <i class="fas fa-users me-2 text-primary"></i>
                Usuários
            </h3>
            <p class="text-muted mb-0">
                Gerenciamento de usuários e permissões do sistema
            </p>
        </div>

        <a href="<?= BASE_URL ?>/usuarios/criar" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-2"></i>
            Novo Usuário
        </a>

    </div>

    <!-- FILTROS -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <div class="row g-3">

                <div class="col-lg-4">
                    <label class="form-label fw-semibold">Buscar</label>
                    <input type="text" class="form-control" placeholder="Nome ou e-mail">
                </div>

                <div class="col-lg-3">
                    <label class="form-label fw-semibold">Tipo</label>
                    <select class="form-select">
                        <option value="">Todos</option>
                        <option>Administrador</option>
                        <option>Técnico</option>
                        <option>Cliente</option>
                        <option>Visualizador</option>
                    </select>
                </div>

                <div class="col-lg-3">
                    <label class="form-label fw-semibold">Status</label>
                    <select class="form-select">
                        <option value="">Todos</option>
                        <option>Ativo</option>
                        <option>Inativo</option>
                    </select>
                </div>

                <div class="col-lg-2 d-flex align-items-end">
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
                            <th>Id</th>
                            <th>Usuário</th>
                            <th>E-mail</th>
                            <th>Tipo</th>
                            <th>Status</th>
                            <th>Último acesso</th>
                            <th width="180" class="text-center">Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                        <?php foreach ($usuarios as $usuario) : ?>

                            <tr>

                                <td class="fw-semibold text-muted">
                                    #<?= $usuario['id'] ?>
                                </td>

                                <td class="fw-semibold">
                                    <?= htmlspecialchars($usuario['nome']) ?>
                                </td>

                                <td>
                                    <?= htmlspecialchars($usuario['email']) ?>
                                </td>

                                <td>
                                    <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                        <?= htmlspecialchars($usuario['tipo']) ?>
                                    </span>
                                </td>

                                <td>
                                    <?php if ($usuario['ativo']) : ?>
                                        <span class="badge bg-success-subtle text-success px-3 py-2 rounded-pill">
                                            Ativo
                                        </span>
                                    <?php else : ?>
                                        <span class="badge bg-danger-subtle text-danger px-3 py-2 rounded-pill">
                                            Inativo
                                        </span>
                                    <?php endif; ?>
                                </td>

                                <td>
                                    <?= !empty($usuario['ultimo_acesso'])
                                        ? date('d/m/Y H:i', strtotime($usuario['ultimo_acesso']))
                                        : '<span class="text-muted">Nunca acessou</span>' ?>
                                </td>

                                <td>
                                    <div class="d-flex justify-content-center gap-2">

                                        <!-- INFO -->
                                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                                data-bs-toggle="modal"
                                                data-bs-target="#modalUsuario<?= $usuario['id'] ?>">
                                            <i class="fas fa-circle-info"></i>
                                        </button>

                                        <!-- EDITAR -->
                                        <a href="<?= BASE_URL ?>/usuarios/editar/<?= $usuario['id'] ?>"
                                           class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                            <i class="fas fa-edit"></i>
                                        </a>

                                        <!-- EXCLUIR -->
                                        <a href="<?= BASE_URL ?>/usuarios/excluir/<?= $usuario['id'] ?>"
                                           class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                           onclick="return confirm('Deseja realmente excluir este usuário?')">
                                            <i class="fas fa-trash"></i>
                                        </a>

                                    </div>
                                </td>

                            </tr>

                        <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</main>

<!-- =========================
     MODAIS DE USUÁRIOS
========================= -->
<?php foreach ($usuarios as $usuario) : ?>

<div class="modal fade" id="modalUsuario<?= $usuario['id'] ?>" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">

            <div class="modal-header">
                <h5 class="modal-title">
                    <i class="fas fa-user me-2 text-primary"></i>
                    Detalhes do Usuário
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body">

                <p><strong>Nome:</strong> <?= htmlspecialchars($usuario['nome']) ?></p>
                <p><strong>E-mail:</strong> <?= htmlspecialchars($usuario['email']) ?></p>
                <p><strong>Tipo:</strong> <?= htmlspecialchars($usuario['tipo']) ?></p>

                <p><strong>Status:</strong>
                    <?= $usuario['ativo']
                        ? '<span class="badge bg-success">Ativo</span>'
                        : '<span class="badge bg-danger">Inativo</span>' ?>
                </p>

                <p><strong>Último acesso:</strong><br>
                    <td>
                        <?php if (!empty($usuario['ultimo_acesso'])): ?>
                            <?= date('d/m/Y H:i', strtotime($usuario['ultimo_acesso'])) ?>
                        <?php else: ?>
                            <span class="text-muted">Nunca acessou</span>
                        <?php endif; ?>
                    </td>
                </p>

            </div>

            <div class="modal-footer">
                <button class="btn btn-outline-secondary" data-bs-dismiss="modal">
                    Fechar
                </button>
            </div>

        </div>
    </div>
</div>

<?php endforeach; ?>

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

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>