<?php require_once dirname(__DIR__) . '../templates/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>/css/usuarios.css">

<main class="content flex-grow-1 p-4">

    <!-- TOASTS -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">

        <?php if (!empty($_SESSION['sucesso'])) : ?>

            <div id="toastSucesso"
                class="toast align-items-center text-bg-success border-0 shadow-lg"
                role="alert">

                <div class="d-flex">

                    <div class="toast-body">
                        <i class="fas fa-circle-check me-2"></i>
                        <?= $_SESSION['sucesso']; ?>
                    </div>

                    <button type="button"
                            class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast">
                    </button>

                </div>

            </div>

            <?php unset($_SESSION['sucesso']); ?>

        <?php endif; ?>

        <?php if (!empty($_SESSION['erro'])) : ?>

            <div id="toastErro"
                class="toast align-items-center text-bg-danger border-0 shadow-lg"
                role="alert">

                <div class="d-flex">

                    <div class="toast-body">
                        <i class="fas fa-circle-exclamation me-2"></i>
                        <?= $_SESSION['erro']; ?>
                    </div>

                    <button type="button"
                            class="btn-close btn-close-white me-2 m-auto"
                            data-bs-dismiss="toast">
                    </button>

                </div>

            </div>

            <?php unset($_SESSION['erro']); ?>

        <?php endif; ?>

    </div>

    <!-- ALERTAS
    <?php //if (!empty($_SESSION['sucesso'])) : ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            <?= $_SESSION['sucesso']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php //unset($_SESSION['sucesso']); ?>
    <?php //endif; ?>

    <?php //if (!empty($_SESSION['erro'])) : ?>
        <div class="alert alert-danger alert-dismissible fade show shadow-sm" role="alert">
            <i class="fas fa-exclamation-circle me-2"></i>
            <?= $_SESSION['erro']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php unset($_SESSION['erro']); ?>
    <?php //endif; ?> -->

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

        <a href="<?= BASE_URL ?>/usuarios/criar"
           class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-2"></i>
            Novo Usuário
        </a>

    </div>

    <!-- FILTROS -->
    <div class="card border-0 shadow-sm mb-4">
        <div class="card-body">

            <div class="row g-3">

                <div class="col-lg-4">
                    <label class="form-label fw-semibold">
                        Buscar
                    </label>

                    <input type="text"
                           class="form-control"
                           placeholder="Nome ou e-mail">
                </div>

                <div class="col-lg-3">
                    <label class="form-label fw-semibold">
                        Tipo
                    </label>

                    <select class="form-select">
                        <option value="">Todos</option>
                        <option>Administrador</option>
                        <option>Técnico</option>
                        <option>Cliente</option>
                        <option>Visualizador</option>
                    </select>
                </div>

                <div class="col-lg-3">
                    <label class="form-label fw-semibold">
                        Status
                    </label>

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
                            <th width="160" class="text-center">
                                Ações
                            </th>
                        </tr>

                    </thead>

                    <tbody>

                        <?php if (!empty($usuarios)) : ?>

                            <?php foreach ($usuarios as $usuario) : ?>

                                <tr>

                                    <!-- ID -->
                                    <td class="fw-semibold text-muted">
                                        #<?= $usuario['id'] ?>
                                    </td>

                                    <!-- USUÁRIO -->
                                    <td style="min-width: 240px;">

                                        <div class="d-flex align-items-center gap-3">

                                            <!-- Avatar 
                                            <div class="avatar-user flex-shrink-0">
                                                <?= strtoupper(substr($usuario['nome'], 0, 2)) ?>
                                            </div> -->

                                            <!-- Nome -->
                                            <div class="overflow-hidden">

                                                <div class="fw-semibold text-truncate">
                                                    <?= htmlspecialchars($usuario['nome']) ?>
                                                </div>

                                            </div>

                                        </div>

                                    </td>

                                    <!-- EMAIL -->
                                    <td>
                                        <?= htmlspecialchars($usuario['email']) ?>
                                    </td>

                                    <!-- TIPO -->
                                    <td>

                                        <span class="badge bg-primary-subtle text-primary px-3 py-2 rounded-pill">
                                            <?= htmlspecialchars($usuario['tipo']) ?>
                                        </span>

                                    </td>

                                    <!-- STATUS -->
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

                                    <!-- ÚLTIMO ACESSO -->
                                    <td>

                                        <?php if (!empty($usuario['ultimo_acesso'])) : ?>

                                            <?= date('d/m/Y H:i', strtotime($usuario['ultimo_acesso'])) ?>

                                        <?php else : ?>

                                            <span class="text-muted">
                                                Nunca acessou
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <!-- AÇÕES -->
                                    <td>

                                        <div class="d-flex justify-content-center gap-2">

                                            <!-- EDITAR -->
                                            <a href="<?= BASE_URL ?>/usuarios/editar/<?= $usuario['id'] ?>"
                                               class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                               title="Editar">

                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <!-- EXCLUIR -->
                                            <a href="<?= BASE_URL ?>/usuarios/excluir/<?= $usuario['id'] ?>"
                                               class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                               title="Excluir"
                                               onclick="return confirm('Deseja realmente excluir este usuário?')">

                                                <i class="fas fa-trash"></i>
                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            <?php endforeach; ?>

                        <?php else : ?>

                            <tr>
                                <td colspan="6" class="text-center py-5">

                                    <div class="text-muted">

                                        <i class="fas fa-users fa-3x mb-3 opacity-50"></i>

                                        <p class="mb-0">
                                            Nenhum usuário cadastrado.
                                        </p>

                                    </div>

                                </td>
                            </tr>

                        <?php endif; ?>

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</main>

<script>

document.addEventListener('DOMContentLoaded', function () {

    const toastSucesso = document.getElementById('toastSucesso');

    if (toastSucesso) {

        const toast = new bootstrap.Toast(toastSucesso, {
            delay: 4000
        });

        toast.show();
    }

    const toastErro = document.getElementById('toastErro');

    if (toastErro) {

        const toast = new bootstrap.Toast(toastErro, {
            delay: 5000
        });

        toast.show();
    }

});

</script>

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>