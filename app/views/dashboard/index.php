<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<div class="container mt-4">
    <h2>Bem-vindo, <?= htmlspecialchars($usuario) ?>!</h2>
    <p>Você está logado no sistema.</p>

    <!-- Linha 1: Funcionalidades principais -->
    <div class="row mt-4">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-primary h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-building me-2"></i>Empresas</h5>
                    <p class="card-text">Gerencie as empresas cadastradas.</p>
                    <a href="<?= BASE_URL ?>/empresas" class="btn btn-light btn-sm">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-secondary h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-users me-2"></i>Usuários</h5>
                    <p class="card-text">Controle de acesso ao sistema.</p>
                    <a href="<?= BASE_URL ?>/usuarios" class="btn btn-light btn-sm">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-warning h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-file-alt me-2"></i>Relatórios</h5>
                    <p class="card-text">Visualize e emita relatórios técnicos.</p>
                    <a href="<?= BASE_URL ?>/relatorios" class="btn btn-light btn-sm">Acessar</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Linha 2: Riscos e Documentos -->
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card text-white bg-danger h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-exclamation-triangle me-2"></i>Riscos Ocupacionais</h5>
                    <p class="card-text">Gerencie os riscos ocupacionais por categoria.</p>
                    <a href="<?= BASE_URL ?>/riscos" class="btn btn-light btn-sm">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-success h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-chalkboard-teacher me-2"></i>Treinamentos</h5>
                    <p class="card-text">Gerencie treinamentos obrigatórios por função ou colaborador.</p>
                    <a href="<?= BASE_URL ?>/treinamentos" class="btn btn-light btn-sm">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white bg-info h-100">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-file-medical-alt me-2"></i>Laudos</h5>
                    <p class="card-text">Cadastre e consulte laudos técnicos como LTCAT, PCMSO, PPP etc.</p>
                    <a href="<?= BASE_URL ?>/laudos" class="btn btn-light btn-sm">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white" style="background-color: #b87217ff;"> <!-- Azul mais escuro -->
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-hard-hat me-2"></i>EPIs</h5>
                    <p class="card-text">Crie e consulte as fichas de EPI</p>
                    <a href="<?= BASE_URL ?>/epis" class="btn btn-light btn-sm">Acessar</a>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card text-white" style="background-color: #6f42c1;"> <!-- Roxo moderno (Bootstrap purple) -->
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-tools me-2"></i>PETs</h5>
                    <p class="card-text">Crie e gerencie as Permissões de Trabalho.</p>
                    <a href="<?= BASE_URL ?>/pets" class="btn btn-light btn-sm">Acessar</a>
                </div>
            </div>
        </div>

    </div>
</div>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>