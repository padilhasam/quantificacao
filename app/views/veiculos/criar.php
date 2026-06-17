<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>/css/veiculos.css">

<div class="container py-4">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">

        <div>
            <h3 class="mb-0 fw-bold">
                <i class="fas fa-car me-2 text-primary"></i>
                Cadastrar Veículo
            </h3>
            <small class="text-muted">
                Preencha os dados do novo veículo da frota
            </small>
        </div>

        <a href="<?= BASE_URL ?>/veiculos" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Voltar
        </a>

    </div>

    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form action="<?= BASE_URL ?>/veiculos/salvar" method="POST">

                <div class="row g-3">

                    <div class="col-12 col-md-6">
                        <label class="form-label fw-semibold">Modelo / Marca *</label>
                        <input type="text" 
                               class="form-control" 
                               name="modelo" 
                               placeholder="Ex: Fiat Uno 1.0 / Toyota Hilux" 
                               required>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label fw-semibold">Placa *</label>
                        <input type="text" 
                               class="form-control text-uppercase font-monospace" 
                               name="placa" 
                               id="placa" 
                               placeholder="ABC1D23" 
                               maxlength="7"
                               required>
                    </div>

                    <div class="col-12 col-md-3">
                        <label class="form-label">Cor</label>
                        <input type="text" 
                               class="form-control" 
                               name="cor" 
                               placeholder="Ex: Branco, Prata">
                    </div>

                    <div class="col-12 mt-4">

                        <input type="hidden" name="ativo" value="0">

                        <div class="form-check form-switch d-flex align-items-center gap-3">

                            <input class="form-check-input" type="checkbox" id="ativo" name="ativo" value="1" checked>

                            <div>
                                <label class="form-check-label fw-semibold mb-0" for="ativo">
                                    Disponibilidade do veículo
                                </label>

                                <div class="status-text">
                                    <span class="badge bg-success text-white px-2 py-1 rounded-pill">
                                        Disponível
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>

                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">

                    <a href="<?= BASE_URL ?>/veiculos" class="btn btn-outline-secondary px-4">
                        Cancelar
                    </a>

                    <button type="submit" class="btn btn-primary px-4">
                        Salvar Veículo
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<script>
document.addEventListener('DOMContentLoaded', function () {

    // Efeito Visual de Status (Ativo / Inativo)
    const switchInput = document.getElementById('ativo');
    const statusText = document.querySelector('.status-text');

    function updateStatus() {
        statusText.innerHTML = switchInput.checked
            ? `<span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">Disponível</span>`
            : `<span class="badge bg-danger-subtle text-danger px-2 py-1 rounded-pill">Inativo / Manutenção</span>`;
    }

    switchInput.addEventListener('change', updateStatus);
    updateStatus();

    // Máscara e validação em tempo real para o campo de Placa (Aceita padrão Antigo e Mercosul)
    const placaInput = document.getElementById('placa');
    if (placaInput) {
        placaInput.addEventListener('input', function (e) {
            // Remove caracteres especiais, mantendo apenas letras e números
            let value = e.target.value.replace(/[^a-zA-Z0-9]/g, '');
            
            // Limita estritamente ao tamanho padrão de placas brasileiras (7 dígitos)
            e.target.value = value.substring(0, 7).toUpperCase();
        });
    }

});
</script>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>