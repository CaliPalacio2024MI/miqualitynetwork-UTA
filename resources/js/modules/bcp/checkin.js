document.addEventListener('DOMContentLoaded', () => {
  const switchAcompanante = document.getElementById('switchAcompanante');

  const camposAcompanante = [
    'acompNombreField',
    'acompMailField',
    'acompTelField',
    'acompCalleField',
    'acompCiudadField',
    'acompEstadoField',
    'acompCPField'
  ];

  switchAcompanante.addEventListener('change', () => {
    const visible = switchAcompanante.checked;

    camposAcompanante.forEach(id => {
      const campo = document.getElementById(id);
      if (campo) campo.style.display = visible ? 'flex' : 'none';
    });

    // ✅ Replicar datos del titular si están vacíos (solo si se activó el switch)
    if (visible) {
      const titularMail = document.querySelector('input[type="email"]')?.value || '';
      const titularTel = document.querySelector('input[placeholder="Teléfono"]')?.value || '';
      const titularCalle = document.querySelector('input[placeholder="Calle"]')?.value || '';
      const titularCiudad = document.querySelector('input[placeholder="Ciudad"]')?.value || '';
      const titularEstado = document.querySelector('input[placeholder="Estado"]')?.value || '';
      const titularCP = document.querySelector('input[placeholder="CP"]')?.value || '';

      if (document.getElementById('acompMail')?.value === '') {
        document.getElementById('acompMail').value = titularMail;
        document.getElementById('acompTel').value = titularTel;
        document.getElementById('acompCalle').value = titularCalle;
        document.getElementById('acompCiudad').value = titularCiudad;
        document.getElementById('acompEstado').value = titularEstado;
        document.getElementById('acompCP').value = titularCP;
      }

    } else {
      // Si se desactiva, limpiar los campos
      document.querySelectorAll('[id^="acomp"] input')?.forEach(input => input.value = '');
    }
  });
});
