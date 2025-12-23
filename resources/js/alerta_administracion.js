document.addEventListener("DOMContentLoaded", () => {

    //seccion de contenedor de registro de proceso
    var alerta_registro_proceso = document.querySelector(".contenedor-alerta-registro-proceso");
    var form_registro_proceso = document.querySelector(".form-registro-procesos");
    var btn_aceptar_boton_registro_alerta = document.querySelector(".btn-aceptar-boton-registro-alerta");

    var timeoutAlerta;

    if (form_registro_proceso) {
        form_registro_proceso.addEventListener('submit', function(event) {
            event.preventDefault();


            alerta_registro_proceso.style.display = "flex";


            timeoutAlerta = setTimeout(function () {
                form_registro_proceso.submit();
            }, 3000);
        });
    }
    if (btn_aceptar_boton_registro_alerta) {
        btn_aceptar_boton_registro_alerta.addEventListener('click', function () {
            alerta_registro_proceso.style.display = "none";

            clearTimeout(timeoutAlerta);
            form_registro_proceso.submit();
        });
    }
    //Fin seccion de registro de procesos

    //seccion borrar procesos
    var alerta_eliminar_proceso = document.querySelector(".contenedor-alerta-eliminacion-proceso");
    var form_eliminar_proceso = document.querySelectorAll(".formulario-borrar-proceso");
    var btn_aceptar_eliminar_alerta = document.querySelector(".btn-borrar-proceso-alerta");
    var btn_cancelar_eliminar_alerta = document.querySelector(".btn-cancelar-proceso-alerta");
    let formulario_proceso_borrar = null;

    form_eliminar_proceso.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            formulario_proceso_borrar = form;

            alerta_eliminar_proceso.style.display = "flex";
        });
    });
    if (btn_aceptar_eliminar_alerta) {
        btn_aceptar_eliminar_alerta.addEventListener('click', function () {

            alerta_eliminar_proceso.style.display = "none";
            if(formulario_proceso_borrar){
                formulario_proceso_borrar.submit();
            }});
    }
    if (btn_cancelar_eliminar_alerta) {
        btn_cancelar_eliminar_alerta.addEventListener('click', function () {
            alerta_eliminar_proceso.style.display = "none";
            formulario_proceso_borrar = null;
        });
    }
    //fin seccion de borrado de procesos


    //seccion modificado de procesos
    var alerta_modificar_proceso = document.querySelector(".contenedor-alerta-modificar-proceso");
    var form_modificar_proceso = document.querySelectorAll(".formulario-modificacion-nombre-proceso");
    var btn_aceptar_modificado_proceso_alerta = document.querySelector(".btn-aceptar-proceso-alerta");
    var btn_cancelar_modificado_proceso_alerta = document.querySelector(".btn-cancelar-modificacion-proceso-alerta");
    let formulario_modificar_proceso = null;

    form_modificar_proceso.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            formulario_modificar_proceso = form;

            alerta_modificar_proceso.style.display = "flex";
        });
    });
    if (btn_aceptar_modificado_proceso_alerta) {
        btn_aceptar_modificado_proceso_alerta.addEventListener('click', function () {

            alerta_modificar_proceso.style.display = "none";
            if(formulario_modificar_proceso){
                formulario_modificar_proceso.submit();
            }});
    }
    if (btn_cancelar_modificado_proceso_alerta) {
        btn_cancelar_modificado_proceso_alerta.addEventListener('click', function () {
            alerta_modificar_proceso.style.display = "none";
            formulario_modificar_proceso = null;
        });
    }
    //fin seccion de modificado de procesos

    //seccion de contenedor de registro de propiedades
    var alerta_registro_propiedad = document.querySelector(".contenedor-alerta-registro-propiedad");
    var formulario_registro_propiedades = document.querySelector(".form-registro-propiedades");
    var btn_aceptar_propiedad_registro_alerta = document.querySelector(".btn-aceptar-propiedad-registro-alerta");

    var timeoutAlerta_propiedad;

    if (formulario_registro_propiedades) {
        formulario_registro_propiedades.addEventListener('submit', function(event) {
            event.preventDefault();


            alerta_registro_propiedad.style.display = "flex";


            timeoutAlerta_propiedad = setTimeout(function () {
                formulario_registro_propiedades.submit();
            }, 3000);
        });
    }
    if (btn_aceptar_propiedad_registro_alerta) {
        btn_aceptar_propiedad_registro_alerta.addEventListener('click', function () {
            alerta_registro_propiedad.style.display = "none";

            clearTimeout(timeoutAlerta_propiedad);
            formulario_registro_propiedades.submit();
        });
    }
    //Fin seccion de registro de propiedades

    //seccion borrar propiedades
    var alerta_eliminar_propiedad = document.querySelector(".contenedor-alerta-eliminacion-propiedades");
    var form_eliminar_propiedad = document.querySelectorAll(".form-eliminacion-propiedad");
    var btn_aceptar_eliminar_propiedad = document.querySelector(".btn-borrar-propiedades-alerta");
    var btn_cancelar_eliminar_propiedad = document.querySelector(".btn-cancelar-propiedades-alerta");
    let let_propiedades_borrar = null;

    form_eliminar_propiedad.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            let_propiedades_borrar = form;

            alerta_eliminar_propiedad.style.display = "flex";
        });
    });
    if (btn_aceptar_eliminar_propiedad) {
        btn_aceptar_eliminar_propiedad.addEventListener('click', function () {

            alerta_eliminar_propiedad.style.display = "none";
            if(let_propiedades_borrar){
                let_propiedades_borrar.submit();
            }});
    }
    if (btn_cancelar_eliminar_propiedad) {
        btn_cancelar_eliminar_propiedad.addEventListener('click', function () {
            alerta_eliminar_propiedad.style.display = "none";
            let_propiedades_borrar = null;
        });
    }
    //fin seccion de borrado de propiedades

    //seccion modificado de PROPIEDADES
    var alerta_modificar_propiedad = document.querySelector(".contenedor-alerta-modificar-propiedad");
    var form_modificar_propiedad = document.querySelectorAll(".form-modificacion-propiedad");
    var btn_aceptar_modificado_propiedad_alerta = document.querySelector(".btn-aceptar-propiedad-modificacion");
    var btn_cancelar_modificado_propiedad_alerta = document.querySelector(".btn-cancelar-modificacion-propiedad-alerta");
    let let_modificar_propiedad = null;

    form_modificar_propiedad.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            let_modificar_propiedad = form;

            alerta_modificar_propiedad.style.display = "flex";
        });
    });
    if (btn_aceptar_modificado_propiedad_alerta) {
        btn_aceptar_modificado_propiedad_alerta.addEventListener('click', function () {

            alerta_modificar_propiedad.style.display = "none";
            if(let_modificar_propiedad){
                let_modificar_propiedad.submit();
            }});
    }
    if (btn_cancelar_modificado_propiedad_alerta) {
        btn_cancelar_modificado_propiedad_alerta.addEventListener('click', function () {
            alerta_modificar_propiedad.style.display = "none";
            let_modificar_propiedad = null;
            
        });
    }
    //fin seccion de modificado de PROPIEDADES


   //seccion de contenedor de registro de ANFITRIONES
   var alerta_registro_anfitrion = document.querySelector(".contenedor-alerta-registro-anfitriones");
   var form_registro_anfitrion = document.querySelector(".form-registrar-anfitrion");
   var btn_aceptar_anfitrion_registro_alerta = document.querySelector(".btn-aceptar-anfitriones-registro-alerta");

   var timeoutAlerta_anfitrion;

//    if (form_registro_anfitrion) {
//     form_registro_anfitrion.addEventListener('submit', function(event) {
//            event.preventDefault();


//         //    alerta_registro_anfitrion.style.display = "flex";


//            timeoutAlerta_anfitrion = setTimeout(function () {
//             form_registro_anfitrion.submit();
//            }, 3000);
//        });
//    }
//    if (btn_aceptar_anfitrion_registro_alerta) {
//     btn_aceptar_anfitrion_registro_alerta.addEventListener('click', function () {
//         alerta_registro_anfitrion.style.display = "none";

//            clearTimeout(timeoutAlerta_anfitrion);
//         //    form_registro_anfitrion.submit();
//        });
//    }
   //Fin seccion de registro de ANFITRIONES


    //seccion borrar ANFITRIONES
    var alerta_eliminar_anfitriones = document.querySelector(".contenedor-alerta-eliminacion-anfitriones");
    var form_eliminar_anfitriones = document.querySelectorAll(".form-borrar");
    var btn_aceptar_eliminar_anfitriones = document.querySelector(".btn-borrar-anfitriones-alerta");
    var btn_cancelar_eliminar_anfitriones = document.querySelector(".btn-cancelar-anfitriones-alerta");
    let let_anfitriones_borrar = null;

    form_eliminar_anfitriones.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            let_anfitriones_borrar = form;

            alerta_eliminar_anfitriones.style.display = "flex";
        });
    });
    if (btn_aceptar_eliminar_anfitriones) {
        btn_aceptar_eliminar_anfitriones.addEventListener('click', function () {

            alerta_eliminar_anfitriones.style.display = "none";
            if(let_anfitriones_borrar){
                let_anfitriones_borrar.submit();
            }});
    }
    if (btn_cancelar_eliminar_anfitriones) {
        btn_cancelar_eliminar_anfitriones.addEventListener('click', function () {
            alerta_eliminar_anfitriones.style.display = "none";
            let_anfitriones_borrar = null;
        });
    }
    //fin seccion de borrado de Anfitriones


    //seccion modificado de ANFITRIONES
    var alerta_modificar_anfitrion = document.querySelector(".contenedor-alerta-modificar-anfitrion");
    var form_modificar_anfitrion = document.querySelectorAll(".formulario");
    var btn_aceptar_modificado_anfitrion_alerta = document.querySelector(".btn-aceptar-anfitrion-modificacion");
    var btn_cancelar_modificado_anfitrion_alerta = document.querySelector(".btn-cancelar-modificacion-anfitrion-alerta");
    let let_modificar_anfitrion = null;

    form_modificar_anfitrion.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            event.preventDefault();

            let_modificar_anfitrion = form;

            alerta_modificar_anfitrion.style.display = "flex";
        });
    });
    if (btn_aceptar_modificado_anfitrion_alerta) {
        btn_aceptar_modificado_anfitrion_alerta.addEventListener('click', function () {

            alerta_modificar_anfitrion.style.display = "none";
            if(let_modificar_anfitrion){
                let_modificar_anfitrion.submit();
            }});
    }
    if (btn_cancelar_modificado_anfitrion_alerta) {
        btn_cancelar_modificado_anfitrion_alerta.addEventListener('click', function () {
            alerta_modificar_anfitrion.style.display = "none";
            let_modificar_anfitrion = null;
        });
    }
    //fin seccion de modificado de ANFITRIONES


    //AQUI SE GUARDARA EL MOSTRAR EL BOTON DE EDITAR PROCESOS
    const input_editar =document.querySelectorAll(".input-nombre-proceso");
    const btn_actualizar_proceso = document.querySelectorAll(".btn-actualizar")

    input_editar.forEach((input, index) => {
        input.addEventListener('click', function() {
            
            btn_actualizar_proceso.forEach(btn => {
                btn.style.display = "none";
            });
            
            
            if (btn_actualizar_proceso[index]) {
                btn_actualizar_proceso[index].style.display = "flex";
            }
        });
    });

    //AQUI VA EL QUE MUESTRA EL BOTON DE ACTUALIZAR PROPIEDADES DE PROPIEDADES 
    const input_editar_propiedad =document.querySelectorAll(".nombre-propiedad-text");
    const btn_actualizar_propiedad =document.querySelectorAll(".btn-actualizar-propiedad");
    input_editar_propiedad.forEach((input, index) => {
        input.addEventListener('click', function() {
            
            btn_actualizar_propiedad.forEach(btn => {
                btn.style.display = "none";
            });
            
            
            if (btn_actualizar_propiedad[index]) {
                btn_actualizar_propiedad[index].style.display = "flex";
            }
        });
    });
});
