@extends('layouts.dashboard')

@section('title', 'Gestión de Responsables')

@section('content')

    <div class="text-center mt-6 mb-4">
        <h1 class="text-3xl font-bold text-[#111111]">Administración de Responsables</h1>
    </div>

    {{-- ALERTA DE REGISTRO --}}
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 contenedor-alerta-registro-proceso">
        <div class="bg-white p-6 rounded-xl shadow-md text-center max-w-sm">
            <h1 class="text-xl font-bold mb-2">Registrado</h1>
            <p>Responsable registrado</p>
            <img src="{{ asset('images/giftcompletado.gif') }}" class="w-20 h-20 mx-auto my-4">
            <button class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 px-4 rounded">Aceptar</button>
        </div>
    </div>

    {{-- ALERTA DE ELIMINACIÓN --}}
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 contenedor-alerta-eliminacion-proceso">
        <div class="bg-white p-6 rounded-xl shadow-md text-center max-w-sm">
            <h1 class="text-xl font-bold mb-2 text-red-600">Eliminar ⚠️</h1>
            <p>¿Está seguro de eliminar este responsable?</p>
            <p class="text-sm mt-1 text-gray-600">No se podrán revertir los cambios</p>
            <img src="{{ asset('images/advertencia.png') }}" class="w-20 h-20 mx-auto my-4">
            <form id="formEliminarResponsable" method="POST" action="{{ route('responsable.eliminar') }}" class="flex justify-center gap-4 mt-4">
                @csrf
                <input type="hidden" name="id" id="responsableEliminarId">
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Aceptar</button>
                <button type="button" class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded btn-cancelar-proceso-alerta">Cancelar</button>
            </form>
        </div>
    </div>

    {{-- ALERTA DE MODIFICACIÓN --}}
    <div class="fixed inset-0 bg-black bg-opacity-50 hidden justify-center items-center z-50 contenedor-alerta-modificar-proceso">
        <div class="bg-white p-6 rounded-xl shadow-md text-center max-w-sm">
            <h1 class="text-xl font-bold mb-2">Modificación</h1>
            <p>¿Está seguro de modificar el nombre de este responsable?</p>
            <div class="flex justify-center gap-4 mt-4">
                <button class="bg-yellow-400 hover:bg-yellow-500 text-black font-bold py-2 px-4 rounded btn-aceptar-proceso-alerta">Aceptar</button>
                <button class="bg-gray-300 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded btn-cancelar-modificacion-proceso-alerta">Cancelar</button>
            </div>
        </div>
    </div>

    <div class="w-full max-w-xl mx-auto p-6 bg-white rounded-xl shadow-lg">
        {{-- Formulario de registro --}}
        <form action="{{ route('responsable.crear') }}" method="POST" class="space-y-4">
            @csrf
            <div>
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre del Responsable</label>
                <input type="text" id="nombre" name="nombre" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400" required />
            </div>
            <div class="text-right">
                <button type="submit" class="bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-4 py-2 rounded-lg">Registrar Responsable</button>
            </div>
        </form>
    </div>

    {{-- Tabla de responsables --}}
    <div class="w-full max-w-2xl mx-auto mt-10">
        <h2 class="text-xl font-bold text-gray-800 mb-4">Responsables registrados</h2>
        <div class="bg-white p-4 rounded-xl shadow-md space-y-4">
            @foreach ($responsables as $responsable)
                <div class="flex items-center gap-3">
                    <form action="{{ route('responsable.actualizar') }}" method="POST" class="flex flex-1 gap-2">
                        @csrf
                        <input type="hidden" name="id" value="{{ $responsable->id }}">
                        <input type="text" name="nombre" value="{{ $responsable->nombre }}" class="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-400" />
                        <button type="submit" title="Actualizar" class="bg-yellow-400 hover:bg-yellow-500 px-3 py-2 rounded">
                            <img src="{{ asset('images/check.png') }}" class="w-6 h-6">
                        </button>
                    </form>
                    <button onclick="mostrarAlertaEliminar({{ $responsable->id }})" title="Eliminar" class="bg-red-500 hover:bg-red-600 px-3 py-2 rounded">
                        <img src="{{ asset('images/iconodeborrar.png') }}" class="w-6 h-6">
                    </button>
                </div>
                <hr class="border-t-2 border-yellow-400">
            @endforeach
        </div>
    </div>

    <script>
        // Mostrar alerta de eliminación
        function mostrarAlertaEliminar(id) {
            document.getElementById('responsableEliminarId').value = id;
            document.querySelector('.contenedor-alerta-eliminacion-proceso').style.display = 'flex';
        }

        // Botones de cancelar alerta de eliminación
        document.querySelectorAll('.btn-cancelar-proceso-alerta').forEach(btn => {
            btn.addEventListener('click', () => {
                document.querySelector('.contenedor-alerta-eliminacion-proceso').style.display = 'none';
            });
        });

        // Botones de aceptar alerta de registro
        document.querySelectorAll('.btn-aceptar-boton-registro-alerta').forEach(btn => {
            btn.addEventListener('click', () => {
                // Oculta la alerta
                document.querySelector('.contenedor-alerta-registro-proceso').style.display = 'none';

                // Limpia el campo de nombre
                const inputNombre = document.getElementById('nombre');
                if (inputNombre) inputNombre.value = '';

                // Reinicia el formulario completo
                const form = document.getElementById('formResponsable');
                if (form) form.reset();

                // Opcional: vuelve a enfocar el input
                inputNombre?.focus();
            });
        });

        // Mostrar alerta al registrar si existe el mensaje de éxito en sesión
        @if (session('success'))
            document.addEventListener('DOMContentLoaded', () => {
                document.querySelector('.contenedor-alerta-registro-proceso').style.display = 'flex';
            });
        @endif
    </script>

@endsection
