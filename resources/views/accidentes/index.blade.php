@extends('layouts.dashboard')

@section('title', 'Accidentes')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Accidentes Registrados</h2>
    </div>

    <!-- inline form para crear -->
    <form id="formCrear" class="mb-4 flex space-x-2">
        <input
            type="text"
            name="nombre"
            placeholder="Nuevo accidente…"
            required
            class="border px-2 py-1 flex-grow">
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>

    <!-- tabla vacía: se llenará vía JS -->
    <table id="tablaAccidentes" class="table-auto w-full">
        <thead>
            <tr>
                <th>Nombre</th>
                <th class="text-right">Acciones</th>
            </tr>
        </thead>
        <tbody>
            {{-- filas inyectadas por JS --}}
        </tbody>
    </table>
</div>
@endsection

{{-- CSRF token (si tu layout no lo inyecta en <head>) --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

{{-- Script AJAX para CRUD --}}
@push('scripts')
<script>
    (() => {
        const token = document.head.querySelector('meta[name="csrf-token"]').content;

        async function loadAccidentes() {
            const res = await fetch('/accidentes');
            const data = await res.json();
            const tbody = document.querySelector('#tablaAccidentes tbody');
            tbody.innerHTML = '';
            data.forEach(a => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
        <td>${a.nombre}</td>
        <td class="text-right space-x-2">
          <button data-id="${a.id}" class="btn-ver text-green-600">Ver</button>
          <button data-id="${a.id}" class="btn-editar text-yellow-600">Editar</button>
          <button data-id="${a.id}" class="btn-eliminar text-red-600">Eliminar</button>
        </td>`;
                tbody.appendChild(tr);
            });
        }

        async function crearAccidente(nombre) {
            await fetch('/admin/accidentes', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    nombre
                })
            });
            loadAccidentes();
        }

        async function actualizarAccidente(id, nombre) {
            await fetch(`/admin/accidentes/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    nombre
                })
            });
            loadAccidentes();
        }

        async function eliminarAccidente(id) {
            if (!confirm('¿Eliminar este accidente?')) return;
            await fetch(`/admin/accidentes/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            loadAccidentes();
        }

        document.addEventListener('DOMContentLoaded', () => {
            // cargar la lista
            loadAccidentes();

            // crear
            document.getElementById('formCrear')
                .addEventListener('submit', e => {
                    e.preventDefault();
                    const nombre = e.target.nombre.value.trim();
                    if (nombre) {
                        crearAccidente(nombre);
                        e.target.reset();
                    }
                });

            // delegar acciones en la tabla
            document.getElementById('tablaAccidentes')
                .addEventListener('click', e => {
                    const id = e.target.dataset.id;
                    if (!id) return;

                    if (e.target.classList.contains('btn-ver')) {
                        window.location.href = `/admin/accidentes/${id}`;
                    }
                    if (e.target.classList.contains('btn-editar')) {
                        const current = e.target.closest('tr').querySelector('td').textContent;
                        const nuevo = prompt('Nuevo nombre:', current);
                        if (nuevo) actualizarAccidente(id, nuevo.trim());
                    }
                    if (e.target.classList.contains('btn-eliminar')) {
                        eliminarAccidente(id);
                    }
                });
        });
    })();
</script>
@endpush