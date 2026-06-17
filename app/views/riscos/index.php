<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>
<link rel="stylesheet" href="<?= BASE_URL ?>/css/riscos.css">

<main class="content flex-grow-1 pt-3 px-4 pb-4 bg-light-subtle">

    <div class="container-fluid px-2 px-lg-4 mb-4">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 pb-3 border-bottom">
            <div>
                <span class="badge bg-warning-subtle text-warning-emphasis rounded-pill px-3 py-1.5 mb-2 fw-semibold">
                    <i class="fas fa-shield-alt me-1"></i> Segurança do Trabalho
                </span>
                <h2 class="fw-bold text-dark mb-1 page-header-title">
                    Riscos Ocupacionais
                </h2>
                <p class="text-muted small mb-0">
                    Selecione uma categoria abaixo para monitorar, mitigar e gerenciar os riscos cadastrados.
                </p>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row g-4 riscos-grid px-2 px-lg-4">

            <?php
            $tiposDeRisco = [
                'Físicos' => [
                    'rota' => 'fisicos',
                    'bg_linha' => 'bg-primary',
                    'classe_icone' => 'bg-soft-primary',
                    'icone' => 'fa-wind',
                    'detalhe' => 'Ruídos, vibrações, temperaturas extremas e radiações.'
                ],
                'Químicos' => [
                    'rota' => 'quimicos',
                    'bg_linha' => 'bg-danger',
                    'classe_icone' => 'bg-soft-danger',
                    'icone' => 'fa-flask',
                    'detalhe' => 'Poeiras, fumos, névoas, gases ou vapores tóxicos.'
                ],
                'Biológicos' => [
                    'rota' => 'biologicos',
                    'bg_linha' => 'bg-success',
                    'classe_icone' => 'bg-soft-success',
                    'icone' => 'fa-virus',
                    'detalhe' => 'Vírus, bactérias, protozoários, fungos e parasitas.'
                ],
                'Ergonômicos' => [
                    'rota' => 'ergonomicos',
                    'bg_linha' => 'bg-info',
                    'classe_icone' => 'bg-soft-info',
                    'icone' => 'fa-chair',
                    'detalhe' => 'Esforço físico intenso, postura inadequada e repetitividade.'
                ],
                'Acidentes' => [
                    'rota' => 'acidentes',
                    'bg_linha' => 'bg-warning',
                    'classe_icone' => 'bg-soft-warning',
                    'icone' => 'fa-exclamation-triangle',
                    'detalhe' => 'Arranjo físico deficiente, máquinas sem proteção e iluminação.'
                ],
                'Psicossociais' => [
                    'rota' => 'psicossociais',
                    'bg_linha' => 'bg-dark',
                    'classe_icone' => 'bg-soft-dark',
                    'icone' => 'fa-brain',
                    'detalhe' => 'Estresse ocupacional, jornadas excessivas e assédio.'
                ],
            ];
            ?>

            <?php foreach ($tiposDeRisco as $nome => $info): ?>

                <div class="col-12 col-md-6 col-lg-4">
                    
                    <div class="card h-100 shadow-sm risco-card bg-white position-relative">
                        <div class="card-top-line <?= $info['bg_linha'] ?>"></div>

                        <div class="card-body p-4 d-flex flex-column">
                            
                            <div class="d-flex align-items-start justify-content-between mb-3">
                                <div class="modern-icon-box <?= $info['classe_icone'] ?>">
                                    <i class="fas <?= $info['icone'] ?>"></i>
                                </div>
                                
                                <a href="<?= BASE_URL ?>/riscos/<?= $info['rota'] ?>" class="stretched-link text-decoration-none">
                                    <span class="text-muted small go-arrow">
                                        Gerenciar <i class="fas fa-arrow-right ms-1 text-secondary"></i>
                                    </span>
                                </a>
                            </div>

                            <h5 class="fw-bold text-dark mb-2 central-card-title">
                                <?= htmlspecialchars($nome) ?>
                            </h5>
                            
                            <p class="text-muted small flex-grow-1 mb-4 central-card-text">
                                <?= htmlspecialchars($info['detalhe']) ?>
                            </p>

                            <div class="pt-3 border-top d-flex justify-content-between align-items-center text-muted card-footer-metrics">
                                <span class="d-flex align-items-center gap-1">
                                    <i class="far fa-folder-open text-secondary"></i> Ver Cadastros
                                </span>
                                <span class="badge bg-light text-dark border rounded-pill px-2.5 py-1 font-monospace">
                                    Configurar
                                </span>
                            </div>

                        </div>
                    </div>

                </div>

            <?php endforeach; ?>

        </div>
    </div>

</main>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>