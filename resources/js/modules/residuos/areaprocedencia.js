// resources/js/modules/residuos/areaprocedencia.js

/**
 * toggleEdit: Muestra el <input> y los botones de “Guardar/Cancelar” para editar inline.
 * @param {number} id - El ID del área de procedencia a editar.
 */
function toggleEdit(id) {
  const span = document.getElementById(`display-${id}`);
  const input = document.getElementById(`input-${id}`);
  const editBtn = document.getElementById(`edit-btn-${id}`);
  const deleteFrm = document.getElementById(`delete-form-${id}`);
  const editForm = document.getElementById(`form-edit-${id}`);
  const hiddenInput = document.getElementById(`hidden-${id}`);

  if (!span || !input || !editBtn || !deleteFrm || !editForm || !hiddenInput) {
    return;
  }

  // Mostrar el input y ocultar el <span>
  span.style.display = 'none';
  input.style.display = 'inline-block';
  input.focus();

  // Ocultar botón editar y botón eliminar, mostrar formulario de edición (Guardar/Cancelar)
  editBtn.style.display = 'none';
  deleteFrm.style.display = 'none';
  editForm.style.display = 'inline-flex';

  // Inicializar el hidden con valor actual del input
  hiddenInput.value = input.value;

  // Sincronizar hidden cada vez que el usuario cambie el input
  input.addEventListener('input', () => {
    hiddenInput.value = input.value;
  });
}

/**
 * cancelEdit: Deshace el modo edición, recupera la visualización original.
 * @param {number} id - El ID del área de procedencia a cancelar.
 */
function cancelEdit(id) {
  const span = document.getElementById(`display-${id}`);
  const input = document.getElementById(`input-${id}`);
  const editBtn = document.getElementById(`edit-btn-${id}`);
  const deleteFrm = document.getElementById(`delete-form-${id}`);
  const editForm = document.getElementById(`form-edit-${id}`);

  if (!span || !input || !editBtn || !deleteFrm || !editForm) {
    return;
  }

  // Restaurar el <span> y ocultar el input
  span.style.display = 'inline';
  input.style.display = 'none';

  // Mostrar botones editar y eliminar, ocultar formulario de edición
  editBtn.style.display = 'inline-flex';
  deleteFrm.style.display = 'inline-flex';
  editForm.style.display = 'none';
}

// Exponer funciones en window para que onclick="toggleEdit(id)" y onclick="cancelEdit(id)" funcionen
window.toggleEdit = toggleEdit;
window.cancelEdit = cancelEdit;
