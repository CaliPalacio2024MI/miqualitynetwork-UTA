document.addEventListener("DOMContentLoaded", function () {
    console.log("✅ Script de filtros cargado correctamente");

    const searchInput = document.getElementById("search");
    const fileTypeFilter = document.getElementById("fileTypeFilter");
    const fileContainer = document.getElementById("fileContainer");

    function filterFiles() {
        const searchText = searchInput.value.toLowerCase();
        const selectedType = fileTypeFilter.value.toLowerCase();
        const files = document.getElementsByClassName("file-card");

        console.log("🔍 Buscando:", searchText);
        console.log("📂 Filtrando por tipo:", selectedType);
        console.log("📦 Total de archivos encontrados:", files.length);

        Array.from(files).forEach(file => {
            const fileName = file.getAttribute("data-name") ? file.getAttribute("data-name").toLowerCase() : "";
            const fileType = file.getAttribute("data-type") ? file.getAttribute("data-type").toLowerCase() : "";

            const matchesSearch = fileName.includes(searchText);
            let matchesType = selectedType === "" || fileType === selectedType;

            // Si el filtro es "img", aceptar archivos con tipo "png", "jpg", etc.
            if (selectedType === "img") {
                matchesType = ["png", "jpg", "jpeg", "gif"].includes(fileType);
            }

            console.log(`📄 Archivo: ${fileName} | Tipo: ${fileType} | Matches: ${matchesSearch && matchesType}`);

            if (matchesSearch && matchesType) {
                file.classList.remove("hidden");
            } else {
                file.classList.add("hidden");
            }
        });
    }

    searchInput.addEventListener("keyup", filterFiles);
    fileTypeFilter.addEventListener("change", filterFiles);
});
