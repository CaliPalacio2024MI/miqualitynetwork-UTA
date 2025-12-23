@extends('layouts.app')
@section('title', 'Catálogo')
@section('content')

@vite(['resources/css/bcp/app.css', 'resources/js/bcp/app.js'])
@include('seguridaddelainformacion.bcp.layouts.barra')

@if(session('success'))
<div id="modalSuccess" class="modal">
    <div class="modal-content">
        <p>{{ session('success') }}</p>
        <button id="btn-modal">Cerrar</button>
    </div>
</div>
@endif

@if(session('error'))
<div id="modalError" class="modal">
    <div class="modal-content">
        <p>{{ session('error') }}</p>
        <button id="btn-modal">Cerrar</button>
    </div>
</div>
@endif

@if ($errors->any())
<div id="modalError" class="modal">
    <div class="modal-content">
        <ul>
            @foreach ($errors->all() as $e)
            <li>{{ $e }}</li>
            @endforeach
        </ul>
        <button id="btn-modal">Cerrar</button>
    </div>
</div>
@endif

<div class="container_entero">
    <h2>CRÉDITOS</h2>

    <!-- Límite de Créditos -->

    <div class="w-[400px] bg-white p-6 rounded-lg shadow-md text-center" style="margin: 0 auto;">
        <h2 class="text-xl font-semibold mb-4">Límite de Créditos</h2>

        <form id="cuentaForm" method="POST" action="{{ route('creditos.update') }}" class="space-y-4 text-left">
            @csrf

            <!-- Créditos -->
            <label>Créditos x camaristas</label>
            <div>
                <input type="number" name="Creditos" value="{{ $creditos->creditos }}" placeholder="0" required>
            </div>

            <!-- Botón -->
            <div class="text-center pt-2">
                <button type="submit">
                    Guardar
                </button>
            </div>

        </form>
    </div>

</div>

<div id="modalCreditos" class="modal" style="display: none;">
    <div class="modal-content">
        <p>Los créditos actuales son {{ $creditos->creditos }}</p>
        <button id="cerrarCreditos">Cerrar</button>
    </div>
</div>

<script>
    document.getElementById('btn-modal')?.addEventListener('click', function() {
        this.closest('.modal').style.display = 'none';
    });

    document.querySelector('button.boton-icono')?.addEventListener('click', function() {
        document.getElementById('modalCreditos').style.display = 'block';
    });

    document.getElementById('cerrarCreditos')?.addEventListener('click', function() {
        document.getElementById('modalCreditos').style.display = 'none';
    });
</script>


@endsection