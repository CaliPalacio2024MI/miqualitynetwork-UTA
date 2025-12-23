@extends('layouts.app')

@section('title', 'Administración centro consumo')

@vite([
    'resources/css/menu.css',
    'resources/css/administracioncentroconsumo.css',
    'resources/js/administracioncentroconsumo.js'
])

@section('content')

  <div class="contenido-centros">
    <!-- Formulario -->
    <div class="formulario-centro">
      <div class="titulo">Registrar centro de consumo</div><br>
      <label for="nombreCentro">Nombre centro de consumo</label>
      <input type="text" id="nombreCentro" name="nombreCentro" required>

      <label for="propiedad">Propiedad</label>
<select id="propiedad" name="propiedad" required>
    <option value="">Seleccionar propiedad</option>
</select>


      <label for="logo">Cargar logo:</label>
      <input type="file" id="logo" name="logo" accept="image/*">
      <a class="boton-crear">Crear</a>
    </div>

    <!-- Tabla de centros -->
    <div class="main-content">
      <div class="content" id="contenido">
        <div class="search-bar">
          <input type="text" id="searchInput" placeholder="Buscar por nombre o propiedad">
          <button onclick="buscarUsuario()">Buscar</button>
        </div>

        <table>
          <thead>
            <tr>
              <th>Nombre</th>
              <th>Propiedad</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="userTable">
            <tr>
              <td>Marche</td>
              <td>Palacio Mundo Imperial</td>
              <td class="actions">
                <button class="editarusuario"><img src="{{ asset('images/editar.svg') }}"></button>
                <button class="eliminarusuario"><img src="{{ asset('images/eliminar.svg') }}"></button>
              </td>
            </tr>
            <tr>
              <td>Bar Pierre</td>
              <td>Pierre Mundo Imperial</td>
              <td class="actions">
                <button class="editarusuario"><img src="{{ asset('images/editar.svg') }}"></button>
                <button class="eliminarusuario"><img src="{{ asset('images/eliminar.svg') }}"></button>
              </td>
            </tr>
            <tr>
              <td>Chula Vista</td>
              <td>Princess Mundo Imperial</td>
              <td class="actions">
                <button class="editarusuario"><img src="{{ asset('images/editar.svg') }}"></button>
                <button class="eliminarusuario"><img src="{{ asset('images/eliminar.svg') }}"></button>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection
