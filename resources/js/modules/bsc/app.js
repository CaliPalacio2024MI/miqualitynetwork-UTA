

document.addEventListener('DOMContentLoaded', function() {
    // Ajustes para navbar
    if (document.querySelector('nav.navbar')) {
        document.querySelector('main').classList.add('content-with-navbar');
    }
    
    // Ajustes para sidebar
    if (document.querySelector('#sidebar')) {
        document.querySelector('main').classList.add('content-with-sidebar');
    }
});