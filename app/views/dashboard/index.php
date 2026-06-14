<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<main class="content p-4">

    <!-- ========================= -->
    <!-- CABEÇALHO -->
    <!-- ========================= -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1">
            <span class="text-accent">Painel Técnico SST</span>
        </h3>
        <p class="text-muted mb-0">
            Visão operacional: visitas, riscos e pendências técnicas
        </p>
    </div>

    <!-- ========================= -->
    <!-- ALERTAS CRÍTICOS -->
    <!-- ========================= -->
    <?php if (!empty($acima_lt)): ?>
        <div class="alert alert-danger">
            ⚠️ <strong><?= $acima_lt ?></strong> medições acima do limite de tolerância
        </div>
    <?php endif; ?>

    <?php if (!empty($nao_conformidades)): ?>
        <div class="alert alert-warning">
            ⚠️ <strong><?= $nao_conformidades ?></strong> não conformidades pendentes
        </div>
    <?php endif; ?>

    <!-- ========================= -->
    <!-- KPIs PRINCIPAIS -->
    <!-- ========================= -->
    <div class="row g-4">

        <!-- VISITAS DO DIA -->
        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-day fa-2x text-primary mb-2"></i>
                    <h6 class="mb-1">Visitas hoje</h6>
                    <span class="fs-3 fw-bold"><?= $visitas_hoje ?? 0 ?></span>
                </div>
            </div>
        </div>

        <!-- VISITAS TOTAIS -->
        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-calendar-check fa-2x text-primary mb-2"></i>
                    <h6 class="mb-1">Visitas no mês</h6>
                    <span class="fs-3 fw-bold"><?= $visitas_mes_total ?? 0 ?></span>
                </div>
            </div>
        </div>

        <!-- QUANTIFICAÇÕES PENDENTES -->
        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-vials fa-2x text-warning mb-2"></i>
                    <h6 class="mb-1">Quantificações pendentes</h6>
                    <span class="fs-3 fw-bold"><?= $quantificacoes_pendentes ?? 0 ?></span>
                </div>
            </div>
        </div>

        <!-- NÃO CONFORMIDADES -->
        <div class="col-md-3">
            <div class="card shadow-sm h-100">
                <div class="card-body text-center">
                    <i class="fas fa-times-circle fa-2x text-danger mb-2"></i>
                    <h6 class="mb-1">Não conformidades</h6>
                    <span class="fs-3 fw-bold"><?= $nao_conformidades ?? 0 ?></span>
                </div>
            </div>
        </div>

    </div>

    <!-- ========================= -->
    <!-- LISTA OPERACIONAL -->
    <!-- ========================= -->
    <div class="row mt-4 g-4">

        <!-- VISITAS DE HOJE -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="mb-3">
                        <i class="fas fa-calendar-day text-primary"></i>
                        Visitas de hoje
                    </h5>

                    <?php if (!empty($lista_visitas_hoje)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($lista_visitas_hoje as $v): ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><?= htmlspecialchars($v['empresa']) ?></span>
                                    <span class="badge bg-primary"><?= $v['hora'] ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">Nenhuma visita hoje</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>

        <!-- NÃO CONFORMIDADES -->
        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body">
                    <h5 class="mb-3">
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                        Não conformidades abertas
                    </h5>

                    <?php if (!empty($lista_nc)): ?>
                        <ul class="list-group list-group-flush">
                            <?php foreach ($lista_nc as $nc): ?>
                                <li class="list-group-item d-flex justify-content-between">
                                    <span><?= htmlspecialchars($nc['descricao']) ?></span>
                                    <span class="badge bg-danger"><?= $nc['status'] ?></span>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    <?php else: ?>
                        <p class="text-muted">Nenhuma não conformidade aberta</p>
                    <?php endif; ?>

                </div>
            </div>
        </div>

    </div>

    <!-- ========================= -->
    <!-- GRÁFICOS -->
    <!-- ========================= -->
    <div class="row mt-4 g-4">

        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5><i class="fas fa-chart-line text-primary"></i> Visitas por mês</h5>
                    <canvas id="chartVisitas"></canvas>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card shadow-sm h-100">
                <div class="card-body py-2">
                    
                    <h5 class="mb-2">
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                        Riscos por categoria
                    </h5>

                    <div class="chart-box">
                        <canvas id="chartRiscos" class="chart-small"></canvas>
                    </div>

                </div>
            </div>
        </div>

    </div>

    <!-- ========================= -->
    <!-- JS DATA -->
    <!-- ========================= -->
    <script>
        window.visitasMes = <?= json_encode($visitas_mes ?? []) ?>;
        window.riscosCategoria = <?= json_encode($riscos_categoria ?? []) ?>;
    </script>

</main>

<style>
.card {
    border-radius: 12px;
}
</style>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>