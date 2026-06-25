<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<main class="content flex-grow-1 pt-3 px-4 pb-4 bg-light-subtle">
    <div class="container-fluid px-2 px-lg-4 mb-4">

        <?php
        $erro = $_SESSION['erro'] ?? null;
        unset($_SESSION['erro']);
        ?>

        <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index:9999;">
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
                    <span class="icon-container d-flex align-items-center justify-content-center"
                        style="width: 38px; height: 38px; background: linear-gradient(135deg, #0d6efd, #0a58ca); border-radius: 8px; box-shadow: 0 2px 6px rgba(13, 110, 253, 0.2);">
                        <i class="fas fa-building text-white" style="font-size: 1.10rem;"></i>
                    </span>
                    Cadastrar Empresa
                </h3>
                <small class="text-muted d-block mt-1">
                    Insira os dados cadastrais, localização e contatos da nova empresa cliente/parceira
                </small>
            </div>

            <a href="<?= BASE_URL ?>/empresas" class="btn btn-outline-secondary btn-sm rounded-pill px-3 fw-medium">
                <i class="fas fa-arrow-left me-1"></i> Voltar à Lista
            </a>
        </header>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">

                <form action="<?= BASE_URL ?>/empresas/armazenar" method="POST" class="needs-validation" novalidate>

                    <div class="border rounded-3 p-3 mb-4 bg-light-subtle">
                        <h6 class="text-primary fw-bold mb-3 d-flex align-items-center gap-2">
                            <i class="fas fa-balance-scale"></i> Identificação Jurídica
                        </h6>

                        <div class="row g-3">
                            <div class="col-12 col-md-6">
                                <label for="razao_social" class="form-label fw-semibold text-secondary small">Razão Social *</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-dark-subtle rounded-start-3 text-muted">
                                        <i class="fas fa-file-signature"></i>
                                    </span>
                                    <input type="text" class="form-control rounded-end-3 border-dark-subtle" name="razao_social" id="razao_social" maxlength="200" required>
                                    <div class="invalid-feedback">A razão social é obrigatória.</div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="nome_fantasia" class="form-label fw-semibold text-secondary small">Nome Fantasia</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-dark-subtle rounded-start-3 text-muted">
                                        <i class="fas fa-store"></i>
                                    </span>
                                    <input type="text" class="form-control rounded-end-3 border-dark-subtle" name="nome_fantasia" id="nome_fantasia" maxlength="200">
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="cnpj" class="form-label fw-semibold text-secondary small">CNPJ</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-dark-subtle rounded-start-3 text-muted">
                                        <i class="fas fa-id-card"></i>
                                    </span>
                                    <input type="text" class="form-control rounded-end-3 border-dark-subtle" name="cnpj" id="cnpj" placeholder="00.000.000/0000-00">
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="inscricao_estadual" class="form-label fw-semibold text-secondary small">Inscrição Estadual</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-dark-subtle rounded-start-3 text-muted">
                                        <i class="fas fa-receipt"></i>
                                    </span>
                                    <input type="text" class="form-control rounded-end-3 border-dark-subtle" name="inscricao_estadual" id="inscricao_estadual" maxlength="50">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded-3 p-3 mb-4 bg-light-subtle">
                        <h6 class="text-primary fw-bold mb-3 d-flex align-items-center gap-2">
                            <i class="fas fa-envelope-open-text"></i> Canais de Comunicação
                        </h6>

                        <div class="row g-3">
                            <div class="col-12 col-md-4">
                                <label for="telefone" class="form-label fw-semibold text-secondary small">Telefone Comercial</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-dark-subtle rounded-start-3 text-muted">
                                        <i class="fas fa-phone"></i>
                                    </span>
                                    <input type="text" class="form-control rounded-end-3 border-dark-subtle" name="telefone" id="telefone" placeholder="(00) 0000-0000">
                                </div>
                            </div>

                            <div class="col-12 col-md-8">
                                <label for="email" class="form-label fw-semibold text-secondary small">E-mail Institucional</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-dark-subtle rounded-start-3 text-muted">
                                        <i class="fas fa-envelope"></i>
                                    </span>
                                    <input type="email" class="form-control rounded-end-3 border-dark-subtle" name="email" id="email" placeholder="comercial@empresa.com" maxlength="150">
                                    <div class="invalid-feedback">Insira um e-mail válido.</div>
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="responsavel" class="form-label fw-semibold text-secondary small">Nome do Responsável / Gestor</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-dark-subtle rounded-start-3 text-muted">
                                        <i class="fas fa-user-tie"></i>
                                    </span>
                                    <input type="text" class="form-control rounded-end-3 border-dark-subtle" name="responsavel" id="responsavel" maxlength="150">
                                </div>
                            </div>

                            <div class="col-12 col-md-6">
                                <label for="contato_responsavel" class="form-label fw-semibold text-secondary small">Contato do Responsável</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-dark-subtle rounded-start-3 text-muted">
                                        <i class="fas fa-mobile-screen-button"></i>
                                    </span>
                                    <input type="text" class="form-control rounded-end-3 border-dark-subtle" name="contato_responsavel" id="contato_responsavel" placeholder="(00) 00000-0000">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="border rounded-3 p-3 mb-4 bg-light-subtle">
                        <h6 class="text-primary fw-bold mb-3 d-flex align-items-center gap-2">
                            <i class="fas fa-map-marked-alt"></i> Endereço e Status Cadastral
                        </h6>

                        <div class="row g-3 align-items-center">
                            <div class="col-12 col-md-3">
                                <label for="cep" class="form-label fw-semibold text-secondary small">CEP</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-dark-subtle rounded-start-3 text-muted">
                                        <i class="fas fa-map-pin"></i>
                                    </span>
                                    <input type="text" class="form-control rounded-end-3 border-dark-subtle" name="cep" id="cep" placeholder="00000-000">
                                </div>
                            </div>

                            <div class="col-12 col-md-5">
                                <label for="endereco" class="form-label fw-semibold text-secondary small">Logradouro</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-dark-subtle rounded-start-3 text-muted">
                                        <i class="fas fa-road"></i>
                                    </span>
                                    <input type="text" class="form-control rounded-end-3 border-dark-subtle" name="endereco" id="endereco" placeholder="Ex: Rua das Flores, 123 - Centro">
                                </div>
                            </div>

                            <div class="col-12 col-md-3">
                                <label for="cidade" class="form-label fw-semibold text-secondary small">Cidade</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-dark-subtle rounded-start-3 text-muted">
                                        <i class="fas fa-city"></i>
                                    </span>
                                    <input type="text" class="form-control rounded-end-3 border-dark-subtle" name="cidade" id="cidade">
                                </div>
                            </div>

                            <div class="col-12 col-md-1">
                                <label for="estado" class="form-label fw-semibold text-secondary small">UF</label>
                                <input type="text" class="form-control rounded-3 border-dark-subtle text-uppercase" name="estado" id="estado" maxlength="2">
                            </div>

                            <div class="col-12 mt-4">
                                <input type="hidden" name="ativo" value="0">
                                <div class="form-check form-switch d-flex align-items-center gap-3 ps-0">
                                    <input class="form-check-input switch-lg m-0 border-dark-subtle" type="checkbox" id="ativo" name="ativo" value="1" checked style="cursor: pointer;">
                                    <div>
                                        <label class="form-check-label fw-semibold text-secondary small d-block" for="ativo">Status Cadastral</label>
                                        <div class="status-text mt-0.5">
                                            <span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">Ativo</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 border-top pt-3">
                        <a href="<?= BASE_URL ?>/empresas" class="btn btn-outline-danger rounded-pill px-4 fw-medium">
                            Cancelar
                        </a>

                        <button type="submit" class="btn btn-success rounded-pill px-4 fw-medium shadow-sm">
                            <i class="fas fa-check me-1"></i> Salvar Empresa
                        </button>
                    </div>

                </form>
            </div>
        </div>

    </div>
</main>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const toastErro = document.getElementById('toastErro');

    if (toastErro) {
        new bootstrap.Toast(toastErro, { delay: 5000 }).show();
    }

    const switchInput = document.getElementById('ativo');
    const statusText = document.querySelector('.status-text');

    function updateStatus() {
        statusText.innerHTML = switchInput.checked
            ? `<span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">Ativo</span>`
            : `<span class="badge bg-danger-subtle text-danger px-2 py-1 rounded-pill">Inativo</span>`;
    }

    switchInput.addEventListener('change', updateStatus);
    updateStatus();

    const cnpj = document.getElementById('cnpj');

    cnpj.addEventListener('input', function(e) {
        let v = e.target.value.replace(/\D/g, '');
        v = v.replace(/^(\d{2})(\d)/, '$1.$2')
             .replace(/^(\d{2})\.(\d{3})(\d)/, '$1.$2.$3')
             .replace(/\.(\d{3})(\d)/, '.$1/$2')
             .replace(/(\d{4})(\d)/, '$1-$2');

        e.target.value = v.substring(0, 18);
    });

    const aplicarMascaraTelefone = (id) => {
        const input = document.getElementById(id);

        if (!input) return;

        input.addEventListener('input', function(e) {
            let v = e.target.value.replace(/\D/g, '');
            v = v.replace(/^(\d{2})(\d)/g, '($1) $2');
            v = v.length > 13 ? v.replace(/(\d{5})(\d)/, '$1-$2') : v.replace(/(\d{4})(\d)/, '$1-$2');
            e.target.value = v.substring(0, 15);
        });
    };

    aplicarMascaraTelefone('telefone');
    aplicarMascaraTelefone('contato_responsavel');

    const cep = document.getElementById('cep');

    cep.addEventListener('input', function(e) {
        let v = e.target.value.replace(/\D/g, '');
        v = v.replace(/^(\d{5})(\d)/, '$1-$2');
        e.target.value = v.substring(0, 9);
    });

    cep.addEventListener('blur', function () {
        const cepLimpo = this.value.replace(/\D/g, '');

        if (cepLimpo.length !== 8) return;

        fetch(`https://viacep.com.br/ws/${cepLimpo}/json/`)
            .then(response => response.json())
            .then(data => {
                if (data.erro) {
                    alert('CEP não encontrado.');
                    return;
                }

                document.getElementById('endereco').value = `${data.logradouro}, ${data.bairro}`;
                document.getElementById('cidade').value = data.localidade;
                document.getElementById('estado').value = data.uf;
            })
            .catch(() => {
                alert('Erro ao buscar o CEP. Tente novamente.');
            });
    });

    const email = document.getElementById('email');

    email.addEventListener('blur', function() {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email.value !== '' && !regex.test(email.value)) {
            email.setCustomValidity('Inválido');
            email.classList.add('is-invalid');
        } else {
            email.setCustomValidity('');
            email.classList.remove('is-invalid');
        }
    });

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