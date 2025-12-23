@extends('layouts.dashboard')

@section('title', 'Energéticos')

@vite(['resources/css/seguridadambiental/energetico.css'])

@section('content')
<div class="captura-container">
    <!-- Encabezado -->
    <div class="text-center mb-6">
        <h2 class="px-6 py-3 text-2xl font-bold text-center bg-gray-300 rounded-full shadow-md">
          Administración de Energéticos
        </h2>
    </div>

    <div class="main-content">
        <!-- Mensajes -->
        @if(session('success'))
            <div class="alert-message">
                {{ session('success') }}
                <button type="button" class="close-button" onclick="this.parentElement.remove()">
                    x
                </button>
            </div>
        @endif

        <!-- Barra superior -->
        <div class="action-bar">
            <h5 class="section-title">Lista de Energéticos</h5>
            <button id="btnMostrarFormulario" class="add-button">
                <i class="fas fa-plus mr-2"></i> Nuevo Energético
            </button>
        </div>

        <!-- Contenedor principal -->
        <div class="content-wrapper">
            <!-- Tabla de energéticos -->
            <div id="tablaContainer" class="table-wrapper">
                <div class="table-content">
                    <table class="energeticos-table">
                        <thead>
                            <tr>
                                <th class="text-left">Nombre</th>
                                <th class="text-center">Unidad</th>
                                <th class="text-center">Color</th>
                                <th class="text-center">Módulo</th>
                                <th class="text-center">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($energeticos as $energetico)
                            <tr>
                                <td>{{ $energetico->nombre }}</td>
                                <td class="text-center">{{ $energetico->unidad }}</td>
                                <td class="text-center">
                                    <div class="color-display" style="background-color: {{ $energetico->color }}"></div>
                                </td>
                                <td class="text-center">{{ ucfirst($energetico->modulo) }}</td>
                                <td class="text-center">
                                    <div class="action-buttons">
                                        <button onclick="prepararEditar({{ json_encode($energetico) }})" 
                                                class="edit-button">
                                            <img src="{{ asset('images/botoneditar.png') }}" alt="Editar" class="action-icon">
                                        </button>
                                        <form action="{{ route('control.energeticos.destroy', $energetico->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" 
                                                    onclick="return confirm('¿Eliminar este energético?')"
                                                    class="delete-button">
                                                <img src="{{ asset('images/iconodeborrar.png') }}" alt="Eliminar" class="action-icon">
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="no-results">
                                    <i class="fas fa-database"></i>
                                    <p>No hay energéticos registrados</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Formulario -->
            <div id="formularioContainer" class="form-container hidden">
                <div class="form-card">
                    <div class="form-header">
                        <h5 id="formTitle">Nuevo Energético</h5>
                        <button id="btnOcultarFormulario" type="button" class="close-button">
                            &times;
                        </button>
                    </div>
                    <div class="form-body">
                        <form id="energeticoForm" method="POST" action="{{ route('control.energeticos.store') }}">
                            @csrf
                            <div id="methodField"></div>
                            
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="nombre" class="form-input" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Unidad</label>
                                <input type="text" name="unidad" class="form-input" required>
                            </div>
                            
                            <div class="form-group">
                                <label>Módulo</label>
                                <select name="modulo" class="form-input" required>
                                    <option value="agua">Agua</option>
                                    <option value="electricidad">Electricidad</option>
                                    <option value="aire">Aire (Combustibles)</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label>Color</label>
                                <div class="color-selector">
                                    <input type="color" id="colorPicker" value="#3490dc">
                                    <input type="text" name="color" class="color-input" 
                                           value="#3490dc" pattern="^#[0-9A-Fa-f]{6}$" required>
                                </div>
                                <small class="input-hint">Formato HEX (ej. #3490dc)</small>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" id="btnCancelar" class="cancel-button">
                                    Cancelar
                                </button>
                                <button type="submit" class="submit-button">
                                    Guardar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// URLs para las acciones del formulario
const storeUrl = "{{ route('control.energeticos.store') }}";
const updateUrl = "{{ route('control.energeticos.update', '') }}";

// Mostrar/ocultar formulario
document.getElementById('btnMostrarFormulario').addEventListener('click', function() {
    document.getElementById('formularioContainer').classList.remove('hidden');
    document.getElementById('tablaContainer').classList.add('reduced-width');
    resetearFormulario();
});

document.getElementById('btnOcultarFormulario').addEventListener('click', function() {
    document.getElementById('formularioContainer').classList.add('hidden');
    document.getElementById('tablaContainer').classList.remove('reduced-width');
});

document.getElementById('btnCancelar').addEventListener('click', function() {
    document.getElementById('formularioContainer').classList.add('hidden');
    document.getElementById('tablaContainer').classList.remove('reduced-width');
});

function prepararEditar(energetico) {
    if (document.getElementById('formularioContainer').classList.contains('hidden')) {
        document.getElementById('formularioContainer').classList.remove('hidden');
        document.getElementById('tablaContainer').classList.add('reduced-width');
    }

    const form = document.getElementById('energeticoForm');
    const title = document.getElementById('formTitle');
    
    title.textContent = 'Editar Energético';
    form.action = `${updateUrl}/${energetico.id}`;
    document.getElementById('methodField').innerHTML = '<input type="hidden" name="_method" value="PUT">';
    
    form.nombre.value = energetico.nombre;
    form.unidad.value = energetico.unidad;
    form.modulo.value = energetico.modulo;
    form.color.value = energetico.color;
    document.getElementById('colorPicker').value = energetico.color;
}

function resetearFormulario() {
    const form = document.getElementById('energeticoForm');
    const title = document.getElementById('formTitle');
    
    title.textContent = 'Nuevo Energético';
    form.action = storeUrl;
    document.getElementById('methodField').innerHTML = '';
    
    form.reset();
    document.getElementById('colorPicker').value = '#3490dc';
    form.color.value = '#3490dc';
}

// Sincronizar color picker
document.addEventListener('DOMContentLoaded', function() {
    const colorPicker = document.getElementById('colorPicker');
    const colorInput = document.querySelector('input[name="color"]');
    
    colorPicker.addEventListener('input', function() {
        colorInput.value = this.value;
    });
    
    colorInput.addEventListener('input', function() {
        if (/^#[0-9A-Fa-f]{6}$/i.test(this.value)) {
            colorPicker.value = this.value;
        }
    });
});
</script>
@endsection