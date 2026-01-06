<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<!-- TÍTULO DA PÁGINA -->
<div class="mb-4">
    <h3 class="fw-bold mb-1">
        <span class="text-accent">Painel Técnico</span>
    </h3>

    <p class="text-muted mb-0">
        Planejamento, quantificação e gestão de riscos ocupacionais
    </p>
</div>

<!-- ========================= -->
<!-- INDICADORES TÉCNICOS -->
<!-- ========================= -->
<div class="row g-4">

    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-project-diagram fa-2x text-primary me-3"></i>
                    <div>
                        <h6 class="mb-0">Planejamentos Ativos</h6>
                        <span class="fs-4 fw-bold">12</span>
                    </div>
                </div>
                <small class="text-muted">
                    Avaliações em execução
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-exclamation-circle fa-2x text-warning me-3"></i>
                    <div>
                        <h6 class="mb-0">Quantificação Crítica</h6>
                        <span class="fs-4 fw-bold">5</span>
                    </div>
                </div>
                <small class="text-muted">
                    Alta variabilidade ou risco elevado
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-vials fa-2x text-danger me-3"></i>
                    <div>
                        <h6 class="mb-0">Amostragem Complexa</h6>
                        <span class="fs-4 fw-bold">7</span>
                    </div>
                </div>
                <small class="text-muted">
                    Múltiplos pontos ou ciclos
                </small>
            </div>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <i class="fas fa-check-circle fa-2x text-success me-3"></i>
                    <div>
                        <h6 class="mb-0">Concluídos</h6>
                        <span class="fs-4 fw-bold">18</span>
                    </div>
                </div>
                <small class="text-muted">
                    Prontos para documentação
                </small>
            </div>
        </div>
    </div>

</div>

<!-- ========================= -->
<!-- MÓDULOS PRINCIPAIS -->
<!-- ========================= -->
<div class="row g-4 mt-4">

    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <i class="fas fa-building fa-2x text-primary mb-3"></i>
                <h5>Empresas</h5>
                <p class="text-muted">
                    Gestão das unidades, setores e ambientes avaliados.
                </p>
                <a href="<?= BASE_URL ?>/empresas" class="btn btn-outline-primary btn-sm mt-auto">
                    Acessar módulo
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <i class="fas fa-file-signature fa-2x text-warning mb-3"></i>
                <h5>Planos de Quantificação</h5>
                <p class="text-muted">
                    Definição da técnica, pontuação e estratégia de amostragem.
                </p>
                <a href="<?= BASE_URL ?>/relatorios" class="btn btn-outline-warning btn-sm mt-auto">
                    Acessar módulo
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <i class="fas fa-exclamation-triangle fa-2x text-danger mb-3"></i>
                <h5>Inventário de Riscos</h5>
                <p class="text-muted">
                    Caracterização dos agentes e critérios de avaliação.
                </p>
                <a href="<?= BASE_URL ?>/riscos" class="btn btn-outline-danger btn-sm mt-auto">
                    Acessar módulo
                </a>
            </div>
        </div>
    </div>

</div>

<!-- ========================= -->
<!-- DOCUMENTOS E CONTROLES -->
<!-- ========================= -->
<div class="row g-4 mt-4">

    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <i class="fas fa-file-medical fa-2x text-success mb-3"></i>
                <h5>Documentos Técnicos</h5>
                <p class="text-muted">
                    LTCAT, PCMSO, PPP e memoriais de avaliação.
                </p>
                <a href="<?= BASE_URL ?>/laudos" class="btn btn-outline-success btn-sm mt-auto">
                    Acessar módulo
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <i class="fas fa-hard-hat fa-2x text-secondary mb-3"></i>
                <h5>EPI / EPC</h5>
                <p class="text-muted">
                    Controle técnico vinculado aos riscos avaliados.
                </p>
                <a href="<?= BASE_URL ?>/epis" class="btn btn-outline-secondary btn-sm mt-auto">
                    Acessar módulo
                </a>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card h-100">
            <div class="card-body d-flex flex-column">
                <i class="fas fa-tools fa-2x text-dark mb-3"></i>
                <h5>Permissões de Trabalho</h5>
                <p class="text-muted">
                    Gestão de atividades críticas e controles operacionais.
                </p>
                <a href="<?= BASE_URL ?>/pets" class="btn btn-outline-dark btn-sm mt-auto">
                    Acessar módulo
                </a>
            </div>
        </div>
    </div>

</div>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>
