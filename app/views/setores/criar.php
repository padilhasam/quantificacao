<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<main class="content flex-grow-1 pt-3 px-4 pb-4 bg-light-subtle">
    <div class="container-fluid px-2 px-lg-4 mb-4">
        <div class="pb-3 border-bottom mb-4">
            <h2 class="fw-bold text-dark mb-1 page-header-title">Cadastrar Setor</h2>
            <p class="text-muted small mb-0">Adicione uma nova divisão operacional a uma unidade.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <form action="<?= BASE_URL ?>/setores/salvar" method="POST">
                    <div class="row g-3">
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-secondary small">Selecione a Unidade Alvo</label>
                            <select class="form-select" name="unidade_id" required>
                                <option value="">Selecione uma unidade...</option>
                                </select>
                        </div>
                        <div class="col-12 col-md-6">
                            <label class="form-label fw-semibold text-secondary small">Nome do Setor / Departamento</label>
                            <input type="text" class="form-control" name="nome" placeholder="Ex: Almoxarifado, Recursos Humanos" required>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                        <a href="<?= BASE_URL ?>/setores" class="btn btn-outline-secondary px-4 fw-semibold">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4 fw-semibold shadow-sm">Salvar Setor</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>