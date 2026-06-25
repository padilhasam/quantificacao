<?php
$css = 'dashboard.css';
require_once dirname(__DIR__) . '/templates/header.php';

$nomeUsuario = $_SESSION['nome'] ?? 'Usuário';
$dataHoje = date('d/m/Y');

$empresas_total = $empresas_total ?? 0;
$unidades_total = $unidades_total ?? 0;
$setores_total = $setores_total ?? 0;
$cargos_total = $cargos_total ?? 0;

$levantamentos_andamento = $levantamentos_andamento ?? 0;
$levantamentos_mes = $levantamentos_mes ?? 0;
$riscos_aplicados_mes = $riscos_aplicados_mes ?? 0;
$relatorios_pendentes = $relatorios_pendentes ?? 0;
$visitas_sem_levantamento = $visitas_sem_levantamento ?? 0;
$planos_acao_abertos = $planos_acao_abertos ?? 0;

$tecnicos_operacao = $tecnicos_operacao ?? [];
$trabalhos_andamento = $trabalhos_andamento ?? [];
?>

<main class="content dashboard-page">

    <section class="dashboard-hero">
        <div>
            <span class="dashboard-eyebrow">Central de Operações SST</span>
            <h3>Olá, <?= htmlspecialchars($nomeUsuario) ?> 👋</h3>
            <p>
                Hoje você possui <strong><?= $visitas_hoje ?? 0 ?></strong> visita(s),
                <strong><?= $levantamentos_andamento ?></strong> levantamento(s) em andamento
                e <strong><?= $nao_conformidades ?? 0 ?></strong> pendência(s) técnica(s).
            </p>
        </div>

        <div class="dashboard-hero-actions">
            <a href="<?= BASE_URL ?>/visitas/criar" class="btn btn-primary rounded-pill">
                <i class="fas fa-plus-circle me-1"></i> Nova Visita
            </a>
            <a href="<?= BASE_URL ?>/levantamentos/criar" class="btn btn-outline-primary rounded-pill">
                <i class="fas fa-clipboard-check me-1"></i> Novo Levantamento
            </a>
        </div>
    </section>

    <?php if (!empty($acima_lt) || !empty($nao_conformidades)): ?>
        <section class="dashboard-alerts">
            <?php if (!empty($acima_lt)): ?>
                <div class="dashboard-alert danger">
                    <i class="fas fa-triangle-exclamation"></i>
                    <div>
                        <strong><?= $acima_lt ?></strong>
                        <span>medição(ões) acima do limite de tolerância</span>
                    </div>
                </div>
            <?php endif; ?>

            <?php if (!empty($nao_conformidades)): ?>
                <div class="dashboard-alert warning">
                    <i class="fas fa-circle-exclamation"></i>
                    <div>
                        <strong><?= $nao_conformidades ?></strong>
                        <span>não conformidade(s) pendente(s)</span>
                    </div>
                </div>
            <?php endif; ?>
        </section>
    <?php endif; ?>

    <section class="dashboard-kpis">
        <a href="<?= BASE_URL ?>/visitas" class="dashboard-kpi-card primary">
            <div class="kpi-icon"><i class="fas fa-calendar-day"></i></div>
            <div><span>Visitas hoje</span><strong><?= $visitas_hoje ?? 0 ?></strong></div>
        </a>

        <a href="<?= BASE_URL ?>/levantamentos" class="dashboard-kpi-card success">
            <div class="kpi-icon"><i class="fas fa-clipboard-check"></i></div>
            <div><span>Levantamentos</span><strong><?= $levantamentos_andamento ?></strong></div>
        </a>

        <a href="<?= BASE_URL ?>/quantificacoes" class="dashboard-kpi-card warning">
            <div class="kpi-icon"><i class="fas fa-ruler-combined"></i></div>
            <div><span>Quantificações</span><strong><?= $quantificacoes_pendentes ?? 0 ?></strong></div>
        </a>

        <a href="<?= BASE_URL ?>/nao-conformidades" class="dashboard-kpi-card danger">
            <div class="kpi-icon"><i class="fas fa-triangle-exclamation"></i></div>
            <div><span>Não conformidades</span><strong><?= $nao_conformidades ?? 0 ?></strong></div>
        </a>
    </section>

    <section class="dashboard-section">
        <div class="dashboard-section-header">
            <div>
                <h5>Ações rápidas</h5>
                <p>Atalhos para atividades mais usadas no fluxo técnico.</p>
            </div>
        </div>

        <div class="dashboard-actions-grid">
            <a href="<?= BASE_URL ?>/visitas/criar" class="action-card primary">
                <i class="fas fa-calendar-plus"></i><span>Agendar visita</span>
            </a>

            <a href="<?= BASE_URL ?>/levantamentos/criar" class="action-card success">
                <i class="fas fa-clipboard-check"></i><span>Novo levantamento</span>
            </a>

            <a href="<?= BASE_URL ?>/nao-conformidades/criar" class="action-card danger">
                <i class="fas fa-circle-exclamation"></i><span>Nova não conformidade</span>
            </a>

            <a href="<?= BASE_URL ?>/quantificacoes/criar" class="action-card warning">
                <i class="fas fa-ruler-combined"></i><span>Nova quantificação</span>
            </a>
        </div>
    </section>

    <section class="dashboard-grid-main">

        <div class="dashboard-panel dashboard-agenda">
            <div class="dashboard-panel-header">
                <div>
                    <h5><i class="fas fa-calendar-day text-primary me-1"></i> Agenda técnica</h5>
                    <p>Próximas visitas de hoje — <?= $dataHoje ?></p>
                </div>
                <a href="<?= BASE_URL ?>/visitas" class="btn btn-sm btn-outline-primary rounded-pill">Ver agenda</a>
            </div>

            <?php if (!empty($lista_visitas_hoje)): ?>
                <div class="dashboard-list">
                    <?php foreach ($lista_visitas_hoje as $v): ?>
                        <article class="dashboard-visit-item">
                            <div class="visit-time"><?= htmlspecialchars($v['hora'] ?? '-') ?></div>
                            <div class="visit-content">
                                <strong><?= htmlspecialchars($v['empresa'] ?? 'Empresa não informada') ?></strong>
                                <span><?= !empty($v['unidade']) ? htmlspecialchars($v['unidade']) : 'Unidade não informada' ?></span>
                            </div>
                            <a href="<?= BASE_URL ?>/visitas" class="btn btn-sm btn-primary rounded-pill">Abrir</a>
                        </article>
                    <?php endforeach; ?>
                </div>
            <?php else: ?>
                <div class="dashboard-empty">
                    <i class="fas fa-calendar-check"></i>
                    <strong>Nenhuma visita hoje</strong>
                    <span>Não há visitas técnicas agendadas para hoje.</span>
                </div>
            <?php endif; ?>
        </div>

        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h5><i class="fas fa-list-check text-danger me-1"></i> Pendências críticas</h5>
                    <p>Itens que impactam relatórios e planos de ação</p>
                </div>
            </div>

            <div class="pending-list">
                <a href="<?= BASE_URL ?>/relatorios" class="pending-item">
                    <div><strong><?= $relatorios_pendentes ?></strong><span>Relatórios pendentes</span></div>
                    <i class="fas fa-chevron-right"></i>
                </a>

                <a href="<?= BASE_URL ?>/visitas" class="pending-item">
                    <div><strong><?= $visitas_sem_levantamento ?></strong><span>Visitas sem levantamento</span></div>
                    <i class="fas fa-chevron-right"></i>
                </a>

                <a href="<?= BASE_URL ?>/quantificacoes" class="pending-item">
                    <div><strong><?= $quantificacoes_pendentes ?? 0 ?></strong><span>Quantificações pendentes</span></div>
                    <i class="fas fa-chevron-right"></i>
                </a>

                <a href="<?= BASE_URL ?>/nao-conformidades" class="pending-item">
                    <div><strong><?= $planos_acao_abertos ?></strong><span>Planos de ação abertos</span></div>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

    </section>

    <section class="dashboard-panel dashboard-tecnicos">
        <div class="dashboard-panel-header">
            <div>
                <h5><i class="fas fa-users-gear text-primary me-1"></i> Gestão por técnico</h5>
                <p>Agenda, levantamentos e pendências por responsável técnico</p>
            </div>

            <a href="<?= BASE_URL ?>/usuarios" class="btn btn-sm btn-outline-primary rounded-pill">
                Ver equipe
            </a>
        </div>

        <?php if (!empty($tecnicos_operacao)): ?>
            <div class="tecnicos-list">
                <?php foreach ($tecnicos_operacao as $tec): ?>
                    <article class="tecnico-card">
                        <div class="tecnico-header">
                            <div class="tecnico-avatar">
                                <?= strtoupper(substr($tec['nome'] ?? 'T', 0, 1)) ?>
                            </div>

                            <div>
                                <strong><?= htmlspecialchars($tec['nome'] ?? 'Técnico') ?></strong>
                                <span><?= htmlspecialchars($tec['status'] ?? 'Status não informado') ?></span>
                            </div>
                        </div>

                        <div class="tecnico-metrics">
                            <div><strong><?= $tec['visitas_hoje'] ?? 0 ?></strong><span>Visitas</span></div>
                            <div><strong><?= $tec['levantamentos_andamento'] ?? 0 ?></strong><span>Levant.</span></div>
                            <div><strong><?= $tec['pendencias'] ?? 0 ?></strong><span>Pendências</span></div>
                        </div>

                        <a href="<?= BASE_URL ?>/visitas?tecnico_id=<?= $tec['id'] ?? '' ?>" class="btn btn-sm btn-outline-secondary rounded-pill w-100">
                            Ver agenda
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="dashboard-empty compact">
                <i class="fas fa-users"></i>
                <strong>Nenhum técnico em operação</strong>
                <span>Não há técnicos com visitas ou atividades vinculadas no momento.</span>
            </div>
        <?php endif; ?>
    </section>

    <section class="dashboard-panel dashboard-trabalhos">
        <div class="dashboard-panel-header">
            <div>
                <h5><i class="fas fa-person-digging text-success me-1"></i> Trabalhos em andamento</h5>
                <p>Levantamentos iniciados e ainda não finalizados</p>
            </div>

            <a href="<?= BASE_URL ?>/levantamentos" class="btn btn-sm btn-outline-success rounded-pill">
                Ver todos
            </a>
        </div>

        <?php if (!empty($trabalhos_andamento)): ?>
            <div class="work-list">
                <?php foreach ($trabalhos_andamento as $trab): ?>
                    <?php $progresso = $trab['progresso'] ?? 0; ?>
                    <article class="work-card">
                        <div>
                            <strong><?= htmlspecialchars($trab['empresa'] ?? 'Empresa não informada') ?></strong>
                            <span>
                                <?= htmlspecialchars($trab['unidade'] ?? 'Unidade não informada') ?>
                                <?= !empty($trab['setor']) ? ' • ' . htmlspecialchars($trab['setor']) : '' ?>
                            </span>
                            <small><?= htmlspecialchars($trab['etapa'] ?? 'Etapa não informada') ?></small>
                        </div>

                        <div class="work-progress">
                            <div class="progress">
                                <div class="progress-bar" style="width: <?= (int)$progresso ?>%;"></div>
                            </div>
                            <span><?= (int)$progresso ?>%</span>
                        </div>

                        <a href="<?= BASE_URL ?>/levantamentos" class="btn btn-sm btn-success rounded-pill">
                            Continuar
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="dashboard-empty compact">
                <i class="fas fa-clipboard-check"></i>
                <strong>Nenhum levantamento em andamento</strong>
                <span>Os trabalhos iniciados aparecerão aqui para continuidade.</span>
            </div>
        <?php endif; ?>
    </section>

    <section class="dashboard-grid-secondary">

        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h5><i class="fas fa-industry text-success me-1"></i> Produção SST no mês</h5>
                    <p>Volume técnico produzido pela operação</p>
                </div>
            </div>

            <div class="production-grid">
                <div class="production-card"><span>Levantamentos</span><strong><?= $levantamentos_mes ?></strong></div>
                <div class="production-card"><span>Riscos aplicados</span><strong><?= $riscos_aplicados_mes ?></strong></div>
                <div class="production-card"><span>Quantificações</span><strong><?= $quantificacoes_pendentes ?? 0 ?></strong></div>
                <div class="production-card"><span>NC registradas</span><strong><?= $nao_conformidades ?? 0 ?></strong></div>
            </div>
        </div>

        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h5><i class="fas fa-building text-secondary me-1"></i> Carteira de clientes</h5>
                    <p>Base operacional cadastrada no sistema</p>
                </div>
            </div>

            <div class="client-grid">
                <a href="<?= BASE_URL ?>/empresas" class="client-card"><span>Empresas</span><strong><?= $empresas_total ?></strong></a>
                <a href="<?= BASE_URL ?>/unidades" class="client-card"><span>Unidades</span><strong><?= $unidades_total ?></strong></a>
                <a href="<?= BASE_URL ?>/setores" class="client-card"><span>Setores</span><strong><?= $setores_total ?></strong></a>
                <a href="<?= BASE_URL ?>/cargos" class="client-card"><span>Cargos</span><strong><?= $cargos_total ?></strong></a>
            </div>
        </div>

    </section>

    <section class="dashboard-charts">
        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h5><i class="fas fa-chart-line text-primary me-1"></i> Levantamentos por mês</h5>
                    <p>Evolução mensal dos levantamentos técnicos</p>
                </div>
            </div>

            <div class="chart-box">
                <canvas id="chartVisitas"></canvas>
            </div>
        </div>

        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h5><i class="fas fa-chart-pie text-danger me-1"></i> Riscos por categoria</h5>
                    <p>Distribuição dos riscos aplicados/cadastrados</p>
                </div>
            </div>

            <div class="chart-box">
                <canvas id="chartRiscos"></canvas>
            </div>
        </div>
    </section>

    <script>
        window.visitasMes = <?= json_encode($visitas_mes ?? []) ?>;
        window.riscosCategoria = <?= json_encode($riscos_categoria ?? []) ?>;
    </script>

</main>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>