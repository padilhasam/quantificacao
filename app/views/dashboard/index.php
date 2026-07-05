<?php
$css = 'dashboard.css';
require_once dirname(__DIR__) . '/templates/header.php';

$nomeUsuario = $_SESSION['nome'] ?? 'Usuário';
$dataHoje = date('d/m/Y');

$visitas_hoje = $visitas_hoje ?? 0;
$visitas_aguardando = $visitas_aguardando ?? 0;
$checklists_andamento = $checklists_andamento ?? 0;
$checklists_concluidos = $checklists_concluidos ?? 0;

$quantificacoes_pendentes = $quantificacoes_pendentes ?? 0;
$nao_conformidades = $nao_conformidades ?? 0;
$relatorios_pendentes = $relatorios_pendentes ?? 0;

$empresas_total = $empresas_total ?? 0;
$unidades_total = $unidades_total ?? 0;
$setores_total = $setores_total ?? 0;
$cargos_total = $cargos_total ?? 0;

$lista_visitas_hoje = $lista_visitas_hoje ?? [];
$trabalhos_andamento = $trabalhos_andamento ?? [];
$tecnicos_operacao = $tecnicos_operacao ?? [];
?>

<main class="content dashboard-page">

    <!-- HERO -->
    <section class="dashboard-hero">
        <div>
            <span class="dashboard-eyebrow">Central de Operações NEXUS SST</span>
            <h3>Olá, <?= htmlspecialchars($nomeUsuario) ?> 👋</h3>
            <p>
                Hoje você possui <strong><?= $visitas_hoje ?></strong> visita(s),
                <strong><?= $visitas_aguardando ?></strong> aguardando início,
                <strong><?= $checklists_andamento ?></strong> check-list(s) em andamento
                e <strong><?= $nao_conformidades ?></strong> não conformidade(s) aberta(s).
            </p>
        </div>

        <div class="dashboard-hero-actions">
            <a href="<?= BASE_URL ?>/visitas/criar" class="btn btn-primary rounded-pill">
                <i class="fas fa-calendar-plus me-1"></i> Agendar Visita
            </a>

            <a href="<?= BASE_URL ?>/levantamentos" class="btn btn-outline-primary rounded-pill">
                <i class="fas fa-play-circle me-1"></i> Iniciar Check-list
            </a>
        </div>
    </section>

    <!-- CENTRAL DE OPERAÇÕES -->
    <section class="operation-grid">
        <a href="<?= BASE_URL ?>/visitas" class="operation-card primary">
            <div class="operation-icon"><i class="fas fa-calendar-day"></i></div>
            <div>
                <span>Visitas hoje</span>
                <strong><?= $visitas_hoje ?></strong>
                <small>Agenda do dia</small>
            </div>
        </a>

        <a href="<?= BASE_URL ?>/levantamentos" class="operation-card success">
            <div class="operation-icon"><i class="fas fa-play-circle"></i></div>
            <div>
                <span>Aguardando início</span>
                <strong><?= $visitas_aguardando ?></strong>
                <small>Prontas para check-list</small>
            </div>
        </a>

        <a href="<?= BASE_URL ?>/checklists" class="operation-card warning">
            <div class="operation-icon"><i class="fas fa-list-check"></i></div>
            <div>
                <span>Check-lists em andamento</span>
                <strong><?= $checklists_andamento ?></strong>
                <small>Continuar execução</small>
            </div>
        </a>

        <a href="<?= BASE_URL ?>/nao_conformidades" class="operation-card danger">
            <div class="operation-icon"><i class="fas fa-circle-exclamation"></i></div>
            <div>
                <span>Não conformidades abertas</span>
                <strong><?= $nao_conformidades ?></strong>
                <small>Acompanhamento técnico</small>
            </div>
        </a>
    </section>

    <!-- AÇÕES RÁPIDAS -->
    <section class="dashboard-panel">
        <div class="dashboard-panel-header">
            <div>
                <h5><i class="fas fa-bolt text-primary me-1"></i> Ações rápidas</h5>
                <p>Atalhos para o fluxo principal de campo.</p>
            </div>
        </div>

        <div class="dashboard-actions-grid">
            <a href="<?= BASE_URL ?>/visitas/criar" class="action-card primary">
                <i class="fas fa-calendar-plus"></i>
                <span>Agendar visita</span>
            </a>

            <a href="<?= BASE_URL ?>/levantamentos" class="action-card success">
                <i class="fas fa-play-circle"></i>
                <span>Iniciar check-list</span>
            </a>

            <a href="<?= BASE_URL ?>/checklists" class="action-card warning">
                <i class="fas fa-list-check"></i>
                <span>Continuar check-list</span>
            </a>

            <a href="<?= BASE_URL ?>/nao_conformidades/criar" class="action-card danger">
                <i class="fas fa-circle-exclamation"></i>
                <span>Registrar não conformidade</span>
            </a>
        </div>
    </section>

    <!-- OPERAÇÃO DO DIA -->
    <section class="dashboard-grid-main">

        <!-- AGENDA -->
        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h5><i class="fas fa-calendar-check text-primary me-1"></i> Agenda de hoje</h5>
                    <p>Visitas técnicas programadas para <?= $dataHoje ?>.</p>
                </div>

                <a href="<?= BASE_URL ?>/visitas" class="btn btn-sm btn-outline-primary rounded-pill">
                    Ver agenda
                </a>
            </div>

            <?php if (!empty($lista_visitas_hoje)): ?>
                <div class="dashboard-list">
                    <?php foreach ($lista_visitas_hoje as $v): ?>
                        <article class="dashboard-visit-item">
                            <div class="visit-time">
                                <?= htmlspecialchars($v['hora'] ?? '-') ?>
                            </div>

                            <div class="visit-content">
                                <strong><?= htmlspecialchars($v['empresa'] ?? 'Empresa não informada') ?></strong>
                                <span><?= htmlspecialchars($v['unidade'] ?? 'Unidade não informada') ?></span>
                            </div>

                            <a href="<?= BASE_URL ?>/levantamentos" class="btn btn-sm btn-primary rounded-pill">
                                Iniciar
                            </a>
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

        <!-- PENDÊNCIAS -->
        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h5><i class="fas fa-triangle-exclamation text-danger me-1"></i> Pendências críticas</h5>
                    <p>Itens que impactam a conclusão dos levantamentos.</p>
                </div>
            </div>

            <div class="pending-list">
                <a href="<?= BASE_URL ?>/checklists" class="pending-item">
                    <div>
                        <strong><?= $checklists_andamento ?></strong>
                        <span>Check-lists em andamento</span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </a>

                <a href="<?= BASE_URL ?>/quantificacoes" class="pending-item">
                    <div>
                        <strong><?= $quantificacoes_pendentes ?></strong>
                        <span>Quantificações pendentes</span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </a>

                <a href="<?= BASE_URL ?>/nao_conformidades" class="pending-item">
                    <div>
                        <strong><?= $nao_conformidades ?></strong>
                        <span>Não conformidades abertas</span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </a>

                <a href="<?= BASE_URL ?>/relatorios" class="pending-item">
                    <div>
                        <strong><?= $relatorios_pendentes ?></strong>
                        <span>Relatórios pendentes</span>
                    </div>
                    <i class="fas fa-chevron-right"></i>
                </a>
            </div>
        </div>

    </section>

    <!-- CHECK-LISTS EM ANDAMENTO -->
    <section class="dashboard-panel dashboard-trabalhos">
        <div class="dashboard-panel-header">
            <div>
                <h5><i class="fas fa-list-check text-success me-1"></i> Check-lists em andamento</h5>
                <p>Levantamentos técnicos iniciados e ainda não finalizados.</p>
            </div>

            <a href="<?= BASE_URL ?>/checklists" class="btn btn-sm btn-outline-success rounded-pill">
                Ver todos
            </a>
        </div>

        <?php if (!empty($trabalhos_andamento)): ?>
            <div class="work-list">
                <?php foreach ($trabalhos_andamento as $trab): ?>
                    <?php $progresso = (int)($trab['progresso'] ?? 0); ?>

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
                                <div class="progress-bar" style="width: <?= $progresso ?>%;"></div>
                            </div>
                            <span><?= $progresso ?>%</span>
                        </div>

                        <a href="<?= BASE_URL ?>/checklists" class="btn btn-sm btn-success rounded-pill">
                            Continuar
                        </a>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="dashboard-empty compact">
                <i class="fas fa-clipboard-check"></i>
                <strong>Nenhum check-list em andamento</strong>
                <span>Os levantamentos iniciados aparecerão aqui.</span>
            </div>
        <?php endif; ?>
    </section>

    <!-- PAINEL GERENCIAL -->
    <section class="dashboard-grid-secondary">

        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h5><i class="fas fa-chart-simple text-success me-1"></i> Produção SST no mês</h5>
                    <p>Indicadores operacionais para supervisão e diretoria.</p>
                </div>
            </div>

            <div class="production-grid">
                <div class="production-card">
                    <span>Check-lists concluídos</span>
                    <strong><?= $checklists_concluidos ?></strong>
                </div>

                <div class="production-card">
                    <span>Quantificações</span>
                    <strong><?= $quantificacoes_pendentes ?></strong>
                </div>

                <div class="production-card">
                    <span>Não conformidades registradas</span>
                    <strong><?= $nao_conformidades ?></strong>
                </div>

                <div class="production-card">
                    <span>Relatórios pendentes</span>
                    <strong><?= $relatorios_pendentes ?></strong>
                </div>
            </div>
        </div>

        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h5><i class="fas fa-building text-secondary me-1"></i> Base cadastrada</h5>
                    <p>Estrutura organizacional disponível para levantamentos.</p>
                </div>
            </div>

            <div class="client-grid">
                <a href="<?= BASE_URL ?>/empresas" class="client-card">
                    <span>Empresas</span>
                    <strong><?= $empresas_total ?></strong>
                </a>

                <a href="<?= BASE_URL ?>/unidades" class="client-card">
                    <span>Unidades</span>
                    <strong><?= $unidades_total ?></strong>
                </a>

                <a href="<?= BASE_URL ?>/setores" class="client-card">
                    <span>Setores</span>
                    <strong><?= $setores_total ?></strong>
                </a>

                <a href="<?= BASE_URL ?>/cargos" class="client-card">
                    <span>Cargos</span>
                    <strong><?= $cargos_total ?></strong>
                </a>
            </div>
        </div>

    </section>

    <!-- EQUIPE -->
    <section class="dashboard-panel dashboard-tecnicos">
        <div class="dashboard-panel-header">
            <div>
                <h5><i class="fas fa-users-gear text-primary me-1"></i> Equipe em operação</h5>
                <p>Agenda, check-lists e pendências por responsável técnico.</p>
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
                            <div>
                                <strong><?= $tec['visitas_hoje'] ?? 0 ?></strong>
                                <span>Visitas</span>
                            </div>

                            <div>
                                <strong><?= $tec['checklists_andamento'] ?? 0 ?></strong>
                                <span>Check-lists</span>
                            </div>

                            <div>
                                <strong><?= $tec['pendencias'] ?? 0 ?></strong>
                                <span>Pendências</span>
                            </div>
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
                <span>Não há técnicos com visitas ou check-lists vinculados no momento.</span>
            </div>
        <?php endif; ?>
    </section>

    <!-- GRÁFICOS -->
    <section class="dashboard-charts">

        <div class="dashboard-panel">
            <div class="dashboard-panel-header">
                <div>
                    <h5><i class="fas fa-chart-line text-primary me-1"></i> Check-lists por mês</h5>
                    <p>Evolução mensal dos levantamentos técnicos.</p>
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
                    <p>Distribuição dos riscos aplicados nos levantamentos.</p>
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