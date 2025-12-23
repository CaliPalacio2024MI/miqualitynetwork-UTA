document.addEventListener("DOMContentLoaded", () => {

    //Seccion alerta olvide contraseña

    var alerta = document.querySelector(".alerta");
    var alerta_olvide_contrasena = document.querySelector(".contenedor-alerta-olvide-contrasena");
    var btn_aceptar_boton_alerta_olvide_contrasena = document.querySelector(".btn-aceptar-alerta-olvide-contrasena");


    if (alerta) {
        alerta.addEventListener('click', function(event) {
            alerta_olvide_contrasena.style.display = "flex";
        });
    }
    if (btn_aceptar_boton_alerta_olvide_contrasena) {
        btn_aceptar_boton_alerta_olvide_contrasena.addEventListener('click', function () {
            alerta_olvide_contrasena.style.display = "none";
        });
    }
    //Fin seccion alerta olvide contraseña

    //seccion alerta contraseña incorrecta
    const backendError = document.getElementById('error-backend');
    const contenedor_alerta_contrasena_incorrecta = document.querySelector('.contenedor-alerta-contrasena-incorrecta');
    const btnCerrar_incorrecta = document.querySelector('.btn-aceptar-alerta-contrasena-incorrecta');

    if (backendError?.dataset.error === 'true' && contenedor_alerta_contrasena_incorrecta) {
        contenedor_alerta_contrasena_incorrecta.style.display = 'flex';

        setTimeout(() => {
            contenedor_alerta_contrasena_incorrecta.style.display = 'none';
        }, 15000);
    }

    if (btnCerrar_incorrecta) {
        btnCerrar_incorrecta.addEventListener('click', () => {
            contenedor_alerta_contrasena_incorrecta.style.display = 'none';
        });
    }
    //Fin seccion alerta contraseña incorrecta
});
