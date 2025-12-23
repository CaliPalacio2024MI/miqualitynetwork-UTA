
window.initCanvas = function () {
    const $canvas = document.querySelector("#canvas"),
          $btnDescargar = document.querySelector("#btnDescargar"),
          $btnLimpiar = document.querySelector("#btnLimpiar"),
          btnGuardar = document.querySelector("#btnImprimir");

    if (!$canvas) {
        console.error("Canvas no encontrado.");
        return;
    }

    // Hacemos global el canvas
    window.canvas = $canvas;

    const contexto = $canvas.getContext("2d");

    const COLOR_PINCEL = "black";
    const COLOR_FONDO = "white";
    const GROSOR = 1;
    let xAnterior = 0, yAnterior = 0, xActual = 0, yActual = 0;

    const obtenerXReal = (clientX) => {
        const rect = $canvas.getBoundingClientRect();
        return (clientX - rect.left) * ($canvas.width / rect.width);
    };

    const obtenerYReal = (clientY) => {
        const rect = $canvas.getBoundingClientRect();
        return (clientY - rect.top) * ($canvas.height / rect.height);
    };

    let haComenzadoDibujo = false;

    const limpiarCanvas = () => {
        contexto.fillStyle = COLOR_FONDO;
        contexto.fillRect(0, 0, $canvas.width, $canvas.height);
    };

    limpiarCanvas();

    $btnLimpiar && ($btnLimpiar.onclick = limpiarCanvas);

    $btnDescargar && ($btnDescargar.onclick = () => {
        const enlace = document.createElement('a');
        enlace.download = "Firma.png";
        enlace.href = $canvas.toDataURL();
        enlace.click();
    });

    window.obtenerImagen = () => {
        return $canvas.toDataURL();
    };

    btnGuardar?.addEventListener("click", () => {
        const firma = window.obtenerImagen();
        const input = document.querySelector("#firmaInput");
        if (input) input.value = firma;
    });

    const onClicOToqueIniciado = evento => {
        xAnterior = xActual;
        yAnterior = yActual;
        xActual = obtenerXReal(evento.clientX || evento.touches?.[0]?.clientX);
        yActual = obtenerYReal(evento.clientY || evento.touches?.[0]?.clientY);
        contexto.beginPath();
        contexto.fillStyle = COLOR_PINCEL;
        contexto.fillRect(xActual, yActual, GROSOR, GROSOR);
        contexto.closePath();
        haComenzadoDibujo = true;
    };

    const onMouseODedoMovido = evento => {
        evento.preventDefault();
        if (!haComenzadoDibujo) return;

        let target = evento.type.includes("touch") ? evento.touches[0] : evento;
        xAnterior = xActual;
        yAnterior = yActual;
        xActual = obtenerXReal(target.clientX);
        yActual = obtenerYReal(target.clientY);
        contexto.beginPath();
        contexto.moveTo(xAnterior, yAnterior);
        contexto.lineTo(xActual, yActual);
        contexto.strokeStyle = COLOR_PINCEL;
        contexto.lineWidth = GROSOR;
        contexto.stroke();
        contexto.closePath();
    };

    const onMouseODedoLevantado = () => {
        haComenzadoDibujo = false;
    };

    ["mousedown", "touchstart"].forEach(evento =>
        $canvas.addEventListener(evento, onClicOToqueIniciado)
    );
    ["mousemove", "touchmove"].forEach(evento =>
        $canvas.addEventListener(evento, onMouseODedoMovido)
    );
    ["mouseup", "touchend"].forEach(evento =>
        $canvas.addEventListener(evento, onMouseODedoLevantado)
    );

    // Alternativa al botón guardar
    document.querySelector('.btn-save')?.addEventListener('click', () => {
        const input = document.querySelector("#firmaInput");
        if (input) input.value = window.obtenerImagen();
    });
};

window.imprimirFormulario = function () {
    const firmaBase64 = canvas.toDataURL("image/jpeg");
    // Recopila los datos del formulario
    let formData = new FormData(document.querySelector('form'));
    formData.append("firma", firmaBase64); // Agrega la firma a los datos del formulario
    let params = new URLSearchParams(formData);
    // Abrir una nueva ventana con los datos del formulario
    window.open(`/imprimir-formulario?${params.toString()}`, "_blank");
};

window.initCanvasMedico = function (){
    const $canvas = document.querySelector("#canvasMedico"),
        $btnDescargar = document.querySelector("#btnDescargarMedico"),
        $btnLimpiar = document.querySelector("#btnLimpiarMedico"),
        btnGuardar = document.querySelector("#btnImprimir"); // Asegúrate que este ID también se usa para guardar médico si aplica.

    const contexto = $canvas.getContext("2d");

    const COLOR_PINCEL = "black";
    const COLOR_FONDO = "white";
    const GROSOR = 1;
    let xAnterior = 0, yAnterior = 0, xActual = 0, yActual = 0;

    const obtenerXReal = (clientX) => {
        const rect = $canvas.getBoundingClientRect();
        return (clientX - rect.left) * ($canvas.width / rect.width);
    };

    const obtenerYReal = (clientY) => {
        const rect = $canvas.getBoundingClientRect();
        return (clientY - rect.top) * ($canvas.height / rect.height);
    };

    let haComenzadoDibujo = false;

    const limpiarCanvas = () => {
        contexto.fillStyle = COLOR_FONDO;
        contexto.fillRect(0, 0, $canvas.width, $canvas.height);
    };

    limpiarCanvas();
    $btnLimpiar.onclick = limpiarCanvas;

    $btnDescargar.onclick = () => {
        const enlace = document.createElement('a');
        enlace.download = "FirmaMedico.png";
        enlace.href = $canvas.toDataURL();
        enlace.click();
    };

    function obtenerImagenMedico() {
        return $canvas.toDataURL();
    }

    btnGuardar.addEventListener("click", () => {
        document.querySelector("#firmaInputMedico").value = obtenerImagenMedico();
    });

    const onClicOToqueIniciado = evento => {
        xAnterior = xActual;
        yAnterior = yActual;
        xActual = obtenerXReal(evento.clientX);
        yActual = obtenerYReal(evento.clientY);
        contexto.beginPath();
        contexto.fillStyle = COLOR_PINCEL;
        contexto.fillRect(xActual, yActual, GROSOR, GROSOR);
        contexto.closePath();
        haComenzadoDibujo = true;
    };

    const onMouseODedoMovido = evento => {
        evento.preventDefault();
        if (!haComenzadoDibujo) return;

        let target = evento;
        if (evento.type.includes("touch")) {
            target = evento.touches[0];
        }

        xAnterior = xActual;
        yAnterior = yActual;
        xActual = obtenerXReal(target.clientX);
        yActual = obtenerYReal(target.clientY);

        contexto.beginPath();
        contexto.moveTo(xAnterior, yAnterior);
        contexto.lineTo(xActual, yActual);
        contexto.strokeStyle = COLOR_PINCEL;
        contexto.lineWidth = GROSOR;
        contexto.stroke();
        contexto.closePath();
    };

    const onMouseODedoLevantado = () => {
        haComenzadoDibujo = false;
    };

    ["mousedown", "touchstart"].forEach(nombreDeEvento => {
        $canvas.addEventListener(nombreDeEvento, onClicOToqueIniciado);
    });

    ["mousemove", "touchmove"].forEach(nombreDeEvento => {
        $canvas.addEventListener(nombreDeEvento, onMouseODedoMovido);
    });

    ["mouseup", "touchend"].forEach(nombreDeEvento => {
        $canvas.addEventListener(nombreDeEvento, onMouseODedoLevantado);
    });

    // También guarda cuando se use .btn-save
    document.querySelector('.btn-save').addEventListener('click', function () {
        const firmaBase64 = obtenerImagenMedico();
        document.querySelector('#firmaInputMedico').value = firmaBase64;
    });
}