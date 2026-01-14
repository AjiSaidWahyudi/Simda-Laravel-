const toggleBtn = document.getElementById('toggleSidebar');
const sidebar = document.querySelector('.sidebar');
const overlay = document.getElementById('sidebarOverlay');

toggleBtn?.addEventListener('click', () => {
    sidebar.classList.add('active');
    overlay.classList.add('active');
    document.body.classList.add('sidebar-open');
});

overlay?.addEventListener('click', closeSidebar);

document.querySelectorAll('.menu a').forEach(link => {
    link.addEventListener('click', closeSidebar);
});

function closeSidebar() {
    sidebar.classList.remove('active');
    overlay.classList.remove('active');
    document.body.classList.remove('sidebar-open');
}

document.getElementById('closeSidebar')?.addEventListener('click', closeSidebar);