/**
 * Alterna edición inline de una fila de tipo de residuo.
 * @param {HTMLElement} btn - Botón de edición que disparó la acción.
 */
function toggleInlineEdit(btn) {
  const $btn = window.$(btn);
  const $tr = $btn.closest('tr');
  const editing = $btn.data('editing');

  if (!editing) {
    // 1) Modo edición: convertir cada <td> evaluable a <input>
    $tr.find('.td-editable').each(function () {
      const $cell = window.$(this);
      const campo = $cell.data('campo');
      const textoOriginal = $cell.text().trim();

      if (campo === 'color') {
        // Tomar el color actual del <div> (rgb) y convertir a HEX
        const rgb = $cell.find('div').css('background-color');
        $cell.html(
          `<input type="color" class="edit-input" value="${rgbToHex(rgb)}" style="width:50px;">`
        );
      } else if (campo === 'precio') {
        // Convertir a <input type="number">
        $cell.html(
          `<input type="number" step="0.01" class="edit-input" value="${textoOriginal}" style="width:70px;">`
        );
      } else {
        // Nombre → <input type="text">
        $cell.html(`<input type="text" class="edit-input" value="${textoOriginal}">`);
      }
    });

    // 2) Cambiar el icono a “check” y marcar que estamos en modo edición
    $btn.data('editing', true);
    $btn.find('i')
      .removeClass('fa-pen-to-square')
      .addClass('fa-check');
  } else {
    // 3) Modo guardar: tomar valores de inputs y volver a celdas normales
    const updated = {};
    $tr.find('.td-editable').each(function () {
      const $cell = window.$(this);
      const campo = $cell.data('campo');
      let val;

      if (campo === 'color') {
        val = $cell.find('input').val();
        $cell.html(
          `<div style="width:24px; height:24px; background-color:${val}; border:1px solid #000;"></div>`
        );
      } else {
        val = $cell.find('input').val();
        $cell.text(val);
      }

      updated[campo] = val;
    });

    // 4) Restaurar el icono del lápiz y marcar “no editing”
    $btn.data('editing', false);
    $btn.find('i')
      .removeClass('fa-check')
      .addClass('fa-pen-to-square');

    // 5) Realizar AJAX PUT para persistir en la BD
    const template = window.tipoResiduoAjaxUrlTemplate;
    const id = $tr.data('id');
    const url = template.replace('ID_PLACEHOLDER', id);

    window.$.ajax({
      url: url,
      method: 'PUT',
      data: {
        _token: window.csrfToken,
        nombre: updated.nombre,
        color: updated.color,
        precio: updated.precio
      },
      success(resp) {
        console.log('Actualizado en BD:', resp);
      },
      error(err) {
        console.error('Error al actualizar:', err);
        alert('Ocurrió un error al actualizar. Intenta de nuevo.');
      }
    });
  }
}

/**
 * @param {string} rgb
 * @returns {string} color en formato hexadecimal
 */
function rgbToHex(rgb) {
  const m = /^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/.exec(rgb);
  if (!m) return rgb;
  return (
    "#" +
    [1, 2, 3]
      .map((i) => parseInt(m[i], 10).toString(16).padStart(2, "0"))
      .join("")
  );
}

// Exponer al scope global para que onclick="toggleInlineEdit(this)" funcione
window.toggleInlineEdit = toggleInlineEdit;
window.rgbToHex = rgbToHex;
