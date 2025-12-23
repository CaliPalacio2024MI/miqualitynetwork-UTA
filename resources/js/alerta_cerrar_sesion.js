document.addEventListener('DOMContentLoaded', ()=> {

    // Sección alerta cerrar sesión
    var contenedor_alerta_sesion = document.querySelector(".contenedor-alerta-cerrar-sesion");
    var form_cerrar_sesion = document.querySelector(".cerrar-sesion");
    var btn_aceptar_cerrar_alerta = document.querySelector(".btn-cerrar-sesion");
    var btn_cancelar_cerrar_alerta = document.querySelector(".btn-cerrar-sesion-cancelar");
    var cerrar_sesion = false;

    if(form_cerrar_sesion){
        form_cerrar_sesion.addEventListener('submit', function(event) {
            if(!cerrar_sesion) {
                event.preventDefault();
                contenedor_alerta_sesion.style.display = "flex";
            }
        });
    }

    if (btn_aceptar_cerrar_alerta) {
        btn_aceptar_cerrar_alerta.addEventListener('click', function() {
            contenedor_alerta_sesion.style.display = "none";
            cerrar_sesion = true;
            form_cerrar_sesion.submit();
        });
    }

    if (btn_cancelar_cerrar_alerta) {
        btn_cancelar_cerrar_alerta.addEventListener('click', function () {
            contenedor_alerta_sesion.style.display = "none";
            cerrar_sesion = false; 
           
        });
    }

});
