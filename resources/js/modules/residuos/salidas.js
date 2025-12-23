// resources/js/salidas.js

// Función que marca/desmarca la fila
function toggleRow(checkbox) {
    const row = checkbox.closest('tr');
    if (checkbox.checked) {
      row.classList.add('selected');
    } else {
      row.classList.remove('selected');
    }
  }
  
  // Al cargar el DOM, atachamos el listener a todos los checkboxes
  document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('input[name="entrada_id[]"]').forEach(chk => {
      chk.addEventListener('change', () => toggleRow(chk));
    });
  });
  