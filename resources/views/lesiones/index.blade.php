@extends('layouts.dashboard')

@section('title', 'Lesiones')

@section('content')
<div class="bg-white rounded-lg shadow-lg p-6">
    <div class="flex justify-between items-center mb-4">
        <h2 class="text-2xl font-bold">Lesiones Registradas</h2>
    </div>

    <!-- formulario inline para crear nueva lesión -->
    <form id="formCrearLesion" class="mb-4 flex space-x-2">
        <input
            type="text"
            name="nombre"
            placeholder="Nueva lesión…"
            required
            class="border px-2 py-1 flex-grow">
        <button type="submit" class="btn btn-primary">Crear</button>
    </form>

    <!-- tabla vacía: se llenará vía AJAX -->
    <table id="tablaLesiones" class="table-auto w-full">
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

{{-- CSRF token (necesario para POST/PUT/DELETE) --}}
<meta name="csrf-token" content="{{ csrf_token() }}">

@push('scripts')
<script>
    (() => {
        const token = document.head.querySelector('meta[name="csrf-token"]').content;

        // 1) Carga todas las lesiones en JSON :contentReference[oaicite:0]{index=0}
        async function loadLesiones() {
            const res = await fetch('/api/lesiones');
            const data = await res.json();
            const tbody = document.querySelector('#tablaLesiones tbody');
            tbody.innerHTML = '';
            data.forEach(l => {
                const tr = document.createElement('tr');
                tr.innerHTML = `
        <td>${l.nombre}</td>
        <td class="text-right space-x-2">
          <button data-id="${l.id}" class="btn-ver text-green-600">Ver</button>
          <button data-id="${l.id}" class="btn-editar text-yellow-600">Editar</button>
          <button data-id="${l.id}" class="btn-eliminar text-red-600">Eliminar</button>
        </td>`;
                tbody.appendChild(tr);
            });
        }

        // 2) Crear nueva lesión
        async function crearLesion(nombre) {
            await fetch('/admin/lesiones', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    nombre
                })
            });
            loadLesiones();
        }

        // 3) Actualizar lesión existente
        async function actualizarLesion(id, nombre) {
            await fetch(`/admin/lesiones/${id}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    nombre
                })
            });
            loadLesiones();
        }

        // 4) Eliminar lesión
        async function eliminarLesion(id) {
            if (!confirm('¿Eliminar esta lesión?')) return;
            await fetch(`/admin/lesiones/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': token
                }
            });
            loadLesiones();
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Carga inicial
            loadLesiones();

            // Maneja creación vía formulario inline
            document.getElementById('formCrearLesion')
                .addEventListener('submit', e => {
                    e.preventDefault();
                    const nombre = e.target.nombre.value.trim();
                    if (nombre) {
                        crearLesion(nombre);
                        e.target.reset();
                    }
                });

            // Delegación de eventos para Ver, Editar y Eliminar
            document.getElementById('tablaLesiones')
                .addEventListener('click', e => {
                    const id = e.target.dataset.id;
                    if (!id) return;

                    if (e.target.classList.contains('btn-ver')) {
                        window.location.href = `/admin/lesiones/${id}`;
                    }
                    if (e.target.classList.contains('btn-editar')) {
                        const current = e.target.closest('tr').querySelector('td').textContent;
                        const nuevo = prompt('Nuevo nombre:', current);
                        if (nuevo) actualizarLesion(id, nuevo.trim());
                    }
                    if (e.target.classList.contains('btn-eliminar')) {
                        eliminarLesion(id);
                    }
                });
        });
    })();
</script>
@endpush