<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<main class="content flex-grow-1 p-4">

    <!-- HEADER PADRÃO -->
    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

        <div>
            <h3 class="fw-bold mb-1">
                <i class="fas fa-exclamation-triangle me-2 text-warning"></i>
                Riscos Ocupacionais
            </h3>
            <p class="text-muted mb-0">
                Selecione uma categoria para gerenciar os riscos do sistema
            </p>
        </div>

    </div>

    <!-- CARDS -->
    <div class="row g-4">

        <?php
        $tiposDeRisco = [
            'Físicos' => [
                'rota' => 'fisicos',
                'classe' => 'border-primary',
                'icone' => 'fa-wind',
                'cor' => 'text-primary'
            ],
            'Químicos' => [
                'rota' => 'quimicos',
                'classe' => 'border-danger',
                'icone' => 'fa-flask',
                'cor' => 'text-danger'
            ],
            'Biológicos' => [
                'rota' => 'biologicos',
                'classe' => 'border-success',
                'icone' => 'fa-virus',
                'cor' => 'text-success'
            ],
            'Ergonômicos' => [
                'rota' => 'ergonomicos',
                'classe' => 'border-info',
                'icone' => 'fa-chair',
                'cor' => 'text-info'
            ],
            'Acidentes' => [
                'rota' => 'acidentes',
                'classe' => 'border-warning',
                'icone' => 'fa-triangle-exclamation',
                'cor' => 'text-warning'
            ],
            'Psicossociais' => [
                'rota' => 'psicossociais',
                'classe' => 'border-dark',
                'icone' => 'fa-brain',
                'cor' => 'text-dark'
            ],
        ];
        ?>

        <?php foreach ($tiposDeRisco as $nome => $info): ?>

            <div class="col-12 col-md-6 col-lg-4">

                <a href="<?= BASE_URL ?>/riscos/<?= $info['rota'] ?>"
                   class="text-decoration-none">

                    <div class="card h-100 shadow-sm border-0 risco-card <?= $info['classe'] ?>">

                        <div class="card-body d-flex flex-column">

                            <div class="d-flex align-items-center mb-3">

                                <div class="icon-box me-3">
                                    <i class="fas <?= $info['icone'] ?> fa-lg <?= $info['cor'] ?>"></i>
                                </div>

                                <h5 class="mb-0 fw-bold">
                                    <?= htmlspecialchars($nome) ?>
                                </h5>

                            </div>

                            <p class="text-muted small flex-grow-1">
                                Gerenciar riscos ocupacionais do tipo <strong><?= htmlspecialchars($nome) ?></strong>
                                com controle detalhado e organização por categoria.
                            </p>

                            <div class="mt-auto">
                                <span class="btn btn-sm btn-outline-primary w-100">
                                    Acessar categoria
                                </span>
                            </div>

                        </div>

                    </div>

                </a>

            </div>

        <?php endforeach; ?>

    </div>

</main>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>