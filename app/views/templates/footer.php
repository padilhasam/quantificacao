        </main>
        <!-- /content -->

    </div>
    <!-- /app-body -->

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container text-center py-3">
            <small>
                &copy; <?= date('Y') ?> <?= APP_NAME ?> - Todos os direitos reservados.
            </small>
        </div>
    </footer>

</div>
<!-- /app-wrapper -->

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<!-- Tom-Select -->
<script src="https://cdn.jsdelivr.net/npm/tom-select/dist/js/tom-select.complete.min.js"></script>


<!-- JS do sistema -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="<?= BASE_URL ?>/js/dashboard.js"></script>

<script>
document.addEventListener('DOMContentLoaded', () => {

    const sidebar = document.getElementById('sidebar');
    const btnToggle = document.getElementById('btnToggleSidebar');

    if (!sidebar || !btnToggle) return;

    btnToggle.addEventListener('click', function(e){
        e.stopPropagation();
        sidebar.classList.toggle('show');
    });

    document.addEventListener('click', function(e){

        // somente no mobile/tablet
        if (window.innerWidth >= 992) return;

        if (
            !sidebar.contains(e.target) &&
            !btnToggle.contains(e.target)
        ){
            sidebar.classList.remove('show');
        }

    });

});
</script>

</body>
</html>
