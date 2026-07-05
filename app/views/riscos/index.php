<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>
<link rel="stylesheet" href="<?= BASE_URL ?>/css/riscos.css">

<main class="content flex-grow-1 pt-3 px-4 pb-4 bg-light-subtle">
    <div class="container-fluid px-2 px-lg-4 mb-4">
        
        <header class="mb-4 px-4 py-3 bg-white border rounded-3 shadow-sm d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h3 class="m-0 fw-bold text-dark d-flex align-items-center gap-3" style="font-size: 1.5rem;">
                    <span class="icon-container d-flex align-items-center justify-content-center"
                        style="width: 38px; height: 38px; background: linear-gradient(135deg, #0d6efd, #0a58ca); border-radius: 8px; box-shadow: 0 2px 6px rgba(13, 110, 253, 0.2);">
                        <i class="fas fa-shield-alt text-white" style="font-size: 1.10rem;"></i>
                    </span>
                    Riscos Ocupacionais
                </h3>
                <small class="text-muted d-block mt-1">Selecione uma categoria abaixo para monitorar, mitigar e gerenciar os riscos.</small>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="<?= BASE_URL ?>/dashboard" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-medium">
                    <i class="fas fa-arrow-left me-1"></i> Dashboard
                </a>
            </div>
        </header>

        <div class="row g-4 riscos-grid">
            <?php
            $tiposDeRisco = [
                'Físicos' => [
                    'rota' => 'fisicos',
                    'gradiente' => 'linear-gradient(135deg, #198754, #146c43)', // Verde
                    'sombra' => 'rgba(25, 135, 84, 0.25)',
                    'icone' => 'fa-wind',
                    'detalhe' => 'Ruídos, vibrações, pressões anormais, temperaturas extremas e radiações.'
                ],
                'Químicos' => [
                    'rota' => 'quimicos',
                    'gradiente' => 'linear-gradient(135deg, #dc3545, #b02a37)', // Vermelho
                    'sombra' => 'rgba(220, 53, 69, 0.25)',
                    'icone' => 'fa-flask',
                    'detalhe' => 'Poeiras, fumos, névoas, gases ou vapores tóxicos e produtos químicos.'
                ],
                'Biológicos' => [
                    'rota' => 'biologicos',
                    'gradiente' => 'linear-gradient(135deg, #795548, #5d4037)', // Marrom
                    'sombra' => 'rgba(121, 85, 72, 0.25)',
                    'icone' => 'fa-virus',
                    'detalhe' => 'Vírus, bactérias, protozoários, fungos, parasitas e microorganismos patogênicos.'
                ],
                'Ergonômicos' => [
                    'rota' => 'ergonomicos',
                    'gradiente' => 'linear-gradient(135deg, #ffc107, #ff9800)', // Amarelo
                    'sombra' => 'rgba(255, 193, 7, 0.25)',
                    'icone' => 'fa-chair',
                    'detalhe' => 'Esforço físico intenso, postura inadequada, repetitividade e transporte de peso.'
                ],
                'Acidentes' => [
                    'rota' => 'acidentes',
                    'gradiente' => 'linear-gradient(135deg, #0d6efd, #0a58ca)', // Azul
                    'sombra' => 'rgba(13, 110, 253, 0.25)',
                    'icone' => 'fa-exclamation-triangle',
                    'detalhe' => 'Arranjo físico deficiente, máquinas sem proteção, iluminação e riscos elétricos.'
                ],
                'Psicossociais' => [
                    'rota' => 'psicossociais',
                    'gradiente' => 'linear-gradient(135deg, #6c757d, #495057)', // Cinza Escuro
                    'sombra' => 'rgba(108, 117, 125, 0.25)',
                    'icone' => 'fa-brain',
                    'detalhe' => 'Estresse ocupacional, sobrecarga, jornadas excessivas e assédios organizacionais.'
                ],
            ];
            ?>

            <?php foreach ($tiposDeRisco as $nome => $info): ?>
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm rounded-3 bg-white position-relative overflow-hidden">
                        <div style="height: 4px; background: <?= $info['gradiente'] ?>;"></div>
                        <div class="card-body p-4 d-flex flex-column">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <div class="d-flex align-items-center justify-content-center text-white rounded-3"
                                     style="width: 42px; height: 42px; background: <?= $info['gradiente'] ?>; box-shadow: 0 3px 8px <?= $info['sombra'] ?>;">
                                    <i class="fas <?= $info['icone'] ?> fs-5"></i>
                                </div>
                                <a href="<?= BASE_URL ?>/riscos/listar/<?= $info['rota'] ?>" class="stretched-link text-decoration-none">
                                    <span class="text-secondary small fw-medium">
                                        Gerenciar <i class="fas fa-arrow-right ms-1"></i>
                                    </span>
                                </a>
                            </div>
                            <h5 class="fw-bold text-dark mb-2"><?= htmlspecialchars($nome) ?></h5>
                            <p class="text-muted small flex-grow-1 mb-4"><?= htmlspecialchars($info['detalhe']) ?></p>
                            <div class="pt-3 border-top d-flex justify-content-between align-items-center text-muted">
                                <span class="small fw-medium"><i class="far fa-folder-open"></i> Ver Cadastros</span>
                                <span class="badge border rounded-pill px-2.5 py-1 small fw-semibold" style="color: #666;">Configurar</span>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</main>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>