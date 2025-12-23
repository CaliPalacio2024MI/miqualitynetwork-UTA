{{-- resources/views/modules/residuos/configuracion/tipo_residuo.blade.php --}}

@extends('layouts.dashboard')

{{-- Título de la pestaña del navegador --}}
@section('title', 'ADMINISTRACION - TIPO DE RESIDUO')

@section('content')
  {{-- Cargamos FontAwesome para el ícono de “Editar” --}}
  <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
  />

  {{-- Enlazamos nuestro CSS vía Vite --}}
  @vite('resources/css/modules/residuos/tiporesiduo.css')

  <h1 class="mb-6">Tipo de Residuo</h1>

  <div class="form-container mb-8">
    <form
      action="{{ route('configuracion.agregarTipoResiduo') }}"
      method="POST"
      class="form-row"
    >
      @csrf

      <input
        type="text"
        name="nombre"
        class="input"
        placeholder="Nuevo tipo de residuo"
        required
      />

      <input
        type="color"
        name="color"
        class="input color-input"
        value="#000000"
        required
      />

      <input
        type="number"
        name="precio"
        class="input"
        placeholder="Precio"
        step="0.01"
        required
      />

      <button type="submit" class="boton">Agregar</button>
    </form>
  </div>

  <div class="table-centered">
    <table class="table">
      <thead>
        <tr>
          <th>Tipo de residuo</th>
          <th>Color</th>
          <th>Precio</th>
          <th>Acciones</th>
        </tr>
      </thead>
      <tbody>
        @foreach($tipos as $tipo)
          <tr data-id="{{ $tipo->id }}">
            {{-- Nombre editable --}}
            <td class="td-editable" data-campo="nombre">
              {{ $tipo->nombre }}
            </td>

            {{-- Color editable --}}
            <td class="td-editable" data-campo="color">
              <div
                class="color-box"
                style="background-color: {{ $tipo->color }};"
              ></div>
            </td>

            {{-- Precio editable --}}
            <td class="td-editable" data-campo="precio">
              {{ number_format($tipo->precio, 2) }}
            </td>

            {{-- Columna de acciones --}}
            <td class="acciones-cell">
              {{-- 1) Botón editar inline --}}
              <button
                type="button"
                class="icono-editar"
                data-editing="false"
                onclick="toggleInlineEdit(this)"
                title="Editar este registro"
              >
                <i class="fas fa-pen-to-square"></i>
              </button>

              {{-- 2) Formulario ELIMINAR (con <button> + <img>) --}}
              <form
                action="{{ route('configuracion.eliminarTipoResiduo', $tipo->id) }}"
                method="POST"
                class="form-eliminar-inline"
                onsubmit="return confirm('¿Estás seguro de eliminar este tipo de residuo?');"
              >
                @csrf
                @method('DELETE')

                {{-- Botón que contiene solo la imagen --}}
                <button
                  type="submit"
                  class="btn-eliminar-img"
                  title="Eliminar este registro"
                  aria-label="Eliminar este registro"
                  style="background:none;border:none;padding:0;display:inline-flex;align-items:center;justify-content:center;cursor:pointer;margin-top:0;"
                >
                  {{-- Aquí ya no usamos Vite::asset, sino asset() --}}
                  <img
                    src="{{ asset('images/modules/residuos/borrar.png') }}"
                    alt="Eliminar"
                    style="width:20px; height:20px; vertical-align:middle; object-fit:contain; margin-top:12px;"
                  />
                </button>
              </form>
            </td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  {{-- DEFINICION DE LAS VARIABLES DE JS ANTES DE CARGAR EL SCRIPT DE EDICIÓN --}}
  <script>
    // URL plantilla para edición con AJAX
    window.tipoResiduoAjaxUrlTemplate =
      "{{ route('configuracion.editarTipoResiduoAjax', ['id' => 'ID_PLACEHOLDER']) }}";

    // CSRF token para peticiones AJAX
    window.csrfToken = "{{ csrf_token() }}";
  </script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  @vite('resources/js/modules/residuos/tiporesiduo.js')
@endsection
