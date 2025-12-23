// resources/js/modules/historialclinico/formulario.js
// Tamaños nuevos de la parte del cuerpo
const BODY_MAP_WIDTH = 320;
const BODY_MAP_HEIGHT = 430;
const ZOOM_BOX_SIZE = 150;
// ------------------------------------------------------

window.inicializarFormularioDinamico = function () {
    // ► Accidentes
    fetch("/accidentes")
        .then((r) => r.json())
        .then((data) => {
            const sel = document.getElementById("selectAccidente");
            sel.innerHTML = '<option value="">Selecciona un accidente</option>';
            data.forEach((a) => sel.appendChild(new Option(a.nombre, a.id)));
        })
        .catch((err) => console.error("Error al cargar accidentes:", err));

    // ► Lesiones
    fetch("/lesiones")
        .then((r) => r.json())
        .then((data) => {
            const sel = document.getElementById("selectLesion");
            sel.innerHTML = '<option value="">Selecciona una lesión</option>';
            data.forEach((l) => sel.appendChild(new Option(l.nombre, l.id)));
        })
        .catch((err) => console.error("Error al cargar lesiones:", err));

    // ► Causas
    fetch("/causas")
        .then((r) => r.json())
        .then((data) => {
            const sel = document.getElementById("selectCausa");
            sel.innerHTML = '<option value="">Selecciona una causa</option>';
            data.forEach((c) => sel.appendChild(new Option(c.nombre, c.id)));
        })
        .catch((err) => console.error("Error al cargar causas:", err));

    // ► Áreas (Propiedades) → Departamento
    const selProp = document.getElementById("selectPropiedadEvento");
    const selDep = document.getElementById("selectDepartamentoEvento");

    if (selProp && selDep) {
        // 1) Carga todas las Propiedades
        fetch("/api/propiedades")
            .then((r) => r.json())
            .then((props) => {
                selProp.innerHTML =
                    '<option value="">Selecciona un área</option>';
                props.forEach((p) => {
                    const opt = new Option(p.nombre_propiedad, p.id_propiedad);
                    if (
                        "{{ old('propiedad_id', $historial->propiedad_id ?? '') }}" ==
                        p.id_propiedad
                    ) {
                        opt.selected = true;
                    }
                    selProp.appendChild(opt);
                });
                if (selProp.value) selProp.dispatchEvent(new Event("change"));
            })
            .catch((err) => console.error("Error cargando áreas:", err));

        // ...puestos-------------------------------------------------

        const selPuesto = document.getElementById("selectPuesto");
        if (selDep && selPuesto) {
            // Al cambiar el Departamento, carga sus Puestos
            selDep.addEventListener("change", async (e) => {
                const depId = e.target.value;
                selPuesto.innerHTML =
                    '<option value="">-- Selecciona un puesto --</option>';
                if (!depId) {
                    selPuesto.disabled = true;
                    return;
                }
                selPuesto.disabled = false;
                try {
                    const res = await fetch(
                        `/api/departamentos/${depId}/puestos`
                    );
                    const puestos = await res.json();
                    puestos.forEach((p) => {
                        selPuesto.appendChild(new Option(p.puesto, p.id));
                    });
                } catch (err) {
                    console.error("Error cargando puestos:", err);
                    selPuesto.innerHTML =
                        '<option value="">Error al cargar</option>';
                }
            });
        }

        // 2) Al cambiar el Área, pedimos sólo sus Departamentos
        selProp.addEventListener("change", async (e) => {
            const idProp = e.target.value;
            selDep.innerHTML =
                '<option value="">-- Selecciona un departamento --</option>';
            if (!idProp) {
                selDep.disabled = true;
                return;
            }
            selDep.disabled = false;
            try {
                const res = await fetch(
                    `/api/propiedades/${idProp}/departamentos`
                );
                const deps = await res.json();
                deps.forEach((d) => {
                    selDep.appendChild(new Option(d.departamento, d.id));
                });
            } catch (err) {
                console.error(
                    "Error cargando departamentos de la propiedad:",
                    err
                );
                selDep.innerHTML = '<option value="">Error al cargar</option>';
            }
        });
    } else {
        console.warn(
            "No se encontraron selectPropiedadEvento o selectDepartamentoEvento en el DOM"
        );
    }
};

//////-------------------------------------------------//
// Carga el formulario y dispara inicializadores

window.initBodyMap = function () {
    initCanvas(currentView);
    const ov = document.getElementById("zoomOverlay");
    if (ov)
        ov.addEventListener("click", (e) => {
            if (e.target === ov) ov.style.display = "none";
        });
    const btnAdd = document.getElementById("addSub");
    if (btnAdd)
        btnAdd.addEventListener("click", () => {
            const v = document.getElementById("subSelect").value;
            if (v) addSelection(v);
        });
    const tv = document.getElementById("toggleView");
    if (tv)
        tv.addEventListener("click", () => {
            currentView = currentView === "front" ? "back" : "front";
            tv.textContent =
                currentView === "front"
                    ? "Mostrar vista posterior"
                    : "Mostrar vista frontal";
            document.getElementById("zoomOverlay").style.display = "none";
            // document.getElementById("bodyMapContainer").innerHTML = "";
            initCanvas(currentView);
        });
};

// AJAX + DOMContentLoaded
document.addEventListener("DOMContentLoaded", () => {
    document.querySelectorAll("[data-ajax]").forEach((link) => {
        link.addEventListener("click", async (e) => {
            e.preventDefault();
            try {
                const r = await fetch(link.href);
                const html = await r.text();
                document.getElementById("mainContent").innerHTML = html;
                if (window.inicializarFormularioDinamico)
                    inicializarFormularioDinamico();
                if (window.initSignaturePads) initSignaturePads();
                window.initBodyMap();
            } catch (err) {
                console.error("Error cargando formulario:", err);
            }
        });
    });
});

// ---------- Inicializa todos los signature pads ----------
// Al inicio de initSignaturePads, ajusta el tamaño real del canvas:
window.initSignaturePads = function () {
    const roles = ["Anfitrion", "Supervisor", "Patron", "Trabajador"];
    roles.forEach((role) => {
        const id = `signaturePad${role}`;
        const canvas = document.getElementById(id);
        if (!canvas) return;

        // 🔧 Asegúrate de que el canvas tenga width/height en pixels idéntico al CSS
        const rect = canvas.getBoundingClientRect();
        canvas.width = rect.width;
        canvas.height = rect.height;

        // Ahora sí crea el pad
        const pad = new SignaturePad(canvas, {
            backgroundColor: "rgba(0,0,0,0)", // transparente
            penColor: "black",
        });

        // Botón Limpiar
        const clearBtn = document.querySelector(
            `.clear-button[data-target="${id}"]`
        );
        if (clearBtn) clearBtn.addEventListener("click", () => pad.clear());

        // Botón Guardar
        const saveBtn = document.querySelector(
            `.submit-button[data-target="${id}"]`
        );
        if (saveBtn)
            saveBtn.addEventListener("click", () => {
                const dataURL = pad.toDataURL("image/png");
                let hidden = document.querySelector(`input[name="${id}_data"]`);
                if (!hidden) {
                    hidden = document.createElement("input");
                    hidden.type = "hidden";
                    hidden.name = `${id}_data`;
                    canvas.parentNode.appendChild(hidden);
                }
                hidden.value = dataURL;
            });
    });
};

// ---- CONFIGURACIÓN DE ZONAS DEL PARTES DEL CUERPO HUMANO  ----
const zonesConfig = {
    front: [
        {
            name: "Cabeza",
            xPct: 0.5,
            yPct: 0.1,
            rxPct: 0.08,
            ryPct: 0.08,
            color: "rgba(231,76,60,0)",
            highlightPct: { x: 0.5, y: 0.08 }, // <-- Prueba aquí para los puntos rojos
        },
        {
            name: "Hombros",
            xPct: 0.5,
            yPct: 0.22,
            rxPct: 0.22,
            ryPct: 0.06,
            color: "rgba(52,152,219,0.5)",
            highlightPct: { x: 0.5, y: 0.23 },
        },
        {
            name: "Abdomen",
            xPct: 0.5,
            yPct: 0.4,
            rxPct: 0.15,
            ryPct: 0.13,
            color: "rgba(46,204,113,0.5)",
            highlightPct: { x: 0.5, y: 0.4 },
        },
        {
            name: "Brazo Izquierdo",
            xPct: 0.28,
            yPct: 0.4,
            rxPct: 0.07,
            ryPct: 0.16,
            color: "rgba(241,196,15,0.5)",
            highlightPct: { x: 0.28, y: 0.4 },
        },
        {
            name: "Brazo Derecho",
            xPct: 0.72,
            yPct: 0.39,
            rxPct: 0.06,
            ryPct: 0.15,
            color: "rgba(241,196,15,0.5)",
            highlightPct: { x: 0.72, y: 0.39 },
        },
        {
            name: "Pierna Izquierda",
            xPct: 0.4,
            yPct: 0.71,
            rxPct: 0.08,
            ryPct: 0.2,
            color: "rgba(155,89,182,0.5)",
            highlightPct: { x: 0.4, y: 0.71 },
        },
        {
            name: "Pierna Derecha",
            xPct: 0.58,
            yPct: 0.71,
            rxPct: 0.08,
            ryPct: 0.2,
            color: "rgba(155,89,182,0.5)",
            highlightPct: { x: 0.6, y: 0.71 },
        },
        {
            name: "Pie Izquierdo",
            xPct: 0.43,
            yPct: 0.95,
            rxPct: 0.06,
            ryPct: 0.05,
            color: "rgba(231,76,60,0.5)",
            highlightPct: { x: 0.43, y: 0.94 },
        },
        {
            name: "Pie Derecho",
            xPct: 0.55,
            yPct: 0.95,
            rxPct: 0.06,
            ryPct: 0.05,
            color: "rgba(231,76,60,0.5)",
            highlightPct: { x: 0.55, y: 0.95 },
        },
    ],
    back: [
        {
            name: "Cabeza (Posterior)",
            xPct: 0.5,
            yPct: 0.1,
            rxPct: 0.08,
            ryPct: 0.08,
            color: "rgba(231,76,60,0.5)",
            highlightPct: { x: 0.5, y: 0.05 }, // <-- Prueba aquí para los puntos cafe
        },
        {
            name: "Hombros (Posterior)",
            xPct: 0.5,
            yPct: 0.22,
            rxPct: 0.22,
            ryPct: 0.06,
            color: "rgba(52,152,219,0.5)",
            highlightPct: { x: 0.5, y: 0.22 },
        },
        {
            name: "Espalda",
            xPct: 0.5,
            yPct: 0.4,
            rxPct: 0.15,
            ryPct: 0.14,
            color: "rgba(39,174,96,0.5)",
            highlightPct: { x: 0.5, y: 0.4 },
        },
        {
            name: "Brazo Izquierdo (Posterior)",
            xPct: 0.28,
            yPct: 0.4,
            rxPct: 0.07,
            ryPct: 0.16,
            color: "rgba(241,196,15,0.5)",
            highlightPct: { x: 0.28, y: 0.4 },
        },
        {
            name: "Brazo Derecho (Posterior)",
            xPct: 0.72,
            yPct: 0.39,
            rxPct: 0.06,
            ryPct: 0.15,
            color: "rgba(241,196,15,0.5)",
            highlightPct: { x: 0.72, y: 0.39 },
        },
        {
            name: "Mano Izquierda",
            xPct: 0.22,
            yPct: 0.55,
            rxPct: 0.06,
            ryPct: 0.06,
            color: "rgba(155,89,182,0.5)",
            highlightPct: { x: 0.2, y: 0.52 },
        },
        {
            name: "Mano Derecha",
            xPct: 0.79,
            yPct: 0.55,
            rxPct: 0.06,
            ryPct: 0.06,
            color: "rgba(155,89,182,0.5)",
            highlightPct: { x: 0.8, y: 0.52 },
        },
        {
            name: "Parte Trasera Pierna Izquierda",
            xPct: 0.4,
            yPct: 0.72,
            rxPct: 0.08,
            ryPct: 0.2,
            color: "rgba(142,68,173,0.5)",
            highlightPct: { x: 0.4, y: 0.71 },
        },
        {
            name: "Parte Trasera Pierna Derecha",
            xPct: 0.6,
            yPct: 0.72,
            rxPct: 0.08,
            ryPct: 0.2,
            color: "rgba(142,68,173,0.5)",
            highlightPct: { x: 0.6, y: 0.72 },
        },
        {
            name: "Talón Izquierdo",
            xPct: 0.40,
            yPct: 0.95,
            rxPct: 0.06,
            ryPct: 0.05,
            color: "rgba(231,76,60,0.5)",
            highlightPct: { x: 0.39, y: 0.93 },
        },
        {
            name: "Talón Derecho",
            xPct: 0.58,
            yPct: 0.96,
            rxPct: 0.06,
            ryPct: 0.05,
            color: "rgba(231,76,60,0.5)",
            highlightPct: { x: 0.6, y: 0.93 },
        },
    ],
};

// Subzonas para zoom
const subzonesMap = {
    //----Posterior de la parte de enfrente  del cuerpo ----------------------
    Cabeza: [
        { name: "Ojo Izquierdo", xPct: 0.38, yPct: 0.45 },
        { name: "Ojo Derecho", xPct: 0.62, yPct: 0.45 },
        { name: "Nariz", xPct: 0.5, yPct: 0.53 },
        { name: "Boca", xPct: 0.5, yPct: 0.66 },
        { name: "Oreja Izquierda", xPct: 0.22, yPct: 0.5 },
        { name: "Oreja Derecha", xPct: 0.77, yPct: 0.5 },
    ],
    Hombros: [
        { name: "Clavícula Izq", xPct: 0.3, yPct: 0.22 },
        { name: "Clavícula Der", xPct: 0.7, yPct: 0.22 },
    ],
    Abdomen: [
        { name: "Epigastrio", xPct: 0.5, yPct: 0.15 },
        { name: "Mesogastrio", xPct: 0.5, yPct: 0.4 },
        { name: "Hipogastrio", xPct: 0.5, yPct: 0.65 },
    ],
    "Brazo Izquierdo": [
        { name: "Hombro IZQ", xPct: 0.5, yPct: 0.10 },
        { name: "Bíceps IZQ", xPct: 0.55, yPct: 0.30 },
        { name: "Codo IZQ", xPct: 0.6, yPct: 0.45 },
        { name: "Antebrazo IZQ", xPct: 0.5, yPct: 0.68 },
        { name: "Muñeca IZQ", xPct: 0.4, yPct: 0.8 },
    ],
    "Brazo Derecho": [
        { name: "Hombro DER", xPct: 0.4, yPct: 0.10 },
        { name: "Bíceps DER", xPct: 0.3, yPct: 0.32 },
        { name: "Codo DER", xPct: 0.4, yPct: 0.42 },
        { name: "Antebrazo DER", xPct: 0.4, yPct: 0.6 },
        { name: "Muñeca DER", xPct: 0.4, yPct: 0.8 },
    ],
    "Pierna Izquierda": [
        { name: "Muslo IZQ", xPct: 0.5, yPct: 0.05 },
        { name: "Rodilla IZQ", xPct: 0.5, yPct: 0.4 },
        { name: "Pantorrilla IZQ", xPct: 0.5, yPct: 0.6 },
    ],
    "Pierna Derecha": [
        { name: "Muslo DER", xPct: 0.5, yPct: 0.05 },
        { name: "Rodilla DER", xPct: 0.5, yPct: 0.4 },
        { name: "Pantorrilla DER", xPct: 0.5, yPct: 0.6 },
    ],
    "Pie Izquierdo": [
        { name: "Dedo 1 IZQ", xPct: 0.45, yPct: 0.7 },
        { name: "Dedo 2 IZQ", xPct: 0.25, yPct: 0.75 },
        { name: "Dedo 3 IZQ", xPct: 0.19, yPct: 0.74 },
        { name: "Dedo 4 IZQ", xPct: 0.14, yPct: 0.7 },
        { name: "Dedo 5 IZQ", xPct: 0.1, yPct: 0.66 },
        { name: "Tobillo IZQ", xPct: 0.55, yPct: 0.2 },
    ],

    "Pie Derecho": [
        { name: "Dedo 1 DER", xPct: 0.56, yPct: 0.75 },
        { name: "Dedo 2 DER", xPct: 0.70, yPct: 0.75 },
        { name: "Dedo 3 DER", xPct: 0.75, yPct: 0.73 },
        { name: "Dedo 4 DER", xPct: 0.80, yPct: 0.67 },
        { name: "Dedo 5 DER", xPct: 0.85, yPct: 0.6 },
        { name: "Tobillo DER", xPct: 0.56, yPct: 0.2 },
    ],
    //----Posterior de la parte de  atras del cuerpo ----------------------
    "Cabeza (Posterior)": [
        { name: "Protuberancia Occipital", xPct: 0.5, yPct: 0.2 },
        { name: "Región Parietal Izq", xPct: 0.35, yPct: 0.35 },
        { name: "Región Parietal Der", xPct: 0.65, yPct: 0.35 },
        { name: "Nuca", xPct: 0.5, yPct: 0.6 },
    ],

    "Hombros (Posterior)": [
        { name: "Escápula Izq", xPct: 0.3, yPct: 0.45 },
        { name: "Escápula Der", xPct: 0.7, yPct: 0.45 },
    ],

    Espalda: [
        { name: "Dorsal Superior", xPct: 0.5, yPct: 0.25 },
        { name: "Dorsal Medio", xPct: 0.5, yPct: 0.4 },
        { name: "Lumbares", xPct: 0.5, yPct: 0.6 },
    ],

    "Brazo Izquierdo (Posterior)": [
        { name: "Tríceps IZQ", xPct: 0.6, yPct: 0.15 },
        { name: "Olécranon IZQ", xPct: 0.5, yPct: 0.5 },
        { name: "Antebrazo IZQ", xPct: 0.38, yPct: 0.75 },
    ],

    "Brazo Derecho (Posterior)": [
        { name: "Tríceps DER", xPct: 0.48, yPct: 0.12 },
        { name: "Olécranon DER", xPct: 0.5, yPct: 0.5 },
        { name: "Antebrazo DER", xPct: 0.6, yPct: 0.7 },
    ],

    "Mano Izquierda": [
        { name: "Dedo 1 IZQ", xPct: 0.27, yPct: 0.4 },
        { name: "Dedo 2 IZQ", xPct: 0.38, yPct: 0.8 },
        { name: "Dedo 3 IZQ", xPct: 0.5, yPct: 0.8 },
        { name: "Dedo 4 IZQ", xPct: 0.63, yPct: 0.8 },
        { name: "Dedo 5 IZQ", xPct: 0.79, yPct: 0.7 },
    ],

    "Mano Derecha": [
        { name: "Dedo 1 DER", xPct: 0.75, yPct: 0.4 },
        { name: "Dedo 2 DER", xPct: 0.65, yPct: 0.75 },
        { name: "Dedo 3 DER", xPct: 0.5, yPct: 0.8 },
        { name: "Dedo 4 DER", xPct: 0.4, yPct: 0.8 },
        { name: "Dedo 5 DER", xPct: 0.2, yPct: 0.7 },
    ],

    "Parte Trasera Pierna Izquierda": [
        { name: "Isquiotibial IZQ", xPct: 0.5, yPct: 0.2 },
        { name: "Pantorrilla IZQ", xPct: 0.5, yPct: 0.75 },
    ],

    "Parte Trasera Pierna Derecha": [
        { name: "Isquiotibial DER", xPct: 0.5, yPct: 0.2 },
        { name: "Pantorrilla DER", xPct: 0.5, yPct: 0.75 },
    ],

    "Talón Izquierdo": [{ name: "Talon IZQ", xPct: 0.7, yPct: 0.75 }],

    "Talón Derecho": [{ name: "Talon DER", xPct: 0.3, yPct: 0.75 }],
};
// Regiones de recorte para lupa
const regionMap = {
    // Frontales (sin cambios)
    Cabeza: { cx: 0.5, cy: 0.1, w: 600, h: 160 },
    Hombros: { cx: 0.5, cy: 0.22, w: 600, h: 120 },
    Abdomen: { cx: 0.5, cy: 0.4, w: 600, h: 260 },
    "Brazo Izquierdo": { cx: 0.28, cy: 0.4, w: 300, h: 240 },
    "Brazo Derecho": { cx: 0.75, cy: 0.4, w: 300, h: 240 },

    "Pierna Izquierda": { cx: 0.4, cy: 0.75, w: 380, h: 250 },
    "Pierna Derecha": { cx: 0.6, cy: 0.75, w: 380, h: 250 },

    "Pie Izquierdo": { cx: 0.46, cy: 0.95, w: 100, h: 200 },
    "Pie Derecho": { cx: 0.53, cy: 0.95, w: 110, h: 200 },

    // Posteriores (nuevas regiones)
    "Cabeza (Posterior)": { cx: 0.5, cy: 0.1, w: 450, h: 160 },
    "Hombros (Posterior)": { cx: 0.5, cy: 0.22, w: 600, h: 120 },
    Espalda: { cx: 0.5, cy: 0.3, w: 200, h: 360 },

    "Brazo Izquierdo (Posterior)": { cx: 0.28, cy: 0.4, w: 170, h: 320 },
    "Brazo Derecho (Posterior)": { cx: 0.72, cy: 0.4, w: 170, h: 320 },

    "Mano Izquierda": { cx: 0.2, cy: 0.57, w: 100, h: 150 },
    "Mano Derecha": { cx: 0.78, cy: 0.57, w: 100, h: 150 },

    "Parte Trasera Pierna Izquierda": { cx: 0.4, cy: 0.72, w: 280, h: 240 },
    "Parte Trasera Pierna Derecha": { cx: 0.6, cy: 0.72, w: 270, h: 240 },

    "Talón Izquierdo": { cx: 0.39, cy: 0.91, w: 110, h: 200 },
    "Talón Derecho": { cx: 0.6, cy: 0.91, w: 110, h: 200 },
};
//----------------------------------Estado----------------------------------------------------
//----------------------------------Estado----------------------------------------------------
let stage, layer, zoomStage, zoomLayer;
let currentView = "front";
const selectedZones = { front: [], back: [] }; // zonas principales con subzonas seleccionadas
const selectedSubzones = { front: [], back: [] }; // lista de subzonas

// ─── openZoom ───────────────────────────────────────────────────
function openZoom(zoneName) {
    const ov = document.getElementById("zoomOverlay");
    ov.style.display = "flex";
    document.getElementById("zoomBoxCanvas").innerHTML = "";

    zoomStage = new Konva.Stage({
        container: "zoomBoxCanvas",
        width: ZOOM_BOX_SIZE,
        height: ZOOM_BOX_SIZE,
    });
    zoomLayer = new Konva.Layer();
    zoomStage.add(zoomLayer);

    const imgURL =
        currentView === "front"
            ? "/images/modules/historialclinico/adelante_L.png"
            : "/images/modules/historialclinico/atras_LE.png";

    Konva.Image.fromURL(imgURL, (img) => {
        const reg = regionMap[zoneName];
        const scale =
            ZOOM_BOX_SIZE /
            Math.min(
                reg.w * (BODY_MAP_WIDTH / 600),
                reg.h * (BODY_MAP_HEIGHT / 800)
            );
        img.width(BODY_MAP_WIDTH * scale);
        img.height(BODY_MAP_HEIGHT * scale);
        img.x(-(reg.cx * BODY_MAP_WIDTH * scale - ZOOM_BOX_SIZE / 2));
        img.y(-(reg.cy * BODY_MAP_HEIGHT * scale - ZOOM_BOX_SIZE / 2));
        zoomLayer.add(img);

        // subzonas amarillas
        subzonesMap[zoneName].forEach((s) => {
            const c = new Konva.Circle({
                x: s.xPct * ZOOM_BOX_SIZE,
                y: s.yPct * ZOOM_BOX_SIZE,
                radius: ZOOM_BOX_SIZE * 0.02,
                fill: "rgba(255,215,0,0.9)",
                stroke: "#333",
                strokeWidth: 1,
                name: s.name,
                listening: true,
                hitStrokeWidth: 10,
            });
            c.on("click tap", () => {
                // 1) guardamos la subzona
                const sz = selectedSubzones[currentView];
                if (!sz.includes(s.name)) sz.push(s.name);
                // 2) destacamos la zona principal
                const z = selectedZones[currentView];
                if (!z.includes(zoneName)) z.push(zoneName);
                ov.style.display = "none";
                drawAllHighlights();
                renderSelectionList();
            });
            zoomLayer.add(c);
        });

        zoomLayer.draw();
    });
}

// ─── initCanvas ────────────────────────────────────────────────
// ─── initCanvas ────────────────────────────────────────────────
function initCanvas(view) {
    // 1) Vacía el contenedor HTML de stages antiguos
    const container = document.getElementById("bodyMapContainer");
    container.innerHTML = "";

    // 2) Destruye el stage previo si existe
    if (stage) {
        stage.destroy();
        stage = null;
    }

    // 3) Crea el nuevo stage
    stage = new Konva.Stage({
        container: "bodyMapContainer",
        width: BODY_MAP_WIDTH,
        height: BODY_MAP_HEIGHT,
    });
    layer = new Konva.Layer();
    stage.add(layer);

    // 4) Imagen según vista
    const imgURL =
        view === "front"
            ? "/images/modules/historialclinico/adelante_L.png"
            : "/images/modules/historialclinico/atras_LE.png";

    // 5) Dibuja la silueta y zonas
    Konva.Image.fromURL(imgURL, (img) => {
        img.width(BODY_MAP_WIDTH);
        img.height(BODY_MAP_HEIGHT);
        layer.add(img);

        zonesConfig[view].forEach((z) => {
            const e = new Konva.Ellipse({
                x: z.xPct * BODY_MAP_WIDTH,
                y: z.yPct * BODY_MAP_HEIGHT,
                radiusX: z.rxPct * BODY_MAP_WIDTH,
                radiusY: z.ryPct * BODY_MAP_HEIGHT,
                fill: "rgba(231,76,60,0)",
                // fill: z.color,
                stroke: "transparent",
                strokeWidth: 1,
                name: z.name,
                opacity: 0.5,
            });
            e.on("mouseenter", () => {
                e.opacity(0.7);
                layer.draw();
            });
            e.on("mouseleave", () => {
                e.opacity(0.5);
                layer.draw();
            });
            e.on("click tap", () => {
                if (subzonesMap[z.name]) {
                    openZoom(z.name);
                } else {
                    const arr = selectedZones[currentView];
                    if (!arr.includes(z.name)) {
                        arr.push(z.name);
                        drawAllHighlights();
                        renderSelectionList();
                    }
                }
            });
            layer.add(e);
        });

        layer.draw();
        drawAllHighlights();
    });
}

// ─── drawAllHighlights ─────────────────────────────────────────
function drawAllHighlights() {
    // Limpiamos viejos
    layer.find((n) => n.name().startsWith("hl-")).forEach((n) => n.destroy());

    const color =
        currentView === "front" ? "rgba(231,76,60,0.9)" : "rgba(231,76,60,0.9)";

    // Solo para padres que siguen en selectedZones
    selectedZones[currentView].forEach((name) => {
        const cfg = zonesConfig[currentView].find((z) => z.name === name);
        if (!cfg || !cfg.highlightPct) return;
        const { x, y } = cfg.highlightPct;
        const hl = new Konva.Circle({
            x: x * BODY_MAP_WIDTH,
            y: y * BODY_MAP_HEIGHT,
            radius: BODY_MAP_WIDTH * 0.03,
            fill: color,
            name: "hl-" + name,
            listening: false,
        });
        layer.add(hl);
    });

    layer.draw();
}

// ─── removeZone ────────────────────────────────────────────────
window.removeZone = function (name) {
    // 1) Quitamos la subzona de la lista
    selectedSubzones[currentView] = selectedSubzones[currentView].filter(
        (n) => n !== name
    );

    // 2) Averiguamos de qué zona principal venía esta subzona
    let parent = null;
    for (let key in subzonesMap) {
        if (subzonesMap[key].some((s) => s.name === name)) {
            parent = key;
            break;
        }
    }

    // 3) Si ya no queda NINGUNA subzona de ese parent, borramos el highlight café/rojo
    if (parent) {
        const stillHas = selectedSubzones[currentView].some((sub) =>
            subzonesMap[parent].some((s) => s.name === sub)
        );
        if (!stillHas) {
            selectedZones[currentView] = selectedZones[currentView].filter(
                (z) => z !== parent
            );
        }
    }

    // 4) Redibujamos todo
    drawAllHighlights();
    renderSelectionList();
};

// ─── renderSelectionList ───────────────────────────────────────
function renderSelectionList() {
    const left = document.getElementById("selectedLeft");
    const right = document.getElementById("selectedRight");
    left.innerHTML = "<strong>Posterior:</strong>";
    right.innerHTML = "<strong>Frontal:</strong>";

    selectedSubzones.back.forEach((name) => {
        const d = document.createElement("div");
        d.style =
            "margin:6px 0;padding:4px 6px;background:#ccc;" +
            "border-radius:4px;display:flex;justify-content:space-between;" +
            "align-items:center;font-size:14px;";
        d.innerHTML = `<span>${name}</span><button onclick="removeZone('${name}')">×</button>`;
        left.appendChild(d);
    });

    selectedSubzones.front.forEach((name) => {
        const d = document.createElement("div");
        d.style =
            "margin:6px 0;padding:4px 6px;background:#ccc;" +
            "border-radius:4px;display:flex;justify-content:space-between;" +
            "align-items:center;font-size:14px;";
        d.innerHTML = `<span>${name}</span><button onclick="removeZone('${name}')">×</button>`;
        right.appendChild(d);
    });

    // 🔁 Fusionamos las zonas seleccionadas y las mandamos al input oculto
    const allPartes = [...selectedSubzones.front, ...selectedSubzones.back];
    const hiddenInput = document.getElementById("partes_afectadas");
    if (hiddenInput) {
        hiddenInput.value = JSON.stringify(allPartes);
    }
}

// Al final de resources/js/modules/historialclinico/formulario.js
document.addEventListener("DOMContentLoaded", () => {
    // 1) Dibuja la vista inicial (initCanvas ya borra contenedor)
    initCanvas(currentView);
    renderSelectionList();

    // 2) Selects dinámicos
    if (typeof inicializarFormularioDinamico === "function") {
        inicializarFormularioDinamico();
    }

    // 3) Signature pads
    if (typeof initSignaturePads === "function") {
        initSignaturePads();
    }

    // 4) Toggle frontal/posterior (usa initCanvas que limpia)
    const btnToggle = document.getElementById("toggleView");
    if (btnToggle) {
        btnToggle.addEventListener("click", () => {
            currentView = currentView === "front" ? "back" : "front";
            btnToggle.textContent =
                currentView === "front"
                    ? "Mostrar vista posterior"
                    : "Mostrar vista frontal";

            // oculta overlay si está abierto
            const ov = document.getElementById("zoomOverlay");
            if (ov) ov.style.display = "none";

            // VUELVE a limpiar y dibujar solo una silueta
            initCanvas(currentView);
            renderSelectionList();
        });
    }

    // 5) Cierre de overlay al click fuera
    const ov = document.getElementById("zoomOverlay");
    if (ov) {
        ov.addEventListener("click", (e) => {
            if (e.target === ov) ov.style.display = "none";
        });
    }

    // 6) [Opcional] AJAX links
    document.querySelectorAll("[data-ajax]").forEach((link) => {
        link.addEventListener("click", async (e) => {
            e.preventDefault();
            const res = await fetch(link.href);
            const html = await res.text();
            document.getElementById("mainContent").innerHTML = html;
            // reinicializa todo
            initCanvas(currentView);
            renderSelectionList();
            if (typeof inicializarFormularioDinamico === "function")
                inicializarFormularioDinamico();
            if (typeof initSignaturePads === "function") initSignaturePads();
        });
    });
});
