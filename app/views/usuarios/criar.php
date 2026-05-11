<?php require_once dirname(__DIR__) . '../templates/header.php'; ?>

<link rel="stylesheet" href="<?= BASE_URL ?>/css/usuarios.css">

<div class="container py-4">

    <!-- HEADER -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-2 mb-4">

        <div>
            <h3 class="mb-0 fw-bold">
                <i class="fas fa-user-plus me-2 text-primary"></i>
                Cadastrar Usuário
            </h3>
            <small class="text-muted">Preencha os dados do novo usuário do sistema</small>
        </div>

        <a href="<?= BASE_URL ?>/usuarios" class="btn btn-outline-secondary">
            <i class="fas fa-arrow-left me-2"></i> Voltar
        </a>

    </div>

    <!-- CARD FORM -->
    <div class="card shadow-sm border-0">
        <div class="card-body p-4">

            <form action="<?= BASE_URL ?>/usuarios/salvar" method="POST">

                <div class="row g-3">

                    <!-- NOME -->
                    <div class="col-12 col-md-12">
                        <label class="form-label">Nome</label>

                        <input 
                            type="text"
                            class="form-control form-control-md"
                            name="nome"
                            placeholder="Digite o nome completo"
                            required
                        >
                    </div>

                    <!-- EMAIL -->
                    <div class="col-12 col-md-12">
                        <label class="form-label">E-mail</label>

                        <input 
                            type="email"
                            class="form-control form-control-md"
                            name="email"
                            id="email"
                            placeholder="exemplo@empresa.com.br"
                            autocomplete="off"
                            required
                        >
                    </div>

                    <!-- SENHA -->
                    <div class="col-12 col-md-6">
                        <label class="form-label">Senha</label>

                        <input 
                            type="password"
                            class="form-control"
                            name="senha"
                            placeholder="Digite uma senha segura"
                            required
                        >
                    </div>

                    <!-- TIPO -->
                    <div class="col-12 col-md-6">
                        <label class="form-label">Tipo</label>

                        <select class="form-select" name="tipo">

                            <option value="ADMIN">
                                Administrador
                            </option>

                            <option value="TECNICO" selected>
                                Técnico
                            </option>

                            <option value="CLIENTE">
                                Cliente
                            </option>

                            <option value="VISUALIZADOR">
                                Visualizador
                            </option>

                        </select>
                    </div>

                    <!-- TELEFONE -->
                    <div class="col-12 col-md-6">
                        <label class="form-label">Telefone</label>

                        <input 
                            type="text"
                            class="form-control"
                            name="telefone"
                            id="telefone"
                            placeholder="(41) 99999-9999"
                        >
                    </div>

                    <!-- STATUS -->
                    <div class="status-switch w-100">

                        <input type="hidden" name="ativo" value="0">

                        <div class="form-check form-switch d-flex align-items-center gap-3">

                            <input 
                                class="form-check-input switch-lg"
                                type="checkbox"
                                id="ativo"
                                name="ativo"
                                value="1"
                                checked
                            >

                            <div>

                                <label class="form-check-label fw-semibold mb-0" for="ativo">
                                    Status do usuário
                                </label>

                                <div class="status-text">

                                    <span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">
                                        Ativo
                                    </span>

                                </div>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- BOTÕES -->
                <div class="d-flex justify-content-end flex-wrap gap-2 mt-4">

                    <a href="<?= BASE_URL ?>/usuarios" class="btn btn-outline-secondary px-4">
                        <i class="fas fa-times me-2"></i> Cancelar
                    </a>

                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-check me-2"></i> Salvar Usuário
                    </button>

                </div>

            </form>

        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const switchInput = document.getElementById('ativo');
        const statusText = document.querySelector('.status-text');

        function updateStatus() {
            if (switchInput.checked) {
                statusText.innerHTML = `
                    <span class="badge bg-success-subtle text-success px-2 py-1 rounded-pill">
                        Ativo
                    </span>
                `;
            } else {
                statusText.innerHTML = `
                    <span class="badge bg-danger-subtle text-danger px-2 py-1 rounded-pill">
                        Inativo
                    </span>
                `;
            }
        }

        switchInput.addEventListener('change', updateStatus);
        updateStatus();
    });

    // Máscara TELEFONE
    const telefone = document.getElementById('telefone');

    telefone.addEventListener('input', function(e) {

        let value = e.target.value.replace(/\D/g, '');

        value = value.replace(/^(\d{2})(\d)/g, '($1) $2');

        value = value.replace(/(\d{5})(\d)/, '$1-$2');

        e.target.value = value.substring(0, 15);
    });


    // Validação visual EMAIL
    const email = document.getElementById('email');

    email.addEventListener('blur', function() {

        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (email.value !== '' && !regex.test(email.value)) {

            email.classList.add('is-invalid');

        } else {

            email.classList.remove('is-invalid');
        }
    });

</script>

<?php require_once dirname(__DIR__) . '../templates/footer.php'; ?>