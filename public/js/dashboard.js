const btnToggleSidebar = document.getElementById('btnToggleSidebar');
const sidebar = document.getElementById('sidebar');

if (btnToggleSidebar && sidebar) {
     btnToggleSidebar.addEventListener('click', () => {
        sidebar.classList.toggle('active');
    });
}