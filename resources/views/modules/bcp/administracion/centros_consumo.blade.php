@extends('layouts.dashboard')

@section('title', 'Administración de Racks de Habitaciones')
@vite([
    'resources/css/modules/bcp/centros_consumo.css'
])
@section('content')
<div class="rack-container">

    <h2 class="rack-title">Centros de Consumo</h2>

    <div class="rack-content">
        <!-- Formulario -->
        <!-- Formulario -->
<div class="rack-form">
    <form action="{{ route('admincentrosconsumo.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <label for="nombre">Nombre centro de consumo</label>
        <input type="text" name="nombre" id="nombre" required><br><br>

        <label for="propiedad">Propiedad</label>
        <select name="propiedad" id="propiedad" required onchange="this.options[0].disabled = true;">
            <option value="" selected disabled hidden>Seleccionar propiedad</option>
            <option value="Palacio Mundo Imperial">Palacio Mundo Imperial</option>
            <option value="Pierre Mundo Imperial">Pierre Mundo Imperial</option>
            <option value="Princess Mundo Imperial">Princess Mundo Imperial</option>
        </select><br><br>

        <label for="categoria">Categoría</label>
        <input type="text" name="categoria" id="categoria"><br><br>

        <label for="logo">Cargar logo:</label>
        <input type="file" name="logo" id="logo" accept="image/*">

        <button type="submit" class="crear-btn">Crear</button>
    </form>
</div>



        <!-- Tabla -->
        <!-- Buscador -->
<div class="rack-busqueda">
    <form method="GET" action="{{ route('admincentrosconsumo.index') }}">
        <input type="text" name="buscar" placeholder="Buscar por nombre o propiedad" value="{{ request('buscar') }}">
        <button type="submit">Buscar</button>
    </form>
</div>
<div class="rack-tabla">
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Propiedad</th>
                <th>Categoría</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($centros as $centro)
                <tr>
                    <td>{{ $centro->nombre }}</td>
                    <td>{{ $centro->propiedad }}</td>
                    <td>{{ $centro->categoria }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">No se encontraron registros.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>

        </div>
    </div>
</div>
@endsection
