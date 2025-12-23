document.addEventListener("DOMContentLoaded", () => {
    // Seleccionar todos los botones con la clase 'btn-privilegios'
    document.querySelectorAll(".btn-privilegios").forEach(button => {
        button.addEventListener("click", () => {
            // Obtener el ID del botón (que coincide con el div oculto)
            const userId = button.getAttribute("id");

            // Buscar el div con la misma ID que el botón
            const checkboxDiv = document.getElementById(userId);

            if (checkboxDiv) {
                // CAMBIA LA VISISIBILIDAD DE LOS CHECKBOX
                checkboxDiv.style.display = (checkboxDiv.style.display === "none" || checkboxDiv.style.display === "") ? "block" : "none";
            }
        });
    });
});
