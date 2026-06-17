<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<main class="content flex-grow-1 pt-3 px-4 pb-4 bg-light-subtle">
    <div class="container-fluid px-2 px-lg-4 mb-4">
        
        <header class="mb-4 px-4 py-3 bg-white border rounded-3 shadow-sm d-flex align-items-center justify-content-between flex-wrap gap-3">
            <div>
                <h3 class="m-0 fw-bold text-dark d-flex align-items-center gap-3" style="font-size: 1.5rem;">
                    <span class="icon-container d-flex align-items-center justify-content-center"
                        style="width: 38px; height: 38px; background: linear-gradient(135deg, #0d6efd, #0a58ca); border-radius: 8px; box-shadow: 0 2px 6px rgba(13, 110, 253, 0.2);">
                        <i class="fas fa-map-marked-alt text-white" style="font-size: 1.10rem;"></i>
                    </span>
                    Cadastrar Unidade
                </h3>
                <small class="text-muted d-block mt-1">Insira os dados cadastrais, localização e vínculo institucional da nova unidade física</small>
            </div>

            <a href="<?= BASE_URL ?>/unidades" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-medium">
                <i class="fas fa-arrow-left me-1"></i> Voltar à Lista
            </a>
        </header>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                
                <form action="<?= BASE_URL ?>/unidades/salvar" method="POST" class="needs-validation" novalidate>
                    
                    <div class="border rounded-3 p-3 mb-4 bg-light-subtle">
                        <h6 class="text-primary fw-bold mb-3 d-flex align-items-center gap-2">
                            <i class="fas fa-id-card"></i> Identificação Estrutural
                        </h6>
                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="empresa_id" class="form-label fw-semibold text-secondary small">Empresa Responsável *</label>
                                <select class="form-select rounded-3 border-dark-subtle" name="empresa_id" id="empresa_id" required>
                                    <option value="" disabled selected>Selecione a empresa proprietária...</option>
                                    <?php if (!empty($empresas)): ?>
                                        <?php foreach ($empresas as $emp): ?>
                                            <option value="<?= $emp['id'] ?>">
                                                <?= htmlspecialchars($emp['nome_fantasia'] ?? $emp['razao_social']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                                <div class="invalid-feedback">Selecione a empresa vinculada a esta unidade.</div>
                            </div>
                            
                            <div class="col-12 col-md-6">
                                <label for="nome" class="form-label fw-semibold text-secondary small">Nome da Unidade / Filial *</label>
                                <input type="text" class="form-control rounded-3 border-dark-subtle" name="nome" id="nome" placeholder="Ex: Planta Industrial Principal" maxlength="150" required>
                                <div class="invalid-feedback">O nome da unidade é obrigatório.</div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="cnpj" class="form-label fw-semibold text-secondary small">CNPJ da Unidade (Se houver)</label>
                                <input type="text" class="form-control rounded-3 border-dark-subtle" name="cnpj" id="cnpj" placeholder="00.000.000/0000-00">
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="telefone" class="form-label fw-semibold text-secondary small">Telefone de Contato</label>
                                <input type="text" class="form-control rounded-3 border-dark-subtle" name="telefone" id="telefone" placeholder="(41) 3333-3333">
                            </div>
                        </div>
                    </div>

                    <div class="border rounded-3 p-3 mb-4 bg-light-subtle">
                        <h6 class="text-primary fw-bold mb-3 d-flex align-items-center gap-2">
                            <i class="fas fa-map-marker-alt"></i> Endereço e Diretrizes
                        </h6>
                        <div class="row g-3 align-items-center">
                            <div class="col-12 col-md-5">
                                <label for="endereco" class="form-label fw-semibold text-secondary small">Logradouro (Rua, Número, Bairro)</label>
                                <input type="text" class="form-control rounded-3 border-dark-subtle" name="endereco" id="endereco" placeholder="Ex: Av. das Nações, 2500 - Distrito Industrial">
                            </div>
                            
                            <div class="col-12 col-md-4">
                                <label for="cidade_uf" class="form-label fw-semibold text-secondary small">Cidade / UF</label>
                                <input type="text" class="form-control rounded-3 border-dark-subtle" name="cidade_uf" id="cidade_uf" placeholder="Ex: Araucária / PR">
                            </div>

                            <div class="col-12 col-md-3 mt-md-4 pt-md-2">
                                <input type="hidden" name="ativo" value="0">
                                <div class="form-check form-switch d-flex align-items-center gap-3 ps-0 ps-md-4">
                                    <input class="form-check-input switch-lg m-0 border-dark-subtle" type="checkbox" id="ativo" name="ativo" value="1" checked style="cursor: pointer;">
                                    <div>
                                        <label class="form-check-label fw-semibold text-secondary small d-block" for="ativo">Status da Unidade</label>
                                        <div class="status-text mt-0.5">
                                            <span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">Ativo</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="<?= BASE_URL ?>/unidades" class="btn btn-outline-danger rounded-pill px-4 fw-medium">
                            Cancelar
                        </a>
                        <button type="submit" class="btn btn-success rounded-pill px-4 fw-medium shadow-sm">
                            <i class="fas fa-check me-1"></i> Salvar Unidade
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Gerenciamento visual do Switch de Status
    const switchInput = document.getElementById('ativo');
    const statusText = document.querySelector('.status-text');

    function updateStatus() {
        if (switchInput.checked) {
            statusText.innerHTML = `<span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">Ativo</span>`;
        } else {
            statusText.innerHTML = `<span class="badge bg-danger-subtle text-danger px-2 py-1 rounded-pill">Inativo</span>`;
        }
    }
    switchInput.addEventListener('change', updateStatus);

    // Máscara reativa para CNPJ
    const cnpjInput = document.getElementById('cnpj');
    cnpjInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/^(\d{2})(\d)/, '$1.$2');
        value = value.replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3');
        value = value.replace(/\.(\d{3})(\d)/, '.$1/$2');
        value = value.replace(/(\d{4})(\d)/, '$1-$2');
        e.target.value = value.substring(0, 18);
    });

    // Máscara reativa para Telefone/Celular
    const telInput = document.getElementById('telefone');
    telInput.addEventListener('input', function(e) {
        let value = e.target.value.replace(/\D/g, '');
        value = value.replace(/^(\d{2})(\d)/g, '($1) $2');
        if (value.length > 9) {
            value = value.replace(/(\d{5})(\d)/, '$1-$2');
        } else {
            value = value.replace(/(\d{4})(\d)/, '$1-$2');
        }
        e.target.value = value.substring(0, 15);
    });

    // Validação nativa do Bootstrap 5
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