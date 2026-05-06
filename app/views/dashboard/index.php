<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<main class="content flex-grow-1 p-4">

    <!-- TÍTULO -->
    <div class="mb-4">
        <h3 class="fw-bold mb-1">
            <span class="text-accent">Painel Técnico SST</span>
        </h3>
        <p class="text-muted mb-0">
            Monitoramento de visitas, riscos e avaliações quantitativas
        </p>
    </div>

    <!-- ALERTAS -->
    <?php if (!empty($acima_lt)): ?>
        <div class="alert alert-danger">
            ⚠️ Existem <strong><?= $acima_lt ?></strong> avaliações acima do limite de tolerância
        </div>
    <?php endif; ?>

    <?php if (!empty($nao_conformidades)): ?>
        <div class="alert alert-warning">
            ⚠️ <strong><?= $nao_conformidades ?></strong> não conformidades pendentes
        </div>
    <?php endif; ?>

    <!-- ========================= -->
    <!-- INDICADORES -->
    <!-- ========================= -->
    <div class="row g-4">

        <?php
        $cards = [
            ['icon'=>'fa-calendar-check','color'=>'primary','title'=>'Visitas','value'=>$visitas ?? 0],
            ['icon'=>'fa-exclamation-triangle','color'=>'danger','title'=>'Riscos Críticos','value'=>$riscos_criticos ?? 0],
            ['icon'=>'fa-vials','color'=>'warning','title'=>'Acima do LT','value'=>$acima_lt ?? 0],
            ['icon'=>'fa-times-circle','color'=>'dark','title'=>'Não Conformidades','value'=>$nao_conformidades ?? 0],
        ];
        ?>

        <?php foreach ($cards as $card): ?>
            <div class="col-md-3">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <i class="fas <?= $card['icon'] ?> fa-2x text-<?= $card['color'] ?> mb-2"></i>
                        <h6 class="mb-1"><?= $card['title'] ?></h6>
                        <span class="fs-4 fw-bold"><?= $card['value'] ?></span>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>

    <!-- ========================= -->
    <!-- GRÁFICOS -->
    <!-- ========================= -->
    <div class="row g-4 mt-4">

        <!-- VISITAS -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5><i class="fas fa-calendar text-primary"></i> Visitas por Mês</h5>
                    <div class="chart-box">
                        <canvas id="chartVisitas"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- RISCOS -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5><i class="fas fa-exclamation-triangle text-danger"></i> Riscos por Categoria</h5>
                    <div class="chart-box">
                        <canvas id="chartRiscos"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- QUANTIFICAÇÃO -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5><i class="fas fa-vials text-warning"></i> Avaliações (LT)</h5>
                    <div class="chart-box">
                        <canvas id="chartQuantificacao"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- NÃO CONFORMIDADES -->
        <div class="col-md-6">
            <div class="card h-100 shadow-sm">
                <div class="card-body">
                    <h5><i class="fas fa-times-circle text-dark"></i> Não Conformidades</h5>
                    <div class="chart-box">
                        <canvas id="chartNC"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </div>

</main>

<!-- VARIÁVEIS PARA JS -->
<script>
    window.visitasMes = <?= json_encode($visitas_mes ?? []) ?>;
    window.riscosCategoria = <?= json_encode($riscos_categoria ?? []) ?>;
    window.quantificacao = <?= json_encode($quantificacao ?? []) ?>;
    window.naoConformidades = <?= json_encode($nao_conformidades_status ?? []) ?>;
</script>

<!-- CHART JS -->
<script src="/js/chart.js"></script>

<style>
.chart-box {
    position: relative;
    height: 250px;
}
</style>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>