// resources/js/layout-adjustments.js

function adjustLayoutForNavbarAndSidebar() {
    const main = document.querySelector('main');
    if (!main) return;

    if (document.querySelector('nav.navbar')) {
        main.classList.add('content-with-navbar');
    }
    
    if (document.querySelector('#sidebar')) {
        main.classList.add('content-with-sidebar');
    }
}

// Ejecutar al cargar y también si el DOM cambia (para SPA)
document.addEventListener('DOMContentLoaded', adjustLayoutForNavbarAndSidebar);
document.addEventListener('turbolinks:load', adjustLayoutForNavbarAndSidebar); // Para Turbolinks