<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mundo Imperial</title>

  <!-- Fuentes y estilo -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('administracionpropiedades.css') }}">

  <!-- Scripts -->
  <script src="{{ asset('administracionpropiedades.js') }}" defer></script>
</head>
<body>
  <div class="sidebar">
    <div class="menu"><br><br>
      <a href="{{ url('rackhabitaciones') }}" class="menu-item"><img src="{{ asset('images/estatushabitacion.svg') }}" alt="Estatus"><span>Rack de habitaciones</span></a>
      <a href="{{ url('llegadas') }}" class="menu-item"><img src="{{ asset('images/llegadas.svg') }}" alt="Llegadas"><span>Llegadas</span></a>
      <div class="menu-item dropdown">
        <button class="dropbtn"><img src="{{ asset('images/centroconsumo.svg') }}" alt="Centro"><span>Centro consumo</span></button>
        <div class="dropdown-content">
          <a href="{{ url('centroconsumopalacio') }}">Palacio</a>
          <a href="{{ url('centroconsumopierre') }}">Pierre</a>
          <a href="{{ url('centroconsumoprincess') }}">Princess</a>
        </div>
      </div>
      <a href="{{ url('estadodecuenta') }}" class="menu-item"><img src="{{ asset('images/estadodecuenta.svg') }}" alt="Cuenta"><span>Estado de cuenta</span></a>
      <div class="menu-item dropdown">
        <button class="dropbtn"><img src="{{ asset('images/administracioncuentas.svg') }}" alt="Admin"><span>Administración</span></button>
        <div class="dropdown-content">
          <a href="{{ url('administracionpropiedades') }}">Propiedades</a>
          <a href="{{ url('administracioncentroconsumo') }}">Centro consumo</a>
        </div>
      </div>
    </div>
    <div class="logout">
      <a href="#" class="menu-item"><img src="{{ asset('images/cerrarsesion.svg') }}" alt="Cerrar sesión"><span>Cerrar sesión</span></a>
    </div>
  </div>

  <div class="contenido-centros">
    <!-- Formulario -->
    <div class="formulario-centro">
      <h2>Registrar propiedad</h2><br>
      <label for="propiedad">Nombre de la propiedad:</label>
      <input type="text" id="propiedad" name="propiedad" required>


      <label for="logo">Cargar logo:</label>
      <input type="file" id="logo" name="logo" accept="image/*">

      <button id="crearBtn" class="boton-crear">Crear</button>

    </div>

    <!-- Tabla -->
    <div class="main-content">
      <div class="content" id="contenido">
        <div class="search-bar">
          <input type="text" id="searchInput" placeholder="Buscar por propiedad">
          <button onclick="buscarUsuario()">Buscar</button>
        </div>

        <table>
          <thead>
            <tr>
              <th>Propiedad</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="userTable">
            <tr>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>
</html>
