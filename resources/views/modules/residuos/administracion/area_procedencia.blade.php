{{-- resources/views/modules/residuos/configuracion/area_procedencia.blade.php --}}

@extends('layouts.dashboard')

{{-- Título de la pestaña del navegador --}}
@section('title', 'ADMINISTRACION - AREA DE PROCEDENCIA')

@section('content')
  {{-- Cargamos FontAwesome para los íconos --}}
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  />

  {{-- Enlazamos nuestro CSS vía Vite --}}
  @vite('resources/css/modules/residuos/areaprocedencia.css')

  <div class="area-container">
    <div class="zoom-container">
      <section class="area-header">
        <h1 class="page-title">Área de Procedencia</h1>

        <form
          action="{{ route('configuracion.agregarAreaProcedencia') }}"
          method="POST"
          class="form-row"
        >
          @csrf
          <input
            type="text"
            name="nombre"
            class="input"
            placeholder="Nueva área"
            required
          />
          <button type="submit" class="boton">Agregar</button>
        </form>
      </section>

      <div class="table-centered">
        <table class="table">
          <thead>
            <tr>
              <th>Área de procedencia</th>
              <th>Acción</th>
            </tr>
          </thead>
          <tbody>
            @foreach($areas as $area)
              <tr>
                {{-- Columna TEXTO / INPUT --}}
                <td>
                  <span id="display-{{ $area->id }}">{{ $area->nombre }}</span>
                  <input
                    type="text"
                    id="input-{{ $area->id }}"
                    class="input input-inline"
                    value="{{ $area->nombre }}"
                  />
                </td>

                {{-- Columna ACCIONES --}}
                <td class="acciones-cell">
                  {{-- 1) Botón Editar --}}
                  <button
                    type="button"
                    id="edit-btn-{{ $area->id }}"
                    class="icono-editar"
                    data-id="{{ $area->id }}"
                    onclick="toggleEdit({{ $area->id }})"
                    title="Editar esta área"
                  >
                    <i class="fas fa-pen-to-square"></i>
                  </button>

                  {{-- 2) Formulario ELIMINAR (con <button> + <img>) --}}
                  <form
                    id="delete-form-{{ $area->id }}"
                    action="{{ route('configuracion.eliminarAreaProcedencia', $area->id) }}"
                    method="POST"
                    class="form-eliminar delete-form"
                    onsubmit="return confirm('¿Estás seguro de eliminar esta área?');"
                  >
                    @csrf
                    @method('DELETE')

                    {{-- Botón que contiene solo la imagen --}}
                    <button
                      type="submit"
                      class="btn-eliminar-img"
                      title="Eliminar esta área"
                      aria-label="Eliminar esta área"
                      style="
                        background: none;
                        border: none;
                        padding: 0;
                        margin-left: 6px;
                        display: inline-flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                      "
                    >
                      {{-- Ahora apuntamos a public/images/modules/residuos/borrar.png --}}
                      <img
                        src="{{ asset('images/modules/residuos/borrar.png') }}"
                        alt="Eliminar"
                        style="
                          width: 20px;
                          height: 20px;
                          vertical-align: middle;
                          object-fit: contain;
                          margin-top: 12px;
                        "
                      />
                    </button>
                  </form>

                  {{-- 3) Formulario “Guardar/Cancelar” (modo edición) --}}
                  <form
                    id="form-edit-{{ $area->id }}"
                    action="{{ route('configuracion.editarAreaProcedencia', $area->id) }}"
                    method="POST"
                    class="edit-form form-edit-inline"
                  >
                    @csrf
                    @method('PUT')
                    {{-- Hidden para capturar el valor real cuando el usuario edite --}}
                    <input type="hidden" name="nombre" id="hidden-{{ $area->id }}" />

                    {{-- Botón Confirmar (ícono check) --}}
                    <button type="submit" class="icono-editar" title="Guardar cambios">
                      <i class="fas fa-check"></i>
                    </button>

                    {{-- Botón Cancelar (ícono xmark) --}}
                    <button
                      type="button"
                      class="icono-eliminar-cancel"
                      onclick="cancelEdit({{ $area->id }})"
                      title="Cancelar edición"
                    >
                      <i class="fas fa-xmark"></i>
                    </button>
                  </form>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  {{-- Cargamos jQuery --}}
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  {{-- Cargamos nuestro JS vía Vite --}}
  @vite('resources/js/modules/residuos/areaprocedencia.js')
@endsection
