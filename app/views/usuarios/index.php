<?php require_once dirname(__DIR__) . '../templates/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>/css/usuarios.css">

<main class="content flex-grow-1 p-4">

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
                        <option>Usuário</option>
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

                                    <td>
                                        <div class="d-flex align-items-center gap-2">

                                            <div class="avatar-user">
                                                <?= strtoupper(substr($usuario['nome'], 0, 2)) ?>
                                            </div>

                                            <div>
                                                <div class="fw-semibold">
                                                    <?= htmlspecialchars($usuario['nome']) ?>
                                                </div>

                                                <small class="text-muted">
                                                    ID #<?= $usuario['id'] ?>
                                                </small>
                                            </div>

                                        </div>
                                    </td>

                                    <td>
                                        <?= htmlspecialchars($usuario['email']) ?>
                                    </td>

                                    <td>
                                        <span class="badge bg-primary-subtle text-primary">
                                            <?= htmlspecialchars($usuario['tipo']) ?>
                                        </span>
                                    </td>

                                    <td>

                                        <?php if ($usuario['ativo']) : ?>

                                            <span class="badge bg-success">
                                                Ativo
                                            </span>

                                        <?php else : ?>

                                            <span class="badge bg-danger">
                                                Inativo
                                            </span>

                                        <?php endif; ?>

                                    </td>

                                    <td>
                                        <?= $usuario['ultimo_acesso'] ?? '-' ?>
                                    </td>

                                    <td>

                                        <div class="d-flex justify-content-center gap-2">

                                            <a href="<?= BASE_URL ?>/usuarios/editar/<?= $usuario['id'] ?>"
                                               class="btn btn-sm btn-outline-primary"
                                               title="Editar">

                                                <i class="fas fa-edit"></i>
                                            </a>

                                            <a href="<?= BASE_URL ?>/usuarios/excluir/<?= $usuario['id'] ?>"
                                               class="btn btn-sm btn-outline-danger"
                                               title="Excluir">

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

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>