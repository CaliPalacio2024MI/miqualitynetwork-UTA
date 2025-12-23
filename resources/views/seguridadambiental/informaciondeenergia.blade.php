@extends('layouts.dashboard')

@section('title', 'Información de Energía')
@vite(['resources/css/carpetas.css'])

@section('content')
    <div class="container mx-auto p-4">
        <div class="container mx-auto px-6 py-8 min-h-screen">
            <h2 class="text-2xl font-bold mb-6 bg-gray-300 text-center rounded-full py-3 px-6 shadow-md">
                Información de Energía
            </h2>

            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show text-center w-75" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- 🔹 Sección para mostrar Carpetas -->
            <div class="d-flex flex-wrap gap-3">
                @foreach ($carpetas as $carpeta)
                    @if (is_null($carpeta->parent_id)) {{-- Solo mostrar carpetas principales --}}
                        <div class="folder-container">
                            <a href="{{ route('informaciondeenergia.carpetas', ['carpeta_id' => $carpeta->id]) }}"
                               class="btn-carpeta">
                                <img src="{{ asset('images/carpeta.png') }}" alt="Carpeta" class="folder-icon">
                                <span>{{ $carpeta->nombre_carpeta }}</span>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>

            @if ($carpetas->isEmpty())
                <p class="text-center text-muted">No hay carpetas en esta subsección.</p>
            @endif
        </div>
    </div>
@endsection
