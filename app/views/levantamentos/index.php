<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<main class="content flex-grow-1 pt-3 px-4 pb-4 bg-light-subtle">

    <div class="container-fluid px-2 px-lg-4 mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 pb-3 border-bottom">
            <div>
                <span class="badge bg-success-subtle text-success-emphasis rounded-pill px-3 py-1.5 mb-2 fw-semibold">
                    <i class="fas fa-clipboard-check me-1"></i> Gestão Técnica
                </span>
                <h2 class="fw-bold text-dark mb-1 page-header-title">Checklists de Inspeção</h2>
                <p class="text-muted small mb-0">Gerencie e aplique questionários normativos e rotinas de fiscalização.</p>
            </div>
            <div>
                <button class="btn btn-success d-flex align-items-center gap-2 px-3 py-2 fw-semibold shadow-sm">
                    <i class="fas fa-sliders-h"></i> Criar Modelo Personalizado
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid px-2 px-lg-4 mb-4">
        <div class="card border-0 shadow-sm p-3 bg-white">
            <div class="row g-2">
                <div class="col-12 col-md-8">
                    <div class="input-group">
                        <span class="input-group-text bg-transparent border-end-0 text-muted"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control border-start-0" placeholder="Buscar por NR, norma ou título do checklist...">
                    </div>
                </div>
                <div class="col-12 col-md-4">
                    <select class="form-select">
                        <option value="">Todas as Categorias</option>
                        <option value="nr">Normas Regulamentadoras (NR)</option>
                        <option value="interna">Auditoria Interna</option>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid px-2 px-lg-4">
        <div class="row g-4">
            
            <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm bg-white position-relative">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-danger-subtle text-danger px-2.5 py-1.5 fw-bold">NR-12</span>
                            <span class="text-muted small font-monospace">v2.1</span>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Segurança em Máquinas e Equipamentos</h5>
                        <p class="text-muted small flex-grow-1">Avaliação de pontos de esmagamento, proteções mecânicas, botões de emergência e intertravamentos.</p>
                        <div class="pt-3 border-top mt-3 d-flex justify-content-between align-items-center">
                            <span class="text-secondary small fw-medium"><i class="far fa-list-alt me-1"></i> 42 Itens</span>
                            <button class="btn btn-sm btn-outline-success px-3 rounded-pill fw-semibold">Aplicar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm bg-white position-relative">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-warning-subtle text-warning-emphasis px-2.5 py-1.5 fw-bold">NR-35</span>
                            <span class="text-muted small font-monospace">v1.0</span>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Trabalho em Altura</h5>
                        <p class="text-muted small flex-grow-1">Análise de pontos de ancoragem, condições de EPIs, linhas de vida e aptidão clínica da equipe.</p>
                        <div class="pt-3 border-top mt-3 d-flex justify-content-between align-items-center">
                            <span class="text-secondary small fw-medium"><i class="far fa-list-alt me-1"></i> 28 Itens</span>
                            <button class="btn btn-sm btn-outline-success px-3 rounded-pill fw-semibold">Aplicar</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card h-100 border-0 shadow-sm bg-white position-relative">
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge bg-info-subtle text-info-emphasis px-2.5 py-1.5 fw-bold">Interno</span>
                            <span class="text-muted small font-monospace">v3.4</span>
                        </div>
                        <h5 class="fw-bold text-dark mb-2">Inspeção Geral de EPI / EPC</h5>
                        <p class="text-muted small flex-grow-1">Verificação de estoque, prazos de validade de C.A., entrega e uso efetivo nos setores operacionais.</p>
                        <div class="pt-3 border-top mt-3 d-flex justify-content-between align-items-center">
                            <span class="text-secondary small fw-medium"><i class="far fa-list-alt me-1"></i> 15 Itens</span>
                            <button class="btn btn-sm btn-outline-success px-3 rounded-pill fw-semibold">Aplicar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

</main>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>