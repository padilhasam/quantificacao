<?php 
if (isset($visitas) && !empty($visitas)): 
    foreach ($visitas as $v): 
        $s = $v['status'] ?? 'ABERTA';
        $col = ($s == 'FINALIZADA') ? 'success' : (($s == 'CANCELADA') ? 'danger' : 'warning');
?>
    <tr>
        <td class="ps-4 text-muted fw-bold">#<?= $v['id'] ?></td>
        <td><i class="fas fa-user text-primary me-2"></i><?= htmlspecialchars($v['usuario_nome'] ?? 'N/A') ?></td>
        <td><?= !empty($v['veiculo_modelo']) ? '<i class="fas fa-car text-secondary me-2"></i>' . htmlspecialchars($v['veiculo_modelo']) : '<i class="fas fa-walking text-muted me-2"></i>A pé' ?></td>
        <td><i class="fas fa-building text-secondary me-2"></i><?= htmlspecialchars($v['empresa_nome']) ?></td>
        <td data-raw="<?= date('Y-m-d', strtotime($v['data_visita'])) ?>">
            <div class="fw-bold"><i class="far fa-calendar-alt text-muted me-1"></i><?= date('d/m/Y', strtotime($v['data_visita'])) ?></div>
            <div class="small text-muted ps-3"><i class="far fa-clock me-1"></i><?= substr($v['hora_visita'] ?? '00:00', 0, 5) ?></div>
        </td>
        <td><span class="badge bg-<?= $col ?>-subtle text-<?= $col ?> px-2 py-1 rounded-pill"><?= ucfirst(strtolower($s)) ?></span></td>
        
        <td class="text-end pe-4">
            <div class="d-flex justify-content-end gap-2">
                <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill px-3" data-bs-toggle="modal" data-bs-target="#modalVisita<?= $v['id'] ?>" title="Visualizar Detalhes">
                    <i class="fas fa-circle-info"></i>
                </button>
                
                <?php if ($s !== 'FINALIZADA'): ?>
                    <a href="<?= BASE_URL ?>/visitas/editar?id=<?= $v['id'] ?>" class="btn btn-sm btn-outline-primary rounded-pill px-3" title="Editar">
                        <i class="fas fa-edit"></i>
                    </a>
                    <a href="<?= BASE_URL ?>/visitas/cancelar?id=<?= $v['id'] ?>" class="btn btn-sm btn-outline-danger rounded-pill px-3" title="Cancelar" onclick="return confirm('Tem certeza que deseja cancelar este agendamento?')">
                        <i class="fas fa-ban"></i>
                    </a>
                <?php endif; ?>
            </div>
        </td>
    </tr>
<?php endforeach; else: ?>
    <tr><td colspan="7" class="text-center py-5 text-muted">Nenhum registro encontrado.</td></tr>
<?php endif; ?>