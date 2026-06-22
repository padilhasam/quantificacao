<?php 
require_once dirname(__DIR__) . '/templates/header.php'; 
require_once dirname(__DIR__, 3) . '/config/config.php';
require_once dirname(__DIR__, 3) . '/app/models/Visita.php'; 

// Extração de eventos e datas únicas para os filtros
$eventos = [];
$datasDisponiveis = [];

if (isset($visitas) && is_array($visitas)) {
    foreach ($visitas as $v) {
        $eventos[] = [
            'id'    => $v['id'],
            'title' => $v['empresa_nome'],
            'start' => $v['data_visita'] . 'T' . ($v['hora_visita'] ?? '00:00:00'),
            'url'   => BASE_URL . '/visitas/visualizar?id=' . $v['id'],
            'extendedProps' => ['status' => $v['status'] ?? 'ABERTA']
        ];
        
        $data = date('Y-m-d', strtotime($v['data_visita']));
        if (!in_array($data, $datasDisponiveis)) {
            $datasDisponiveis[] = $data;
        }
    }
    sort($datasDisponiveis);
}
?>

<link href='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css' rel='stylesheet' />

<style>
    /* Força cor preta apenas nos elementos internos do calendário */
    #calendar .fc-toolbar-title, 
    #calendar .fc-col-header-cell-cushion, 
    #calendar .fc-daygrid-day-number, 
    #calendar .fc-event,
    #calendar .fc-event-title,
    #calendar .fc-event-time {
        color: #000000 !important;
        text-shadow: none !important;
    }
</style>

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

        <header class="mb-4 px-4 py-3 bg-white border rounded-3 shadow-sm d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h3 class="m-0 fw-bold text-dark d-flex align-items-center gap-3" style="font-size: 1.5rem;">
                    <span class="icon-container d-flex align-items-center justify-content-center" style="width: 38px; height: 38px; background: linear-gradient(135deg, #0d6efd, #084298); border-radius: 8px; box-shadow: 0 2px 6px rgba(13, 110, 253, 0.25);">
                        <i class="fas fa-calendar-check text-white" style="font-size: 1.10rem;"></i>
                    </span>
                    Controle de Visitas e Veículos
                </h3>
            </div>
            <a href="<?= BASE_URL ?>/visitas/criar" class="btn btn-primary rounded-pill px-4 shadow-sm fw-medium">
                <i class="fas fa-calendar-plus me-2"></i> Novo Agendamento
            </a>
        </header>

        <ul class="nav nav-pills mb-4 gap-2" id="visitasTab" role="tablist">
            <li class="nav-item">
                <button class="nav-link active rounded-pill px-4" data-bs-toggle="tab" data-bs-target="#tab-calendario">
                    <i class="fas fa-calendar-alt me-2"></i> Calendário
                </button>
            </li>
            <li class="nav-item">
                <button class="nav-link rounded-pill px-4" data-bs-toggle="tab" data-bs-target="#tab-lista">
                    <i class="fas fa-list me-2"></i> Lista Completa
                </button>
            </li>
        </ul>

        <div class="tab-content">
            <div class="tab-pane fade show active" id="tab-calendario">
                <div class="card shadow-sm border-0 p-4 rounded-3">
                    <div id="calendar"></div>
                </div>
            </div>

            <div class="tab-pane fade" id="tab-lista">
                <div class="card shadow-sm border-0 mb-4 rounded-3">
                    <div class="card-body p-4">
                        <h6 class="text-primary mb-3 fw-bold"><i class="fas fa-filter me-2"></i>Filtrar Agendamentos</h6>
                        <div class="row g-3">
                            <div class="col-md-4">
                                <label class="form-label text-muted small fw-semibold">Técnico / Usuário</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 rounded-start-pill"><i class="fas fa-user text-secondary"></i></span>
                                    <select id="filtroTecnico" class="form-select bg-light border-0 rounded-end-pill">
                                        <option value="">Todos os usuários</option>
                                        <?php 
                                        $usuariosUnicos = array_unique(array_column($visitas, 'usuario_nome'));
                                        foreach ($usuariosUnicos as $u): if($u): ?>
                                            <option value="<?= htmlspecialchars($u) ?>"><?= htmlspecialchars($u) ?></option>
                                        <?php endif; endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted small fw-semibold">Veículo</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 rounded-start-pill"><i class="fas fa-car text-secondary"></i></span>
                                    <select id="filtroVeiculo" class="form-select bg-light border-0 rounded-end-pill">
                                        <option value="">Todos os veículos</option>
                                        <?php 
                                        $veiculosUnicos = array_unique(array_column($visitas, 'veiculo_modelo'));
                                        foreach ($veiculosUnicos as $v): if($v): ?>
                                            <option value="<?= htmlspecialchars($v) ?>"><?= htmlspecialchars($v) ?></option>
                                        <?php endif; endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-muted small fw-semibold">Data da Visita</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-0 rounded-start-pill"><i class="fas fa-calendar-day text-secondary"></i></span>
                                    <input type="date" id="filtroData" class="form-control bg-light border-0 rounded-end-pill">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card border-0 shadow-sm rounded-3">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover align-middle mb-0" id="tabelaVisitas">
                                <thead class="table-light text-secondary fw-semibold">
                                    <tr>
                                        <th class="ps-4">#</th>
                                        <th>Usuário</th>
                                        <th>Veículo</th>
                                        <th>Destino</th>
                                        <th>Data / Horário</th>
                                        <th>Status</th>
                                        <th class="text-center pe-4">Ações</th>
                                    </tr>
                                </thead>
                                <tbody id="corpo-tabela-visitas">
                                    <?php include 'listar-tabela-ajax.php'; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   <?php if (isset($visitas) && !empty($visitas)): foreach ($visitas as $v): ?>
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
                            <label class="text-secondary small fw-semibold d-block">Destino (Empresa)</label>
                            <span class="text-dark fw-bold fs-5"><?= htmlspecialchars($v['empresa_nome']) ?></span>
                        </div>
                        <div class="mb-3 border-bottom pb-2">
                            <label class="text-secondary small fw-semibold d-block">Usuário Responsável</label>
                            <span class="text-dark fw-medium"><?= htmlspecialchars($v['usuario_nome'] ?? 'N/A') ?></span>
                        </div>
                        <div class="row g-3 mb-3">
                            <div class="col-6">
                                <label class="text-secondary small fw-semibold d-block">Veículo</label>
                                <span class="text-dark fw-bold"><?= !empty($v['veiculo_modelo']) ? htmlspecialchars($v['veiculo_modelo']) : 'A pé' ?></span>
                            </div>
                            <div class="col-6">
                                <label class="text-secondary small fw-semibold d-block">Status</label>
                                <?php 
                                $s = $v['status'] ?? 'ABERTA';
                                $col = ($s == 'FINALIZADA') ? 'success' : (($s == 'CANCELADA') ? 'danger' : 'warning');
                                echo '<span class="text-'.$col.' fw-bold">'.ucfirst(strtolower($s)).'</span>';
                                ?>
                            </div>
                        </div>
                        <div class="text-end">
                            <small class="text-muted d-block fs-7">
                                <i class="far fa-calendar-alt me-1"></i> Data: <?= date('d/m/Y', strtotime($v['data_visita'])) ?> às <?= substr($v['hora_visita'] ?? '00:00', 0, 5) ?>
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer bg-light border-top py-3">
                        <button type="button" class="btn btn-secondary rounded-pill px-4" data-bs-dismiss="modal">Fechar</button>
                        <?php if ($v['status'] !== 'FINALIZADA'): ?>
                            <a href="<?= BASE_URL ?>/visitas/editar?id=<?= $v['id'] ?>" class="btn btn-primary rounded-pill px-4">
                                <i class="fas fa-edit me-1"></i> Editar
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; endif; ?>

    <?php if (isset($_SESSION['sucesso']) || isset($_SESSION['erro'])): ?>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                <?php if (isset($_SESSION['sucesso'])): ?>
                    showToast("<?= addslashes($_SESSION['sucesso']) ?>", "success");
                <?php endif; ?>
                <?php if (isset($_SESSION['erro'])): ?>
                    showToast("<?= addslashes($_SESSION['erro']) ?>", "danger");
                <?php endif; ?>
            });
        </script>
        <?php unset($_SESSION['sucesso'], $_SESSION['erro']); ?>
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
        const tecnico = document.getElementById('filtroTecnico').value.toLowerCase();
        const veiculo = document.getElementById('filtroVeiculo').value.toLowerCase();
        const data = document.getElementById('filtroData').value; 

        document.querySelectorAll('#tabelaVisitas tbody tr').forEach(tr => {
            if (tr.children.length < 2) return;
            const textUsuario = tr.children[1].innerText.toLowerCase();
            const textVeiculo = tr.children[2].innerText.toLowerCase();
            const dataLinha = tr.querySelector('[data-raw]')?.getAttribute('data-raw') || '';

            const matchTecnico = (tecnico === "" || textUsuario.includes(tecnico));
            const matchVeiculo = (veiculo === "" || textVeiculo.includes(veiculo));
            const matchData = (data === "" || dataLinha === data);

            tr.style.display = (matchTecnico && matchVeiculo && matchData) ? '' : 'none';
        });
    }

    document.getElementById('filtroTecnico').addEventListener('change', aplicarFiltros);
    document.getElementById('filtroVeiculo').addEventListener('change', aplicarFiltros);
    document.getElementById('filtroData').addEventListener('input', aplicarFiltros);

    document.querySelector('button[data-bs-target="#tab-calendario"]').addEventListener('shown.bs.tab', () => { 
        if(window.calendar) window.calendar.render(); 
    });

    $(document).ready(function () {
        $('#tabelaVisitas').DataTable({
            responsive: true,
            autoWidth: false,
            pageLength: 10,
            lengthMenu: [5, 10, 25, 50, 100],
            language: { url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json' },
            columnDefs: [{ orderable: false, targets: 5 }],
            drawCallback: function() {
                $('.dataTables_paginate .paginate_button').addClass('shadow-sm');
            }
        });
    });
</script>
<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>
    
</main>