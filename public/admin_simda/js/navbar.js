const toggle = document.getElementById('userToggle');
const menu = document.getElementById('userMenu');
const wrapper = toggle.closest('.user-dropdown');

toggle.addEventListener('click', () => {
    menu.classList.toggle('show');
    wrapper.classList.toggle('open');
});

document.addEventListener('click', (e) => {
    if (!wrapper.contains(e.target)) {
        menu.classList.remove('show');
        wrapper.classList.remove('open');
    }
});