document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll('.categoria-item').forEach(item => {
        const button = item.querySelector('.categoria-btn');
        const submenu = item.querySelector('.subcategorias');

        button.addEventListener('mouseenter', () => {
            document.querySelectorAll('.subcategorias').forEach(s => s.style.display = 'none');
            document.querySelectorAll('.categoria-btn').forEach(b => b.classList.remove('active'));
            submenu.style.display = 'flex';
            button.classList.add('active');
        });

        item.addEventListener('mouseleave', () => {
            submenu.style.display = 'none';
            button.classList.remove('active');
        });
    });
});
