@extends('layouts.app')

@section('title', 'Estado de cuenta')

@vite([
    'resources/css/menu.css',
    'resources/css/estadodecuenta.css',
    'resources/js/estadodecuenta.js'
])

@section('content')

  <div class="main-content">
    <div class="top-section">
      <div class="form-group">
        <label for="habitacion">Habitación</label>
        <input type="text" id="habitacion" name="habitacion" maxlength="4" pattern="\d{4}" required>
      </div>
      <div>
        <button class="button" onclick="generarPDF()">Imprimir</button>
        <button class="button">Check Out</button>
      </div>
    </div>

    <div class="table-container">
      <h3>ESTADO DE CUENTA</h3>
      <table>
        <tr><td>Huesped</td><td><input type="text"></td><td>F.Llegada</td><td><input type="text"></td><td>F.Salida</td><td><input type="text"></td></tr>
        <tr><td>Compañia</td><td><input type="text"></td><td>Telefono</td><td><input type="text"></td><td>C.P.</td><td><input type="text"></td></tr>
        <tr><td>Direccion</td><td><input type="text"></td><td>Estado</td><td><input type="text"></td><td>Cve. Res.</td><td><input type="text"></td></tr>
        <tr><td>Ciudad</td><td><input type="text"></td><td>Folio</td><td><input type="text"></td><td>Fecha</td><td id="fecha"></td></tr>
      </table>

      <table>
        <thead>
          <tr><th>Fecha</th><th>Codigo</th><th>Descripcion</th><th>Cargos</th><th>Abonos</th></tr>
        </thead>
        <tbody>
          <tr><td>-</td><td>-</td><td>-</td><td>-</td><td>-</td></tr>
        </tbody>
      </table><br>

      <div class="facturacion">
        <h4>DATOS PARA FACTURAR</h4>
        <p>Solicite su factura en el mismo mes de consumo.</p>
        <p>Ingrese a nuestro portal:</p>
        <a href="https://facturacion.mundoimperial.com/manualBilling" target="_blank">
          https://facturacion.mundoimperial.com/manualBilling
        </a>
      </div>

      <div class="balance">BALANCE: $0.00</div><br>
      <div class="footer">Firma del Huésped</div>
    </div>
  </div>

  <script>
    document.getElementById("fecha").innerText = new Date().toLocaleDateString("es-ES");
  </script>
  <!-- jsPDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>

<!-- jsPDF AutoTable -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.28/jspdf.plugin.autotable.min.js"></script>

@endsection
