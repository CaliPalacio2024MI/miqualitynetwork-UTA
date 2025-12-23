// Función para validar el formulario
function validarFormulario(event) {
    let errores = [];

    const campos = document.querySelectorAll('input, select');
    let camposVacios = false;



    campos.forEach(campo => {

    // Si el campo tiene el atributo data-optional y es un select, lo saltamos

    if (campo.tagName === 'SELECT' && campo.hasAttribute('data-optional') && campo.getAttribute('data-optional') === 'true') {

    campo.style.backgroundColor = ""; // Asegurarse de que no se resalte si era opcional

 return; // Saltar este campo y continuar con el siguiente en el bucle

}



 if (campo.type === 'radio') {

// Validar radio buttons

const grupoRadioButtons = document.querySelectorAll(`input[name="${campo.name}"]`);
 let radioSeleccionado = false;

grupoRadioButtons.forEach(radio => {

if (radio.checked) {

 radioSeleccionado = true;
}

});

if (!radioSeleccionado) {

 grupoRadioButtons.forEach(radio => {

 radio.style.backgroundColor = "#BABABA";

});

camposVacios = true;

 } else {

 grupoRadioButtons.forEach(radio => {

 radio.style.backgroundColor = "";
});

}

 } else {

// Validar otros campos (input, select)

 if (campo.value === "Sin seleccionar") {

campo.style.backgroundColor = "#F0D4B3";

 camposVacios = true;

} else {

campo.style.backgroundColor = "";

}

}

});

if (camposVacios) {

mostrarPopup("Por favor, completa todos los campos obligatorios."); // Mostrar mensaje en el popup

return false; // Detener el envío del formulario

}

    // Validaciones específicas de campos
    const edadInput = document.querySelector('[name="edad"]');
    // Asegúrate de que el elemento existe antes de intentar acceder a su valor
    if (edadInput) {
        const edad = parseInt(edadInput.value, 10);
        if (isNaN(edad) || edad < 16 || edad > 60) {
            errores.push("La edad debe estar entre 16 y 60 años.");
            edadInput.focus();
        }
    }

    const telefonoInput = document.querySelector('[name="tel-emergencia"]');
    if (telefonoInput) {
        const telefono = telefonoInput.value.replace(/\D/g, "");
        if (telefono.length !== 10) {
            errores.push("El teléfono de emergencias debe tener 10 dígitos.");
            telefonoInput.focus();
        }
    }

    const telefonoPersonalInput = document.querySelector('[name="telefono"]');
    if (telefonoPersonalInput) {
        const telefonoPersonal = telefonoPersonalInput.value.replace(/\D/g, "");
        if (telefonoPersonal.length !== 10) {
            errores.push("El teléfono personal debe tener 10 dígitos.");
            telefonoPersonalInput.focus();
        }
    }

    const zapatoInput = document.querySelector('[name="no-zapato"]');
    if (zapatoInput) {
        const zapato = parseInt(zapatoInput.value, 10);
        if (isNaN(zapato)) {
            errores.push("Digite números para el No. de Zapato.");
            zapatoInput.focus();
        } else if (zapato < 20 || zapato > 35) {
            errores.push("No. de Zapato fuera de rango.");
            zapatoInput.focus();
        }
    }

    const playeraInput = document.querySelector('[name="talla-playera"]');
    if (playeraInput) {
        const playera = playeraInput.value.toUpperCase();
        const tallasValidas = ["XXS", "XS", "S", "M", "L", "XL", "XXL", "3XL", "4XL"];
        const playeraNum = parseInt(playera, 10);
        if (isNaN(playeraNum)) {
            if (!tallasValidas.includes(playera)) {
                errores.push("Talla de Playera no reconocida. (de XXS al 4XL)");
                playeraInput.focus();
            }
        } else if (playeraNum < 70 || playeraNum > 123) {
            errores.push("Talla de Playera fuera de rango. (70 - 123)");
            playeraInput.focus();
        }
    }

    const pantalonInput = document.querySelector('[name="talla-pantalon"]');
    if (pantalonInput) {
        const pantalon = pantalonInput.value.toUpperCase();
        const tallasValidasPantalon = ["XXS", "XS", "S", "M", "L", "XL", "XXL", "3XL", "4XL"];
        const pantalonNum = parseInt(pantalon, 10);
        if (isNaN(pantalonNum)) {
            if (!tallasValidasPantalon.includes(pantalon)) {
                errores.push("Talla de Pantalón no reconocida. (de XXS al 4XL) ");
                pantalonInput.focus();
            }
        } else if (pantalonNum < 26 || pantalonNum > 50) {
            errores.push("Talla de Pantalón fuera de rango. (26 al 50)");
            pantalonInput.focus();
        }
    }

    const fechaInput = document.querySelector('[name="fecha-nacimiento"]');
    if (fechaInput && fechaInput.value) { // Solo valida si hay un valor
        const fecha = new Date(fechaInput.value);
        const fechaMinima = new Date("1955-01-01");
        const fechaMaxima = new Date("2009-12-31");
        if (isNaN(fecha.getTime()) || fecha < fechaMinima || fecha > fechaMaxima) {
            errores.push("Fecha de Nacimiento fuera de rango (1955-2009).");
            fechaInput.focus();
        }
    }

    const generoInput = document.querySelector('[name="genero"]');
    if (generoInput && generoInput.value === "Sin seleccionar") {
        errores.push("Por favor, seleccione un género.");
        generoInput.focus();
    }

    const estadoCivilInput = document.querySelector('[name="estado-civil"]');
    if (estadoCivilInput && estadoCivilInput.value === "Sin seleccionar") {
        errores.push("Por favor, seleccione un estado civil.");
        estadoCivilInput.focus();
    }

    const puestoAspiranteInput = document.querySelector('[name="puesto-aspirante"]');
    if (puestoAspiranteInput && puestoAspiranteInput.value === "Sin Seleccionar") {
        errores.push("Por favor, seleccione un puesto.");
        puestoAspiranteInput.focus();
    }

    const edadInicioLaboresInput = document.querySelector('[name="edad-inicio-labores"]');
    if (edadInicioLaboresInput) {
        const edadInicioLabores = parseInt(edadInicioLaboresInput.value, 10);
        if (isNaN(edadInicioLabores) || edadInicioLabores < 16) {
            errores.push("La edad de inicio de labores debe ser 16 o mayor.");
            edadInicioLaboresInput.focus();
        }
    }

    // --- AQUÍ ES DONDE SE MUEVE event.preventDefault() ---
    if (errores.length > 0) {
        mostrarPopup(errores.join("<br>"));
        event.preventDefault(); // SOLO detiene el envío si hay errores
        return false;
    }

    // Si no hay errores, la función retorna 'true' y event.preventDefault() no fue llamado,
    // permitiendo que el formulario se envíe de forma normal.
    return true;
}
window.validarFormulario = validarFormulario;

// --- Funciones para el Popup (se mantienen igual) ---
function mostrarPopup(mensaje) {
    const popup = document.getElementById("miPopup");
    const mensajePopup = document.getElementById("mensajePopup");
    mensajePopup.innerHTML = mensaje;
    popup.style.display = "block";

    document.querySelector(".cerrar-popup").addEventListener("click", cerrarPopup);
    document.getElementById("btn-cerrar-popup").addEventListener("click", cerrarPopup);
}

function cerrarPopup() {
    document.getElementById("miPopup").style.display = "none";
}
window.mostrarPopup = mostrarPopup;
