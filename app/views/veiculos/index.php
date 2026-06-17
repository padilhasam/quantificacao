<?php require_once dirname(__DIR__) . '../templates/header.php'; ?>

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.bootstrap5.min.css">

<main class="content flex-grow-1 p-4">

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

<div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

    <div>
        <h3 class="fw-bold mb-1 d-flex align-items-center gap-2">
            <i class="fas fa-car text-primary"></i>
            Veículos
            <span class="badge bg-primary-subtle text-primary border border-primary-subtle">
                <?= count($veiculos ?? []) ?>
            </span>
        </h3>

        <p class="text-muted mb-0">
            Gestão da frota de veículos disponíveis para visitas técnicas.
        </p>
    </div>

    <div class="d-flex gap-2 flex-wrap">

        <a href="<?= BASE_URL ?>/dashboard"
           class="btn btn-light border shadow-sm">
            <i class="fas fa-arrow-left me-1"></i>
            Dashboard
        </a>

        <a href="<?= BASE_URL ?>/veiculos/criar"
           class="btn btn-primary shadow-sm">
            <i class="fas fa-plus-circle me-1"></i>
            Novo Veículo
        </a>

    </div>

</div>

<div class="card border-0 shadow-sm">

    <div class="card-body p-4">

        <?php if (!empty($veiculos)): ?>

            <div class="table-responsive">

                <table id="tabelaVeiculos" class="table table-hover align-middle nowrap w-100">

                    <thead class="table-light">
                        <tr>
                            <th style="width:60px;">#</th>
                            <th>Modelo</th>
                            <th>Placa</th>
                            <th>Cor</th>
                            <th>Status</th>
                            <th class="text-center" style="width:140px;">Ações</th>
                        </tr>
                    </thead>

                    <tbody>

                    <?php foreach ($veiculos as $vei): ?>

                        <tr>

                            <td class="text-muted fw-semibold">
                                #<?= $vei['id'] ?>
                            </td>

                            <td class="fw-semibold">
                                <?= htmlspecialchars($vei['modelo']) ?>
                            </td>

                            <td class="font-monospace text-muted">
                                <?php 
                                    $placa = htmlspecialchars($vei['placa']);
                                    echo (strlen($placa) === 7) ? substr($placa, 0, 3) . '-' . substr($placa, 3) : $placa;
                                ?>
                            </td>

                            <td>
                                <span class="badge bg-light text-dark border">
                                    <?= htmlspecialchars($vei['cor'] ?? 'Não informada') ?>
                                </span>
                            </td>

                            <td>

                                <?php if (!empty($vei['ativo'])): ?>

                                    <span class="badge bg-success-subtle text-success border border-success-subtle">
                                        Disponível
                                    </span>

                                <?php else: ?>

                                    <span class="badge bg-danger-subtle text-danger border border-danger-subtle">
                                        Inativo
                                    </span>

                                <?php endif; ?>

                            </td>

                            <td class="text-center">

                                <div class="d-flex justify-content-center gap-2">

                                    <button
                                        class="btn btn-sm btn-outline-secondary rounded-pill px-3"
                                        data-bs-toggle="modal"
                                        data-bs-target="#modalVeiculo<?= $vei['id'] ?>">
                                        <i class="fas fa-circle-info"></i>
                                    </button>

                                    <a href="<?= BASE_URL ?>/veiculos/editar/<?= $vei['id'] ?>"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                        <i class="fas fa-edit"></i>
                                    </a>

                                    <a href="<?= BASE_URL ?>/veiculos/excluir/<?= $vei['id'] ?>"
                                       class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                       onclick="return confirm('Deseja realmente excluir este veículo?')">
                                        <i class="fas fa-trash"></i>
                                    </a>

                                </div>

                            </td>

                        </tr>

                    <?php endforeach; ?>

                    </tbody>

                </table>

            </div>

        <?php else: ?>

            <div class="text-center py-5 text-muted">

                <i class="fas fa-car fa-3x mb-3 opacity-50"></i>

                <h5>Nenhum veículo cadastrado</h5>

                <p class="small text-muted mb-3">
                    Clique no botão acima para adicionar o primeiro veículo à frota.
                </p>

                <a href="<?= BASE_URL ?>/veiculos/criar"
                   class="btn btn-primary btn-sm">
                    <i class="fas fa-plus-circle me-1"></i>
                    Cadastrar
                </a>

            </div>

        <?php endif; ?>

    </div>

</div>

<?php if (!empty($veiculos)): ?>
    <?php foreach ($veiculos as $vei): ?>

        <div class="modal fade"
             id="modalVeiculo<?= $vei['id'] ?>"
             tabindex="-1">

            <div class="modal-dialog modal-dialog-centered">

                <div class="modal-content">

                    <div class="modal-header">

                        <h5 class="modal-title fw-bold">
                            Veículo #<?= $vei['id'] ?>
                        </h5>

                        <button type="button"
                                class="btn-close"
                                data-bs-dismiss="modal">
                        </button>

                    </div>

                    <div class="modal-body">

                        <p>
                            <strong>Modelo:</strong>
                            <?= htmlspecialchars($vei['modelo']) ?>
                        </p>

                        <p>
                            <strong>Placa:</strong>
                            <span class="font-monospace">
                                <?php 
                                    $placa = htmlspecialchars($vei['placa']);
                                    echo (strlen($placa) === 7) ? substr($placa, 0, 3) . '-' . substr($placa, 3) : $placa;
                                ?>
                            </span>
                        </p>

                        <p>
                            <strong>Cor:</strong>
                            <?= htmlspecialchars($vei['cor'] ?? '-') ?>
                        </p>

                        <p>
                            <strong>Status:</strong>
                            <?= !empty($vei['ativo']) ? 'Disponível para uso' : 'Inativo / Manutenção' ?>
                        </p>

                        <p class="small text-muted mb-0 mt-3">
                            <strong>Cadastrado em:</strong> 
                            <?= date('d/m/Y H:i', strtotime($vei['criado_em'])) ?>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    <?php endforeach; ?>
<?php endif; ?>

</main>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.5.0/js/responsive.bootstrap5.min.js"></script>

<script>
$(document).ready(function () {

    ['toastSucesso', 'toastErro'].forEach(id => {
        const el = document.getElementById(id);

        if (el) {
            new bootstrap.Toast(el, {
                delay: id === 'toastSucesso' ? 4000 : 5000
            }).show();
        }
    });

    // Inicialização da tabela atualizada para a frota
    $('#tabelaVeiculos').DataTable({
        responsive: true,
        autoWidth: false,
        pageLength: 10,
        lengthMenu: [5, 10, 25, 50, 100],
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
        },
        columnDefs: [
            {
                orderable: false,
                targets: 5 // Desativa a ordenação na coluna de ações (índice 5)
            }
        ]
    });

});
</script>

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>