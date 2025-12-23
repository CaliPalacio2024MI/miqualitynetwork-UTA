window.addEventListener("DOMContentLoaded", () => {
    // Mostrar la fecha actual en el campo
    const fechaElement = document.getElementById("fecha");
    if (fechaElement) {
        fechaElement.innerText = new Date().toLocaleDateString("es-ES");
    }
});

function generarPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF('p', 'mm', 'a4');

    const habitacion = document.getElementById("habitacion").value || "----";

    // Cabecera
    doc.setFont("helvetica", "bold");
    doc.setFontSize(16);
    doc.text("ESTADO DE CUENTA", 80, 20);

    // Información del huésped (simulada, puedes obtenerla desde inputs si lo deseas)
    doc.setFontSize(10);
    doc.setFont("helvetica", "normal");
    doc.text(`Huésped: Juan Pérez`, 20, 40);
    doc.text(`F. Llegada: 21/03/2025`, 130, 40);
    doc.text(`F. Salida: 24/03/2025`, 130, 50);
    doc.text(`Compañía: -`, 20, 50);
    doc.text(`Teléfono: 555-123-4567`, 20, 60);
    doc.text(`Dirección: Calle Falsa 123, CDMX`, 20, 70);
    doc.text(`Estado: CDMX`, 130, 60);
    doc.text(`Cve. Res.: 167824`, 130, 70);
    doc.text(`Ciudad: CDMX`, 20, 80);
    doc.text(`Folio: 123456`, 130, 80);
    doc.text(`Habitación: ${habitacion}`, 20, 90);
    doc.text(`Fecha: ${new Date().toLocaleDateString("es-ES")}`, 130, 90);

    // Tabla de cargos
    const datos = [
        ["24/01/24", "62334", "Marche (Comida)", "$2,620.00", "-"],
        ["25/01/24", "62334", "Marche (Desayuno)", "$2,000.00", "-"],
        ["26/01/24", "62334", "Marche (Cena)", "$1,500.00", "-"],
        ["27/01/24", "62334", "Marche (Comida)", "$3,000.00", "-"],
        ["28/01/24", "62334", "Marche (Desayuno)", "$1,500.00", "-"],
        ["29/01/24", "62334", "Marche (Cena)", "$2,500.00", "-"]
    ];

    doc.autoTable({
        startY: 100,
        head: [["Fecha", "Código", "Descripción", "Cargos", "Abonos"]],
        body: datos,
        theme: "grid",
        styles: { fontSize: 10 },
        headStyles: { fillColor: [9, 32, 52], textColor: [255, 255, 255] }
    });

    // Balance
    const yFinal = doc.lastAutoTable.finalY + 10;
    doc.setFont("helvetica", "bold");
    doc.text("BALANCE: $19,870.00", 140, yFinal);

    // Datos de facturación
    doc.setFont("helvetica", "normal");
    doc.text("DATOS PARA FACTURAR:", 20, yFinal + 10);
    doc.text("Solicite su factura en el mismo mes de consumo.", 20, yFinal + 20);
    doc.text("Ingrese a nuestro portal:", 20, yFinal + 30);
    doc.setTextColor(0, 0, 255);
    doc.textWithLink("https://facturacion.mundoimperial.com/manualBilling", 20, yFinal + 40, {
        url: "https://facturacion.mundoimperial.com/manualBilling"
    });

    // Firma
    doc.setTextColor(0, 0, 0);
    doc.text("Firma del Huésped", 140, yFinal + 60);

    // Guardar
    doc.save(`EstadoCuenta_Habitacion${habitacion}.pdf`);
}
window.generarPDF = generarPDF;

