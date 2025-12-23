@extends('layouts.dashboard')

@section('title', 'Control de Agua')

@section('content')
@vite(['resources/css/CapturaDeEnergetico.css'])
<div class="max-w-md p-6 mx-auto">
    <h1 class="font-bold text-center" style="color: #011a32; font-size: 1.875rem; line-height: 2.25rem; margin-bottom: 0.5rem;">Control de Agua</h1>
    <p class="text-center" style="color: #011a32; font-size: 1.25rem; line-height: 1.75rem; margin-bottom: 1.5rem;">Captura del consumo de agua</p>
    
    @if(session('success'))
        <div class="mb-4 alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form id="form-agua" method="POST" action="{{ route('captura.agua.store') }}" style="background-color: #f8fafc; padding: 1.0rem; border-radius: 0.5rem; border: 1px solid #e2e8f0;">
        @csrf

        <!-- Selector de Propiedad -->
        <div class="mb-4">
            <label style="display: block; font-weight: 600; color: #011a32; margin-bottom: 0.5rem;">Propiedad:</label>
            <select name="propiedad_id" style="width: 100%; padding: 0.4rem; border: 1px solid #cbd5e0; border-radius: 0.25rem; background-color: white;">
                <option value="">Seleccione...</option>
                @foreach($propiedades as $prop)
                <option value="{{ $prop->id_propiedad }}">
                    {{ $prop->nombre_propiedad }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Selector de Tipo de Recurso -->
        <div class="mb-4">
            <label style="display: block; font-weight: 600; color: #011a32; margin-bottom: 0.5rem;">Tipo de Recurso:</label>
            <select name="energetico_id" id="energetico_id" style="width: 100%; padding: 0.4rem; border: 1px solid #cbd5e0; border-radius: 0.25rem; background-color: white;">
                <option value="">Seleccione un recurso</option>
                @if(isset($energeticos))
                    @foreach($energeticos->where('modulo', 'agua') as $energetico)
                        <option value="{{ $energetico->id }}" data-unidad="{{ $energetico->unidad }}">
                            {{ $energetico->nombre }}
                        </option>
                    @endforeach
                @endif
            </select>
        </div>

        <!-- Consumo -->
        <div class="mb-4">
            <label style="display: block; font-weight: 600; color: #011a32; margin-bottom: 0.5rem;">Consumo (m³):</label>
            <input type="number" id="cantidad" name="cantidad" style="width: 100%; padding: 0.4rem; border: 1px solid #cbd5e0; border-radius: 0.25rem; background-color: white;" 
                   step="0.01" min="0" required>
        </div>

        <!-- Fecha -->
        <div class="mb-4">
            <label style="display: block; font-weight: 600; color: #011a32; margin-bottom: 0.5rem;">Fecha:</label>
            <input type="date" id="fecha" name="fecha" style="width: 100%; padding: 0.4rem; border: 1px solid #cbd5e0; border-radius: 0.25rem; background-color: white;" 
                   value="{{ $fecha_actual }}" required>
        </div>

        <!-- Costo -->
        <div class="mb-4">
            <label style="display: block; font-weight: 600; color: #011a32; margin-bottom: 0.5rem;">Costo Total (MXN):</label>
            <input type="number" id="costo" name="costo" style="width: 100%; padding: 0.4rem; border: 1px solid #cbd5e0; border-radius: 0.25rem; background-color: white;" 
                   step="0.01" min="0" required>
        </div>

        <!-- Costo Promedio -->
        <div class="mb-4">
            <label style="display: block; font-weight: 600; color: #011a32; margin-bottom: 0.5rem;">Costo por m³:</label>
            <input type="text" id="costo_promedio" style="width: 100%; padding: 0.4rem; border: 1px solid #cbd5e0; border-radius: 0.25rem; background-color: #edf2f7;" 
                   value="{{ session('costo_promedio') ?? '0.00' }}" readonly>
        </div>

        <button type="submit" style="width: 100%; padding: 0.4rem; background-color: #B38B2D; color: white; font-weight: 600; border: none; border-radius: 0.25rem; cursor: pointer; margin-top: 1rem;">
            <i class="mr-2 fas fa-save"></i> Registrar Consumo
        </button>
    </form>
</div>

<script src="{{ asset('js/agua.js') }}"></script>
@endsection