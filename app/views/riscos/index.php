<?php require_once dirname(__DIR__) . '../templates/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>/css/riscos.css">

<div class="container mt-4">
    <h2><i class="fas fa-exclamation-triangle"></i> Riscos Ocupacionais</h2>
    <p>Escolha a categoria de risco para gerenciar os riscos ocupacionais.</p>

    <div class="row mt-4">

        <?php
        $tiposDeRisco = [
            'Físicos' => ['rota' => 'fisicos', 'classe' => 'fisicos'],
            'Químicos' => ['rota' => 'quimicos', 'classe' => 'quimicos'],
            'Biológicos' => ['rota' => 'biologicos', 'classe' => 'biologicos'],
            'Ergonômicos' => ['rota' => 'ergonomicos', 'classe' => 'ergonomicos'],
            'Acidentes' => ['rota' => 'acidente', 'classe' => 'acidentes'],
            'Psicossociais' => ['rota' => 'psicossociais', 'classe' => 'psicossociais'],
        ];
        ?>

        <?php foreach ($tiposDeRisco as $nome => $info): ?>
            <div class="col-md-4">
                <div class="card mb-3 border-dark <?= $info['classe'] ?>">
                    <div class="card-body">
                        <h5 class="card-title"><?= htmlspecialchars($nome) ?></h5>
                        <p class="card-text">Gerenciar riscos do tipo <strong><?= htmlspecialchars($nome) ?></strong>.</p>
                        <a href="<?= BASE_URL ?>/riscos/<?= $info['rota'] ?>" class="btn btn-outline-primary btn-sm">Acessar</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</div>

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>
