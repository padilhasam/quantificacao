/**
 * ARQUIVO GLOBAL DE SCRIPTS (app.js)
 */

document.addEventListener('DOMContentLoaded', () => {
    // Inicializa automaticamente qualquer toast vindo do PHP
    const toasts = document.querySelectorAll('.toast');
    toasts.forEach(toastEl => {
        // Define o tempo baseado no ID se existir, ou padrão
        const delay = toastEl.id === 'toastSucesso' ? 4000 : 5000;
        new bootstrap.Toast(toastEl, { delay: delay }).show();
    });
});

// Função para disparar novos Toasts via AJAX
function showToast(mensagem, tipo = 'success') {
    const container = document.querySelector('.toast-container');
    const id = 'toast-' + Date.now();
    const classe = tipo === 'success' ? 'text-bg-success' : 'text-bg-danger';
    const icone = tipo === 'success' ? 'fa-circle-check' : 'fa-circle-exclamation';

    const html = `
        <div id="${id}" class="toast ${classe} border-0 shadow-lg" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="d-flex">
                <div class="toast-body">
                    <i class="fas ${icone} me-2"></i> ${mensagem}
                </div>
                <button class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
            </div>
        </div>
    `;

    container.insertAdjacentHTML('beforeend', html);
    const toastEl = document.getElementById(id);
    new bootstrap.Toast(toastEl, { delay: 4000 }).show();
    toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
}