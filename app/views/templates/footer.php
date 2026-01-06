  </main>
        <!-- /content -->

    </div>
    <!-- /app-body -->

    <!-- FOOTER -->
    <footer class="footer text-center py-3">
        <div class="container">
            <small>
                &copy; <?= date('Y') ?> <?= APP_NAME ?> - Todos os direitos reservados.
            </small>
        </div>
    </footer>

</div>
<!-- /app-wrapper -->

<!-- Bootstrap JS (necessário para dropdown funcionar) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- JS do sistema -->
<script>
    const btnToggleSidebar = document.getElementById('btnToggleSidebar');
    const sidebar = document.getElementById('sidebar');

    if (btnToggleSidebar && sidebar) {
        btnToggleSidebar.addEventListener('click', () => {
            sidebar.classList.toggle('active');
        });
    }
</script>

</body>
</html>