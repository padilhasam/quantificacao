<?php require_once __DIR__ . '/../templates/header.php'; ?>

<div class="page-container">

    <div class="page-header">
        <h1>Checklist de Levantamento de Riscos</h1>
        <p>Visita técnica em andamento</p>
    </div>

    <div class="card">
        <h2>Dados da Visita</h2>

        <p><strong>Empresa:</strong> <?= htmlspecialchars($checklist['empresa_nome']) ?></p>
        <p><strong>CNPJ:</strong> <?= htmlspecialchars($checklist['empresa_cnpj']) ?></p>

        <p><strong>Unidade:</strong> <?= htmlspecialchars($checklist['unidade_nome'] ?? 'Não informada') ?></p>
        <p><strong>CNPJ Unidade:</strong> <?= htmlspecialchars($checklist['unidade_cnpj'] ?? 'Não informado') ?></p>

        <p><strong>Data:</strong> <?= date('d/m/Y', strtotime($checklist['data_visita'])) ?></p>
        <p><strong>Hora:</strong> <?= substr($checklist['hora_visita'], 0, 5) ?></p>

        <p><strong>Responsável pelo acompanhamento:</strong> <?= htmlspecialchars($checklist['responsavel_acompanhamento'] ?? '') ?></p>
        <p><strong>Status:</strong> <?= htmlspecialchars($checklist['status']) ?></p>
    </div>

    <div class="tabs-checklist">
        <a href="#" class="tab active">1. Dados</a>
        <a href="#" class="tab">2. Hierarquia</a>
        <a href="#" class="tab">3. GHE / Riscos</a>
        <a href="#" class="tab">4. EPI / EPC</a>
        <a href="#" class="tab">5. Evidências</a>
        <a href="#" class="tab">6. Quantificações</a>
        <a href="#" class="tab">7. Não Conformidades</a>
        <a href="#" class="tab">8. Assinaturas</a>
    </div>

</div>

<?php require_once __DIR__ . '/../templates/footer.php'; ?>