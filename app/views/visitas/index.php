<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<main class="content flex-grow-1 pt-3 px-4 pb-4 bg-light-subtle">

    <div class="container-fluid px-2 px-lg-4 mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 pb-3 border-bottom">
            <div>
                <span class="badge bg-primary-subtle text-primary-emphasis rounded-pill px-3 py-1.5 mb-2 fw-semibold">
                    <i class="fas fa-calendar-check me-1"></i> Gestão Técnica
                </span>
                <h2 class="fw-bold text-dark mb-1 page-header-title">Visitas Técnicas</h2>
                <p class="text-muted small mb-0">Agende, monitore e registre as inspeções de campo nas unidades de trabalho.</p>
            </div>
            <div>
                <button class="btn btn-primary d-flex align-items-center gap-2 px-3 py-2 fw-semibold shadow-sm">
                    <i class="fas fa-plus"></i> Agendar Nova Visita
                </button>
            </div>
        </div>
    </div>

    <div class="container-fluid px-2 px-lg-4 mb-4">
        <div class="row g-3">
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 bg-white rounded-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-medium d-block mb-1">Este Mês</span>
                            <h3 class="fw-bold text-dark mb-0">12</h3>
                        </div>
                        <div class="p-3 bg-primary-subtle text-primary rounded-3 fs-4"><i class="fas fa-calendar-alt"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 bg-white rounded-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-medium d-block mb-1">Pendentes</span>
                            <h3 class="fw-bold text-warning mb-0">4</h3>
                        </div>
                        <div class="p-3 bg-warning-subtle text-warning rounded-3 fs-4"><i class="fas fa-clock"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 bg-white rounded-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-medium d-block mb-1">Realizadas</span>
                            <h3 class="fw-bold text-success mb-0">8</h3>
                        </div>
                        <div class="p-3 bg-success-subtle text-success rounded-3 fs-4"><i class="fas fa-check-circle"></i></div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-sm-6 col-xl-3">
                <div class="card border-0 shadow-sm p-3 bg-white rounded-3">
                    <div class="d-flex align-items-center justify-content-between">
                        <div>
                            <span class="text-muted small fw-medium d-block mb-1">Canceladas</span>
                            <h3 class="fw-bold text-danger mb-0">0</h3>
                        </div>
                        <div class="p-3 bg-danger-subtle text-danger rounded-3 fs-4"><i class="fas fa-times-circle"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid px-2 px-lg-4">
        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light text-secondary small fw-semibold">
                            <tr>
                                <th class="ps-4">Empresa / Unidade</th>
                                <th>Técnico Responsável</th>
                                <th>Data Programada</th>
                                <th>Status</th>
                                <th class="text-end pe-4">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="text-dark">
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold">Nexus Indústria S.A.</div>
                                    <span class="text-muted small">Planta Industrial - Galpão 02</span>
                                </td>
                                <td>Carlos Eduardo (Segurança)</td>
                                <td>24/06/2026</td>
                                <td><span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-2.5 py-1">Pendente</span></td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-outline-secondary me-1" title="Editar"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-sm btn-success" title="Iniciar Checklist"><i class="fas fa-play"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td class="ps-4">
                                    <div class="fw-bold">Logix Transportes</div>
                                    <span class="text-muted small">Matriz - Setor Logístico</span>
                                </td>
                                <td>Mariana Souza (Ergonomista)</td>
                                <td>10/06/2026</td>
                                <td><span class="badge bg-success-subtle text-success-emphasis rounded-pill px-2.5 py-1">Realizada</span></td>
                                <td class="text-end pe-4">
                                    <button class="btn btn-sm btn-outline-primary me-1" title="Ver Relatório"><i class="fas fa-file-alt"></i></button>
                                    <button class="btn btn-sm btn-outline-secondary" title="Opções"><i class="fas fa-ellipsis-v"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</main>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>