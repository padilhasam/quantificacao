<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<div class="container mt-4">
    <h2>Bem-vindo, <?= htmlspecialchars($usuario) ?>!</h2>
    <p>Você está logado no sistema.</p>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-building"></i> Empresas</h5>
                    <p class="card-text">Gerencie as empresas cadastradas.</p>
                    <a href="<?= BASE_URL ?>/empresas" class="btn btn-light btn-sm">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-info mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users"></i> Usuários</h5>
                    <p class="card-text">Controle de acesso ao sistema.</p>
                    <a href="<?= BASE_URL ?>/usuarios" class="btn btn-light btn-sm">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-file-alt"></i> Relatórios</h5>
                    <p class="card-text">Visualize e emita relatórios técnicos.</p>
                    <a href="<?= BASE_URL ?>/relatorios" class="btn btn-light btn-sm">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-exclamation-triangle"></i> Riscos Ocupacionais</h5>
                    <p class="card-text">Gerencie os riscos ocupacionais por categoria.</p>
                    <a href="<?= BASE_URL ?>/riscos" class="btn btn-light btn-sm">Acessar</a>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>