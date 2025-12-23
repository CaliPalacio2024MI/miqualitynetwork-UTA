document.addEventListener("DOMContentLoaded", () => {
    const formBuscarNombre = document.querySelector(".formulario-busqueda-anfitriones");
    const contenedoresInformacion = document.querySelectorAll(".contenedor-informacion-general-anfitriones");
    const inputNombre = document.querySelector(".input-nombre-buscador");
    
    const linea_dorada = document.querySelectorAll(".linea-dorada");

    if(formBuscarNombre) {
        formBuscarNombre.addEventListener('submit', function(event) {
            event.preventDefault(); 
            
            const valorBusqueda = inputNombre.value.trim().toLowerCase();
            
            // ESTA ACCION OCULTA LOS CONTENEDORES
            contenedoresInformacion.forEach(contenedor => {
                contenedor.style.display = "none";
                
            });
            linea_dorada.forEach(linea =>{
                linea.style.display="none";
            });



            // SI NO ENCUENTRA EL VALOR MUESTRA TODOS LOS FORMULARIOS
            if(valorBusqueda === "") {
                contenedoresInformacion.forEach(contenedor => {
                    contenedor.style.display = "flex";
                });
                linea_dorada.forEach(linea =>{
                    linea.style.display="flex";
                });
                return;
            }
            



            // EN ESTA PARTE SE REALIZA LA BUSQUEDA PARA MOSTRAR SOLO LOS FORMULARIOS
            let encontrado = false;
            contenedoresInformacion.forEach(contenedor => {
                const nombreUsuario = contenedor.id.toLowerCase();
                if(nombreUsuario.includes(valorBusqueda)) {
                    contenedor.style.display = "flex";
                    encontrado = true;
                }
            });
            //FILTRO DE LINEA DORADA ESTA AQUI PORQUE NO LO PODIA PONER DENTRO DEL DIV DEL CONTENIDO PRINCIPAL
            let encontrado2 = false;
            linea_dorada.forEach(linea => {
                const nombreUsuario = linea.id.toLowerCase();
                if(nombreUsuario.includes(valorBusqueda)) {
                    linea.style.display="flex";
                    encontrado2 = true;
                }
            });
            

        });
    }
});