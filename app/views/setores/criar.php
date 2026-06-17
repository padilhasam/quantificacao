<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<main class="content flex-grow-1 pt-3 px-4 pb-4 bg-light-subtle">
    <div class="container-fluid px-2 px-lg-4 mb-4">
        
        <header class="mb-4 px-4 py-3 bg-white border rounded-3 shadow-sm d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h3 class="m-0 fw-bold text-dark d-flex align-items-center gap-3" style="font-size: 1.5rem;">
                    <span class="icon-container d-flex align-items-center justify-content-center"
                        style="width: 38px; height: 38px; background: linear-gradient(135deg, #0d6efd, #0a58ca); border-radius: 8px; box-shadow: 0 2px 6px rgba(13, 110, 253, 0.2);">
                        <i class="fas fa-sitemap text-white" style="font-size: 1.10rem;"></i>
                    </span>
                    Cadastrar Setor
                </h3>
                <small class="text-muted d-block mt-1">Adicione uma nova divisão operacional vinculada à sua respectiva unidade</small>
            </div>

            <a href="<?= BASE_URL ?>/setores" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-medium">
                <i class="fas fa-arrow-left me-1"></i> Voltar à Lista
            </a>
        </header>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                
                <form action="<?= BASE_URL ?>/setores/salvar" method="POST" class="needs-validation" novalidate>
                    
                    <div class="border rounded-3 p-3 mb-4 bg-light-subtle">
                        <h6 class="text-primary fw-bold mb-3 d-flex align-items-center gap-2">
                            <i class="fas fa-layer-group"></i> Estrutura Operacional
                        </h6>
                        
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="unidade_id" class="form-label fw-semibold text-secondary small">Unidade Alvo *</label>
                                <select class="form-select rounded-3 border-dark-subtle" name="unidade_id" id="unidade_id" required>
                                    <option value="" disabled selected>Selecione uma unidade...</option>
                                    </select>
                                <div class="invalid-feedback">Por favor, selecione uma unidade para o setor.</div>
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <label for="nome" class="form-label fw-semibold text-secondary small">Nome do Setor / Departamento *</label>
                                <input type="text" class="form-control rounded-3 border-dark-subtle" name="nome" id="nome" placeholder="Ex: Almoxarifado, Recursos Humanos" required>
                                <div class="invalid-feedback">O nome do setor é obrigatório.</div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="<?= BASE_URL ?>/setores" class="btn btn-outline-danger rounded-pill px-4 fw-medium">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-success rounded-pill px-4 fw-medium shadow-sm">
                            <i class="fas fa-check me-1"></i> Salvar Setor
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Ativa a validação visual nativa do Bootstrap 5
    const forms = document.querySelectorAll('.needs-validation');
    Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }
            form.classList.add('was-validated');
        }, false);
    });
});
</script>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>