<?php 
require_once dirname(__DIR__) . '/templates/header.php'; 
require_once dirname(__DIR__, 3) . '/config/config.php';
require_once dirname(__DIR__, 3) . '/app/models/Visita.php'; 

$eventos = [];
$datasDisponiveis = [];

if (isset($visitas) && is_array($visitas)) {
    foreach ($visitas as $v) {
        $horaInicio = $v['hora_inicio'] ?? '00:00:00';
        $horaFim    = $v['hora_fim'] ?? $horaInicio;

        $eventos[] = [
            'id'    => $v['id'],
            'title' => $v['empresa_nome'],
            'start' => $v['data_visita'] . 'T' . $horaInicio,
            'end'   => $v['data_visita'] . 'T' . $horaFim,
            'url'   => BASE_URL . '/visitas/visualizar?id=' . $v['id'],
            'extendedProps' => [
                'status'       => $v['status'] ?? 'ABERTA',
                'prioridade'   => $v['prioridade'] ?? 'NORMAL',
                'hora_inicio'  => $horaInicio,
                'hora_fim'     => $horaFim,
                'empresa'      => $v['empresa_nome'],
                'tecnico'      => $v['usuario_nome'],
                'veiculo'      => $v['veiculo_modelo'] ?? 'A pé',
                'unidade'      => $v['unidade_nome']
            ]
        ];
        
        $data = date('Y-m-d', strtotime($v['data_visita']));

        if (!in_array($data, $datasDisponiveis)) {
            $datasDisponiveis[] = $data;
        }
    }

    sort($datasDisponiveis);
}
?>

<main class="content flex-grow-1 pt-3 px-4 pb-4 bg-light-subtle">

    <div class="container-fluid px-2 px-lg-4 mb-4">

        <?php
        $sucesso = $_SESSION['sucesso'] ?? null;
        $erro = $_SESSION['erro'] ?? null;
        unset($_SESSION['sucesso'], $_SESSION['erro']);
        ?>

        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:9999;">
            <?php if ($sucesso): ?>
                <div id="toastSucesso" class="toast text-bg-success border-0 shadow-lg">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas fa-circle-check me-2"></i>
                            <?= htmlspecialchars($sucesso) ?>
                        </div>
                        <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            <?php endif; ?>

            <?php if ($erro): ?>
                <div id="toastErro" class="toast text-bg-danger border-0 shadow-lg">
                    <div class="d-flex">
                        <div class="toast-body">
                            <i class="fas fa-circle-exclamation me-2"></i>
                            <?= htmlspecialchars($erro) ?>
                        </div>
                        <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <section class="visitas-page-header mb-4">
            <div>
                <h3 class="visitas-page-title">
                    <span class="visitas-icon">
                        <i class="fas fa-calendar-check"></i>
                    </span>
                    Controle de Visitas Técnicas
                </h3>
                <p class="visitas-page-subtitle">
                    Gerencie agendamentos, acompanhe visitas em campo e inicie checklists de levantamento de riscos.
                </p>
            </div>

            <a href="<?= BASE_URL ?>/visitas/criar" class="btn btn-primary rounded-pill px-4 shadow-sm fw-semibold">
                <i class="fas fa-calendar-plus me-2"></i>
                Novo Agendamento
            </a>
        </section>

        <div class="visitas-tabs-card mb-4">
            <ul class="nav nav-pills visitas-tabs gap-2" id="visitasTab" role="tablist">
                <li class="nav-item">
                    <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#tab-calendario">
                        <i class="fas fa-calendar-alt me-2"></i>
                        FullCalendar
                    </button>
                </li>
                <li class="nav-item">
                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#tab-lista">
                        <i class="fas fa-list me-2"></i>
                        Lista Completa
                    </button>
                </li>
            </ul>
        </div>

        <div class="tab-content">

            <div class="tab-pane fade show active" id="tab-calendario">
                <section class="visitas-card">
                    <div class="visitas-card-header">
                        <h5 class="visitas-card-title">
                            <i class="fas fa-calendar-days me-2"></i>
                            Calendário de Agendamentos
                        </h5>
                        <p class="visitas-card-subtitle">
                            Visualização mensal, semanal e diária das visitas técnicas programadas.
                        </p>
                    </div>

                    <div class="visitas-calendar-wrapper">
                        <div id="calendar"></div>
                    </div>
                </section>
            </div>

            <div class="tab-pane fade" id="tab-lista">

                <section class="visitas-card mb-4">
                    <div class="card-body p-4">
                        <h5 class="visitas-card-title mb-3">
                            <i class="fas fa-filter me-2"></i>
                            Filtros da Lista
                        </h5>

                        <div class="row g-3">
                            <div class="col-12 col-md-3">
                                <label class="form-label text-muted small fw-semibold">Técnico</label>
                                <select id="filtroTecnico" class="form-select bg-light border-0 rounded-pill">
                                    <option value="">Todos</option>
                                    <?php 
                                    $usuariosUnicos = array_unique(array_column($visitas, 'usuario_nome'));
                                    foreach ($usuariosUnicos as $u): if ($u): ?>
                                        <option value="<?= htmlspecialchars($u) ?>"><?= htmlspecialchars($u) ?></option>
                                    <?php endif; endforeach; ?>
                                </select>
                            </div>

                            <div class="col-12 col-md-2">
                                <label class="form-label text-muted small fw-semibold">Veículo</label>
                                <select id="filtroVeiculo" class="form-select bg-light border-0 rounded-pill">
                                    <option value="">Todos</option>
                                    <?php 
                                    $veiculosUnicos = array_unique(array_column($visitas, 'veiculo_modelo'));
                                    foreach ($veiculosUnicos as $v): if ($v): ?>
                                        <option value="<?= htmlspecialchars($v) ?>"><?= htmlspecialchars($v) ?></option>
                                    <?php endif; endforeach; ?>
                                </select>
                            </div>

                            <div class="col-12 col-md-2">
                                <label class="form-label text-muted small fw-semibold">Data</label>
                                <input type="date" id="filtroData" class="form-control bg-light border-0 rounded-pill">
                            </div>

                            <div class="col-12 col-md-2">
                                <label class="form-label text-muted small fw-semibold">Prioridade</label>
                                <select id="filtroPrioridade" class="form-select bg-light border-0 rounded-pill">
                                    <option value="">Todas</option>
                                    <option value="BAIXA">Baixa</option>
                                    <option value="NORMAL">Normal</option>
                                    <option value="ALTA">Alta</option>
                                    <option value="URGENTE">Urgente</option>
                                    <option value="EMERGENCIA">Emergência</option>
                                </select>
                            </div>

                            <div class="col-12 col-md-3">
                                <label class="form-label text-muted small fw-semibold">Status</label>
                                <select id="filtroStatus" class="form-select bg-light border-0 rounded-pill">
                                    <option value="">Todos</option>
                                    <option value="ABERTA">Aberta</option>
                                    <option value="CHECKLIST_INICIADO">Checklist iniciado</option>
                                    <option value="EM_ANDAMENTO">Em andamento</option>
                                    <option value="FINALIZADA">Finalizada</option>
                                    <option value="CANCELADA">Cancelada</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </section>

                <section class="visitas-card">
                    <div class="visitas-card-header">
                        <h5 class="visitas-card-title">
                            <i class="fas fa-table-list me-2"></i>
                            Lista Completa de Agendamentos
                        </h5>
                        <p class="visitas-card-subtitle">
                            Consulte, edite, visualize ou inicie o checklist das visitas técnicas.
                        </p>
                    </div>

                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="tabelaVisitas">
                                <thead>
                                    <tr>
                                        <th>Prioridade</th>
                                        <th>Data / Horário</th>
                                        <th>Empresa</th>
                                        <th>Técnico</th>
                                        <th>Veículo</th>
                                        <th>Status</th>
                                        <th class="text-end pe-4">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="corpo-tabela-visitas">
                                    <?php include 'listar-tabela-ajax.php'; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>

    <?php if (isset($visitas) && !empty($visitas)): ?>
        <?php foreach ($visitas as $v): ?>
            <div class="modal fade" id="modalVisita<?= $v['id'] ?>" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content border-0 shadow-lg rounded-3">
                        <div class="modal-header bg-light border-bottom py-3">
                            <h5 class="modal-title fw-bold text-dark d-flex align-items-center gap-2">
                                <i class="fas fa-calendar-check border p-2 bg-light rounded-3 text-secondary"></i> 
                                Ficha da Visita #<?= $v['id'] ?>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>

                        <div class="modal-body p-4">
                            <div class="mb-3 border-bottom pb-2">
                                <label class="text-secondary small fw-semibold d-block">Destino / Empresa</label>
                                <span class="text-dark fw-bold fs-5"><?= htmlspecialchars($v['empresa_nome']) ?></span>
                            </div>

                            <div class="mb-3 border-bottom pb-2">
                                <label class="text-secondary small fw-semibold d-block">Usuário Responsável</label>
                                <span class="text-dark fw-medium"><?= htmlspecialchars($v['usuario_nome'] ?? 'N/A') ?></span>
                            </div>

                            <div class="col-6">
                                <label class="text-secondary small fw-semibold d-block">
                                    Prioridade
                                </label>

                                <span class="badge <?= $corPrioridade ?>">
                                    <?= $v['prioridade'] ?>
                                </span>
                            </div>

                            <div class="row g-3 mb-3">
                                <div class="col-6">
                                    <label class="text-secondary small fw-semibold d-block">Veículo</label>
                                    <span class="text-dark fw-bold">
                                        <?= !empty($v['veiculo_modelo']) ? htmlspecialchars($v['veiculo_modelo']) : 'A pé' ?>
                                    </span>
                                </div>

                                <div class="col-6">
                                    <label class="text-secondary small fw-semibold d-block">Status</label>
                                    <?php 
                                    $s = $v['status'] ?? 'ABERTA';
                                    $col = ($s == 'FINALIZADA') ? 'success' : (($s == 'CANCELADA') ? 'danger' : 'warning');
                                    ?>
                                    <span class="text-<?= $col ?> fw-bold">
                                        <?= ucfirst(strtolower($s)) ?>
                                    </span>
                                </div>
                            </div>

                            <div class="text-end">
                                <div class="text-end">
                                    <small class="text-muted d-block">
                                        <i class="fas fa-calendar-day me-1"></i>
                                        <?= date('d/m/Y', strtotime($v['data_visita'])) ?>
                                    </small>

                                    <small class="text-muted d-block">
                                        <i class="fas fa-clock me-1"></i>
                                        <?= substr($v['hora_inicio'] ?? '00:00', 0, 5) ?>
                                        às
                                        <?= substr($v['hora_fim'] ?? '00:00', 0, 5) ?>
                                    </small>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer bg-light border-top py-3">
                            <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">
                                Fechar
                            </button>

                            <?php if (!in_array($v['status'], ['FINALIZADA', 'CANCELADA', 'EXCLUIDA'])): ?>
                                <a 
                                    href="<?= BASE_URL ?>/checklists/iniciar/<?= $v['id'] ?>" 
                                    class="btn btn-success rounded-pill px-4"
                                    onclick="return confirm('Deseja iniciar o checklist desta visita?');"
                                >
                                    <i class="fas fa-clipboard-check me-1"></i>
                                    Iniciar Checklist
                                </a>
                            <?php endif; ?>

                            <?php if ($v['status'] !== 'FINALIZADA'): ?>
                                <a href="<?= BASE_URL ?>/visitas/editar?id=<?= $v['id'] ?>" class="btn btn-primary rounded-pill px-4">
                                    <i class="fas fa-edit me-1"></i>
                                    Editar
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>

</main>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>
<script src="<?= BASE_URL ?>/js/app.js"></script>
<script src="<?= BASE_URL ?>/js/calendario-visitas.js"></script>

<script>
    window.eventosData = <?= json_encode($eventos) ?>;
    window.baseUrl = '<?= BASE_URL ?>';

    function aplicarFiltros() {
        const tecnico = document.getElementById('filtroTecnico')?.value.toLowerCase() || '';
        const veiculo = document.getElementById('filtroVeiculo')?.value.toLowerCase() || '';
        const data = document.getElementById('filtroData')?.value || '';
        const prioridade = document.getElementById('filtroPrioridade')?.value.toLowerCase() || '';
        const status = document.getElementById('filtroStatus')?.value.toLowerCase() || '';

        document.querySelectorAll('#tabelaVisitas tbody tr').forEach(tr => {
            if (tr.children.length < 7) return;

            const textPrioridade = tr.children[0].innerText.toLowerCase();
            const dataLinha = tr.querySelector('[data-raw]')?.getAttribute('data-raw') || '';
            const textTecnico = tr.children[3].innerText.toLowerCase();
            const textVeiculo = tr.children[4].innerText.toLowerCase();
            const textStatus = tr.children[5].innerText.toLowerCase();

            const matchTecnico = tecnico === '' || textTecnico.includes(tecnico);
            const matchVeiculo = veiculo === '' || textVeiculo.includes(veiculo);
            const matchData = data === '' || dataLinha === data;
            const matchPrioridade = prioridade === '' || textPrioridade.includes(prioridade);
            const matchStatus = status === '' || textStatus.includes(status);

            tr.style.display = (matchTecnico && matchVeiculo && matchData && matchPrioridade && matchStatus) ? '' : 'none';
        });
    }

    document.getElementById('filtroTecnico')?.addEventListener('change', aplicarFiltros);
    document.getElementById('filtroVeiculo')?.addEventListener('change', aplicarFiltros);
    document.getElementById('filtroData')?.addEventListener('input', aplicarFiltros);
    document.getElementById('filtroPrioridade')?.addEventListener('change', aplicarFiltros);
    document.getElementById('filtroStatus')?.addEventListener('change', aplicarFiltros);

    document.querySelector('button[data-bs-target="#tab-calendario"]')?.addEventListener('shown.bs.tab', () => { 
        if (window.calendar) window.calendar.render(); 
    });

    document.addEventListener('DOMContentLoaded', () => {
        const toastSucesso = document.getElementById('toastSucesso');
        const toastErro = document.getElementById('toastErro');

        if (toastSucesso) {
            new bootstrap.Toast(toastSucesso).show();
        }

        if (toastErro) {
            new bootstrap.Toast(toastErro).show();
        }

        if ($.fn.DataTable) {
            $('#tabelaVisitas').DataTable({
                responsive: true,
                autoWidth: false,
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50, 100],
                language: { 
                    url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json' 
                },
                columnDefs: [
                    { orderable: false, targets: 6 }
                ],
                drawCallback: function() {
                    $('.dataTables_paginate .paginate_button').addClass('shadow-sm');
                }
            });
        }
    });
</script>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>