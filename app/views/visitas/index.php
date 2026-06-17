<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<div class="container py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h3 class="mb-0 fw-bold text-dark d-flex align-items-center gap-2">
                <i class="fas fa-calendar-check text-primary"></i>
                Controle de Visitas e Veículos
            </h3>
            <small class="text-muted">Gerencie os agendamentos de visitas técnicas e reservas da frota</small>
        </div>
        
        <a href="<?= BASE_URL ?>/visitas/criar" class="btn btn-primary rounded-pill px-4 shadow-sm">
            <i class="fas fa-calendar-plus me-2"></i> Novo Agendamento
        </a>
    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light text-secondary fw-semibold">
                        <tr>
                            <th class="ps-4">ID</th>
                            <th>Usuário (Agendado por)</th>
                            <th>Veículo Alocado</th>
                            <th>Destino (Empresa / Unidade)</th>
                            <th>Data / Horário</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (isset($visitas) && !empty($visitas)): ?>
                            <?php foreach ($visitas as $visita): ?>
                                <tr>
                                    <td class="ps-4 text-muted fw-bold">#<?= $visita['id'] ?></td>
                                    
                                    <td>
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px;">
                                                <i class="fas fa-user text-xs"></i>
                                            </div>
                                            <div>
                                                <span class="fw-semibold d-block text-dark"><?= htmlspecialchars($visita['usuario_nome'] ?? 'Não informado') ?></span>
                                                <small class="text-muted text-xs"><?= htmlspecialchars($visita['usuario_email'] ?? '') ?></small>
                                            </div>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <?php if (!empty($visita['veiculo_id'])): ?>
                                            <div class="d-flex align-items-center gap-2">
                                                <span class="text-secondary"><i class="fas fa-car"></i></span>
                                                <div>
                                                    <span class="d-block fw-medium text-sm"><?= htmlspecialchars($visita['veiculo_modelo']) ?></span>
                                                    <span class="badge bg-light text-dark border font-monospace text-uppercase" style="font-size: 0.7rem;">
                                                        <?= htmlspecialchars($visita['veiculo_placa']) ?>
                                                    </span>
                                                </div>
                                            </div>
                                        <?php else: ?>
                                            <span class="text-muted text-sm"><i class="fas fa-walking me-1"></i> Sem veículo (A pé / Carona)</span>
                                        <?php endif; ?>
                                    </td>
                                    
                                    <td>
                                        <div>
                                            <span class="text-dark fw-medium d-block text-truncate" style="max-width: 200px;" title="<?= htmlspecialchars($visita['empresa_nome']) ?>">
                                                <i class="fas fa-building text-muted me-1"></i>
                                                <?= htmlspecialchars($visita['empresa_nome']) ?>
                                            </span>
                                            <?php if (!empty($visita['unidade_nome'])): ?>
                                                <small class="text-muted ps-3">
                                                    <i class="fas fa-location-dot me-1" style="font-size: 0.75rem;"></i>
                                                    <?= htmlspecialchars($visita['unidade_nome']) ?>
                                                </small>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <div class="text-sm">
                                            <span class="d-block text-dark fw-medium">
                                                <i class="far fa-calendar me-1 text-muted"></i>
                                                <?= date('d/m/Y', strtotime($visita['data_visita'])) ?>
                                            </span>
                                            <small class="text-muted">
                                                <i class="far fa-clock me-1"></i>
                                                <?= !empty($visita['hora_visita']) ? substr($visita['hora_visita'], 0, 5) : 'Não def.' ?>
                                            </small>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <?php 
                                        $status = $visita['status'] ?? 'ABERTA';
                                        if ($status === 'FINALIZADA') {
                                            echo '<span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">Finalizada</span>';
                                        } elseif ($status === 'CANCELADA') {
                                            echo '<span class="badge bg-danger-subtle text-danger px-2 py-1 rounded-pill">Cancelada</span>';
                                        } else {
                                            echo '<span class="badge bg-warning-subtle text-warning px-2 py-1 rounded-pill">Aberta</span>';
                                        }
                                        ?>
                                    </td>
                                    
                                    <td class="text-end pe-4">
                                        <div class="btn-group btn-group-sm">
                                            <a href="<?= BASE_URL ?>/visitas/visualizar/<?= $visita['id'] ?>" class="btn btn-outline-secondary" title="Ver Detalhes">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <?php if ($status === 'ABERTA'): ?>
                                                <a href="<?= BASE_URL ?>/visitas/cancelar/<?= $visita['id'] ?>" class="btn btn-outline-danger" title="Cancelar" onclick="return confirm('Deseja realmente cancelar este agendamento?')">
                                                    <i class="fas fa-ban"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" class="text-center py-5 text-muted">
                                    <i class="fas fa-calendar-times display-6 d-block mb-3 text-black-50"></i>
                                    Nenhuma visita ou agendamento de veículo encontrado.
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>