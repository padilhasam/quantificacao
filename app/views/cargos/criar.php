<?php require_once dirname(__DIR__) . '/templates/header.php'; ?>

<main class="content flex-grow-1 pt-3 px-4 pb-4 bg-light-subtle">
    <div class="container-fluid px-2 px-lg-4 mb-4">
        <div class="pb-3 border-bottom mb-4">
            <h2 class="fw-bold text-dark mb-1 page-header-title">Cadastrar Cargo / Função</h2>
            <p class="text-muted small mb-0">Insira um novo cargo vinculando-o ao seu respectivo setor.</p>
        </div>

        <div class="card border-0 shadow-sm rounded-3">
            <div class="card-body p-4">
                <form action="<?= BASE_URL ?>/cargos/salvar" method="POST">
                    <div class="row g-3">
                        <div class="col-12 col-md-5">
                            <label class="form-label fw-semibold text-secondary small">Setor Vinculado</label>
                            <select class="form-select" name="setor_id" required>
                                <option value="">Selecione um setor...</option>
                                </select>
                        </div>
                        <div class="col-12 col-md-4">
                            <label class="form-label fw-semibold text-secondary small">Nome do Cargo</label>
                            <input type="text" class="form-control" name="nome" placeholder="Ex: Auxiliar de Produção" required>
                        </div>
                        <div class="col-12 col-md-3">
                            <label class="form-label fw-semibold text-secondary small">Código CBO</label>
                            <input type="text" class="form-control font-monospace" name="cbo" placeholder="Ex: 721215">
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold text-secondary small">Descrição das Atividades (Opcional)</label>
                            <textarea class="form-control" name="descricao" rows="3" placeholder="Descreva sucintamente as atribuições da função para facilitar a avaliação de riscos nos laudos..."></textarea>
                        </div>
                    </div>
                    <div class="mt-4 pt-3 border-top d-flex justify-content-end gap-2">
                        <a href="<?= BASE_URL ?>/cargos" class="btn btn-outline-secondary px-4 fw-semibold">Cancelar</a>
                        <button type="submit" class="btn btn-primary px-4 fw-semibold shadow-sm">Salvar Cargo</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</main>

<?php require_once dirname(__DIR__) . '/templates/footer.php'; ?>