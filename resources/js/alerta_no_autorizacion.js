document.addEventListener("DOMContentLoaded", function() {
    let mensaje = document.querySelector('meta[name="mensaje"]').getAttribute("content");
    var alerta_no_autorizado = document.querySelector(".contenedor-alerta-no-autorizado");
    var btn_aceptar_boton_alerta_no_autorizado = document.querySelector(".btn-aceptar-alerta-no-autorizado");

    if (mensaje === "1") {
        alerta_no_autorizado.style.display = "flex";
    }
    if (btn_aceptar_boton_alerta_no_autorizado) {
        btn_aceptar_boton_alerta_no_autorizado.addEventListener('click', function () {
            alerta_no_autorizado.style.display = "none";
        });
    }
});
